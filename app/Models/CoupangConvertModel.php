<?php

namespace App\Models;


use CodeIgniter\Model;
class CoupangConvertModel extends Model
{
    protected $table = 'coupangConvert';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'no',
        'kind',
        'code',
        'prdName',
        'prdSize',
        'order',
        'posble',
        'posEa',
        'weight',
        'expiration',
        'warning',
    ];
}