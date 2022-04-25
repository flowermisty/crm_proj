<?php

namespace App\Controllers;

use App\Models\NOrderHistoryModel;

if (!defined("BASEPATH") && session()->has('aIdx') == "") {
    exit("No direct script access allowed");
}

class GenuineController extends BaseController
{
    public function index()
    {
        helper(['form', 'alert']);

        if( session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        define("IVENETCRMKEY", "ODU1NjM=");

        $limitstart = ((int)$_GET['page']-1)*10;
        $model = new NOrderHistoryModel();
        $select = [
            "idx",
            "cabage","InOut",
            "(select aName from nAdmin where idx = nOrderHistory.employee) as aName",
            "case when reType='D' then '직접' when reType='T' then '택배' end as reType",
            "resultTotalPrice","pucDate","pucDate1","sellType","mName",
            "AES_DECRYPT(UNHEX(mHp), '".IVENETCRMKEY."') as mHp",
            "status","traDown","erpDown","memo",
            "(SELECT prdName FROM nPrdInfo WHERE prdCode = npurPrd.prdCode) as prdName FROM `npurPrd` WHERE pView = 'Y'"
        ];



        if($_GET['page']=="1"){
            $data['orderList'] = $model->select($select)->orderBy('idx','desc')->findAll("10");
        }else{
            $data['orderList'] = $model->select($select)->orderBy('idx','desc')->findAll("10","$limitstart");
        }





        $data['user'] = $model->paginate(10);
        $data['pager'] = $model->pager;

        echo view('genuine/templates/header');
        echo view('genuine/genuine_out',$data);
        echo view('genuine/templates/footer');
    }
}