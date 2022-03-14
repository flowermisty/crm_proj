<?php

namespace App\Models;

use CodeIgniter\Model;

class NAdminaddModel extends Model
{
    protected $table = 'nAdminadd';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'aIdx',
        'Tel',
        'inTel',
        'Hp',
        'smsAgree',
        'eMail',
        'inDate',
        'zipCode',
        'adr1',
        'adr2',
        'adr3',
        'aBirth',
        'grade',
        'regDate',
        'modifyDate',
        'dePwd',
    ];
}