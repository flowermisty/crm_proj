<?php

namespace App\Models;


use CodeIgniter\Model;
class NAdminModel extends Model
{
    protected $table = 'nAdmin';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'gPage',
        'aName',
        'aId',
        'aPwd',
        'erpCode',
        'purCode',
        'aCnt',
        'aPrice',
        'aIp',
        'orgCode',
        'aLoginday',
        'aPwdday',
        'aStatus',
    ];
}