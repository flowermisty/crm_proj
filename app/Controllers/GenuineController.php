<?php

namespace App\Controllers;

use App\Models\NGenuineSearchModel;
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

        $model = new NOrderHistoryModel();
        $data = $model->getList($_GET['page']);


        echo view('genuine/templates/header');
        echo view('genuine/genuine_out',$data);
        echo view('genuine/templates/footer');
    }

    public function search(){
        helper(['form', 'alert']);
        $model = new NOrderHistoryModel();
        $searchModel = new NGenuineSearchModel();
        $db = \Config\Database::connect();
        $limitstart = ((int)$_GET['page']-1)*10;
        if($db->tableExists('genuine_search') && $this->request->getPost('searchObj')!=""){
            $forge = \Config\Database::forge();
            $forge->dropTable('genuine_search');
        }

        if ($this->request->getMethod() == 'post' && $this->request->getPost('searchObj')!="") {
            $searchObj = $this->request->getPost('searchObj');
            if($searchObj=="2"){
                $model->search($this->request->getPost('searchMain'));
            }else if($searchObj=="3"){
                $date = [
                    'serDate' => $this->request->getPost('serDate'),
                    'from' => $this->request->getPost('sPucDate'),
                    'to' => $this->request->getPost('ePucDate'),
                    ];
                $model->search($date);
            }else if($searchObj=="4"){
                $price = [
                    'sPrice' => $this->request->getPost('sPrice'),
                    'ePrice' => $this->request->getPost('ePrice'),
                ];
                $model->search($price);
            }else if($searchObj=="5"){
                $model->search($this->request->getPost('STATUS'));
            }else if($searchObj=="6"){
                $model->search($this->request->getPost('sellType'));
            }else if($searchObj=="7"){
                $model->search($this->request->getPost('InOut'));
            }else if($searchObj=="8"){
                $model->search($this->request->getPost('cabage'));
            }else if($searchObj=="9"){
                $model->search($this->request->getPost('xlsDown'));
            }else{
                alert_only('검색조건이 입력되지 않았습니다.');
            }

        }
        if($_GET['page']=="1" && $searchModel->findAll()){
            $data['orderList'] = $searchModel->orderBy('idx','desc')->findAll("10");
        }else{
            $data['orderList'] = $searchModel->orderBy('idx','desc')->findAll("10","$limitstart");
        }



        $data['user'] = $searchModel->paginate(10);
        $data['pager'] = $searchModel->pager;
        $data['signal'] = "search";

        echo view('genuine/templates/header');
        echo view('genuine/genuine_out',$data);
        echo view('genuine/templates/footer');


        }



}