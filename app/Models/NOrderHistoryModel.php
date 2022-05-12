<?php

namespace App\Models;

use CodeIgniter\Model;

class NOrderHistoryModel extends Model
{
    protected $table = 'nOrderHistory';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        'oIdx', 'mIdx', 'cIdx', 'mName', 'bExp', 'mMail', 'mHp', 'mTel', 'channel', 'tEtc', 'purchaseCnt', 'tEa',
        'resultPrice', 'resultDiscountPrice', 'resultTotalPrice', 'payMent', 'reType', 'sellType', 'cabage', 'inCabage', 'InOut',
        'accountNo', 'bankName', 'tax', 'taxText', 'mBaby', 'mBabyCnt', 'pucDate', 'pucDate1', 'pucDate2', 'cashDate', 'finishDate',
        'preKind', 'preEa', 'preEtc', 'zip', 'zipcode3', 'addr1', 'addr2', 'addr3', 'orgGroup', 'employee', 'cPoint', 'refund', 'cTrans',
        'memo', 'amemo', 'oView', 'status', 'erpDown', 'traDown', 'daDown', 'getrans'
    ];


    public function getList($page): array
    {
        $db = \Config\Database::connect();
        $model = new NOrderHistoryModel();

        $IVsellType = array("4" => "기부", "401" => "기부", "18" => "지인", "30" => "친인척", "50" => "직계", "101" => "홍보 > 체험단", "102" => "홍보 > 정품체험", "103" => "홍보 > 증정", "104" => "홍보 > CP 정품체험", "201" => "클레임 > 증정", "301" => "샘플 > 상담용", "302" => "샘플 > 연구용");
        $IVstatus = array("C" => "신청중", "I" => "임시저장", "P" => "신청접수", "J" => "주문완료", "S" => "재가요청", "A" => "재가완료", "E" => "구매완료", "R" => "환불완료", "T" => "출고완료", "B" => "ERP다운중");
        $IVcabage = array("C0001" => "충주 창고", "C0005" => "본사창고", "C0015" => "경기제품창고", "C0008" => "광주제품창고", "C0007" => "대구제품창고", "C0009" => "대전제품창고", "C0006" => "부산제품창고");

        define("IVENETCRMKEY", "ODU1NjM=");
        $select = [
            "idx",
            "cabage", "InOut",
            "(select aName from nAdmin where idx = nOrderHistory.employee) as aName",
            "case when reType='D' then '직접' when reType='T' then '택배' end as reType",
            "resultPrice", "pucDate", "pucDate1", "sellType", "mName",
            "AES_DECRYPT(UNHEX(mHp), '" . IVENETCRMKEY . "') as mHp",
            "status", "traDown", "erpDown", "memo",
        ];

        $limitstart = ((int)$_GET['page'] - 1) * 10;

        if ($page == "1") {
            $data['orderList'] = $model->select($select)->orderBy('idx', 'desc')->findAll("10");
            for ($i = 0; $i <= count($data['orderList']) - 1; $i++) {
                $SQL = $db->query("SELECT a.ea, b.prdRName
						                FROM
							                npurPrd a left outer join
							                nPrdInfo b ON a.prdCode = b.prdCode
						                WHERE 1
                                        AND a.pView = 'Y'
                                        AND a.nIdx ='{$data['orderList'][$i]['idx']}'");
                $ROW = $SQL->getRowArray();
                if (count($ROW) > 1) {
                    $etcPrdCnt = count($ROW) - 1;
                    $etcPrdName = " 외 " . $etcPrdCnt . " 건";
                } else {
                    $etcPrdName = "";
                }
                $prdName = $ROW['prdRName'] . " (" . $ROW['ea'] . " 개) " . $etcPrdName;
                $data['orderList'][$i]['prdRName'] = $prdName;
                $data['orderList'][$i]['status'] = $IVstatus["{$data['orderList'][$i]['status']}"];
                $data['orderList'][$i]['sellType'] = $IVsellType["{$data['orderList'][$i]['sellType']}"];
                $data['orderList'][$i]['cabage'] = $IVcabage["{$data['orderList'][$i]['cabage']}"];

            }
        } else {
            $data['orderList'] = $model->select($select)->orderBy('idx', 'desc')->findAll("10", "$limitstart");
            for ($i = 0; $i <= count($data['orderList']) - 1; $i++) {
                $SQL = $db->query("SELECT a.ea, b.prdRName
						                FROM
							                npurPrd a left outer join
							                nPrdInfo b ON a.prdCode = b.prdCode
						                WHERE 1
                                        AND a.pView = 'Y'
                                        AND a.nIdx ='{$data['orderList'][$i]['idx']}'");
                $ROW = $SQL->getRowArray();
                if (count($ROW) > 1) {
                    $etcPrdCnt = count($ROW) - 1;
                    $etcPrdName = " 외 " . $etcPrdCnt . " 건";
                } else {
                    $etcPrdName = "";
                }
                $prdName = $ROW['prdRName'] . " (" . $ROW['ea'] . " 개) " . $etcPrdName;
                $data['orderList'][$i]['prdRName'] = $prdName;
                $data['orderList'][$i]['status'] = $IVstatus["{$data['orderList'][$i]['status']}"];
                $data['orderList'][$i]['sellType'] = $IVsellType["{$data['orderList'][$i]['sellType']}"];
                $data['orderList'][$i]['cabage'] = $IVcabage["{$data['orderList'][$i]['cabage']}"];
            }
        }


        $data['user'] = $model->paginate(10);
        $data['pager'] = $model->pager;
        $data['signal'] = "list";

        return $data;
    }

    public function search($searchValue)
    {
        helper(['form', 'alert']);

        define("IVENETCRMKEY", "ODU1NjM=");

        $model = new NOrderHistoryModel();
        $searchModel = new NGenuineSearchModel();
        $db = \Config\Database::connect();


        $IVsellType = ["4" => "기부", "401" => "기부", "18" => "지인",
            "30" => "친인척", "50" => "직계", "101" => "홍보 > 체험단",
            "102" => "홍보 > 정품체험", "103" => "홍보 > 증정", "104" => "홍보 > CP 정품체험",
            "201" => "클레임 > 증정", "301" => "샘플 > 상담용", "302" => "샘플 > 연구용"];

        $IVstatus = ["C" => "신청중", "I" => "임시저장", "P" => "신청접수", "J" => "주문완료", "S" => "재가요청",
            "A" => "재가완료", "E" => "구매완료", "R" => "환불완료", "T" => "출고완료", "B" => "ERP다운중"];

        $IVcabage = ["C0001" => "충주 창고", "C0005" => "본사창고", "C0015" => "경기제품창고", "C0008" => "광주제품창고",
            "C0007" => "대구제품창고", "C0009" => "대전제품창고", "C0006" => "부산제품창고"];


        $query = "SELECT 
                        idx,cabage,`InOut`,(select aName from nAdmin where idx = nOrderHistory.employee) as aName, 
                        case when reType='D' then '직접' when reType='T' then '택배' end as reType,
                        resultPrice, pucDate, pucDate1, sellType, mName, AES_DECRYPT(UNHEX(mHp), '" . IVENETCRMKEY . "') as mHp, 
                        status, traDown, erpDown, memo 
                   FROM nOrderHistory";


        if ($searchValue['searchObj'] == "2") {
            $query .= " WHERE (select aName from nAdmin where idx = nOrderHistory.employee) = '{$searchValue['searchMain']}'
                       or mName = '{$searchValue['searchMain']}' or AES_DECRYPT(UNHEX(mHp), '" . IVENETCRMKEY . "') Like '%{$searchValue['searchMain']}%'
                       ORDER BY idx DESC ";
        } else if ($searchValue['searchObj'] == "3") {
            $query .= " WHERE `{$searchValue['serDate']}` BETWEEN  '{$searchValue['sPucDate']}' AND '{$searchValue['ePucDate']}' ORDER BY idx DESC ";
        } else if ($searchValue['searchObj'] == "4") {
            $query .= " WHERE resultPrice BETWEEN  '{$searchValue['sPrice']}' AND '{$searchValue['ePrice']}' ORDER BY idx DESC ";
        } else if ($searchValue['searchObj'] == "5") {
            $statusLength = count($searchValue['STATUS']);
            for ($i = 0; $i < $statusLength; $i++) {
                if ($searchValue['STATUS'][$i] && $i == 0) {
                    $query .= " WHERE status = '{$searchValue['STATUS'][$i]}'";
                }
                if ($searchValue['STATUS'][$i] && $i != 0) {
                    $query .= " OR status = '{$searchValue['STATUS'][$i]}'";
                }
            }
            $query .= " ORDER BY idx DESC ";

        } else if ($searchValue['searchObj'] == "6") {
            $useLength = count($searchValue['sellType']);
            for ($i = 0; $i < $useLength; $i++) {
                if ($searchValue['sellType'][$i] && $i == 0) {
                    $query .= " WHERE sellType = '{$searchValue['sellType'][$i]}'";
                }
                if ($searchValue['sellType'][$i] && $i != 0) {
                    $query .= " OR sellType = '{$searchValue['sellType'][$i]}'";
                }
            }
            $query .= " ORDER BY idx DESC ";

        } else if ($searchValue['searchObj'] == "7") {
            $inOutLength = count($searchValue['InOut']);
            for ($i = 0; $i < $inOutLength; $i++) {
                if ($searchValue['InOut'][$i] && $i == 0) {
                    $query .= " WHERE `InOut` = '{$searchValue['InOut'][$i]}'";
                }
                if ($searchValue['InOut'][$i] && $i != 0) {
                    $query .= " OR `InOut` = '{$searchValue['InOut'][$i]}'";
                }
            }
            $query .= "  ORDER BY idx DESC ";

        } else if ($searchValue['searchObj'] == "8") {
            $cabageLength = count($searchValue['cabage']);
            for ($i = 0; $i < $cabageLength; $i++) {
                if ($searchValue['cabage'][$i] && $i == 0) {
                    $query .= " WHERE cabage = '{$searchValue['cabage'][$i]}'";
                }
                if ($searchValue['cabage'][$i] && $i != 0) {
                    $query .= " OR cabage = '{$searchValue['cabage'][$i]}'";
                }
            }
            $query .= " ORDER BY idx DESC ";
        } else if ($searchValue['searchObj'] == "9") {
            $query .= " WHERE erpDown = '{$searchValue['xlsDown']}'  ORDER BY idx DESC ";
        } else {

        }


        $SQL = $db->query($query);
        $data['orderList'] = $SQL->getResultArray();
        $cnt = count($data['orderList']);

        if ($data['orderList']) {
            $model->createSearchTable();
        } else {
            alert_move("검색 결과가 없습니다!", "http://godo.event.admin/genuine_out?page=1");
        }


        if ($cnt > 10000) {
            alert_only("검색결과가 너무 많습니다. 최근 10000건 까지 검색됩니다.");
            for ($i = 0; $i < 10000; $i++) {
                $SQL = $db->query("SELECT a.ea, b.prdRName
						                FROM
							                npurPrd a left outer join
							                nPrdInfo b ON a.prdCode = b.prdCode
						                WHERE 1
                                        AND a.pView = 'Y'
                                        AND a.nIdx ='{$data['orderList'][$i]['idx']}'");
                $ROW = $SQL->getRowArray();
                if (!$ROW) {
                    continue;
                }
                if (count($ROW) > 1) {
                    $etcPrdCnt = count($ROW) - 1;
                    $etcPrdName = " 외 " . $etcPrdCnt . " 건";
                } else {
                    $etcPrdName = "";
                }
                $prdName = $ROW['prdRName'] . " (" . $ROW['ea'] . " 개) " . $etcPrdName;
                $data['orderList'][$i]['prdRName'] = $prdName;
                $statusFlag = in_array("{$data['orderList'][$i]['status']}", $IVstatus);
                $sellTypeFlag = in_array("{$data['orderList'][$i]['sellType']}", $IVsellType);
                $cabageFlag = in_array("{$data['orderList'][$i]['sellType']}", $IVsellType);

                if ($statusFlag == true) {
                    $data['orderList'][$i]['status'] = $IVstatus["{$data['orderList'][$i]['status']}"];
                }
                if ($sellTypeFlag == true) {
                    $data['orderList'][$i]['sellType'] = $IVsellType["{$data['orderList'][$i]['sellType']}"];
                }
                if ($cabageFlag == true) {
                    $data['orderList'][$i]['cabage'] = $IVcabage["{$data['orderList'][$i]['cabage']}"];
                }


                $searchModel->insert($data['orderList'][$i]);

            }
        } else {
            for ($i = 0; $i < $cnt; $i++) {
                $SQL = $db->query("SELECT a.ea, b.prdRName
						                FROM
							                npurPrd a left outer join
							                nPrdInfo b ON a.prdCode = b.prdCode
						                WHERE 1
                                        AND a.pView = 'Y'
                                        AND a.nIdx ='{$data['orderList'][$i]['idx']}'");
                $ROW = $SQL->getRowArray();
                if (!$ROW) {
                    continue;
                }
                if (count($ROW) > 1) {
                    $etcPrdCnt = count($ROW) - 1;
                    $etcPrdName = " 외 " . $etcPrdCnt . " 건";
                } else {
                    $etcPrdName = "";
                }
                $prdName = $ROW['prdRName'] . " (" . $ROW['ea'] . " 개) " . $etcPrdName;
                $data['orderList'][$i]['prdRName'] = $prdName;
                $statusFlag = array_key_exists("{$data['orderList'][$i]['status']}", $IVstatus);
                $sellTypeFlag = array_key_exists("{$data['orderList'][$i]['sellType']}", $IVsellType);
                $cabageFlag = array_key_exists("{$data['orderList'][$i]['sellType']}", $IVsellType);

                if ($statusFlag) {
                    $data['orderList'][$i]['status'] = $IVstatus["{$data['orderList'][$i]['status']}"];
                }
                if ($sellTypeFlag) {
                    $data['orderList'][$i]['sellType'] = $IVsellType["{$data['orderList'][$i]['sellType']}"];
                }
                if ($cabageFlag) {
                    $data['orderList'][$i]['cabage'] = $IVcabage["{$data['orderList'][$i]['cabage']}"];
                }


                $searchModel->insert($data['orderList'][$i]);

            }
        }


    }


    public function reSearch($searchValue){
        helper(['form', 'alert']);

        $searchModel = new NGenuineSearchModel();
        $db = \Config\Database::connect();

        $query = "SELECT * FROM genuine_search";

        $IVsellType = ["4" => "기부", "401" => "기부", "18" => "지인",
            "30" => "친인척", "50" => "직계", "101" => "홍보 > 체험단",
            "102" => "홍보 > 정품체험", "103" => "홍보 > 증정", "104" => "홍보 > CP 정품체험",
            "201" => "클레임 > 증정", "301" => "샘플 > 상담용", "302" => "샘플 > 연구용"];

        $IVstatus = ["C" => "신청중", "I" => "임시저장", "P" => "신청접수", "J" => "주문완료", "S" => "재가요청",
            "A" => "재가완료", "E" => "구매완료", "R" => "환불완료", "T" => "출고완료", "B" => "ERP다운중"];

        $IVcabage = ["C0001" => "충주 창고", "C0005" => "본사창고", "C0015" => "경기제품창고", "C0008" => "광주제품창고",
            "C0007" => "대구제품창고", "C0009" => "대전제품창고", "C0006" => "부산제품창고"];

        if ($searchValue['searchObj'] == "2") {
            $query .= " WHERE aName = '{$searchValue['searchMain']}'
                       or mName = '{$searchValue['searchMain']}' or mHp Like '%{$searchValue['searchMain']}%'
                       ORDER BY idx DESC ";
        } else if ($searchValue['searchObj'] == "3") {
            $query .= " WHERE `{$searchValue['serDate']}` BETWEEN  '{$searchValue['sPucDate']}' AND '{$searchValue['ePucDate']}' ORDER BY idx DESC ";
        } else if ($searchValue['searchObj'] == "4") {
            $query .= " WHERE resultPrice BETWEEN  '{$searchValue['sPrice']}' AND '{$searchValue['ePrice']}' ORDER BY idx DESC ";
        } else if ($searchValue['searchObj'] == "5") {
            $statusLength = count($searchValue['STATUS']);
            for ($i = 0; $i < $statusLength; $i++) {
                if ($searchValue['STATUS'][$i] && $i == 0) {
                    $query .= " WHERE status = '{$IVstatus[$searchValue['STATUS'][$i]]}'";
                }
                if ($searchValue['STATUS'][$i] && $i != 0) {
                    $query .= " OR status = '{$IVstatus[$searchValue['STATUS'][$i]]}'";
                }
            }
            $query .= " ORDER BY idx DESC ";

        } else if ($searchValue['searchObj'] == "6") {
            $useLength = count($searchValue['sellType']);
            for ($i = 0; $i < $useLength; $i++) {
                if ($searchValue['sellType'][$i] && $i == 0) {
                    $query .= " WHERE sellType = '{$IVsellType[$searchValue['sellType'][$i]]}'";
                }
                if ($searchValue['sellType'][$i] && $i != 0) {
                    $query .= " OR sellType = '{$IVsellType[$searchValue['sellType'][$i]]}'";
                }
            }
            $query .= " ORDER BY idx DESC ";

        } else if ($searchValue['searchObj'] == "7") {
            $inOutLength = count($searchValue['InOut']);
            for ($i = 0; $i < $inOutLength; $i++) {
                if ($searchValue['InOut'][$i] && $i == 0) {
                    $query .= " WHERE `InOut` = '{$searchValue['InOut'][$i]}'";
                }
                if ($searchValue['InOut'][$i] && $i != 0) {
                    $query .= " OR `InOut` = '{$searchValue['InOut'][$i]}'";
                }
            }
            $query .= "  ORDER BY idx DESC ";

        } else if ($searchValue['searchObj'] == "8") {
            $cabageLength = count($searchValue['cabage']);
            for ($i = 0; $i < $cabageLength; $i++) {
                if ($searchValue['cabage'][$i] && $i == 0) {
                    $query .= " WHERE cabage = '{$IVcabage[$searchValue['cabage'][$i]]}'";
                }
                if ($searchValue['cabage'][$i] && $i != 0) {
                    $query .= " OR cabage = '{$IVcabage[$searchValue['cabage'][$i]]}'";
                }
            }
            $query .= " ORDER BY idx DESC ";
        } else if ($searchValue['searchObj'] == "9") {
            $query .= " WHERE erpDown = '{$searchValue['xlsDown']}'  ORDER BY idx DESC ";
        } else {

        }

        $SQL = $db->query($query);
        $data['orderList'] = $SQL->getResultArray();
        return  $data['orderList'];



    }


    public function getCartegory(){
        $model = new NPrdInfoModel();
        $cate1 = $model->select("prdCode, prdName")->where("length(prdCode)","3")
                        ->where("sellYN","Y")
                        ->where("viewYN","Y")
                        ->findAll();
        return $cate1;
    }


    public function createSearchTable()
    {
        $forge = \Config\Database::forge();
        $fields = [
            'idx' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'cabage' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,

            ],
            'InOut' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'aName' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'reType' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'resultPrice' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'pucDate' => [
                'type' => 'Timestamp',
                'null' => TRUE,
            ],
            'pucDate1' => [
                'type' => 'Timestamp',
                'null' => TRUE,
            ],
            'sellType' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'mName' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'mHp' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'traDown' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'erpDown' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'memo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],
            'prdRName' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ],

        ];
        $forge->addField($fields);
        $forge->addKey('idx');
        $forge->createTable("genuine_search");
    }


}

