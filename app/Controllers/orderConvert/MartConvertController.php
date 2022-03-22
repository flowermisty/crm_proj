<?php

namespace App\Controllers\orderConvert;

use App\Models\MartConvertModel;
use \CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;

require ROOTPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MyReadFilter implements IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        // Read rows 1 to 7 and columns A to E only

        if (in_array($column, range('A', 'Z'))) {
            return true;
        }
        return false;
    }
}

class MartConvertController extends \App\Controllers\BaseController
{

    protected $helpers = ['form'];


    public function index()
    {
        helper(['form', 'alert']);

        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        echo view('orderConvert/templates/header');
        echo view('orderConvert/mart');
        echo view('orderConvert/templates/footer');
    }

    public function martConvert()
    {
        helper(['form', 'alert']);

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


        $db = \Config\Database::connect();
        $martConvert = new MartConvertModel();


        if ($this->request->getPost('type') == "maeip") {    //매입 양식
            $db->query("TRUNCATE TABLE tmpMart");
            if ($this->request->getPost('kind') == "lottemart") { //롯데마트 매입양식
                for ($i = 3; $i <= $total_rows; $i++) {
                    $gubun = trim($sheetData[$i]['A']);

                    if ($gubun == "매입" || $gubun == "매입정정") {
                        //$bData[ldate]	= jdtogregorian(trim($sheetData[$i][I]) + 2415023);
                        $bData['ldate'] = PHPExcel_Style_NumberFormat::toFormattedString(trim($sheetData[$i]['I']), 'YYYY-MM-DD');

                        $store = trim($sheetData[$i]['B']);

                        $SQL2 = $db->query("SELECT erpCode FROM shopCate WHERE 1 AND shopName = '" . $store . "' AND left(cateCode,3) = '001' AND sView = 'Y'");
                        $ROW2 = $SQL2->getResultArray();

                        if (count($ROW2) == "1") {
                            $bData['store'] = $ROW2[0]['erpCode'];
                        } else {
                            $bData['store'] = "상점[{$store}]이 없습니다.";
                        }
                        $bData['bDate'] = PHPExcel_Style_NumberFormat::toFormattedString(trim($sheetData[$i]['E']), 'YYYY-MM-DD');
                    }

                    if (is_numeric($gubun)) {
                        $SQL1 = $db->query("SELECT erpCode,taxYN FROM nPrdInfo WHERE 1 AND lotCode = '" . $gubun . "'");
                        $ROW = $SQL1->getResultArray();

                        if ($sheetData[$i]['H'] < "0") {
                            $giho = "-";
                        } else {
                            $giho = "";
                        }

                        if (count($ROW) == "1") {
                            $bData['erpCode'] = $ROW[0]['erpCode'];

                            if ($ROW[0]['taxYN'] == "Y") {
                                $bData['tax'] = $giho . round(trim($sheetData[$i]['G']) / 10);
                            } else {
                                $bData['tax'] = "0";
                            }
                        } else {
                            $bData['erpCode'] = "상품[{$sheetData[$i]['B']}]이 이상합니다.";
                        }
                        $bData['Ea'] = $giho . (trim($sheetData[$i]['F']) * trim($sheetData[$i]['D']));
                        //echo $bData[Ea]." : [".$i." ]<br />";
                        $bData['Price'] = $giho . (trim($sheetData[$i]['G']) / (trim($sheetData[$i]['F']) * trim($sheetData[$i]['D'])));
                        $bData['tPrice'] = $giho . (trim($sheetData[$i]['G']));

                        $martConvert->save($bData);
                    }
                    $employee = "1471201";

                }
            } else if ($this->request->getPost('kind') == "homeplus") { //홈플러스 매입 양식

                $tmpCode = substr(str_replace("거래선코드 : ", "", trim($sheetData[4]['H'])), 0, 1);
                if ($tmpCode == "1") {
                    $guraeCode = "2208160348";
                } else if ($tmpCode == "6") {
                    $guraeCode = "3148111803";
                }

                for ($i = 7; $i <= $total_rows; $i++) {
                    if (is_numeric(trim($sheetData[$i]['A'])) && is_numeric(trim($sheetData[$i]['D']))) {
                        $SQL = $db->query("SELECT erpCode,taxYN FROM nPrdInfo WHERE 1 AND homCode = '" . trim($sheetData[$i]['D']) . "'");
                        $ROW = $SQL->getResultArray();

                        $bData['ldate'] = trim($sheetData[$i]['A']);
                        if ($ROW[0]['erpCode'] != "") {
                            $bData['erpCode'] = $ROW[0]['erpCode'];
                        } else {
                            $bData['erpCode'] = $sheetData[$i]['D'] . "코드 이상";
                        }
                        if ($ROW[0]['taxYN'] == "Y") {
                            $bData['tax'] = round(trim($sheetData[$i]['J']) / 10);
                        } else {
                            $bData['tax'] = "0";
                        }
                        $bData['store'] = $guraeCode;
                        $bData['Ea'] = trim($sheetData[$i]['I']);
                        $bData['Price'] = trim($sheetData[$i]['J']) / trim($sheetData[$i]['I']);
                        $bData['tPrice'] = trim($sheetData[$i]['J']);
                        $martConvert->save($bData);
                    }
                }
                $employee = "1471201";
            }

            $now = date("YmdHis", time());
            $EXCEL_NAME = "IVENET_XLS_" . $now . ".xls";

            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$EXCEL_NAME");
            header("Content-Description: PHP4 Generated Data");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo "<table border='1'>";
            echo "<tr>
			<td align='center'>일자</td>
			<td align='center'>순번</td>
			<td align='center'>거래처코드</td>
			<td align='center'>거래처명</td>
			<td align='center'>담당자코드</td>			
			<td align='center'>출하창고</td>
			<td align='center'>거래유형</td>
			<td align='center'>통화</td>
			<td align='center'>환율</td>
			<td align='center'>품목코드</td>
			<td align='center'>품목명</td>
			<td align='center'>규격</td>
			<td align='center'>수량</td>
			<td align='center'>단가</td>
			<td align='center'>외화금액</td>
			<td align='center'>공급가액</td>
			<td align='center'>부가세</td>
			<td align='center'>적요</td>
			<td align='center'>적요1</td>
			<td align='center'>부대비용</td>
			<td align='center'>생산전표생성</td>			
		</tr>";

            $SQL = $db->query("SELECT ldate FROM tmpMart group by ldate");
            $ROW = $SQL->getResultArray();

            $idx = "1";

            for ($i = 0; $i < count($ROW); $i++) {
                $SQL1 = $db->query("SELECT store FROM tmpMart WHERE 1 AND ldate = '" . $ROW[$i]['ldate'] . "' GROUP BY store order by idx");
                $ROW1 = $SQL1->getResultArray();

                for ($j = 0; $j < count($ROW1); $j++) {
                    $SQL2 = $db->query("SELECT * FROM tmpMart WHERE 1 AND ldate = '" . $ROW[$i]['ldate'] . "' AND store = '" . $ROW1[$j]['store'] . "' order by idx");
                    $ROW2 = $SQL2->getResultArray();

                    for ($k = 0; $k < count($ROW2); $k++) {
                        if ($ROW2[$k]['tax'] != "0") {
                            $tax1 = "11";
                        } else {
                            $tax1 = "12";
                        }
                        echo "<tr>";
                        echo "<td>" . $ROW2[$k]['ldate'] . "</td>";
                        echo "<td>" . $idx . "</td>";
                        echo "<td>" . $ROW2[$k]['store'] . "</td>";
                        echo "<td></td>";
                        echo "<td>" . $employee . "</td>";
                        echo "<td>C0011</td>";
                        echo "<td>" . $tax1 . "</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>" . $ROW2[$k]['erpCode'] . "</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td>" . $ROW2[$k]['Ea'] . "</td>";
                        echo "<td>" . $ROW2[$k]['Price'] . "</td>";
                        echo "<td></td>";
                        echo "<td>" . $ROW2[$k]['tPrice'] . "</td>";
                        echo "<td>" . $ROW2[$k]['tax'] . "</td>";
                        echo "<td>" . $ROW2[$k]['bDate'] . "</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "</tr>";

                    }
                    $idx++;


                }


            }
            echo "</table>";


        } else if ($this->request->getPost('type') == "balju") {
            $now = date("YmdHis", time());
            $EXCEL_NAME = "IVENET_XLS_" . $now . ".xls";


            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$EXCEL_NAME");
            header("Content-Description: PHP4 Generated Data");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo "<table border='1'>";
            echo "<tr>
			<td align='center'>일자(8)</td>
			<td align='center'>순번(4)</td>
			<td align='center'>담당자(30)</td>
			<td align='center'>보내는창고코드(5)</td>
			<td align='center'>받는창고코드(5)</td>
			<td align='center'>품목코드(20)</td>
			<td align='center'>수량(12)</td>
			<td align='center'>적요(200)</td>
			<td align='center'>생산전표생성(1)</td>
		</tr>";

            if ($this->request->getPost('kind') == "lottemart") { //롯데마트 매입양식
                for ($i = 5; $i <= $total_rows; $i++) {
                    if (trim($sheetData[$i]['A']) == "ORDERS") {
                        $ldate = NumberFormat::toFormattedString(trim($sheetData[$i]['H']), 'YYYY-MM-DD');
                    }

                    if (is_numeric(trim($sheetData[$i]['A']))) {
                        $SQL = $db->query("SELECT erpCode,taxYN FROM nPrdInfo WHERE 1 AND lotCode = '" . trim($sheetData[$i]['A']) . "'");
                        $ROW = $SQL->getResultArray();


                        if (count($ROW) == "1") {
                            $erpCode = $ROW[0]['erpCode'];
                            $ea = trim($sheetData[$i]['F']) * trim(str_replace("(BOX)", "", $sheetData[$i]['G']));
                            $store = explode("(", trim($sheetData[$i]['D']));
                        } else {
                            $erpCode = trim($sheetData[$i]['A']) . " 없습니다.";
                        }

                        echo "<tr>";
                        echo "<td>" . $ldate . "</td>";
                        echo "<td></td>";
                        echo "<td>1471201</td>";
                        echo "<td>C0001</td>";
                        echo "<td>C0011</td>";
                        echo "<td>" . $erpCode . "</td>";
                        echo "<td>" . $ea . "</td>";
                        echo "<td>롯데마트 [ $store[0] ]</td>";
                        echo "<td></td>";
                        echo "</tr>";


                    }


                }

            } else if ($this->request->getPost('kind') == "homeplus") {
                for ($i = 3; $i <= $total_rows; $i++) {
                    $SQL1 = $db->query("SELECT erpCode,taxYN FROM nPrdInfo WHERE 1 AND homCode = '" . trim($sheetData[$i]['L']) . "'");
                    $ROW1 = $SQL1->getResultArray();
                    $ldate = NumberFormat::toFormattedString(trim($sheetData[$i]['F']), 'YYYY-MM-DD');
                    echo "<tr>";
                    echo "<td>" . $ldate . "</td>";
                    echo "<td></td>";
                    echo "<td>1471201</td>";
                    echo "<td>C0001</td>";
                    echo "<td>C0011</td>";
                    echo "<td>" . $ROW1[0]['erpCode'] . "</td>";
                    echo "<td>" . trim($sheetData[$i]['T']) . "</td>";
                    echo "<td>홈플러스</td>";
                    echo "<td></td>";
                    echo "</tr>";
                }
            }
            echo "</table>";


        }


    }
}