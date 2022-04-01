<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberListModel extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'mem_idx',
        'regist_rute',
        'name',
        'userid',
        'pwd',
        'email',
        'zip',
        'address1',
        'address2',
        'address3',
        'hand',
        'point',
        'rute_code',
        'regist_idx',
        'employee_idx',
        'adminId',
        'classYN',
    ];

}