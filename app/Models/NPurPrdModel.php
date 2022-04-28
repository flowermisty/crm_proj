<?php

namespace App\Models;
use CodeIgniter\Model;

class NPurPrdModel  extends Model{
    protected $table = 'npurPrd';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "nIdx","prdCode","ea","Price","discount","dPrice","pView"
    ];

}
