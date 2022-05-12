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

        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        $model = new NOrderHistoryModel();
        $data = $model->getList($_GET['page']);
        $data['category'] = $model->getCartegory();

        echo view('genuine/templates/header');
        echo view('genuine/main/genuine_out', $data);
        echo view('genuine/templates/footer');
    }

    public function search()
    {
        helper(['form', 'alert']);

        $model = new NOrderHistoryModel();
        $searchModel = new NGenuineSearchModel();
        $db = \Config\Database::connect();

        $limitstart = ((int)$_GET['page'] - 1) * 10;


        $searchValue = $this->request->getPost();


        /**
         * @section 테이블 생성 여부  / 새로운 검색 키워드 판별
         *                  - $db->tableExists('genuine_search')
         *                    가. 테이블의 존재 여부를 확인 한다.
         *                  - $this->request->getPost('searchObj')!=""
         *                    가. 검색 키워드의 유형이 무엇인지 판별하는 셀렉트값
         *                    나. 해당 값이 새로 전송되었다는 것은, 새로운 검색 키워드가
         *                        입력 되었음을 의미한다.
         *                  - 조건문의 두 AND 조건을 만족하면, 기존재하는 테이블을 삭제 하고,
         *                    새로 태이블을 생성할 준비를 한다.
         */
        if ($db->tableExists('genuine_search') && $this->request->getPost('searchObj') != "") {
            $forge = \Config\Database::forge();
            $forge->dropTable('genuine_search');
        }

        if ($this->request->getMethod() == 'post' && $this->request->getPost('searchObj') != "") {
            $model->search($searchValue);
        }
        if ($_GET['page'] == "1" && $searchModel->findAll()) {
            $data['orderList'] = $searchModel->orderBy('idx', 'desc')->findAll("10");
        } else {
            $data['orderList'] = $searchModel->orderBy('idx', 'desc')->findAll("10", "$limitstart");
        }


        $data['user'] = $searchModel->paginate(10);
        $data['pager'] = $searchModel->pager;
        $data['signal'] = "search";

        echo view('genuine/templates/header');
        echo view('genuine/search/search', $data);
        echo view('genuine/templates/footer');




    }

    public function resultSearch(){
        helper(['form', 'alert']);

        $model = new NOrderHistoryModel();
        $searchModel = new NGenuineSearchModel();

        $data = [];

        $searchValue = $this->request->getPost();



        $data['signal'] = "research";
        $data['orderList'] = $model->reSearch($searchValue);





        echo view('genuine/templates/header');
        echo view('genuine/research/research', $data);
        echo view('genuine/templates/footer');


    }

    public function getCategory(){
        $model = new NOrderHistoryModel();
        $model->getCartegory();
    }


}