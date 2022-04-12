<?php

namespace App\Controllers;

use App\Models\NPrdInfoModel;

if(!defined("BASEPATH") && session()->has('aIdx') == "") {
    exit("No direct script access allowed");
}

class ProductManageController extends BaseController
{
    public function index()
    {
        helper(['form', 'alert']);
        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        $nprdInfo = new NPrdInfoModel();
        $db = \Config\Database::connect();

        $data = [];

        $SQL = $db->query("SELECT prdCode, prdName FROM nPrdInfo where 1 AND length(prdCode) = '3' AND viewYN = 'Y' AND cpYN = 'Y'");
        $data['product'] = $SQL->getResultArray();


        echo view('productManage/templates/header');
        echo view('productManage/productManage', $data);
        echo view('productManage/templates/footer');
    }

    public function loadSecond()
    {
        helper(['form', 'alert']);

        if ($this->request->getPost()) {
            $db = \Config\Database::connect();
            $cate1 = $this->request->getPost();
            $cate1Code = $cate1['cate1'][0];
            $SQL = $db->query("SELECT prdCode, prdName FROM nPrdInfo where 1 AND prdCode LIKE '{$cate1Code}%' AND length(prdCode) = '6'");
            $ROW = $SQL->getResultArray();
            return $this->response->setJSON($ROW);
        }
    }

    public function productInit()
    {
        helper(['form', 'alert']);

        $data = [];
        if ($this->request->getPost()) {
            $nprdInfo = new NPrdInfoModel();
            $cate2 = $this->request->getPost();
            $prdCode = $cate2['cate2'][0];
            $db = \Config\Database::connect();

            $data['prdinfo'] = $nprdInfo->where('prdCode', "{$prdCode}")->findAll();
            $SQL = $db->query("select coupangEa from nPrdInfoadd where idx = '{$data['prdinfo'][0]['idx']}'");
            $ROW = $SQL->getResultArray();
            $data['prdinfo'][0]['coupangEa'] = $ROW[0]['coupangEa'];
            return $this->response->setJSON($data);
        }
    }

    public function addNewCate1()
    {
        helper(['form', 'alert']);
        $db = \Config\Database::connect();
        $data = [];
        if ($this->request->getPost('cate1') == "addNewCate1") {
            $SQL = $db->query("SELECT prdCode, prdName FROM nPrdInfo where 1 AND length(prdCode) = '3' AND viewYN = 'Y' AND cpYN = 'Y' ORDER BY prdCode DESC LIMIT 1");
            $data['lastCateNum'] = $SQL->getResultArray();
            return $this->response->setJSON($data);
        }
    }

    public function addNewCate2()
    {
        helper(['form', 'alert']);
        $db = \Config\Database::connect();
        $data = [];
        $cate1 = $this->request->getPost('cate1')[0];

        if ($this->request->getPost('cate1')) {
            $SQL = $db->query("SELECT prdCode FROM nPrdInfo where 1 AND prdCode LIKE '{$cate1}%' AND length(prdCode) = '6' AND viewYN = 'Y' AND cpYN = 'Y' ORDER BY prdCode DESC LIMIT 1");
            $data['lastCateNum'] = $SQL->getResultArray();
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
                alert_move("선택하신 상품이 수정되었습니다.","http://godo.event.admin/product");
            }else{
                alert_move("수정에 문제가 있습니다. 관리자 에게 문의 주세요.","http://godo.event.admin/product");
            }


        }

    }


}