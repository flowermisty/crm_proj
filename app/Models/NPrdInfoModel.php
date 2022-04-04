<?php

namespace App\Models;

use CodeIgniter\Model;

class NPrdInfoModel extends Model
{
    protected $table = 'nPrdInfo';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'idx',
        'prdCode',
        'prdName',
        'prdRName',
        'milkYN',
        'underYN',
        'pColor',
        'prdSize',
        'prdBox',
        'prdEa',
        'sellYN',
        'genuineYN',
        'erpCode',
        'prdPrice',
        'inSellYN',
        'sell18_sup',
        'sell18_tax',
        'sell18_tot',
        'sell30_sup',
        'sell30_tax',
        'sell30_tot',
        'sell50_sup',
        'sell50_tax',
        'sell50_tot',
        'tmYN',
        'prdBarcode',
        'lotCode',
        'homCode',
        'MGCode',
        'NHCode',
        'GSCode',
        'ELCode',
        'taxYN',
        'cpYN',
        'viewYN'
    ];
}