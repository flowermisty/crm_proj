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

}