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

    public function productInit(){
        helper(['form', 'alert']);

        $data=[];
        if($this->request->getPost()){
            $nprdInfo = new NPrdInfoModel();
            $cate2 = $this->request->getPost();
            $prdCode = $cate2['cate2'][0];
            $db = \Config\Database::connect();

            $data['prdinfo'] = $nprdInfo->where('prdCode',"{$prdCode}")->findAll();
            $SQL = $db->query("select coupangEa from nPrdInfoadd where idx = '{$data['prdinfo'][0]['idx']}'");
            $ROW = $SQL->getResultArray();
            $data['prdinfo'][0]['coupangEa'] = $ROW[0]['coupangEa'];
            return $this->response->setJSON($data);
        }
    }

    public function addNewCate1(){
        helper(['form', 'alert']);
        $db = \Config\Database::connect();
        $data=[];
        if($this->request->getPost('cate1')=="addNewCate1"){
            $SQL = $db->query("SELECT prdCode, prdName FROM nPrdInfo where 1 AND length(prdCode) = '3' AND viewYN = 'Y' AND cpYN = 'Y' ORDER BY prdCode DESC LIMIT 1");
            $data['lastCateNum'] = $SQL->getResultArray();
            return $this->response->setJSON($data);
        }
    }

    public function addNewCate2(){
        helper(['form', 'alert']);
        $db = \Config\Database::connect();
        $data=[];
        $cate1 = $this->request->getPost('cate1')[0];

        if($this->request->getPost('cate1')){
            $SQL = $db->query("SELECT prdCode FROM nPrdInfo where 1 AND prdCode LIKE '{$cate1}%' AND length(prdCode) = '6' AND viewYN = 'Y' AND cpYN = 'Y' ORDER BY prdCode DESC LIMIT 1");
            $data['lastCateNum'] = $SQL->getResultArray();
            return $this->response->setJSON($data);
        }
    }



    public function update(){
        helper(['form', 'alert']);
        $dataNprdInfo = [];
        $dataNprdInfoAdd =[];
        $nPrdInfo = new NPrdInfoModel();
        if($this->request->getMethod() == 'post'){
            $dataNprdInfo = $this->request->getPost();
            $dataNprdInfoAdd['prdBarcode'] = $dataNprdInfo['prdBarcode'];
            $dataNprdInfoAdd['coupangEa'] = $dataNprdInfo['coupangEa'];
            $dataNprdInfo['sell18_tot'] = $this->request->getPost('sell18_tot');
            $dataNprdInfo['sell18_sup'] = $this->request->getPost('sell18_sup');
            $dataNprdInfo['sell18_tax'] = $this->request->getPost('sell18_tax');
            $dataNprdInfo['sell30_tot'] = $this->request->getPost('sell30_tot');
            $dataNprdInfo['sell30_sup'] = $this->request->getPost('sell30_sup');
            $dataNprdInfo['sell30_tax'] = $this->request->getPost('sell30_tax');
            $dataNprdInfo['sell50_tot'] = $this->request->getPost('sell50_tot');
            $dataNprdInfo['sell50_sup'] = $this->request->getPost('sell50_sup');
            $dataNprdInfo['sell50_tax'] = $this->request->getPost('sell50_tax');
            unset($dataNprdInfo['coupangEa']);
            unset($dataNprdInfo['honeypot']);
            $nPrdInfo -> update("{$dataNprdInfo['idx']}",$dataNprdInfo);
            alert_move("선택하신 품목 \"{$dataNprdInfo['prdRname']}\" 이(가) 수정 되었습니다.",'http://godo.event.admin/product');

        }

    }


}