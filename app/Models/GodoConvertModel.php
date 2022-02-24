<?php

namespace App\Models;

use CodeIgniter\Model;

class GodoConvertModel extends Model{
    protected $table = 'godoConvert';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'erpCode',
        'prdName',
        'cCode',
        'taxYN',
        'setYN',
        'viewYN',
        'price',
        'godoCode',
        'prdSubCode',
        'yieldUnder20',
        'yieldOver20',
    ];

}