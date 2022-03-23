<?php

namespace App\Controllers;


namespace App\Controllers;

use App\Models\NAdminModel;
use App\Models\NAdminaddModel;

if(defined("BASEPATH")) { exit("No direct script access allowed"); }

class EmployeeController extends BaseController{

    public function index(){
        helper(['form', 'alert']);
        if( session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }
        define("IVENETCRMKEY", "ODU1NjM=");
        $nadmin = new NAdminModel();
        $nadminAdd = new NAdminaddModel();
        $db = \Config\Database::connect();
        $query = $db->query("select na.aName, na.aId, na.orgCode, nd.grade, nd.inTel, AES_DECRYPT(UNHEX(nd.eMail),'" . IVENETCRMKEY . "') as eMail 
                                 from nAdmin as na left join nAdminadd as nd  on na.idx = nd.aIdx 
                                 ORDER BY na.idx DESC");
        $data['nadmin'] = $query->getResultArray();

        echo view('employee/templates/header');
        echo view('employee/employeeList',$data);
        echo view('employee/templates/footer');
    }

}