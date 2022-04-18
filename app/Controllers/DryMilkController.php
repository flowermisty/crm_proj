<?php

namespace App\Controllers;

use App\Models\NPrdInfoModel;

if (!defined("BASEPATH") && session()->has('aIdx') == "") {
    exit("No direct script access allowed");
}

class DryMilkController extends BaseController
{

    public function index()
    {
        helper(['form', 'alert']);
        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }
        $data = [];
        $model = new NPrdInfoModel();
        $data['cate1'] = $model->dryMilkLoadCate1();


        echo view('dryMilk/templates/header');
        echo view('dryMilk/dryMilk',$data);
        echo view('dryMilk/templates/footer');
    }

    public function loadSecond(){
        $model = new NPrdInfoModel();
        if ($this->request->getPost()) {
            $cate1 = $this->request->getPost();
            $cate1Code = $cate1['cate1'][0];
            $ROW = $model->dryMilkLoadCate2($cate1Code);
            return $this->response->setJSON($ROW);
        }
    }

    public function productInit(){
        $data=[];
        if($this->request->getPost()){
            $nprdInfo = new NPrdInfoModel();
            $data['prdInfo'] = $nprdInfo->where("prdCode","{$this->request->getPost()['cate2'][0]}")->find();
            return $this->response->setJSON($data);
        }


    }

    public function addNewCate1(){
        $data = [];
        if ($this->request->getPost('cate1') == "addNewCate1") {
            $nprdInfo = new NPrdInfoModel();
            $cate1 = $this->request->getPost('cate1');
            $data['lastCateNum'] = $nprdInfo->addNewCate($cate1);
            return $this->response->setJSON($data);
        }
    }

    public function addNewCate2(){
        helper(['form', 'alert']);
        $cate1 = $this->request->getPost('cate1')[0];
        $nprdInfo = new NPrdInfoModel();
        if ($this->request->getPost('cate1')) {
            $data['lastCateNum'] = $nprdInfo->addNewProduct($cate1);
            if(!$data['lastCateNum']){
                $data['lastCateNum'][0]['prdCode'] = "$cate1"."001";
            }
            return $this->response->setJSON($data);
        }
    }


    public function update()
    {
        helper(['form', 'alert']);
        $nPrdInfo = new NPrdInfoModel();
        if ($this->request->getMethod() == 'post') {
            $dataNprdInfo = $this->request->getPost();
            $result = $nPrdInfo->nPrdInfoUpdate($dataNprdInfo);
            if($result){
                alert_move("선택하신 상품이 수정되었습니다.","http://godo.event.admin/drymilk");
            }else{
                alert_move("수정에 문제가 있습니다. 관리자 에게 문의 주세요.","http://godo.event.admin/drymilk");
            }


        }

    }

    public function delete(){
        helper(['form', 'alert']);
        $nPrdInfo = new NPrdInfoModel();
        if($this->request->getMethod() == 'post'){
            $dataNprdInfo = $this->request->getPost();
            $result = $nPrdInfo->nPrdInfoDelete($dataNprdInfo);
            if($result){
                alert_move("선택하신 상품({$dataNprdInfo['prdRname']})이 삭제 되었습니다.","http://godo.event.admin/drymilk");
            }else{
                alert_move("상품 삭제에 문제가 있습니다. 관리자 에게 문의 주세요.","http://godo.event.admin/drymilk");
            }
        }
    }

}