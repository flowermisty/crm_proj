<?php

namespace App\Controllers;


use App\Models\NAdminaddModel;
use App\Models\NAdminModel;

class LoginController extends BaseController
{
    public function index()
    {
        echo view('login/login');
    }

    public function loginInit()
    {
        $db = \Config\Database::connect();
        $ROW = [];
        foreach ($this->request->getPost() as $key => $val) {
            $ROW[$key] = htmlspecialchars($val);
        }
        $status = "";
        $msg = "";
        switch ($ROW["Mode"]) {
            //관리자 등록
            case "login" :

                foreach ($this->request->getPost() as $key => $val) {
                    $ROW[$key] = htmlspecialchars($val);

                }

                if ($ROW["user_id"] == "") {
                    $status = "FAIL";
                    $msg = "아이디를 입력 하세요!";
                    $data['STATUS'] = $status;
                    $data['MSG'] = $msg;
                    return $this->response->setJSON($data);
                    exit;
                }

                if ($ROW["user_pw"] == "") {
                    $status = "FAIL";
                    $msg = "비밀번호를 입력 하세요!";
                    $data['STATUS'] = $status;
                    $data['MSG'] = $msg;
                    return $this->response->setJSON($data);
                    exit;
                }

                $pw = md5($ROW['user_pw']);
                $SQL = $db->query("SELECT * FROM nAdmin WHERE 1  AND aId = '{$ROW['user_id']}' AND aPwd	= '{$pw}' AND aStatus = 'N'");
                $ROW1 = $SQL->getRowArray();

                if (!$ROW1) {
                    $status = "FAIL";
                    $msg = "관리자에게 문의주세요";
                    $data['STATUS'] = $status;
                    $data['MSG'] = $msg;
                    return $this->response->setJSON($data);
                    exit;

                } else if (count($ROW1) == "14") {

                    $session = session();
                    $loginSession = [
                        'aName' => $ROW1['aName'],
                        'aIdx' => $ROW1['idx'],
                        'orgCode' => $ROW1['orgCode'],
                    ];
                    $session->set($loginSession);


                    $SQL2 = $db->query("update nAdmin SET aLoginday = now() WHERE 1 AND idx = '{$ROW1['idx']}'");

                    if ($SQL2 == "1") {
                        $status = "SUC";
                        $msg = "로그인 성공했습니다.";
                        $data['STATUS'] = $status;
                        $data['MSG'] = $msg;
                        return $this->response->setJSON($data);
                        exit;
                    }
                }


        }
    }

    public function logOut()
    {
        helper(['form', 'alert']);
        if (session()->has('aIdx') != "") {
            session_destroy();
            alert_move("로그아웃 되었습니다. ", "http://godo.event.admin/");
        }

    }

