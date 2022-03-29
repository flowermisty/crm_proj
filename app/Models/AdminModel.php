<?php

namespace App\Models;


use CodeIgniter\Model;
class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'adminId',
        'adminPwd',
        'pwd_de',
        'adminName',
        'adminLevel',
        'use_grant',
        'employee_idx',
        'regist_id',
        'writeday',
        'modifyday',
        'ip_address',
        'flg_del',
        'adminMemo',
        'location',
    ];
}