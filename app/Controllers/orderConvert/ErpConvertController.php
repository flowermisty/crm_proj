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
            } else if ($_POST["gubun"] == "buy") {    //판매
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
            } else if ($_POST["gubun"] == "buy") {    //판매
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
}