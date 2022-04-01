<?php

namespace App\Controllers;


namespace App\Controllers;


use App\Models\AdminModel;
use App\Models\MemberListModel;

if(defined("BASEPATH")) { exit("No direct script access allowed"); }

class CustomerController extends BaseController{

    public function index($route_code){
        helper(['form', 'alert']);
        if( session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }
        define("IVENETCRMKEY", "ODU1NjM=");
        $db = \Config\Database::connect();

        $memberList = new MemberListModel();
        $adminList = new AdminModel();


        if($route_code == "all"){
            $data['memberList'] = $memberList->orderBy('idx','desc')->findAll('1000');
            $data['memberListHex'] = $memberList->select("AES_DECRYPT(UNHEX(hand), '".IVENETCRMKEY."') as hand")->orderBy('idx','desc')->findAll('1000');
        }else{
            $data['memberList'] = $memberList->where('rute_code',"{$route_code}")->orderBy('idx','desc')->findAll('1000');
            $data['memberListHex'] = $memberList->select("AES_DECRYPT(UNHEX(hand), '".IVENETCRMKEY."') as hand")->where('rute_code',"{$route_code}")->orderBy('idx','desc')->findAll('1000');
        }


        $cnt = count($data['memberList']);

        function dateBaby($startMonth) {
            //아기생일
            $start = str_replace("-", "", $startMonth);
            $babyYear = (int)(substr($start, 0, 4));
            $babyMonth = (int)(substr($start, 4, 2));
            $babyDay = (int)(substr($start, 6, 2));
            $startMonth = ($babyYear * 12) + $babyMonth + 1;

            //현재월
            $current = date("Ymd");
            $currentYear = (int)(substr($current, 0, 4));
            $currentMonth = (int)(substr($current, 4, 2));
            $currentDay = (int)(substr($current, 6, 2));
            $endMonth = ($currentYear * 12) + $currentMonth;

            $resultMonth = $endMonth - $startMonth;
            $resultMonth = floor($resultMonth);

            if (($currentDay - $babyDay) >= 0) $resultMonth++;
            if ($resultMonth <= 0) $resultMonth = "";
            if ($resultMonth >= 100) $resultMonth = "";



            return $resultMonth;
        }
        for ($i = 0; $i < $cnt; $i++){
            $data['memberList'][$i]['hand'] = $data['memberListHex'][$i]['hand'];

            $adminName = $db->query("select adminName from admin where adminId = '{$data['memberList'][$i]['adminId']}'");
            $data['adminName'] = $adminName->getRowArray();
            if($data['adminName']==null){
                $data['adminName']['adminName'] ="-";
            }

            $babyInfo = $db->query("select baby_name from baby_info where member_idx='{$data['memberList'][$i]['idx']}'");
            $data['babyName'] = $babyInfo->getRowArray();
            if(!$data['babyName']){
                $data['babyName']['baby_name'] = "-";
            }

            $babyInfo = $db->query("select chgPrd from baby_info where member_idx='{$data['memberList'][$i]['idx']}'");
            $data['chgPrd'] = $babyInfo->getRowArray();
            if(!$data['chgPrd']){
                $data['chgPrd']['chgPrd'] = "-";
            }

            $babyInfo = $db->query("select product_name from baby_info where member_idx='{$data['memberList'][$i]['idx']}'");
            $data['product_name'] = $babyInfo->getRowArray();
            if(!$data['product_name']){
                $data['product_name']['product_name'] = "-";
            }


            $babyInfo = $db->query("select baby_birth from baby_info where member_idx='{$data['memberList'][$i]['idx']}'");
            $data['baby_birth'] = $babyInfo->getRowArray();

            if(!$data['baby_birth']){
                $baby_mon = "0";
            }else{
                $baby_mon = dateBaby($data['baby_birth']['baby_birth']);
            }





            $data['memberList'][$i]['adminId'] = $data['adminName']['adminName'];
            $data['memberList'][$i]['babyName'] = $data['babyName'];
            $data['memberList'][$i]['chgPrd'] = $data['chgPrd'];
            $data['memberList'][$i]['product_name'] = $data['product_name'];
            $data['memberList'][$i]['baby_birth'] = $baby_mon;
            $data['route_code'] = $route_code;

        }



        echo view('customer/templates/header');
        echo view('customer/customerList',$data);
        echo view('customer/templates/footer');

        unset($data);
    }



}