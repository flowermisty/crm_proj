<?php

namespace App\Models;
use CodeIgniter\Model;

class NGenuineSearchModel extends Model{
    protected $table = 'genuine_search';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'idx','cabage','InOut','aName','reType','resultPrice','pucDate','pucDate1','sellType','mName','mHp','status',
        'traDown','erpDown','resultTotalPrice','memo','prdRName',
    ];
}