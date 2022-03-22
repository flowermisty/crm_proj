<?php

namespace App\Models;


use CodeIgniter\Model;
class MartConvertModel
{
    protected $table = 'tmpMart';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'ldate',
        'store',
        'erpCode',
        'tax',
        'Ea',
        'Price',
        'tPrice',
        'bDate',
    ];
}