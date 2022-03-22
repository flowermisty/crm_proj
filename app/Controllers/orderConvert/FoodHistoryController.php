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

        if (in_array($column, range('A', 'Z'))) {
            return true;
        }
        return false;
    }
}

class FoodHistoryController extends \App\Controllers\BaseController
{

    protected $helpers = ['form'];


    public function index()
    {
        helper(['form', 'alert']);

        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        echo view('orderConvert/templates/header');
        echo view('orderConvert/foodHistory');
        echo view('orderConvert/templates/footer');
    }

    public function foodConvert1()
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

        $now = date("YmdHis", time());
        $EXCEL_NAME = "IVENET_XLS_" . $now . ".xls";

        $db = \Config\Database::connect();

        $manageNumber = $this->request->getPost('tfood') . $this->request->getPost('magnum');

        header("Content-type: application/vnd.ms-excel;");
        header("Content-Disposition: attachment; filename=$EXCEL_NAME");
        header("Content-Description: PHP4 Generated Data");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">";
        echo "<table border='1'>";
        echo "<tr>
                <td align='center'></td>
                <td align='center'>출고일자</td>
                <td align='center'>식품이력추적관리번호</td>
                <td align='center'>제품명</td>
                <td align='center'>출고지명</td>
                <td align='center'>출고지사업자등록번호</td>
                <td align='center'>출고지주소</td>
                <td align='center'>출고수량</td>
                <td align='center'>인허가번호</td>
                <td align='center'>비고</td>
	          </tr>";

