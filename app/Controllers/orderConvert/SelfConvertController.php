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

        if (in_array($column, range('A', 'Q'))) {
            return true;
        }
        return false;
    }
}

class SelfConvertController extends \App\Controllers\BaseController
{

    protected $helpers = ['form'];


    public function index()
    {
        helper(['form', 'alert']);

        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        echo view('orderConvert/templates/header');
        echo view('orderConvert/selfConvert');
        echo view('orderConvert/templates/footer');
    }


    public function selfConvert()
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

        $cnt = count($sheetData);
        $cnt1 = 1;
        $tmpPrd = array();

        $now = date("YmdHis", time());
        $EXCEL_NAME = "IVENET_XLS_" . $now . ".xls";


        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$EXCEL_NAME");
        header("Content-Description: PHP4 Generated Data");
        header("Pragma: no-cache");
        header("Expires: 0");


        $db = \Config\Database::connect();

        echo "<table border='1'>";

        echo "<tr>
		<td>영업부서</td>
		<td>출고부서</td>
		<td>작성일자</td>
		<td>거래처코드</td>
		<td>영업담당</td>
		<td>상품코드</td>
		<td>상품명</td>
		<td>수량</td>
		<td>단가</td>
		<td>공급가액</td>
		<td>부가세</td>
		<td>수령자</td>
		<td>결제조건</td>
		<td>납기요청일</td>
		<td>연락처</td>
		<td>우편번호</td>
		<td>도착지</td>
		<td>사용유형</td>
		<td>유효기간</td>
		<td>배송메세지</td>

	</tr>";


        for ($i = 3; $i <= $cnt; $i++) {
            $data = explode("[", $sheetData[$i]['L']);
            $today = date("Y-m-d");

            for ($j = 1; $j < count($data); $j++) {
                //제품명 검색
                $pSQL = $db->query("SELECT * FROM covtProd WHERE 1 and oldPrd = '" . $sheetData[$i]['J'] . "'");
                $ROW = $pSQL->getRowArray();

                echo "<tr>";
                echo "<td>15000</td>";
                echo "<td>30000</td>";
                echo "<td>2019-11-14</td>";
                echo "<td>1001005</td>";
                echo "<td>0147002</td>";
                echo "<td>{$ROW['newPrd']}</td>";
                echo "<td>{$ROW['PrdName']}</td>";
                echo "<td>{$sheetData[$i]['J']}</td>";
                echo "<td>0</td>";
                echo "<td>0</td>";
                echo "<td>0</td>";
                echo "<td></td>";
                echo "<td>기타</td>";
                echo "<td>{$today}</td>";
                echo "<td>{$sheetData[$i]['F']}</td>";
                echo "<td>{$sheetData[$i]['G']}</td>";
                echo "<td>{$sheetData[$i]['I']}</td>";
                echo "<td>{$sheetData[$i]['N']}</td>";
                echo "<td>{$sheetData[$i]['N']}</td>";
                echo "<td>{$sheetData[$i]['N']}</td>";
                echo "</tr>";
            }
        }
        echo "</table>";


    }

}