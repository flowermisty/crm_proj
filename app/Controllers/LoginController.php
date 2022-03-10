<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function index(){
        echo view('login/login');
    }

    public function loginInit(){

        $db = \Config\Database::connect();
        $ROW=[];
        foreach($this->request->getPost() as $key=>$val) {
            $ROW[$key] = htmlspecialchars($val);
        }
        $status="";
        $msg="";
        switch($ROW["Mode"]) {
            //관리자 등록
            case "login" :

                foreach($this->request->getPost() as $key=>$val) {
                    $ROW[$key] = htmlspecialchars($val);

                }

                if($ROW["user_id"] == "") {
                    $status = "FAIL";
                    $msg	= "아이디를 입력 하세요!";
                    $data['STATUS'] = $status;
                    $data['MSG'] = $msg;
                    return $this->response->setJSON($data);
                    exit;
                }

                if($ROW["user_pw"] == "") {
                    $status = "FAIL";
                    $msg	= "비밀번호를 입력 하세요!";
                    $data['STATUS'] = $status;
                    $data['MSG'] = $msg;
                    return $this->response->setJSON($data);
                    exit;
                }

                $pw	= md5($ROW['user_pw']);
                $SQL = $db->query("SELECT * FROM nAdmin WHERE 1  AND aId = '{$ROW['user_id']}' AND aPwd	= '{$pw}' AND aStatus = 'N'");
                $ROW1 = $SQL->getRowArray();

                if(!$ROW1) {
                    $status = "FAIL";
                    $msg = "관리자에게 문의주세요";
                    $data['STATUS'] = $status;
                    $data['MSG'] = $msg;
                    return $this->response->setJSON($data);
                    exit;

                } else if(count($ROW1)=="14"){

                    $session = session();
                    $loginSession= [
                        'aName' => $ROW1['aName'],
                        'aIdx' => $ROW1['idx'],
                        'orgCode' => $ROW1['orgCode'],
                    ];
                    $session->set($loginSession);



                    $SQL2 = $db->query("update nAdmin SET aLoginday = now() WHERE 1 AND idx = '{$ROW1['idx']}'");

                    if($SQL2 == "1") {
                        $status	= "SUC";
                        $msg = "로그인 성공했습니다.";
                        $data['STATUS'] = $status;
                        $data['MSG'] = $msg;
                        return $this->response->setJSON($data);
                        exit;
                    }
                }





        }
    }

    public function logOut(){
        helper(['form', 'alert']);
        if( session()->has('aIdx') != "") {
            session_destroy();
            alert_move("로그아웃 되었습니다. ", "http://godo.event.admin/");
        }

    }

    public function profile(){
        define("IVENETCRMKEY","ODU1NjM=");
        helper(['form', 'alert']);
        $db = \Config\Database::connect();

        if( session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        if( session()->has('aIdx') != ""){

            $SQL = $db->query("select * from nAdmin where idx='{$_SESSION['aIdx']}'");
            $ROW = $SQL->getRowArray();
            $data['nAdmin'] = $ROW;
            $SQL2 = $db->query("select * from nAdminadd where aIdx='{$_SESSION['aIdx']}'");
            $ROW2 = $SQL2->getRowArray();
            $data['nAdminadd']=$ROW2;
            $SQL3 = $db ->query("select AES_DECRYPT(UNHEX(Tel),'".IVENETCRMKEY."') as Tel,  
                                            AES_DECRYPT(UNHEX(Hp),'".IVENETCRMKEY."') as Hp, 
                                            AES_DECRYPT(UNHEX(eMail),'".IVENETCRMKEY."') as eMail
                                            from nAdminadd where aIdx='{$_SESSION['aIdx']}'");
            $ROW3 = $SQL3->getRowArray();
            $data['nAdminaddHex']=$ROW3;
        }

        echo view('login/templates/header');
        echo view('login/profile',$data);
        echo view('login/templates/footer');
    }
}