        for ($i = 2; $i <= $total_rows; $i++) {
            $bData = substr($sheetData[$i]['D'], 0, 4) . "-" . substr($sheetData[$i]['D'], 5, 2) . "-" . substr($sheetData[$i]['D'], 8, 2);
            $SQL = $db->query("SELECT * FROM tfood1 WHERE 1 AND cabage = '" . $sheetData[$i]['Q'] . "' order by idx limit 1");
            $ROW = $SQL->getResultArray();
            $ROWCNT = count($ROW);
            if ($sheetData[$i]['L'] != "0" && $ROWCNT > 0) {
                ?>
                <tr>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'><?= $bData; ?></td>
                    <td style='mso-number-format:"\@";'><?= $manageNumber; ?></td>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'><?= $ROW['store']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $ROW['stnumber']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $ROW['storeaddress']; ?></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'></td>
                </tr>
                <?php
            } else if ($sheetData[$i]['L'] != "0" && $ROWCNT == 0) {
                ?>
                <tr>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'><?= $bData; ?></td>
                    <td style='mso-number-format:"\@";'><?= $manageNumber; ?></td>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['L']; ?></td>
                    <td style='mso-number-format:"\@";'></td>
                    <td style='mso-number-format:"\@";'></td>
                </tr>
                <?php
            }
        }
        ?>
        </table>
        <?php
    }

    public function foodConvert2()
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

        $now = date("YmdHis", time());
        $EXCEL_NAME = "IVENET_XLS_" . $now . ".xls";

        $db = \Config\Database::connect();

        $manageNumber = $this->request->getPost('tfood') . $this->request->getPost('magnum');

        header("Content-type: application/vnd.ms-excel;");
        header("Content-Disposition: attachment; filename=$EXCEL_NAME");
        header("Content-Description: PHP4 Generated Data");
        header("Pragma: no-cache");
        header("Expires: 0");


        echo "<table border='1'>";
        echo "<tr>
		<td align='center'></td>
		<td align='center'>출고일자</td>
		<td align='center'>식품이력추적관리번호</td>
		<td align='center'>제품명</td>
		<td align='center'>출고지명</td>
		<td align='center'>출고지사업자등록번호</td>
		<td align='center'>출고지주소</td>
		<td align='center'>출고수량</td>
		<td align='center'>인허가번호</td>
		<td align='center'>비고</td>
	</tr>";

        for ($i = 2; $i <= $total_rows; $i++) {
            $bData = substr($sheetData[$i]['H'], 0, 4) . "-" . substr($sheetData[$i]['H'], 5, 2) . "-" . substr($sheetData[$i]['H'], 8, 2);
            //$SQL	= "SELECT * FROM tfood1 WHERE 1 AND cabage = '".$sheetData[$i][Q]."' order by idx limit 1";
            //$ROW	= $MySQL->fetch_array($SQL);

            if ($sheetData[$i]['G'] != "") {


                /*
                $SQL	= "SELECT * FROM tfood1 WHERE 1 AND stnumber = '".$sheetData[$i][G]."' order by idx limit 1";
                $ROW	= $MySQL->fetch_array($SQL);
                */

                $store = $sheetData[$i]['F'];
                $storeNumber = $sheetData[$i]['G'];
                $storeAddress = $sheetData[$i]["AS"];
            } else {
                $store = "개인";
                $storeNumber = "999-99-99902";
                $storeAddress = "";
            }

            ?>
            <tr>
                <td style='mso-number-format:"\@";'></td>
                <td style='mso-number-format:"\@";'><?= $bData; ?></td>
                <td style='mso-number-format:"\@";'><?= $manageNumber; ?></td>
                <td style='mso-number-format:"\@";'></td>
                <td style='mso-number-format:"\@";'><?= $store; ?></td>
                <td style='mso-number-format:"\@";'><?= $storeNumber; ?></td>
                <td style='mso-number-format:"\@";'><?= $storeAddress; ?></td>
                <td style='mso-number-format:"\@";'><?= $sheetData[$i]['J']; ?></td>
                <td style='mso-number-format:"\@";'></td>
                <td style='mso-number-format:"\@";'></td>


            </tr>
            <?php

        }
        ?>
        </table>
        <?php

    }

    public function foodConvert3()
    {
        helper(['form', 'alert']);
        $filterSubset = new MyReadFilter();

        $UpFile = $this->request->getFile('excel_file');
        $upload_path = WRITEPATH . "uploads/" . $UpFile->store();
        $UpFileName = iconv("UTF-8", "EUC-KR", $UpFile->getClientName());
        $UpFilePathInfo = pathinfo($UpFileName);
        $UpFileExt = strtolower($UpFilePathInfo["extension"]);


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

        $now = date("YmdHis", time());
        $EXCEL_NAME = "IVENET_XLS_" . $now . ".xls";

        $db = \Config\Database::connect();

        $manageNumber = $this->request->getPost('tfood') . $this->request->getPost('magnum');

        header("Content-type: application/vnd.ms-excel;");
        header("Content-Disposition: attachment; filename=$EXCEL_NAME");
        header("Content-Description: PHP4 Generated Data");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<table border='1'>";
        echo "<tr>
                <td align='center'>출고일자</td>
                <td align='center'>식품이력추적관리번호</td>
                <td align='center'>제품명</td>
                <td align='center'>출고지명</td>
                <td align='center'>출고지사업자등록번호</td>
                <td align='center'>출고지주소</td>
                <td align='center'>출고수량</td>
                <td align='center'>식품이력추적등록증번호</td>
                <td align='center'>비고</td>
	           </tr>";


        if ($this->request->getPost('tfood') == "400_1") {
            $foodName = "아이배냇 순 산양유아식 1단계";
            $regnum = "6467219";
            $magnum = "880936092021620210901";
        } else if ($this->request->getPost('tfood') == "400_2") {
            $foodName = "아이배냇 순 산양유아식 2단계";
            $regnum = "6449719";
            $magnum = "880936092022320210826";
        } else if ($this->request->getPost('tfood') == "400_3") {
            $foodName = "아이배냇 순 산양유아식 3단계";
            $regnum = "666315";
            $magnum = "880936092023020210816";
        } else if ($this->request->getPost('tfood') == "800_1") {
            $foodName = "아이배냇 순 산양유아식 1단계 800g";
            $regnum = "2359117";
            $magnum = "880936092011720210822";
        } else if ($this->request->getPost('tfood') == "800_2") {
            $foodName = "아이배냇 순 산양유아식 2단계 800g";
            $regnum = "6386819";
            $magnum = "880936092012420210826";
        } else if ($this->request->getPost('tfood') == "800_3") {
            $foodName = "아이배냇 순 산양유아식 3단계 800g";
            $regnum = "944915";
            $magnum = "880936092013120210825";
        } else if ($this->request->getPost('tfood') == "800_4") {
            $foodName = "아이배냇 순 산양유아식 4단계 800g";
            $regnum = "944815";
            $magnum = "880936092014820210722";
        } else {
            $regnum = "";
            $magnum = "";
            $foodName = "";
        }


        for ($i = 3; $i <= $total_rows; $i++) {

            if ($this->request->getPost('kind') == "pur") { //판매현황
                $bData['tDate'] = str_replace("/", "", trim($sheetData[$i]['A']));
                $bData['prdCode'] = trim($sheetData[$i]['B']);
                $bData['prdSize'] = trim($sheetData[$i]['C']);
                $bData['orgCode'] = trim($sheetData[$i]['D']);
                $bData['orgName'] = trim($sheetData[$i]['E']);
                $bData['ea'] = trim($sheetData[$i]['F']);
                $bData['price'] = trim($sheetData[$i]['G']);
                $bData['etc1'] = trim($sheetData[$i]['H']);
                $bData['etc2'] = trim($sheetData[$i]['I']);
                $bData['address'] = trim($sheetData[$i]['J']);


                if (strlen($bData['orgCode']) == "10") {
                    $orgName = $bData['orgName'];
                    $orgCode = substr($bData['orgCode'], 0, 3) . "-" . substr($bData['orgCode'], 3, 2) . "-" . substr($bData['orgCode'], 5, 5);
                    $etc = "";
                } else {
                    switch ($bData['orgName']) {
                        case "수출" :
                            $orgName = "수출";
                            $orgCode = "999-99-99901";
                            $etc = "";
                            break;

                        case "증정" :
                            $orgName = "증정";
                            $orgCode = "999-99-99903";
                            $etc = "";
                            break;

                        case "기부" :
                            $orgName = "기부";
                            $orgCode = "999-99-99904";
                            $etc = "";
                            break;

                        case "연구소제공" :
                            $orgName = "연구소제공";
                            $orgCode = "999-99-99905";
                            $etc = "";
                            break;

                        case "기타" :
                            $orgName = "기타";
                            $orgCode = "999-99-99909";
                            $etc = "";
                            break;

                        default :
                            $orgName = "개인";
                            $orgCode = "999-99-99902";
                            $etc = $bData['orgName'];
                            break;
                    }
                }


            } else if ($this->request->getPost('kind') == "self") {
                $bData['tDate'] = substr(str_replace("/", "", $sheetData[$i]['A']), 0, 10);
                $bData['orgName'] = trim($sheetData[$i]['B']);
                $bData['prdName'] = trim($sheetData[$i]['C']);
                $bData['cabageName'] = trim($sheetData[$i]['D']);
                $bData['ea'] = trim($sheetData[$i]['E']);
                $bData['price'] = trim($sheetData[$i]['F']);
                $bData['etc'] = trim($sheetData[$i]['G']);
                $bData['manage'] = trim($sheetData[$i]['H']);
                $bData['manageName'] = trim($sheetData[$i]['I']);
                $bData['prdCode'] = trim($sheetData[$i]['J']);
                $bData['usekind'] = trim($sheetData[$i]['K']);

                switch ($bData['usekind']) {
                    case "수출" :
                        $orgName = "수출";
                        $orgCode = "999-99-99901";
                        $etc = $bData['usekind'] . "[ " . $bData['etc'] . " ]";
                        break;

                    case "증정" :
                    case "샘플" :
                    case "홍보" :
                        $orgName = "증정";
                        $orgCode = "999-99-99903";
                        $etc = $bData['usekind'] . "[ " . $bData['etc'] . " ]";
                        break;

                    case "기부" :
                        $orgName = "기부";
                        $orgCode = "999-99-99904";
                        $etc = $bData['usekind'] . "[ " . $bData['etc'] . " ]";
                        break;

                    case "연구소제공" :
                        $orgName = "연구소제공";
                        $orgCode = "999-99-99905";
                        $etc = $bData['usekind'] . "[ " . $bData['etc'] . " ]";
                        break;

                    case "기타" :
                    case "클레임" :
                        $orgName = "기타";
                        $orgCode = "999-99-99909";
                        $etc = $bData['usekind'] . "[ " . $bData['etc'] . " ]";
                        break;

                    default :
                        $orgName = "개인";
                        $orgCode = "999-99-99902";
                        $etc = $bData['usekind'] . "[ " . $bData['etc'] . " ]";
                        break;
                }

            }

            ?>
            <tr>
                <td style='mso-number-format:"\@";'><?= $bData['tDate']; ?></td>
                <td style='mso-number-format:"\@";'><?= $magnum; ?></td>
                <td style='mso-number-format:"\@";'><?= $foodName; ?></td>
                <td style='mso-number-format:"\@";'><?= $orgName; ?></td>
                <td style='mso-number-format:"\@";'><?= $orgCode; ?></td>
                <td style='mso-number-format:"\@";'><?= $bData['address']; ?></td>
                <td style='mso-number-format:"\@";'><?= $bData['ea']; ?></td>
                <td style='mso-number-format:"\@";'></td>
                <td style='mso-number-format:"\@";'><?= $etc; ?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php

    }

}