    public function profile()
    {
        define("IVENETCRMKEY", "ODU1NjM=");
        helper(['form', 'alert']);
        $db = \Config\Database::connect();
        $encrypter = \Config\Services::encrypter();

        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        if (session()->has('aIdx') != "") {

            $SQL = $db->query("select * from nAdmin where idx='{$_SESSION['aIdx']}'");
            $ROW = $SQL->getRowArray();
            $data['nAdmin'] = $ROW;
            $SQL2 = $db->query("select * from nAdminadd where aIdx='{$_SESSION['aIdx']}'");
            $ROW2 = $SQL2->getRowArray();
            $data['nAdminadd'] = $ROW2;

            $SQL3 = $db->query("select AES_DECRYPT(UNHEX(Tel),'" . IVENETCRMKEY . "') as Tel,  
                                            AES_DECRYPT(UNHEX(Hp),'" . IVENETCRMKEY . "') as Hp, 
                                            AES_DECRYPT(UNHEX(eMail),'" . IVENETCRMKEY . "') as eMail
                                            from nAdminadd where aIdx='{$_SESSION['aIdx']}'");
            $ROW3 = $SQL3->getRowArray();
            $data['nAdminaddHex'] = $ROW3;


        }

        echo view('login/templates/header');
        echo view('login/profile', $data);
        echo view('login/templates/footer');
    }

    public function employeeRegist()
    {
        $db = \Config\Database::connect();
        helper(['form', 'alert']);
        define("IVENETCRMKEY", "ODU1NjM=");
        $data = [];
        $nAdmin = new NAdminModel();
        $nAdminAdd = new NAdminaddModel();
        if ($this->request->getMethod() == 'post') {
            $data['nAdmin'] = [
                "gPage" => $this->request->getVar('page'),
                "aName" => $this->request->getVar('name'),
                "aId" => $this->request->getVar('userId'),
                "aPwd" => $this->request->getVar('password'),
                "aIp" => "{$_SERVER['REMOTE_ADDR']}",
                "orgCode" => $this->request->getVar('part'),
            ];

            $db->query("INSERT INTO nAdmin(gPage, aName, aId, aPwd, aIp, orgCode) 
                                            values('{$data['nAdmin']['gPage']}', 
                                                   '{$data['nAdmin']['aName']}', 
                                                   '{$data['nAdmin']['aId']}', 
                                                   md5('{$data['nAdmin']['aPwd']}'), 
                                                       '{$data['nAdmin']['aIp']}', 
                                                       '{$data['nAdmin']['orgCode']}' )");

            $result = $nAdmin->select('*')->where('aId', "{$this->request->getVar('userId')}")->findAll();
            $data['nAdminadd'] = [
                'aIdx' => $result[0]['idx'],
                'Tel' => $this->request->getVar('tel'),
                'inTel' => $this->request->getVar('inTel'),
                'Hp' => $this->request->getVar('mobile'),
                'smsAgree' => $this->request->getVar('mobileAgree'),
                'eMail' => $this->request->getVar('email'),
                'inDate' => $this->request->getVar('inDate'),
                'zipCode' => $this->request->getVar('postNumber'),
                'adr1' => "",
                'adr2' => $this->request->getVar('address'),
                'adr3' => $this->request->getVar('addressDetail'),
                'aBirth' => $this->request->getVar('birth'),
                'grade' => $this->request->getVar('grade'),
                'regDate' => date('Y-m-d H:i:s'),
                'modifyDate' => date('Y-m-d H:i:s'),
                'dePwd' => $this->request->getVar('password')
            ];
            $db->query("INSERT INTO nAdminadd(aIdx,Tel,inTel,Hp,smsAgree,eMail,inDate,zipCode,adr1,adr2,adr3,aBirth,grade,regDate,modifyDate,dePwd) 
                                                    values( '{$data['nAdminadd']['aIdx']}', 
                                                           HEX(AES_ENCRYPT('{$data['nAdminadd']['Tel']}', '" . IVENETCRMKEY . "')), 
                                                           '{$data['nAdminadd']['inTel']}', 
                                                           HEX(AES_ENCRYPT('{$data['nAdminadd']['Hp']}', '" . IVENETCRMKEY . "')), 
                                                           '{$data['nAdminadd']['smsAgree']}', 
                                                           HEX(AES_ENCRYPT('{$data['nAdminadd']['eMail']}', '" . IVENETCRMKEY . "')), 
                                                           '{$data['nAdminadd']['inDate']}', 
                                                           '{$data['nAdminadd']['zipCode']}', 
                                                           '{$data['nAdminadd']['adr1']}', 
                                                           '{$data['nAdminadd']['adr2']}', 
                                                           '{$data['nAdminadd']['adr3']}', 
                                                           '{$data['nAdminadd']['aBirth']}', 
                                                           '{$data['nAdminadd']['grade']}', 
                                                           '{$data['nAdminadd']['regDate']}', 
                                                           '{$data['nAdminadd']['modifyDate']}', 
                                                           '{$data['nAdminadd']['dePwd']}') ");
            alert_move('등록 되었습니다. 관리자 승인을 받으세요 내선번호(426)', 'http://godo.event.admin/');


        }


    }


    public function employeeUpdate(){
        $db = \Config\Database::connect();
        helper(['form', 'alert']);
        define("IVENETCRMKEY", "ODU1NjM=");
        $data = [];
        $nAdmin = new NAdminModel();
        $nAdminAdd = new NAdminaddModel();

        if ($this->request->getMethod() == 'post') {
            $data['nAdmin'] = [
                "gPage" => $this->request->getVar('page'),
                "aName" => $this->request->getVar('name'),
                "aId" => $this->request->getVar('userId'),
                "aPwd" => $this->request->getVar('Password'),
                "erpCode"=>$this->request->getVar('employeeCode'),
                "aCnt"=>$this->request->getVar('saleCount'),
                "aPrice"=>$this->request->getVar('saleMoney'),
                "aIp" => "{$_SERVER['REMOTE_ADDR']}",
                "orgCode" => $this->request->getVar('part'),
                "aStatus" => $this->request->getVar('status')
            ];
            $_SESSION['aIdx'] = session()->get('aIdx');

            $db->query("update nAdmin set
                                            gPage = '{$data['nAdmin']['gPage']}',
                                            aPwd  =  md5('{$data['nAdmin']['aPwd']}'),
                                            erpCode = '{$data['nAdmin']['erpCode']}',
                                            aCnt = '{$data['nAdmin']['aCnt']}',
                                            aPrice ='{$data['nAdmin']['aPrice']}',
                                            aIp = '{$_SERVER['REMOTE_ADDR']}',
                                            orgCode = '{$data['nAdmin']['orgCode']}',
                                            aStatus = '{$data['nAdmin']['aStatus']}'
                                          where idx = '{$_SESSION['aIdx']}' ");

            $data['nAdminadd'] = [
                'aIdx' => $_SESSION['aIdx'],
                'Tel' => $this->request->getVar('tel'),
                'inTel' => $this->request->getVar('inTel'),
                'Hp' => $this->request->getVar('mobile'),
                'smsAgree' => $this->request->getVar('mobileAgree'),
                'eMail' => $this->request->getVar('email'),
                'inDate' => $this->request->getVar('hireDate'),
                'zipCode' => $this->request->getVar('postNumber'),
                'adr1' => "",
                'adr2' => $this->request->getVar('doroAddress'),
                'adr3' => $this->request->getVar('detailAddress'),
                'aBirth' => $this->request->getVar('birth'),
                'grade' => $this->request->getVar('grade'),
                'regDate' => date('Y-m-d H:i:s'),
                'modifyDate' => date('Y-m-d H:i:s'),
                'dePwd' => $this->request->getVar('Password')
            ];

            $db->query("update nAdminadd set
                                            Tel = HEX(AES_ENCRYPT('{$data['nAdminadd']['Tel']}', '" . IVENETCRMKEY . "')),
                                            inTel  =  '{$data['nAdminadd']['inTel']}',
                                            Hp = HEX(AES_ENCRYPT('{$data['nAdminadd']['Hp']}', '" . IVENETCRMKEY . "')),
                                            smsAgree = '{$data['nAdminadd']['smsAgree']}',
                                            eMail = HEX(AES_ENCRYPT('{$data['nAdminadd']['eMail']}', '" . IVENETCRMKEY . "')),
                                            inDate = '{$data['nAdminadd']['inDate']}',
                                            zipCode = '{$data['nAdminadd']['zipCode']}',
                                            adr2 = '{$data['nAdminadd']['adr2']}',
                                            adr3 = '{$data['nAdminadd']['adr3']}',
                                            aBirth = '{$data['nAdminadd']['aBirth']}',
                                            grade = '{$data['nAdminadd']['grade']}',
                                            modifyDate = '{$data['nAdminadd']['modifyDate']}',
                                            dePwd = '{$data['nAdminadd']['dePwd']}'
                                          where aIdx = '{$_SESSION['aIdx']}' ");


            alert_move('변경 되었습니다.', 'http://godo.event.admin/');
        }
    }

    public function IdDuplCheck(){
        if ($this->request->getMethod() == 'post') {
            $nAdmin = new NAdminModel();
            $data = [];
            $data['userId'] = $nAdmin->select('*')->where('aId',"{$this->request->getVar('userId')}")->findAll();
            if(!$data['userId']){
                $data['userId']="false";
            }
            return $this->response->setJSON($data);
        }
    }
}