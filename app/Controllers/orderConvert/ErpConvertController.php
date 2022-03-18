<?php

namespace App\Controllers\orderConvert;

use \CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;


require ROOTPATH . 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class MyReadFilter implements IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        // Read rows 1 to 7 and columns A to E only
        if (in_array($column, range('A', "Z"))) {
            return true;
        }
        return false;
    }
}


class ErpConvertController extends \App\Controllers\BaseController
{

    protected $helpers = ['form'];

    public function index()
    {
        helper(['form', 'alert']);

        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        echo view('orderConvert/templates/header');
        echo view('orderConvert/erpConvert');
        echo view('orderConvert/templates/footer');
    }


    public function erpB2B()
    {
        $filterSubset = new MyReadFilter();

        $UpFile = $this->request->getFile('excel_file');
        $upload_path = WRITEPATH . "uploads/" . $UpFile->store();
        $UpFileName = iconv("UTF-8", "EUC-KR", $UpFile->getClientName());
        $UpFilePathInfo = pathinfo($UpFileName);
        $UpFileExt = strtolower($UpFilePathInfo["extension"]);
        if ($UpFileExt == "xls" || $UpFileExt == "xlsx") {

        } else {
            alert_move("엑셀파일만 업로드 가능합니다. (xls, xlsx 확장자의 파일포멧)", 'http://godo.event.admin/convert/godo');
            exit;
        }

        $_CSJ_DEBUG_LEVEL = 0;

        $upfile_path = $upload_path;

        if (is_uploaded_file($UpFileName)) {
            if (!move_uploaded_file($UpFileName, $upfile_path)) {
                alert_move("MoveFILE FAILUER", 'http://godo.event.admin/convert/godo');
                exit;
            }
        }

        $inputFileType = 'Xls';
        if ($UpFileExt == "xlsx" || $UpFileExt == "Xlsx") {
            $inputFileType = 'Xlsx';
        }

        $spreadsheet = new Spreadsheet();
        $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objReader->setReadFilter($filterSubset);
        $objPHPExcel = $objReader->load($upfile_path);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWorksheet = $spreadsheet->getActiveSheet();


        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        $total_rows = count($sheetData);


        $today = date("Y-m-d");
        $day = isset($_GET['day']) ? $_GET['day'] : $today;
        $yesterday = date("Y-m-d", strtotime($day . " -1 day"));

        $EXCEL_NAME = str_replace('.', '_ERPupload.', $UpFileName);
        echo $EXCEL_NAME;
        $db = \Config\Database::connect();

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$EXCEL_NAME");
        header("Content-Description: PHP4 Generated Data");
        header("Pragma: no-cache");
        header("Expires: 0");

        if ($this->request->getPost('gubun') == "balju") {
            echo "<table border='1'>";
            echo "<tr>
			<td align='center'>작성일자</td>
			<td align='center'>출고부서</td>
			<td align='center'>이동요청담당자</td>
			<td align='center'>수주거래처</td>
			<td align='center'>영업부서</td>
			<td align='center'>영업담당</td>
			<td align='center'>입고요청일자</td>
			<td align='center'>입고부서</td>
			<td align='center'>입고타입</td>
			<td align='center'>SPEC구분</td>
			<td align='center'>SPEC지정</td>
			<td align='center'>수량</td>
			<td align='center'>헤더비고</td>
			<td align='center'>품목비고</td>
		</tr>";

        } else if ($this->request->getPost('gubun') == "buy") {
            echo "<table border='1'>";
            echo "<tr>
			<td align='center'>영업부서</td>
			<td align='center'>출고부서</td>
			<td align='center'>작성일자</td>
			<td align='center'>출고일자</td>
			<td align='center'>거래처코드</td>
			<td align='center'>영업담당</td>
			<td align='center'>출고담당</td>
			<td align='center'>매출구분</td>
			<td align='center'>SPEC 지정열</td>
			<td align='center'>상품명</td>
			<td align='center'>수량</td>
			<td align='center'>단가</td>
			<td align='center'>공급가액</td>
			<td align='center'>부가세</td>
			<td align='center'>품목비고</td>
			<td align='center'>헤더비고</td>
		</tr>";
        }

        if ($this->request->getPost('type') == "everyday") { //에브리데이
            if ($this->request->getPost('gubun') == "balju") {    //발주
                for ($i = 2; $i <= $total_rows; $i++) {
                    $SQL = $db->query("SELECT * FROM storeCovt WHERE 1 AND oldStoreCode = '" . $sheetData[$i]['D'] . "' AND storeType = 'everyday' AND viewYN = 'Y'");
                    $ROW = $SQL->getRowArray();

                    ?>
                    <tr>
                        <td style='mso-number-format:"\@";'><?= $today; ?></td>
                        <td style='mso-number-format:"\@";'>30000</td>
                        <td style='mso-number-format:"\@";'>0187004</td>
                        <td style='mso-number-format:"\@";'>1000007</td>
                        <td style='mso-number-format:"\@";'>10000</td>
                        <td style='mso-number-format:"\@";'>0177005</td>
                        <td style='mso-number-format:"\@";'><?= $today; ?></td>
                        <td style='mso-number-format:"\@";'></td>
                        <td style='mso-number-format:"\@";'><?= $ROW['newStoreCode']; ?></td>
                        <td style='mso-number-format:"\@";'>2</td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['F']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['Q']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['U']; ?></td>
                    </tr>
                    <?php
                }
            } else if ($this->request->getPost('gubun') == "buy") {    //매출
                for ($i = 2; $i <= $total_rows; $i++) {
                    $BARCODE = trim($sheetData[$i]['D']);
                    $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND Barcode1 = '" . $BARCODE . "'");
                    $ROW = $SQL->getRowArray();

                    if ($ROW["taxYN"] == "Y") {
                        $danga = round($sheetData[$i]['N'] * 1.1);
                        $tax = round($sheetData[$i]['M'] * 0.1);
                    } else if ($ROW["taxYN"] == "N") {
                        $danga = $sheetData[$i]['N'];
                        $tax = "0";
                    }

                    //점포코드 구하기.
                    $SQL1 = $db->query("SELECT * FROM storeCovt WHERE 1 AND oldStoreCode = '" . $sheetData[$i]['P'] . "' AND storeType = 'everyday' AND viewYN = 'Y'");
                    $ROW1 = $SQL1->getRowArray();


                    $lDate = substr($sheetData[$i]['G'], 0, 4) . "-" . substr($sheetData[$i]['G'], 4, 2) . "-" . substr($sheetData[$i]['G'], 6, 2);
                    $tDate = substr($sheetData[$i]['F'], 0, 4) . "-" . substr($sheetData[$i]['F'], 4, 2) . "-" . substr($sheetData[$i]['F'], 6, 2);


                    if ($sheetData[$i]['P'] == "9121" || $sheetData[$i]['P'] == "9111" || $sheetData[$i]['P'] == "9101") {
                        $manageCode = "0207003";
                    } else {
                        $manageCode = "0177005";
                    }

                    if ($BARCODE == "8809360928823" || $BARCODE == "8809360928830") {
                        $orgCode = "16000";
                        $manageCode = "014700";
                    } else {
                        $orgCode = "10000";
                    }

                    ?>
                    <tr>
                        <td style='mso-number-format:"\@";'>10000</td>
                        <td style='mso-number-format:"\@";'>45060</td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $tDate; ?></td>
                        <td style='mso-number-format:"\@";'><?= $ROW1['newStoreCode']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $manageCode; ?></td>
                        <td style='mso-number-format:"\@";'>0187004</td>
                        <td style='mso-number-format:"\@";'>1</td>
                        <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $danga; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['M']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['C']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['Q']; ?></td>
                    </tr>
                    <?php
                }
            }

        } else if ($this->request->getPost('type') == "lottemart") {
            if ($this->request->getPost('gubun') == "balju") {
                for ($i = 2; $i <= $total_rows; $i++) {


                }
            } else if ($this->request->getPost('gubun') == "buy") {    //판매
                for ($i = 4; $i <= $total_rows; $i++) {
                    $BARCODE = trim($sheetData[$i]['A']);
                    $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND Barcode2 = '" . $BARCODE . "'");
                    $ROW = $SQL->getRowArray();


                    if ($ROW["taxYN"] == "Y") {
                        //$danga		= round($sheetData[$i][M] * 1.1 / $sheetData[$i][D]);
                        $danga = round($sheetData[$i]['M'] * 1.1 / ($sheetData[$i]['D'] * $sheetData[$i]['K']));
                        $tax = round($sheetData[$i]['M'] * 0.1);
                    } else if ($ROW["taxYN"] == "N") {
                        //$danga		= round($sheetData[$i][M] / $sheetData[$i][D]);
                        $danga = round($sheetData[$i]['M'] / ($sheetData[$i]['D'] * $sheetData[$i]['K']));
                        $tax = "0";
                    }

                    //점포코드 구하기.
                    $SQL1 = $db->query("SELECT * FROM storeCovt WHERE 1 AND oldStoreCode = '" . $sheetData[$i][G] . "' AND storeType = 'lottemart' AND viewYN = 'Y'");
                    $ROW1 = $SQL->getRowArray();
                    ?>

                    <tr>
                        <td style='mso-number-format:"\@";'>10000</td>
                        <td style='mso-number-format:"\@";'>45010</td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $yesterday; ?></td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $yesterday; ?></td>
                        <td style='mso-number-format:"\@";'><?= $ROW1['newStoreCode']; ?></td>
                        <td style='mso-number-format:"\@";'>0177005</td>
                        <td style='mso-number-format:"\@";'>0187004</td>
                        <td style='mso-number-format:"\@";'>1</td>
                        <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $danga; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['M']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['F']; ?></td>
                        <td style='mso-number-format:"\@";'></td>
                    </tr>
                    <?php
                }

            }
        } else if ($this->request->getPost('type') == 'homeplus') {
            if ($this->request->getPost('gubun') == "balju") {    //발주
                for ($i = 2; $i <= $total_rows; $i++) {


                }
            } else if ($this->request->getPost('gubun') == "buy") {    //판매
                $tempDeal = explode(":", $sheetData[4]['H']);
                $deal = trim($tempDeal[1]);

                if (substr($deal, 0, 1) == "1" || substr($deal, 0, 1) == "2") {
                    $storeCode = "1001108";
                } else if (substr($deal, 0, 1) == "6") {
                    $storeCode = "1001109";
                } else {
                    $storeCode = "";
                }


                $manageCode = str_replace("거래선코드 : ", "", $sheetData[4]['H']);
                $manageCode = str_replace("거래선코드 :", "", $manageCode);
                if (substr($manageCode, 0, 1) == "2") {
                    $manageCode = "0147000";
                    $Code1 = "16000";
                } else if (substr($manageCode, 0, 1) == "1") {
                    $manageCode = "0207005";
                    $Code1 = "10000";
                }

                for ($i = 7; $i <= $total_rows; $i++) {
                    $lDate = substr($sheetData[$i]['A'], 0, 4) . "-" . substr($sheetData[$i]['A'], 4, 2) . "-" . substr($sheetData[$i]['A'], 6, 2);

                    //상품코드 구하기
                    $BARCODE = trim($sheetData[$i]['D']);
                    $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND Barcode4 = '" . $BARCODE . "'");
                    $ROW = $SQL->getRowArray();

                    if ($ROW["taxYN"] == "Y") {
                        $danga = round($sheetData[$i]['J'] * 1.1 / $sheetData[$i]['I']);
                        $tax = round($sheetData[$i]['J'] * 0.1);
                    } else if ($ROW["taxYN"] == "N") {
                        $danga = round($sheetData[$i]['J'] / $sheetData[$i]['I']);
                        $tax = "0";
                    }

                    if ($sheetData[$i]['B'] != "점합계" && $sheetData[$i]['B'] != "") {
                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'><?= $Code1; ?></td>
                            <td style='mso-number-format:"\@";'>45020</td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                            <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $manageCode; ?></td>
                            <td style='mso-number-format:"\@";'>0187004</td>
                            <td style='mso-number-format:"\@";'>1</td>
                            <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $danga; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['C']; ?></td>
                            <td style='mso-number-format:"\@";'></td>
                        </tr>

                        <?php
                    }


                }


            }

        } else if ($this->request->getPost('type') == "eland") {
            if ($this->request->getPost('gubun') == "balju") {    //발주
                for ($i = 2; $i <= $total_rows; $i++) {


                }
            } else if ($this->request->getPost('gubun') == "buy") {//판매
                for ($i = 2; $i <= $total_rows; $i++) {
                    $lDate = substr($sheetData[$i]['A'], 0, 4) . "-" . substr($sheetData[$i]['A'], 4, 2) . "-" . substr($sheetData[$i]['A'], 6, 2);

                    //점포코드 구하기.
                    $SQL1 = $db->query("SELECT * FROM storeCovt WHERE 1 AND oldStoreCode = '" . $sheetData[$i]['B'] . "' AND storeType = 'eland' AND viewYN = 'Y'");
                    $ROW1 = $SQL1->getRowArray();

                    $BARCODE = trim($sheetData[$i]['F']);
                    $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND Barcode3 = '" . $BARCODE . "'");
                    $ROW = $SQL->getRowArray();

                    if ($ROW["taxYN"] == "Y") {
                        $danga = round(($sheetData[$i]['K'] + $sheetData[$i]['L']) / $sheetData[$i]['J']);
                        $tax = round($sheetData[$i]['M'] * 0.1);
                    } else if ($ROW["taxYN"] == "N") {
                        $danga = round(($sheetData[$i]['K'] + $sheetData[$i]['L']) / $sheetData[$i]['J']);
                        $tax = "0";
                    }

                    ?>
                    <tr>
                        <td style='mso-number-format:"\@";'>10000</td>
                        <td style='mso-number-format:"\@";'>45040</td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                        <td style='mso-number-format:"\@";'><?= $ROW1['newStoreCode']; ?></td>
                        <td style='mso-number-format:"\@";'>0207005</td>
                        <td style='mso-number-format:"\@";'>0187004</td>
                        <td style='mso-number-format:"\@";'>1</td>
                        <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $danga; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                        <td style='mso-number-format:"\@";'></td>
                        <td style='mso-number-format:"\@";'></td>
                    </tr>


                    <?php
                }
            }


        } else if ($this->request->getPost('type') == "lottesuper") {
            if ($this->request->getPost('gubun') == "balju") {    //발주
                for ($i = 2; $i <= $total_rows; $i++) {


                }
            } else if ($this->request->getPost('gubun') == "buy") {
                $colIndexHeader = "";
                $colIndex = 'A';
                $columnHeaderArr = $sheetData[5];
                $colIndexArr = array();

                if ($_CSJ_DEBUG_LEVEL == 1) echo "<tr>";
                foreach ($columnHeaderArr as $_colIndex) {
                    $colStr = $colIndexHeader . $colIndex;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $colStr . " : " . $_colIndex . " ";
                    switch (mb_convert_encoding($sheetData[5][$colStr], "UTF-8")) {
                        case "상품코드":
                            $colIndexArr['productBarcode'] = $colStr;
                            if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[5][$colStr] . $colIndexArr['productBarcode'] . " : " . $colStr . "\n";
                            break;
                        case "상품명":
                            $colIndexArr['productName'] = $colStr;
                            if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[5][$colStr] . $colIndexArr['productName'] . " : " . $colStr . "\n";
                            break;
                        case "품목코드":
                        case "판매코드":
                            $colIndexArr['saleBarcode'] = $colStr;
                            if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[5][$colStr] . $colIndexArr['saleBarcode'] . " : " . $colStr . "\n";
                            break;
                        case "점포명":
                            $colIndexArr['storeName'] = $colStr;
                            if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[5][$colStr] . $colIndexArr['storeName'] . " : " . $colStr . "\n";
                            break;
                        case "점포코드":
                        case "거래처코드":
                            $colIndexArr['storeCode'] = $colStr;
                            if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[5][$colStr] . $colIndexArr['storeCode'] . " : " . $colStr . "\n";
                            break;
                        case "수량":
                        case "매입수량":
                            $colIndexArr['buyingAmount'] = $colStr;
                            if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[5][$colStr] . $colIndexArr['buyingAmount'] . " : " . $colStr . "\n";
                            break;
                        case "공급가":
                        case "매입금액":
                            $colIndexArr['buyingPrice'] = $colStr;
                            if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[5][$colStr] . $colIndexArr['buyingPrice'] . " : " . $colStr . "\n";
                            break;
                        default:
                            if ($_CSJ_DEBUG_LEVEL == 1) {
                                echo "</tr><tr>";
                                echo $colStr . " : " . $colStr . " 칸의 제목을 인식하지 못했습니다.";
                                echo "</tr><tr>";
                            }
                    }
                    if ($colStr == "Z") {
                        $colIndexHeader = 'A';
                        $colIndex = 'A';
                    } else $colIndex = chr(ord($colIndex) + 1);
                }

                if ($_CSJ_DEBUG_LEVEL == 1) echo "</tr>";

                for ($i = 6; $i <= $total_rows; $i++) {
                    if ($sheetData[$i][$colIndexArr['productBarcode']] != "합계") {
                        $ea = (int)$sheetData[$i][$colIndexArr['buyingAmount']];

                        $BARCODE = trim($sheetData[$i][$colIndexArr['saleBarcode']]);
                        $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND Barcode5 = '" . $BARCODE . "'");
                        $ROW = $SQL->getRowArray();

                        $price = str_replace(",", "", $sheetData[$i][$colIndexArr['buyingPrice']]);

                        $storeQuery = "SELECT * FROM storeCovt WHERE storeType LIKE 'lottesuper' ";
                        $storeQuery .= "AND storeName LIKE '" . $sheetData[$i][$colIndexArr['storeName']] . "' ";
                        $storeQuery .= "OR newStoreCode LIKE '" . $sheetData[$i][$colIndexArr['storeCode']] . "' ";
                        $storeQuery .= "OR oldStoreCode LIKE '" . $sheetData[$i][$colIndexArr['storeCode']] . "' ";
                        $storeQueryAll = $db->query($storeQuery);
                        $storeRow = $storeQueryAll->getRowArray($storeQuery);


                        if ($ROW["taxYN"] == "Y") {
                            $danga = round(($price * 1.1) / $ea);
                            $tax = round($price * 0.1);
                        } else if ($ROW["taxYN"] == "N") {
                            $danga = round($price / $ea);
                            $tax = "0";
                        }
                        ?>

                        <tr>
                            <td style='mso-number-format:"\@";'>10000</td>
                            <td style='mso-number-format:"\@";'>45010</td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $yesterday; ?></td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $yesterday; ?></td>
                            <td style='mso-number-format:"\@";'><?= $storeRow['newStoreCode']; ?></td> <!--거래처코드//-->
                            <td style='mso-number-format:"\@";'>0177005</td>
                            <td style='mso-number-format:"\@";'>0187004</td>
                            <td style='mso-number-format:"\@";'>1</td>
                            <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ea; ?></td>
                            <td style='mso-number-format:"\@";'><?= $danga; ?></td>
                            <td style='mso-number-format:"\@";'><?= $price; ?></td>
                            <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                            <td style='mso-number-format:"\@";'></td>
                            <td style='mso-number-format:"\@";'></td>
                        </tr>

                        <?php

                    }


                }
            }
        } else if ($this->request->getPost('type') == "gsretail") {
            if ($this->request->getPost('gubun') == "balju") {    //발주

            } else if ($this->request->getPost('gubun') == "buy") {    //매출
                $tempDeal = explode(":", $sheetData[4]['G']);
                $deal = trim($tempDeal[1]);
                if (substr($deal, 0, 1) == "1") {
                    $storeCode = "1001108";
                } else if (substr($deal, 0, 1) == "6") {
                    $storeCode = "1001109";
                } else {
                    $storeCode = "";
                }

                for ($i = 7; $i <= $total_rows; $i++) {
                    $lDate = substr($sheetData[$i]['A'], 0, 4) . "-" . substr($sheetData[$i]['A'], 4, 2) . "-" . substr($sheetData[$i]['A'], 6, 2);
                    $tmpData = str_replace(" ", "", $sheetData[$i]['B']);
                    $tmpData = preg_replace('/[[:punct:]]/u', '', $tmpData);

                    if ($tmpData != "점합계") {
                        if ($sheetData[$i]['A'] != "일합계") {
                            if ($sheetData[$i]['H'] != "0") {
                                //상품코드 구하기
                                $BARCODE = preg_replace("/\s+/", "", $sheetData[$i]['D']);
                                $BARCODE = str_replace(" ", "", $BARCODE);
                                $BARCODE = preg_replace('/[[:punct:]]/u', '', $BARCODE);

                                if ($BARCODE != "") {
                                    $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND Barcode6 = '" . $BARCODE . "'");
                                    $ROW = $SQL->getRowArray();
                                    $emtyArrReplace = count($SQL->getResultObject());


                                    $STORECODE = preg_replace("/\s+/", "", $sheetData[$i]['B']);
                                    $STORECODE = str_replace(" ", "", $STORECODE);
                                    $STORECODE = preg_replace('/[[:punct:]]/u', '', $STORECODE);

                                    //점포코드 구하기.
                                    $SQL1 = $db->query("SELECT * FROM storeCovt WHERE 1 AND oldStoreCode = '" . $STORECODE . "' AND storeType = 'gsretail' AND viewYN = 'Y'");
                                    $ROW1 = $SQL1->getRowArray();
                                    if ($emtyArrReplace == 0) {
                                        $danga = round($sheetData[$i]['I'] / $sheetData[$i]['H']);
                                        $tax = "0";
                                        ?>
                                        <tr>
                                            <td style='mso-number-format:"\@";'>10000</td>
                                            <td style='mso-number-format:"\@";'>45030</td>
                                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $ROW1['newStoreCode']; ?></td>
                                            <td style='mso-number-format:"\@";'>0177005</td>
                                            <td style='mso-number-format:"\@";'>0187004</td>
                                            <td style='mso-number-format:"\@";'>1</td>
                                            <td style='mso-number-format:"\@";'></td>
                                            <td style='mso-number-format:"\@";'></td>
                                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $danga; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $ROW1['etc']; ?></td>
                                            <td style='mso-number-format:"\@";'></td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <?php
                                        if ($ROW["taxYN"] == "Y") {
                                            $danga = round($sheetData[$i]['I'] * 1.1 / $sheetData[$i]['H']);
                                            $tax = round($sheetData[$i]['I'] * 0.1);
                                        } else if ($ROW["taxYN"] == "N") {
                                            $danga = round($sheetData[$i]['I'] / $sheetData[$i]['H']);
                                            $tax = "0";
                                        }
                                        ?>
                                        <tr>
                                            <td style='mso-number-format:"\@";'>10000</td>
                                            <td style='mso-number-format:"\@";'>45030</td>
                                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $ROW1['newStoreCode']; ?></td>
                                            <td style='mso-number-format:"\@";'>0177005</td>
                                            <td style='mso-number-format:"\@";'>0187004</td>
                                            <td style='mso-number-format:"\@";'>1</td>
                                            <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $danga; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                                            <td style='mso-number-format:"\@";'><?= $ROW1['etc']; ?></td>
                                            <td style='mso-number-format:"\@";'></td>
                                        </tr>
                                        <?php
                                    }
                                }

                            }
                        }
                    }


                }


            }
        } else if ($this->request->getPost('type') == "megamart") {
            if ($this->request->getPost('gubun') == "balju") {    //발주

            } else if ($this->request->getPost('gubun') == "buy") {    //매출
                for ($i = 2; $i <= $total_rows; $i++) {
                    $lDate = substr($sheetData[$i]['A'], 0, 4) . "-" . substr($sheetData[$i]['A'], 5, 2) . "-" . substr($sheetData[$i]['A'], 8, 2);
                    $tmpData = str_replace(" ", "", $sheetData[$i]['B']);
                    $tmpData = preg_replace('/[[:punct:]]/u', '', $tmpData);

                    if ($tmpData != "") {
                        if ($sheetData[$i]['J'] != "0") {
                            //상품코드 구하기
                            $BARCODE = preg_replace("/\s+/", "", $sheetData[$i]['E']);
                            $BARCODE = str_replace(" ", "", $BARCODE);
                            $BARCODE = preg_replace('/[[:punct:]]/u', '', $BARCODE);

                            if ($BARCODE != "") {
                                $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND Barcode7 = '" . $BARCODE . "'");
                                $ROW = $SQL->getRowArray();

                                $STORECODE = preg_replace("/\s+/", "", $sheetData[$i]['B']);
                                $STORECODE = str_replace(" ", "", $STORECODE);
                                $STORECODE = preg_replace('/[[:punct:]]/u', '', $STORECODE);

                                //점포코드 구하기.
                                $SQL1 = $db->query("SELECT * FROM storeCovt WHERE 1 AND oldStoreCode = '" . $STORECODE . "' AND storeType = 'megamart' AND viewYN = 'Y'");
                                $ROW1 = $SQL1->getRowArray();


                                $EA = $sheetData[$i]['I'] * $sheetData[$i]['J'];

                                if ($ROW["taxYN"] == "Y") {
                                    $danga = round($sheetData[$i]['L'] * 1.1 / $EA);
                                    $tax = round($sheetData[$i]['L'] * 0.1);
                                } else if ($ROW["taxYN"] == "N") {
                                    $danga = round($sheetData[$i]['L'] / $EA);
                                    $tax = "0";
                                }

                                ?>

                                <tr>
                                    <td style='mso-number-format:"\@";'>10000</td>
                                    <td style='mso-number-format:"\@";'>45050</td>
                                    <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                                    <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $ROW1['newStoreCode']; ?></td>
                                    <td style='mso-number-format:"\@";'>0177005</td>
                                    <td style='mso-number-format:"\@";'>0187004</td>
                                    <td style='mso-number-format:"\@";'>1</td>
                                    <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $EA; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $danga; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                                    <td style='mso-number-format:"\@";'></td>
                                    <td style='mso-number-format:"\@";'></td>
                                </tr>
                                <?php

                            }
                        }
                    }


                }
            }
        } else if ($this->request->getPost('type') == "nonghyup") {
            if ($this->request->getPost('gubun') == "balju") {    //발주

            } else if ($this->request->getPost('gubun') == "buy") {//매출
                for ($i = 2; $i <= $total_rows; $i++) {
                    $lDate = substr($sheetData[$i]['C'], 0, 4) . "-" . substr($sheetData[$i]['C'], 5, 2) . "-" . substr($sheetData[$i]['C'], 8, 2);
                    $tmpData = str_replace(" ", "", $sheetData[$i]['B']);
                    $tmpData = preg_replace('/[[:punct:]]/u', '', $tmpData);
                    if ($tmpData != "") {
                        if ($sheetData[$i]['J'] != "0") {
                            //상품코드 구하기
                            $BARCODE = preg_replace("/\s+/", "", $sheetData[$i]['N']);
                            $BARCODE = str_replace(" ", "", $BARCODE);
                            $BARCODE = preg_replace('/[[:punct:]]/u', '', $BARCODE);

                            if ($BARCODE != "") {
                                $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND Barcode8 = '" . $BARCODE . "'");
                                $ROW = $SQL->getRowArray();

                                $CABAGECODE = preg_replace("/\s+/", "", $sheetData[$i]['A']);
                                $CABAGECODE = str_replace(" ", "", $CABAGECODE);
                                $CABAGECODE = preg_replace('/[[:punct:]]/u', '', $CABAGECODE);

                                //점포코드 구하기.
                                $SQL1 = $db->query("SELECT * FROM storeCovt WHERE 1 AND oldStoreCode = '" . $CABAGECODE . "' AND storeType = 'nonghyup' AND viewYN = 'Y'");
                                $ROW1 = $SQL1->getRowArray();

                                ?>
                                <tr>
                                    <td style='mso-number-format:"\@";'>10000</td>
                                    <td style='mso-number-format:"\@";'><?= $ROW1['cbCode']; ?></td>
                                    <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                                    <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $lDate; ?></td>
                                    <td style='mso-number-format:"\@";'>1000019</td>
                                    <td style='mso-number-format:"\@";'>0190001</td>
                                    <td style='mso-number-format:"\@";'>0187004</td>
                                    <td style='mso-number-format:"\@";'>1</td>
                                    <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['V']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['U']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['W']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['X']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                                    <td style='mso-number-format:"\@";'></td>
                                </tr>
                                <?php
                            }

                        }
                    }
                }
            }
        } else if ($this->request->getPost('type') == "gs") {
            if ($this->request->getPost('gubun') == "balju") {

            } else if ($this->request->getPost('gubun') == "buy") {    //매출
                for ($i = 7; $i <= $total_rows; $i++) {
                    $sheetData[$i]['A'] = preg_replace("/\s+/", "", $sheetData[$i]['A']);
                    $sheetData[$i]['A'] = str_replace(" ", "", $sheetData[$i]['A']);
                    $sheetData[$i]['A'] = preg_replace('/[[:punct:]]/u', '', $sheetData[$i]['A']);

                    $sheetData[$i]['B'] = preg_replace("/\s+/", "", $sheetData[$i]['B']);
                    $sheetData[$i]['B'] = str_replace(" ", "", $sheetData[$i]['B']);
                    $sheetData[$i]['B'] = preg_replace('/[[:punct:]]/u', '', $sheetData[$i]['B']);

                    $sheetData[$i]['D'] = preg_replace("/\s+/", "", $sheetData[$i]['D']);
                    $sheetData[$i]['D'] = str_replace(" ", "", $sheetData[$i]['D']);
                    $sheetData[$i]['D'] = preg_replace('/[[:punct:]]/u', '', $sheetData[$i]['D']);

                    if (trim($sheetData[$i]['A']) != "일합계" && trim($sheetData[$i]['A']) != "총합계" && trim($sheetData[$i]['B']) != "점합계") {
                        $tDate = substr($sheetData[$i]['A'], 0, 4) . "-" . substr($sheetData[$i]['A'], 4, 2) . "-" . substr($sheetData[$i]['A'], 6, 2);
                        //if ($sheetData[$i]['J'] != "0") {
                        //상품코드 구하기

                        // if($sheetData[$i][D] == "8809360924016") {
                        // 	$prdCode = "ONB002-002";
                        // 	$prdName = "[GS편]곡친[딸기]30입";
                        // } else if($sheetData[$i][D] == "8809360924054") {
                        // 	$prdCode = "ONB002-004";
                        // 	$prdName = "[GS편]곡친[블루베리]30입";
                        // } else {
                        // 	$prdCode = "";
                        // }

                        // GS편의점에 들어가는 품목이 많아져서 if else문을 주석처리하고  switch case문으로 변경 - 21.01.06. 진회
                        switch ($sheetData[$i]['D']) {
                            case "8809360924016":
                                $prdCode = "ONB002-002";
                                $prdName = "[GS편]곡친[딸기]30입";
                                $divideEa = "30";
                                break;
                            case "8809360924054":
                                $prdCode = "ONB002-004";
                                $prdName = "[GS편]곡친[블루베리]30입";
                                $divideEa = "30";
                                break;
                            case "8809360922012":
                                $prdCode = "OHB001-101";
                                $prdName = "[GS]요거트[플레인]";
                                $divideEa = "32";
                                break;
                            case "8809360922029":
                                $prdCode = "OHB001-104";
                                $prdName = "[GS]요거트[딸기]";
                                $divideEa = "32";
                                break;

                            default:
                                $prdCode = '';
                                $prdName = '';
                                $divideEa = '1';
                        }


                        //거래처코드 구하기.
                        $SQL1 = $db->query("SELECT * FROM storeCovt WHERE 1 AND oldStoreCode = '" . $sheetData[$i]['B'] . "' AND storeType = 'gsconv' AND viewYN = 'Y'");
                        $ROW1 = $SQL1->getRowArray();
                        $emtyArrReplace = count($SQL1->getResultObject());

                        $EA = (int)($sheetData[$i]['H'] / $divideEa);

                        // $price	= (int)((str_replace(",","",$sheetData[$i][I]) * 1.1) / 7);
                        $danga = $sheetData[$i]['I'];
                        $tax = $sheetData[$i]['I'] / 10;
                        //김정희대리님이 원하는 수식으로 변경 - 21.01.06.진회
                        $price = ($danga + $tax) / $EA;
                        if ($emtyArrReplace == 0) {
                            ?>
                            <tr>
                                <td style='mso-number-format:"\@";'>10000</td>
                                <td style='mso-number-format:"\@";'>49000</td>
                                <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $tDate; ?></td>
                                <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $tDate; ?></td>
                                <td style='mso-number-format:"\@";'></td>
                                <td style='mso-number-format:"\@";'>0177005</td>
                                <td style='mso-number-format:"\@";'>0187004</td>
                                <td style='mso-number-format:"\@";'>1</td>
                                <td style='mso-number-format:"\@";'><?= $prdCode; ?></td>
                                <td style='mso-number-format:"\@";'><?= $prdName; ?></td>
                                <td style='mso-number-format:"\@";'><?= $EA; ?></td>
                                <td style='mso-number-format:"\@";'><?= $price; ?></td> <!-- 이게 단가 -->
                                <td style='mso-number-format:"\@";'><?= $danga; ?></td> <!-- 이게 공급가액 -->
                                <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                                <td style='mso-number-format:"\@";'></td>
                                <td style='mso-number-format:"\@";'>GS 편의점</td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td style='mso-number-format:"\@";'>10000</td>
                                <td style='mso-number-format:"\@";'>49000</td>
                                <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $tDate; ?></td>
                                <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $tDate; ?></td>
                                <td style='mso-number-format:"\@";'><?= $ROW1['newStoreCode']; ?></td>
                                <td style='mso-number-format:"\@";'>0177005</td>
                                <td style='mso-number-format:"\@";'>0187004</td>
                                <td style='mso-number-format:"\@";'>1</td>
                                <td style='mso-number-format:"\@";'><?= $prdCode; ?></td>
                                <td style='mso-number-format:"\@";'><?= $prdName; ?></td>
                                <td style='mso-number-format:"\@";'><?= $EA; ?></td>
                                <td style='mso-number-format:"\@";'><?= $price; ?></td> <!-- 이게 단가 -->
                                <td style='mso-number-format:"\@";'><?= $danga; ?></td> <!-- 이게 공급가액 -->
                                <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                                <td style='mso-number-format:"\@";'></td>
                                <td style='mso-number-format:"\@";'>GS 편의점</td>
                            </tr>
                            <?php

                        }
                    }


                }
            }
        }

    }

