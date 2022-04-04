<?php

namespace App\Controllers;

use App\Models\NPrdInfoModel;

class ProductManageController extends BaseController{
    public function index(){
        helper(['form', 'alert']);
        if( session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        $nprdInfo = new NPrdInfoModel();
        $db = \Config\Database::connect();

        $data=[];

        $SQL = $db->query("SELECT prdCode, prdName FROM nPrdInfo where 1 AND length(prdCode) = '3' AND viewYN = 'Y' AND cpYN = 'Y'");
        $data['product'] = $SQL->getResultArray();



        echo view('productManage/templates/header');
        echo view('productManage/productManage',$data);
        echo view('productManage/templates/footer');
    }

    public function loadSecond(){
        helper(['form', 'alert']);

        if($this->request->getPost()){
            $db = \Config\Database::connect();
            $cate1 = $this->request->getPost();
            $cate1Code = $cate1['cate1'][0];
            $SQL = $db->query("SELECT prdCode, prdName FROM nPrdInfo where 1 AND prdCode LIKE '{$cate1Code}%' AND length(prdCode) = '6'");
            $ROW = $SQL->getResultArray();
            return $this->response->setJSON($ROW);
        }


    }
}