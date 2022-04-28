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
        if($db->tableExists('genuine_search') && $this->request->getPost('searchMain')!=""){
            $forge = \Config\Database::forge();
            $forge->dropTable('genuine_search');
        }

        if ($this->request->getMethod() == 'post' && $this->request->getPost('searchMain')!="") {
            $model->search($this->request->getPost('searchMain'));
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