    public function erp()
    {
        $_CSJ_DEBUG_LEVEL = 0;
        $tokenList = " +-,.()[]:|!";
        /** 문자열 Tokenizer */
        function strtokarr($wholeString, $tokenList = NULL)
        {
            $retTokArr = array();
            if (is_null($tokenList)) $tokenList = " +-,.()[]:|!";
            $token = strtok($wholeString, $tokenList);
            while ($token !== false) {
                array_push($retTokArr, $token);
                $token = strtok($tokenList);
            }
            return $retTokArr;
        }

        $filterSubset = new MyReadFilter();

        $UpFile = $this->request->getFile('excel_file');
        $upload_path = WRITEPATH . "uploads/" . $UpFile->store();
        $UpFileName = iconv("UTF-8", "EUC-KR", $UpFile->getClientName());

        $UpFilePathInfo = pathinfo($UpFileName);
        $UpFileExt = strtolower($UpFilePathInfo["extension"]);
        $UpFileName = substr($UpFileName, 0, 10);
        if ($UpFileExt == "xls" || $UpFileExt == "xlsx") {

        } else {
            alert_move("엑셀파일만 업로드 가능합니다. (xls, xlsx 확장자의 파일포멧)", 'http://godo.event.admin/convert/godo');
            exit;
        }


        $upfile_path = $upload_path;

        if (is_uploaded_file($UpFileName)) {
            if (!move_uploaded_file($UpFileName, $upfile_path)) {
                alert_move("MoveFILE FAILUER", 'http://godo.event.admin/convert/godo');
                exit;
            }
        }

        $inputFileType = 'Xls';
        if ($UpFileExt == "xlsx" || $UpFileExt == "Xlsx") {
            $inputFileType = 'Xlsx';
        }

        $spreadsheet = new Spreadsheet();
        $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objReader->setReadFilter($filterSubset);
        $objPHPExcel = $objReader->load($upfile_path);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWorksheet = $spreadsheet->getActiveSheet();


        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        $total_rows = count($sheetData);

        $today = date("Y-m-d") . ".xls";
        $today = str_replace('-', '', $today);
        $EXCEL_NAME = $UpFileName . $today;


        $db = \Config\Database::connect();

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$EXCEL_NAME");
        header("Content-Description: PHP4 Generated Data");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<table border='1'>";
        echo "<tr>
		<td align='center'>영업부서</td>
		<td align='center'>출고부서</td>
		<td align='center'>작성일자</td>
		<td align='center'>거래처코드</td>
		<td align='center'>영업담당</td>
		<td align='center'>상품코드</td>
		<td align='center'>상품명</td>
		<td align='center'>수량</td>
		<td align='center'>단가</td>
		<td align='center'>공급가액</td>
		<td align='center'>부가세</td>
		<td align='center'>수령자</td>
		<td align='center'>결제조건</td>
		<td align='center'>납기요청일</td>
		<td align='center'>연락처</td>
		<td align='center'>우편번호</td>
		<td align='center'>도착지</td>
		<td align='center'>배송메세지</td>
	</tr>";

//판매구분
        if ($this->request->getPost('gubun') == "mall") { //자사몰
            $storeCode = "1000898";
            $employeeCode = "0197003";

            for ($i = 2; $i <= $total_rows; $i++) {
                //기존 코드 확인
                $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND viewYN = 'Y' AND oldPrd = '" . $sheetData[$i]['C'] . "'");
                $ROW = $SQL->getRowArray();
                if ($i > "2") {
                    $k = $i - 1;
                    if ($sheetData[$i]['Q'] != $sheetData[$k]['Q']) { //주문번호가 다를 경우
                        $resultPrice = $sheetData[$k]['P'] - $tempPrice;
                        if ($resultPrice != "0") {
                            ?>
                            <tr>
                                <td style='mso-number-format:"\@";'>15000</td>
                                <td style='mso-number-format:"\@";'>30020</td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$k]['A']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                                <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                                <td style='mso-number-format:"\@";'>SGS001-005</td>
                                <td style='mso-number-format:"\@";'>[자사몰]할인액</td>
                                <td style='mso-number-format:"\@";'>1</td>
                                <td style='mso-number-format:"\@";'><?= $resultPrice; ?></td>
                                <td style='mso-number-format:"\@";'><?= $resultPrice; ?></td>
                                <td style='mso-number-format:"\@";'>0</td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$k]['H']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$k]['L']; ?></td>
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$k]['I']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$k]['J']; ?></td>
                                <td style='mso-number-format:"\@";'>
                                    <?php
                                    if ($sheetData[$k]['K'] != "") {
                                        echo $sheetData[$k]['K'];
                                    } else {
                                        echo $sheetData[$k]['O'];
                                    }
                                    ?>
                                </td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$k]['N']; ?></td>
                            </tr>
                            <?php

                        }
                        $resultPrice = "0";
                        $tempPrice = "0";

                    }


                }

                if ($ROW['idx'] > "0") {
                    if ($ROW['setYN'] == "Y") {
                        $SQL1 = $db->query("SELECT * FROM covtPrdSet WHERE 1 AND newPrd = '" . $ROW['oldPrd'] . "' AND oView = 'Y'");
                        $ROW1 = $SQL1->getRowArray();


                        if ($ROW["sku"] == "Y") { //SKU 나 상품 가격이 동일 할 경우에는 단가는 ( 공급가액 + 부가세 ) / 전체 수량 으로 계산 함.
                            $price = round(($sheetData[$i]['F'] + $sheetData[$i]['G']) / ($ROW["skuNum"] * $sheetData[$i]['D']));
                        }

                        //단가 * 수량이 맞는지 틀린지 계산해야 함.
                        $totalPrice = $price * $ROW["skuNum"] * $sheetData[$i]['D'];

                        if ($totalPrice > ($sheetData[$i]['F'] + $sheetData[$i]['G'])) { //단가가 합계 보다 클 경우
                            $FinishPrice = -1;
                        } else if ($totalPrice == ($sheetData[$i]['F'] + $sheetData[$i]['G'])) { //단가가 합계와 같을 경우
                            $FinishPrice = 0;
                        } else if ($totalPrice < ($sheetData[$i]['F'] + $sheetData[$i]['G'])) { //단가가 합계 보다 작을 경우
                            $FinishPrice = 1;
                        }

                        $CNT = count($ROW1);

                        //tempPrd1 이 삭제 되어 있어서 20200526 추가.
                        $tempPrd1 = round(($sheetData[$i]['F'] + $sheetData[$i]['G']) / $CNT);

                        for ($j = 0; $j < count($ROW1); $j++) {
                            if ($ROW["sku"] == "Y") {

                                $setEA = $sheetData[$i]['D'] * $ROW1[$j]['ea'];

                                if ($j == ($CNT - 1)) {
                                    $price = $price + $FinishPrice;
                                }

                                if ($ROW1[$j]['taxYN'] == "Y") {
                                    $setPrd1 = round($tempPrd1 / 1.1);
                                    $setTax = $tempPrd1 - $setPrd1;
                                } else if ($ROW1[$j]['taxYN'] == "N") {
                                    $setPrd1 = $tempPrd1;
                                    $setTax = "0";
                                }
                            } else {
                                $setEA = $sheetData[$i]['D'] * $ROW1[$j]['ea'];

                                if ($ROW1[$j]['taxYN'] == "Y") {
                                    $price = $ROW1[$j]["price"] + $ROW1[$j]["tax"];
                                    $setPrd1 = $ROW1[$j]["price"] * $ROW1[$j]["ea"] * $sheetData[$i]['D'];
                                    $setTax = $ROW1[$j]["tax"] * $ROW1[$j]["ea"] * $sheetData[$i]['D'];
                                } else if ($ROW1[$j]['taxYN'] == "N") {
                                    $price = $ROW1[$j]["price"];
                                    $setPrd1 = $ROW1[$j]["price"] * $ROW1[$j]["ea"] * $sheetData[$i]['D'];
                                    $setTax = "0";
                                }
                            }


                            //가격 임시로 더해줌.
                            $tempPrice += $setPrd1 + $setTax;

                            ?>
                            <tr>
                                <td style='mso-number-format:"\@";'>15000</td>
                                <td style='mso-number-format:"\@";'>30020</td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['A']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                                <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                                <td style='mso-number-format:"\@";'><?= $ROW1[$j]['setProd']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $ROW1[$j]['setProdName']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $setEA; ?></td>
                                <td style='mso-number-format:"\@";'><?= $price; ?></td>
                                <td style='mso-number-format:"\@";'><?= $setPrd1; ?></td>
                                <td style='mso-number-format:"\@";'><?= $setTax; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                                <td style='mso-number-format:"\@";'>
                                    <?php
                                    if ($sheetData[$i]['K'] != "") {
                                        echo $sheetData[$i]['K'];
                                    } else {
                                        echo $sheetData[$i]['O'];
                                    }
                                    ?>
                                </td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['N']; ?></td>
                            </tr>
                            <?php
                            $SETEA = "";


                        }


                    } else {

                        if ($ROW["taxYN"] == "N") {
                            $price = ($sheetData[$i]['F'] + $sheetData[$i]['G']) / $sheetData[$i]['D'];
                            $setPrd1 = $sheetData[$i]['F'] + $sheetData[$i]['G'];
                            $setTax = "0";
                        } else {
                            $price = ($sheetData[$i]['F'] + $sheetData[$i]['G']) / $sheetData[$i]['D'];
                            $setPrd1 = $sheetData[$i]['F'];
                            $setTax = $sheetData[$i]['G'];
                        }


                        //가격 임시로 더해줌.
                        $tempPrice += $setPrd1 + $setTax;

                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'>15000</td>
                            <td style='mso-number-format:"\@";'>30020</td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['A']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['D']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $price; ?></td>
                            <td style='mso-number-format:"\@";'><?= $setPrd1; ?></td>
                            <td style='mso-number-format:"\@";'><?= $setTax; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                            <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                            <td style='mso-number-format:"\@";'>
                                <?php
                                if ($sheetData[$i]['K'] != "") {
                                    echo $sheetData[$i]['K'];
                                } else {
                                    echo $sheetData[$i]['O'];
                                }
                                ?>
                            </td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['N']; ?></td>
                        </tr>
                        <?php

                    }


                } else {

                    //가격 임시로 더해줌.
                    $tempPrice += $sheetData[$i]['F'] + $sheetData[$i]['G'];

                    ?>
                    <tr>
                        <td style='mso-number-format:"\@";'>15000</td>
                        <td style='mso-number-format:"\@";'>30020</td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['A']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                        <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['C']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['B']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['D']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['E']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['F']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['G']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                        <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                        <td style='mso-number-format:"\@";'>
                            <?php
                            if ($sheetData[$i]['K'] != "") {
                                echo $sheetData[$i]['K'];
                            } else {
                                echo $sheetData[$i]['O'];
                            }
                            ?>
                        </td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['N']; ?></td>
                    </tr>
                    <?php

                }


            }

            if ($tempPrice != $sheetData[$total_rows]['P']) { //금액이 서로 상이할 경우.
                $resultPrice = $sheetData[$total_rows]['P'] - $tempPrice;
                ?>
                <tr>
                    <td style='mso-number-format:"\@";'>15000</td>
                    <td style='mso-number-format:"\@";'>30020</td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$total_rows]['A']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                    <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                    <td style='mso-number-format:"\@";'>SGS001-005</td>
                    <td style='mso-number-format:"\@";'>[자사몰]할인액</td>
                    <td style='mso-number-format:"\@";'>1</td>
                    <td style='mso-number-format:"\@";'><?= $resultPrice; ?></td>
                    <td style='mso-number-format:"\@";'><?= $resultPrice; ?></td>
                    <td style='mso-number-format:"\@";'>0</td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$total_rows]['H']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$total_rows]['L']; ?></td>
                    <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$total_rows]['I']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$total_rows]['J']; ?></td>
                    <td style='mso-number-format:"\@";'>
                        <?php
                        if ($sheetData[$total_rows]['K'] != "") {
                            echo $sheetData[$total_rows]['K'];
                        } else {
                            echo $sheetData[$total_rows]['O'];
                        }
                        ?>
                    </td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$total_rows]['N']; ?></td>
                </tr>

                <?php


            }
            $tempPrice = "";

        } else if ($this->request->getPost('gubun') == "tm") { //TM

            $employeeCode = "telemar"; // 21.01.06. 김정희 대리 요청으로 변경 - 진회

            for ($i = 2; $i <= $total_rows; $i++) {
                //기존 코드 확인
                $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND oldPrd = '" . $sheetData[$i]['K'] . "'");
                $ROW = $SQL->getRowArray();

                if ($ROW['idx'] > "0") {
                    if ($sheetData[$i]['H'] == "C0001") { //충주창고
                        $cabage[$i] = "30020";
                    } else if ($sheetData[$i]['H'] == "C0005") { //본사창고
                        $cabage[$i] = "31000";
                    }

                    // 옛날 이카운트ERP 코드를 넣어준 다음 여기서 다시 다해ERP코드로 변경하고 있던 것을 TM erp다운로드시 처음부터 현 ERP코드로 들어가게 변경 21.01.12. 진회
                    // 더넥스트씨 모아베베 구입건에 대해 입력할 때, 해당 셀의 값이 비어있는 경우가 있음.
                    // DB 상에는 더넥스트씨로 담당자명을 두고, ERP 에서는 1000006 으로 출력해주도록 요청함. from 김정희
                    // 따라서 코드를 변경함. 2021.11.04 by Cho Sung Jae
                    if ($sheetData[$i]['E'] == "더넥스트씨") {
                        $storeCode = "1000006";
                    } else {
                        $storeCode = $sheetData[$i]['E'];
                    }

                    // if($sheetData[$i][E] == "A00009") { //전우영
                    // 	$storeCode		= "1000934";
                    // } else if($sheetData[$i][E] == "A00004") { //박애신
                    // 	$storeCode		= "1000514";
                    // } else if($sheetData[$i][E] == "A00030") { //김필남
                    // 	$storeCode		= "1000264";
                    // } else if($sheetData[$i][E] == "A00027") { //정유경
                    // 	$storeCode		= "1000938";
                    // } else if($sheetData[$i][E] == "A00031") { //이선영
                    // 	$storeCode		= "1001247";
                    // }

                    $sheetData[$i]['O'] = ($sheetData[$i]['Q'] + $sheetData[$i]['R']) / $sheetData[$i]['N'];

                    if ($ROW['setYN'] == "Y") {
                        $SQL1 = $db->query("SELECT * FROM covtPrdSet WHERE 1 AND newPrd = '" . $ROW['oldPrd'] . "' AND oView = 'Y'");
                        $ROW1 = $SQL1->getRowArray();

                        if ($ROW["sku"] == "Y") { //SKU 나 상품 가격이 동일 할 경우에는 단가는 ( 공급가액 + 부가세 ) / 전체 수량 으로 계산 함.
                            //$price	= round(($sheetData[$i][F] + $sheetData[$i][G]) / ($ROW["skuNum"] * $sheetData[$i][D]));
                            $price = round(($sheetData[$i]['Q'] + $sheetData[$i]['R']) / ($ROW["skuNum"] * $sheetData[$i]['N']));
                        }

                        //단가 * 수량이 맞는지 틀린지 계산해야 함.
                        $totalPrice = $price * $ROW["skuNum"] * $sheetData[$i]['N'];

                        if ($totalPrice > ($sheetData[$i]['Q'] + $sheetData[$i]['R'])) { //단가가 합계 보다 클 경우
                            $FinishPrice = -1;
                        } else if ($totalPrice == ($sheetData[$i]['Q'] + $sheetData[$i]['R'])) { //단가가 합계와 같을 경우
                            $FinishPrice = 0;
                        } else if ($totalPrice < ($sheetData[$i]['Q'] + $sheetData[$i]['R'])) { //단가가 합계 보다 작을 경우
                            $FinishPrice = 1;
                        }

                        $CNT = count($ROW1);

                        for ($j = 0; $j < count($ROW1); $j++) {
                            if ($ROW["sku"] == "Y") {

                                $setEA = $sheetData[$i]['N'] * $ROW1[$j]['ea'];

                                if ($j == ($CNT - 1)) {
                                    $price = $price + $FinishPrice;
                                }

                                if ($ROW1[$j]['taxYN'] == "Y") { //정보가 맞지 않아서 수정 처리함 2020-09-03
                                    //$setPrd1	= round($tempPrd1 / 1.1);
                                    //$setTax	= $tempPrd1 - $setPrd1;
                                    $setPrd1 = round(($setEA * $price) / 1.1);
                                    $setTax = ($setEA * $price) - $setPrd1;
                                } else if ($ROW1[$j]['taxYN'] == "N") {
                                    //$setPrd1	= $tempPrd1 + 4;
                                    //$setTax	= "0";
                                    $setPrd1 = $setEA * $price;
                                    $setTax = "0";
                                }
                            } else {
                                $setEA = $sheetData[$i]['N'] * $ROW1[$j]['ea'];

                                if ($ROW1[$j]['taxYN'] == "Y") {
                                    $price = $ROW1[$j]["price"] + $ROW1[$j]["tax"];
                                    $setPrd1 = $ROW1[$j]["price"] * $ROW1[$j]["ea"] * $sheetData[$i]['N'];
                                    $setTax = $ROW1[$j]["tax"] * $ROW1[$j]["ea"] * $sheetData[$i]['N'];
                                } else if ($ROW1[$j]['taxYN'] == "N") {
                                    $price = $ROW1[$j]["price"];
                                    $setPrd1 = $ROW1[$j]["price"] * $ROW1[$j]["ea"] * $sheetData[$i]['N'];
                                    $setTax = "0";
                                }
                            }

                            ?>
                            <tr>
                                <td style='mso-number-format:"\@";'>17000</td>
                                <td style='mso-number-format:"\@";'><?= $cabage[$i]; ?></td>
                                <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['C']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                                <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                                <td style='mso-number-format:"\@";'><?= $ROW1[$j]['setProd']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $ROW1[$j]['setProdName']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $setEA; ?></td>
                                <td style='mso-number-format:"\@";'><?= $price; ?></td>
                                <td style='mso-number-format:"\@";'><?= $setPrd1; ?></td>
                                <td style='mso-number-format:"\@";'><?= $setTax; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['S']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['T']; ?></td>
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['U']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['V']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['W']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['Z']; ?></td>
                            </tr>
                            <?php
                            $SETEA = "";

                        }


                    } else {
                        if ($ROW["taxYN"] == "N") {
                            $price = ($sheetData[$i]['Q'] + $sheetData[$i]['R']) / $sheetData[$i]['N'];
                            $setPrd1 = $sheetData[$i]['Q'] + $sheetData[$i]['R'];
                            $setTax = "0";
                        } else {
                            $price = ($sheetData[$i]['Q'] + $sheetData[$i]['R']) / $sheetData[$i]['N'];
                            $setPrd1 = $sheetData[$i]['Q'];
                            $setTax = $sheetData[$i]['R'];
                        }

                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'>17000</td>
                            <td style='mso-number-format:"\@";'><?= $cabage[$i]; ?></td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['C']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['N']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $price; ?></td>
                            <td style='mso-number-format:"\@";'><?= $setPrd1; ?></td>
                            <td style='mso-number-format:"\@";'><?= $setTax; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['S']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['T']; ?></td>
                            <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['U']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['V']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['W']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['Z']; ?></td>
                        </tr>
                        <?php


                    }

                } else { //상품코드가 없을 때에는
                    if ($sheetData[$i]['H'] == "C0001") { //충주창고
                        $cabage[$i] = "30020";
                    } else if ($sheetData[$i]['H'] == "C0005") { //본사창고
                        $cabage[$i] = "31000";
                    }

                    $price = ($sheetData[$i]['Q'] + $sheetData[$i]['R']) / $sheetData[$i]['N'];
                    $setPrd1 = $sheetData[$i]['Q'];
                    $setTax = $sheetData[$i]['R'];

                    ?>
                    <tr>
                        <td style='mso-number-format:"\@";'>17000</td> <!--영업부서//-->
                        <td style='mso-number-format:"\@";'><?= $cabage[$i]; ?></td> <!--출고부서//-->
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['C']; ?></td> <!--작성일자//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['E']; ?></td> <!--거래처코드//-->
                        <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td> <!--영업담당//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td> <!--상품코드//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td> <!--상품명//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['N']; ?></td> <!--수량//-->
                        <td style='mso-number-format:"\@";'><?= $price; ?></td> <!--단가//-->
                        <td style='mso-number-format:"\@";'><?= $setPrd1; ?></td> <!--공급가액//-->
                        <td style='mso-number-format:"\@";'><?= $setTax; ?></td> <!--부가세//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['S']; ?></td> <!--수령자//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['T']; ?></td> <!--결제조건//-->
                        <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td> <!--납기요청일//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['U']; ?></td> <!--연락처//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['V']; ?></td> <!--우편번호//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['W']; ?></td> <!--도착지//-->
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['Z']; ?></td> <!--배송메세지//-->
                    </tr>

                    <?php

                }
                $storeCode = "";

            }

        } else if ($this->request->getPost('gubun') == "office") { // 사내판매
            $storeCode = "1000545";
            $employeeCode = "0127026";
        } else if ($this->request->getPost('gubun') == "mams") { //맘스다이어리
            $storeCode = "1000038";
            $employeeCode = "0197003";

            for ($i = 2; $i <= $total_rows; $i++) {
                //기존 코드 확인
                $prdCode = explode("_", $sheetData[$i]['C']);
                $prdCnt = count($prdCode);

                if ($prdCnt == "1") {
                    $prdBarCode = $prdCode[0];
                    $prdEa = "";
                    $resultEa = $sheetData[$i]['Z'];
                } else if ($prdCnt == "2") {
                    $prdBarCode = $prdCode[0];
                    $prdEa = $prdCode[1];
                    $resultEa = $sheetData[$i]['Z'] * $prdEa;
                }

                $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND newPrd = '" . $prdBarCode . "'");
                $ROW = $SQL->getRowArray();

                if ($ROW['idx'] > "0" && $prdBarCode != "") {

                    if ($prdEa > "0") { //수량 나눠주기.
                        $price = (int)($sheetData[$i]['X'] / $prdEa);
                    } else {
                        $price = (int)($sheetData[$i]['X']);
                    }

                    if ($ROW['taxYN'] == "Y") { //세금 존재 여부
                        $dPrice = (int)($sheetData[$i]['Y'] / 1.1);
                        $tax = $sheetData[$i]['Y'] - $dPrice;
                    } else {
                        $dPrice = $sheetData[$i]['Y'];
                        $tax = 0;
                    }

                    ?>

                    <tr>
                        <td style='mso-number-format:"\@";'>15000</td>
                        <td style='mso-number-format:"\@";'>30020</td>
                        <td style='mso-number-format:"\@";'><?= substr($sheetData[$i]['D'], 0, 4); ?>
                            -<?= substr($sheetData[$i]['D'], 4, 2); ?>-<?= substr($sheetData[$i]['D'], 6, 2); ?></td>
                        <td style='mso-number-format:"\@";'>1000038</td>
                        <td style='mso-number-format:"\@";'>0197003</td>
                        <td style='mso-number-format:"\@";'><?= $ROW['newPrd']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $ROW['PrdName']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $resultEa; ?></td>
                        <td style='mso-number-format:"\@";'><?= $price; ?></td>
                        <td style='mso-number-format:"\@";'><?= $dPrice; ?></td>
                        <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['E']; ?></td>
                        <td style='mso-number-format:"\@";'>기타</td>
                        <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['F']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                    </tr>
                    <?php


                } else {    //제품이 없을 때는 구코드에서 확인해 봄.
                    $SQL1 = $db->query("SELECT * FROM covtProd WHERE 1 AND viewYN = 'Y' AND oldPrd = '" . $prdBarCode . "'");
                    $ROW1 = $SQL1->getRowArray();

                    if ($ROW1['idx'] > "0") {
                        if ($ROW1['setYN'] == "Y") {
                            $SQL2 = $db->query("SELECT * FROM covtPrdSet WHERE 1 AND newPrd = '" . $ROW1['oldPrd'] . "' AND oView = 'Y'");
                            $ROW2 = $SQL2->getRowArray();

                            if ($ROW1["sku"] == "Y") { //SKU 나 상품 가격이 동일 할 경우에는 단가는 ( 공급가액 + 부가세 ) / 전체 수량 으로 계산 함.
                                $price = round($sheetData[$i]['Y'] / ($ROW1['skuNum'] * $sheetData[$i]['Z']));
                            }
                            //단가 * 수량이 맞는지 틀린지 계산해야 함.
                            $totalPrice = $price * $ROW1['skuNum'] * $sheetData[$i]['D'];

                            if ($totalPrice > $sheetData[$i]['Y']) { //단가가 합계 보다 클 경우
                                $FinishPrice = -1;
                            } else if ($totalPrice == $sheetData[$i]['Y']) { //단가가 합계와 같을 경우
                                $FinishPrice = 0;
                            } else if ($totalPrice < $sheetData[$i]['Y']) { //단가가 합계 보다 작을 경우
                                $FinishPrice = 1;
                            }

                            $CNT = count($ROW2);

                            for ($j = 0; $j < count($ROW2); $j++) {
                                $setEA = $sheetData[$i]['Z'] * $ROW2[$j]['ea'];

                                if ($j == ($CNT - 1)) {
                                    $price = $price + $FinishPrice;
                                }

                                if ($ROW2[$j]["taxYN"] == "Y") {
                                    $tempPrd1 = $price * ($ROW2[$j]["ea"] * $sheetData[$i]['Z']);
                                    $setPrd1 = round($tempPrd1 / 1.1);
                                    $setTax = $tempPrd1 - $setPrd1;
                                } else if ($ROW2[$j]["taxYN"] == "N") {
                                    $tempPrd1 = $price * ($ROW2[$j]["ea"] * $sheetData[$i]['Z']);
                                    $setPrd1 = $tempPrd1;
                                    $setTax = "0";
                                }

                                ?>
                                <tr>
                                    <td style='mso-number-format:"\@";'>15000</td>
                                    <td style='mso-number-format:"\@";'>30020</td>
                                    <td style='mso-number-format:"\@";'><?= substr($sheetData[$i]['D'], 0, 4); ?>
                                        -<?= substr($sheetData[$i]['D'], 4, 2); ?>
                                        -<?= substr($sheetData[$i]['D'], 6, 2); ?></td>
                                    <td style='mso-number-format:"\@";'>1000038</td>
                                    <td style='mso-number-format:"\@";'>0197003</td>
                                    <td style='mso-number-format:"\@";'><?= $ROW2[$j]['setProd']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $ROW2[$j]['setProdName']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $setEA; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $price; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $setPrd1; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $setTax; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['E']; ?></td>
                                    <td style='mso-number-format:"\@";'>기타</td>
                                    <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['F']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                                </tr>
                                <?php
                                $SETEA = "";


                            }

                        }


                    } else {
                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'>15000</td>
                            <td style='mso-number-format:"\@";'>30020</td>
                            <td style='mso-number-format:"\@";'><?= substr($sheetData[$i]['D'], 0, 4); ?>
                                -<?= substr($sheetData[$i]['D'], 4, 2); ?>
                                -<?= substr($sheetData[$i]['D'], 6, 2); ?></td>
                            <td style='mso-number-format:"\@";'>1000038</td>
                            <td style='mso-number-format:"\@";'>0197003</td>
                            <td style='mso-number-format:"\@";'>없는상품</td>
                            <td style='mso-number-format:"\@";'>없는상품</td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['Z']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['X']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['Y']; ?></td>
                            <td style='mso-number-format:"\@";'>부가세</td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['E']; ?></td>
                            <td style='mso-number-format:"\@";'>기타</td>
                            <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['F']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                        </tr>
                        <?php

                    }


                }
                $storeCode = "";

            }
        } else if ($this->request->getPost('gubun') == "mami") {
            $storeCode = "1001277";
            $employeeCode = "0217001";

            $nameList = array();
            $itemListQuery = $db->query("SELECT name,code FROM covtOnline");
            $itemList = $itemListQuery->getResultArray();

            foreach ($itemList as $productArray) {
                $nameList[$productArray['code']] = strtokarr($productArray['name']);
            }

            for ($i = 2; $i <= $total_rows; $i++) {
                $prdName = explode(".", $sheetData[$i]['B']);
                $optionCell = preg_replace("/옵션선택\s*:\s*(.*)/", "$1", $sheetData[$i]['C']);
                //$tokenList = " ";
                //$optionArr = strtokarr($optionCell, $tokenList);
                // array_push($optionArr, $optionCell);
                $productName = $sheetData[$i]['B'];

                $matchingScore = 0;
                $highestScore = 0;
                $highestCode = NULL;
                $highestCodeArr = array();
                $optionName = NULL;

                foreach ($nameList as $erpCode => $menuNameArr) {
                    $inputMenu = strtokarr($productName);
                    foreach ($inputMenu as $menuName) {
                        if (in_array($menuName, $menuNameArr)) $matchingScore++;
                    }
                    if ($matchingScore > $highestScore) {
                        $highestCode = $erpCode;
                        $highestScore = $matchingScore;
                    }
                    $matchingScore = 0;

                }

                $SQL = "SELECT * FROM covtOnline WHERE code LIKE '" . $highestCode . "'";

                if (!is_null($optionName)){
                    $SQL .= " AND toption LIKE '" . $optionName . "'";
                }

                $SQLALL = $db->query($SQL);
                $ROW = $SQLALL->getRowArray();

                if (count($ROW) == 1) {
                    echo "<tr>";
                    echo "Debugging - score : " . $highestScore . " / code : " . $highestCode . " / option : " . $optionName . " / name : " . print_r(strtokarr($productName));
                    echo "</tr>";
                }

                $resultEa = $ROW['ea'] * $sheetData[$i]['D'];

                if ($resultEa > "0") { //수량 나눠주기.
                    $price = (int)($sheetData[$i]['P'] / $resultEa);
                } else {
                    $price = (int)($sheetData[$i]['P']);
                }

                if ($ROW['tax'] == "Y") { // 부가가치세 품목
                    $dPrice = (int)($sheetData[$i]['P'] / 1.1);
                    $tax = $sheetData[$i]['P'] - $dPrice;
                } else { // 면세품목
                    $dPrice = $sheetData[$i]['P'];
                    $tax = 0;
                }

                ?>

                <tr>
                    <td style='mso-number-format:"\@";'>15000</td>
                    <td style='mso-number-format:"\@";'>30020</td>
                    <td style='mso-number-format:"\@";'><?= substr($sheetData[$i]['A'], 0, 4); ?>-<?= substr($sheetData[$i]['A'], 4, 2); ?>-<?= substr($sheetData[$i]['A'], 6, 2); ?></td>
                    <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                    <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                    <td style='mso-number-format:"\@";'><?= $ROW['code']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $ROW['name'] . " " . $ROW['toption']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['D']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $price; ?></td>
                    <td style='mso-number-format:"\@";'><?= $dPrice; ?></td>
                    <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['E']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['M']; ?></td>
                    <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['N']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['A']; ?></td>
                </tr>
                <?php


            }

        } else if ($this->request->getPost('gubun') == "meal") {
            $storeCode = "1000898";
            $employeeCode = "0197003";

            for ($i = 2; $i <= $total_rows; $i++) {
                //기존 코드 확인
                $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND viewYN = 'Y' AND oldPrd = '" . $sheetData[$i][C] . "'");
                $ROW = $SQL->getRowArray();


                if ($ROW["taxYN"] == "N") {
                    $price = ($sheetData[$i]['F'] + $sheetData[$i]['G']) / $sheetData[$i]['D'];
                    $setPrd1 = $sheetData[$i]['F'] + $sheetData[$i]['G'];
                    $setTax = "0";
                } else {
                    $price = ($sheetData[$i]['F'] + $sheetData[$i]['G']) / $sheetData[$i]['D'];
                    $setPrd1 = $sheetData[$i]['F'];
                    $setTax = $sheetData[$i]['G'];
                }

                ?>
                <tr>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['A']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['B']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['C']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['D']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['E']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['F']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['G']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['D']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $price; ?></td>
                    <td style='mso-number-format:"\@";'><?= $setPrd1; ?></td>
                    <td style='mso-number-format:"\@";'><?= $setTax; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['H']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                    <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                    <td style='mso-number-format:"\@";'>
                        <?php
                        if ($sheetData[$i]['K'] != "") {
                            echo $sheetData[$i]['K'];
                        } else {
                            echo $sheetData[$i]['O'];
                        }
                        ?>
                    </td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['N']; ?></td>
                </tr>
                <?php

            }

        } else if ($this->request->getPost('gubun') == "newmall") { //자사몰
            $storeCode = "1000898";
            $employeeCode = "0197003";
            $mileagePrice = $shippingPrice = $couponPrice = $etcPrice = "0";
            $tempPrice="0";
            for ($i = 2; $i <= $total_rows; $i++) {
                $mileagePrice += $sheetData[$i]['X'];
                $couponPrice += $sheetData[$i]['Q'];
                $etcPrice += $sheetData[$i]['R'] + $sheetData[$i]['S'] + $sheetData[$i]['T'] + $sheetData[$i]['U'] + $sheetData[$i]['V'] + $sheetData[$i]['W'];

                if ($sheetData[$i]['O'] > "0" && $sheetData[$i]['O'] != "상동") {
                    $tempPrice += $sheetData[$i]['O'];

                    ?>
                    <tr>
                        <td style='mso-number-format:"\@";'>18500</td>
                        <td style='mso-number-format:"\@";'>30020</td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['B']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                        <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                        <td style='mso-number-format:"\@";'>SGS001-001</td>
                        <td style='mso-number-format:"\@";'>배송비</td>
                        <td style='mso-number-format:"\@";'>1</td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['O']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['O']; ?></td>
                        <td style='mso-number-format:"\@";'>0</td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                        <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                        <td style='mso-number-format:"\@";'>
                            <?php
                            if ($sheetData[$i]['N'] != "") {
                                echo $sheetData[$i]['N'];
                            } else {
                                echo $sheetData[$i]['M'];
                            }
                            ?>
                        </td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['P']; ?></td>
                    </tr>
                    <?php

                }

                if ($sheetData[$i]['Z'] > "0" && $sheetData[$i]['Z'] != "상동") { //결제금액 0보다 크고 상동도 아닐 경우
                    $memberPrice = $sheetData[$i]['Z'];
                }


                $SQL = $db->query("SELECT * FROM covtProd WHERE 1 AND viewYN = 'Y' AND oldPrd = '" . $sheetData[$i]['C'] . "' AND viewYN = 'Y'");
                $ROW = $SQL->getResultArray();

                if(count($ROW) != 0 && $ROW[0]['setYN']=="Y") {
                    $SQL1 = $db->query("SELECT * FROM covtPrdSet WHERE 1 AND newPrd = '" . $ROW[0]['oldPrd'] . "' AND oView = 'Y'");
                    $ROW1 = $SQL1->getRowArray();



                    if ($ROW[0]["sku"] == "Y") { //SKU 나 상품 가격이 동일 할 경우에는 단가는 ( 공급가액 + 부가세 ) / 전체 수량 으로 계산 함.
                        $price = round($sheetData[$i]['G'] / $ROW[0]["skuNum"]);
                    }

                    //단가 * 수량이 맞는지 틀린지 계산해야 함.
                    $totalPrice = $price * $ROW[0]["skuNum"];

                    if ($totalPrice > $sheetData[$i]['G']) { //단가가 합계 보다 클 경우
                        $FinishPrice = -1;
                    } else if ($totalPrice == $sheetData[$i]['G']) { //단가가 합계와 같을 경우
                        $FinishPrice = 0;
                    } else if ($totalPrice < $sheetData[$i]['G']) { //단가가 합계 보다 작을 경우
                        $FinishPrice = 1;
                    }

                    $CNT = $SQL1->getNumRows();
                    //공급가액


                    for ($j = 0; $j < $CNT; $j++) {
                        if ($ROW[0]["sku"] == "Y") { //제품이 같은 가격대를 사용 하고 있을 때.
                            if ($j == ($CNT - 1)) {
                                $price = (int)($price + $FinishPrice);
                            }
                            $setEA = $sheetData[$i]['E'] * $ROW1['ea'];
                            if ($ROW1['taxYN'] == "Y") {
                                $setPrd1 = round(($sheetData[$i]['G'] / $ROW[0]['skuNum'] * $ROW1['ea']) / 1.1);
                                $setTax = round($sheetData[$i]['G'] / $ROW[0]['skuNum'] * $ROW1['ea']) - $setPrd1;
                            } else if ($ROW1['taxYN'] == "N") {
                                $setPrd1 = round($sheetData[$i]['G'] / $ROW[0]['skuNum'] * $ROW1['ea']);
                                $setTax = "0";
                            }
                        } else { //제품이 다른 가격대를 사용 하고 있을 때.
                            $setEA = $sheetData[$i]['E'] * $ROW1['ea'];

                            if ($ROW1['taxYN'] == "Y") {
                                $price = $ROW1["price"];
                                $setPrd1 = $ROW1["price"] * $ROW1["ea"] * $sheetData[$i]['E'];
                                $setTax = $ROW1["tax"] * $ROW1["ea"] * $sheetData[$i]['E'];
                            } else if ($ROW1['taxYN'] == "N") {
                                $price = $ROW1["price"];
                                $setPrd1 = $ROW1["price"] * $ROW1["ea"] * $sheetData[$i]['E'];
                                $setTax = "0";
                            }
                        }

                        //가격 임시로 더해줌.
                        $tempPrice += $setPrd1 + $setTax;
                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'>18500</td>
                            <td style='mso-number-format:"\@";'>30020</td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['B']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW1['setProd']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW1['setProdName']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $setEA; ?></td>
                            <td style='mso-number-format:"\@";'><?= $price; ?></td>
                            <td style='mso-number-format:"\@";'><?= $setPrd1; ?></td>
                            <td style='mso-number-format:"\@";'><?= $setTax; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                            <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                            <td style='mso-number-format:"\@";'>
                                <?php
                                if ($sheetData[$i]['N'] != "") {
                                    echo $sheetData[$i]['N'];
                                } else {
                                    echo $sheetData[$i]['M'];
                                }
                                ?>
                            </td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['P']; ?></td>
                        </tr>
                        <?php
                        $SETEA = "";



                    }




                }else { //세트 상품이 아닐 경우 해당 정보 그대로 넣음.

                    ?>
                    <tr>
                        <td style='mso-number-format:"\@";'>18500</td>
                        <td style='mso-number-format:"\@";'>30020</td>
                        <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['B']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                        <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['C']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['D']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['E']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['F']; ?></td>
                        <?php
                        if ($sheetData[$i]['H'] == "과세") {
                            $price = (int)($sheetData[$i]['G'] / 1.1);
                            $tax = $sheetData[$i]['G'] - $price;
                        } else {
                            $price = $sheetData[$i]['G'];
                            $tax = "0";
                        }

                        //가격 임시로 더해줌.
                        $tempPrice += ($price + $tax);

                        ?>
                        <td style='mso-number-format:"\@";'><?= $price; ?></td>
                        <td style='mso-number-format:"\@";'><?= $tax; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                        <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                        <td style='mso-number-format:"\@";'>
                            <?php
                            if ($sheetData[$i]['N'] != "") {
                                echo $sheetData[$i]['N'];
                            } else {
                                echo $sheetData[$i]['M'];
                            }
                            ?>
                        </td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i]['P']; ?></td>
                    </tr>
                    <?php
                }
                $k = $i + 1;
                if($i==$total_rows){
                    $k=$i;
                }
                if ($sheetData[$i]['A'] != $sheetData[$k]['A'] || $i == $total_rows) { //주문번호가 다를 경우
                    //배송비			: SGS001-001
                    //마일리지 할인		: SGS001-002
                    //쿠폰 할인		: SGS001-003
                    //기타 할인		: SGS001-005
                    if ($mileagePrice > "0") {

                        //가격 임시로 더해줌.
                        $tempPrice -= $mileagePrice;

                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'>18500</td>
                            <td style='mso-number-format:"\@";'>30020</td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['B']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                            <td style='mso-number-format:"\@";'>SGS001-002</td>
                            <td style='mso-number-format:"\@";'>[자사몰]마일리지</td>
                            <td style='mso-number-format:"\@";'>1</td>
                            <td style='mso-number-format:"\@";'><?= 0 - $mileagePrice; ?></td>
                            <td style='mso-number-format:"\@";'><?= 0 - $mileagePrice; ?></td>
                            <td style='mso-number-format:"\@";'>0</td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                            <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                            <td style='mso-number-format:"\@";'>
                                <?php
                                if ($sheetData[$i]['N'] != "") {
                                    echo $sheetData[$i]['N'];
                                } else {
                                    echo $sheetData[$i]['M'];
                                }
                                ?>
                            </td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['P']; ?></td>
                        </tr>
                        <?php
                    }

                    if ($couponPrice > "0") {

                        //가격 임시로 더해줌.
                        $tempPrice -= $couponPrice;

                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'>18500</td>
                            <td style='mso-number-format:"\@";'>30020</td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['B']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                            <td style='mso-number-format:"\@";'>SGS001-003</td>
                            <td style='mso-number-format:"\@";'>[자사몰]쿠폰할인</td>
                            <td style='mso-number-format:"\@";'>1</td>
                            <td style='mso-number-format:"\@";'><?= 0 - $couponPrice; ?></td>
                            <td style='mso-number-format:"\@";'><?= 0 - $couponPrice; ?></td>
                            <td style='mso-number-format:"\@";'>0</td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                            <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                            <td style='mso-number-format:"\@";'>
                                <?php
                                if ($sheetData[$i]['N'] != "") {
                                    echo $sheetData[$i]['N'];
                                } else {
                                    echo $sheetData[$i]['M'];
                                }
                                ?>
                            </td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['P']; ?></td>
                        </tr>
                        <?php
                    }
                    if ($tempPrice != $memberPrice) {
                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'>18500</td>
                            <td style='mso-number-format:"\@";'>30020</td>
                            <td style='mso-number-format:"\yyyy\-mm\-dd";'><?= $sheetData[$i]['B']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $storeCode; ?></td>
                            <td style='mso-number-format:"\@";'><?= $employeeCode; ?></td>
                            <td style='mso-number-format:"\@";'>SGS001-005</td>
                            <td style='mso-number-format:"\@";'>[자사몰]기타할인</td>
                            <td style='mso-number-format:"\@";'>1</td>
                            <td style='mso-number-format:"\@";'><?= $memberPrice - $tempPrice; ?></td>
                            <td style='mso-number-format:"\@";'><?= $memberPrice - $tempPrice; ?></td>
                            <td style='mso-number-format:"\@";'>0</td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['I']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                            <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['K']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                            <td style='mso-number-format:"\@";'>
                                <?php
                                if ($sheetData[$i]['N'] != "") {
                                    echo $sheetData[$i]['N'];
                                } else {
                                    echo $sheetData[$i]['M'];
                                }
                                ?>
                            </td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i]['P']; ?></td>
                        </tr>
                        <?php
                    }
                    $tempPrice = $mileagePrice = $shippingPrice = $couponPrice = $etcPrice = "0";

                }




            }
        }
        ?>
        </table>
        <?php

    }
}