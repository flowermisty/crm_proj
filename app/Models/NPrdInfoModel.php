<?php

namespace App\Models;


use CodeIgniter\Model;


use App\Libraries\CustomDB;

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

    /**
     * @param string $primaryKey
     */
    public function setPrimaryKey(string $primaryKey)
    {
        $this->primaryKey = $primaryKey;

    }

    /**
     * @param string[] $allowedFields
     */

    public function setAllowedFields(array $allowedFields)
    {
        $this->allowedFields = $allowedFields;

    }

    /**
     * @return string[]
     */
    public function getAllowedFields(): array
    {
        return $this->allowedFields;
    }

    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    public function nPrdInfoUpdate(array $data):bool{
        $model = new NPrdInfoModel();
        unset($data['honeypot']);
        unset($data['coupangEa']);
        $this->setPrimaryKey($data['idx']);
        $this->setAllowedFields($data);
        $idx = $this->getPrimaryKey();
        $allowedFields = $this->getAllowedFields();
        $result = $model->update("$idx",$allowedFields);
        return $result;
    }

    public function nPrdInfoInsert(array $data):bool{
        $model = new NPrdInfoModel();
        unset($data['honeypot']);
        unset($data['coupangEa']);
        $this->setAllowedFields($data);
        $allowedFields = $this->getAllowedFields();
        $result = $model->insert($allowedFields);
        return $result;
    }

    public function nPrdInfoDelete(array $data):bool{
        $model = new NPrdInfoModel();
        unset($data['honeypot']);
        unset($data['coupangEa']);
        $data['viewYN'] = 'N';
        $this->setPrimaryKey($data['idx']);
        $this->setAllowedFields($data);
        $idx=$this->getPrimaryKey();
        $allowedFields = $this->getAllowedFields();
        $result = $model->update("$idx",$allowedFields);
        return $result;
    }

    public function dryMilkLoadCate1():array{
        $model = new NPrdInfoModel();
        $cate1 = $model->select("prdCode, prdName")->where("length(prdCode)","3")
                                                        ->where("sellYN","Y")
                                                        ->where("viewYN","Y")
                                                        ->where("milkYN","Y")->findAll();
        return $cate1;
    }

    public function dryMilkLoadCate2(string $cate1):array{
        $model = new NPrdInfoModel();
        $cate2 = $model->select("prdCode, prdRName")->where("left(prdCode,3)","$cate1")
                                                        ->where("length(prdCode)","6")
                                                        ->where("sellYN","Y")
                                                        ->where("viewYN","Y")
                                                        ->where("milkYN","Y")->findAll();
        return $cate2;

    }


}