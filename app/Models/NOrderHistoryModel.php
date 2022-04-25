<?php

namespace App\Models;
use CodeIgniter\Model;

class NOrderHistoryModel  extends Model{
    protected $table = 'nOrderHistory';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'oIdx','mIdx','cIdx','mName','bExp','mMail','mHp','mTel','channel','tEtc','purchaseCnt','tEa',
        'resultPrice','resultDiscountPrice','resultTotalPrice','payMent','reType','sellType','cabage','inCabage','InOut',
        'accountNo','bankName','tax','taxText','mBaby','mBabyCnt','pucDate','pucDate1','pucDate2','cashDate','finishDate',
        'preKind','preEa','preEtc','zip','zipcode3','addr1','addr2','addr3','orgGroup','employee','cPoint','refund','cTrans',
        'memo','amemo','oView','status','erpDown','traDown','daDown','getrans'
    ];

}

