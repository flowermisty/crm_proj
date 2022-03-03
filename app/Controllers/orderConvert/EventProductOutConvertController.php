<?php

namespace App\Controllers\orderConvert;

use \CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use App\Models\EventListModel;
use App\Models\EventComponentsModel;
use App\Models\GodoConvertModel;

require ROOTPATH . 'vendor/autoload.php';

use \PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
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


class EventProductOutConvertController extends \App\Controllers\BaseController
{

    protected $helpers = ['form'];

    public function eventProductOutConvert()
    {
        helper(['form', 'alert']);

        $filterSubset = new MyReadFilter();

        $UpFile = $this->request->getFile('excel_file');
        $upload_path = WRITEPATH . "uploads/" . $UpFile->store();
        $UpFileName = $UpFile->getName();
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


        $prdData = explode(",", $this->request->getVar('gubun'));
        $prdName = array();

        $db = \Config\Database::connect();
        $godoConvert = new GodoConvertModel();
        for ($prd = 0; $prd < count($prdData); $prd++) {
            $erpCode = trim($prdData[$prd]);
            $SQL1 = $db->query("SELECT * FROM godoConvert where 1 and erpCode = '{$erpCode}'");
            $ROW1 = $SQL1->getRowArray();

            $prdName[$prd] = $ROW1['prdName'];

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

        $UpFileName = iconv("UTF-8", "EUC-KR", $UpFile->getClientName());
        $EXCEL_NAME = str_replace('.', '_ERPupload.', $UpFileName);

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
                <td align='center'>사용자정의</td>
                <td align='center'>비고</td>
                <td align='center'>사용유형</td>
                <td align='center'>새벽배송정보</td>
                <td align='center'>배송(택배)</td>
                <td align='center'>포장</td>
                <td align='center'>송장수</td>
            </tr>";


        $CALLCHK = 0;

        for ($i = 2; $i <= $total_rows; $i++) {
            for ($j = 0; $j < count($prdData); $j++) {
                ?>
                <tr>
                    <td style='mso-number-format:"\@";'>10000</td>
                    <td style='mso-number-format:"\@";'>30000</td>
                    <td style='mso-number-format:"\@";'><?= $this->request->getVar('sdate') ?></td>
                    <td style='mso-number-format:"\@";'>1000931</td>
                    <td style='mso-number-format:"\@";'>ivmarke</td>
                    <td style='mso-number-format:"\@";'><?= $prdData[$j]; ?></td>
                    <td style='mso-number-format:"\@";'><?= $prdName[$j]; ?></td>
                    <td style='mso-number-format:"\@";'>1</td> <!-- 수량 -->
                    <td style='mso-number-format:"\@";'>0</td> <!-- 단가 -->
                    <td style='mso-number-format:"\@";'>0</td><!-- 공급가액 -->
                    <td style='mso-number-format:"\@";'>0</td><!-- 부가세-->
                    <td style='mso-number-format:"\@";'><?= $sheetData[$i]['A']; ?></td>
                    <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'>증정</td>
                    <td style='mso-number-format:"\@";'><?=$this->request->getVar('fdate')?></td>
                    <td style='mso-number-format:"\@";'><?=$sheetData[$i]['B'];?></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'><?=$sheetData[$i]['C'];?></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'><?=$sheetData[$i]['D'];?></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td style='mso-number-format:"\@";'></td> <!--고도몰 다운로드 원본 파일 기준에 맞게 수정했습니다.-->
                    <td></td>
                </tr>

                <?php
            }
        }
        ?>
        </table>

        <?php
    }


}