<?php

namespace App\Controllers\orderConvert;

use App\Models\CoupangConvertModel;
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

        if (in_array($column, range('A', 'V'))) {
            return true;
        }
        return false;
    }
}

class CoupangConvertController extends \App\Controllers\BaseController
{

    protected $helpers = ['form'];

    public function index()
    {
        helper(['form', 'alert']);

        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/");
        }

        echo view('orderConvert/templates/header');
        echo view('orderConvert/coupangConvert');
        echo view('orderConvert/templates/footer');
    }

    public function coupangResult()
    {
        helper(['form', 'alert']);

        $inputFileType = 'Xls';

        $db = \Config\Database::connect();
        $db->query("TRUNCATE TABLE `coupangConvert`");

        for ($i = 0; $i < count($this->request->getFileMultiple('excel_file')); $i++) {
            $UpFile = $this->request->getFileMultiple('excel_file')[$i];
            $UpFileName = $UpFile->getName();
            $UpFilePathInfo = pathinfo($UpFileName);
            $UpFileExt = strtolower($UpFilePathInfo["extension"]);

            if ($UpFileExt == "xls" || $UpFileExt == "xlsx") {

            } else {
                alert_only("엑셀파일만 업로드 가능합니다. (xls, xlsx 확장자의 파일포멧)");
                exit;
            }

            $upload_path = WRITEPATH . "uploads/" . $UpFile->store();
            $upfile_path = $upload_path;

            $filterSubset = new MyReadFilter();


            if (is_uploaded_file($UpFileName)) {
                if (!move_uploaded_file($UpFileName, $upfile_path)) {
                    alert_move("MoveFILE FAILUER", 'http://godo.event.admin/convert/godo');
                    exit;
                }
            }

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


            function str_con($str)
            {
                $testlen = strlen($str);
                $tests = "";
                $str1 = "";
                for ($i = 0; $i < $testlen; $i++) {
                    $test_substr = substr($str, $i, 1);
                    if (preg_match("/[0-9]/", $test_substr) == true) {
                        $str1 .= $test_substr;
                    }
                }
                return $str1;
            }

            for ($k = 22; $k < count($sheetData); $k++) {
                if ($sheetData[$k]['A']) {
                    $prd = $k;
                    $k = $k + 1;
                    if ($sheetData[$k]['C'] != "") {
                        if (substr($sheetData[$prd]['C'], 0, 4) != 'Box_') {//일반제품으로 신청할때
                            $SQL = $db->query("SELECT a.*, b.coupangEa FROM nPrdInfo a left outer join nPrdInfoadd b ON a.idx = b.idx where 1 AND a.prdBarcode = '{$sheetData[$k]['C']}' AND a.sellYN = 'Y'");

                            $ROW = $SQL->getRowArray();


                            $tmpBoxCode = substr($sheetData[$k]['C'], 0, 3);
                            if (!$ROW) {
                                if ($tmpBoxCode == "188") {
                                    $SQL = $db->query("SELECT a.*, b.coupangEa FROM nPrdInfo a left outer join nPrdInfoadd b ON a.idx = b.idx where 1 AND b.boxBarcode = '{$sheetData[$k]['C']}'");
                                    $ROW = $SQL->getRowArray();
                                    $code = $ROW['prdCode'] . $i . "2";

                                    $data[$code]['no'] = $sheetData[$prd]['A'];

                                    switch ($sheetData[$k]['C']) {
                                        case "18809360927472" :
                                            $data[$code]['prdName'] = "키즈쿠키_꽃님친구_80g*6개입";
                                            break;

                                        default :
                                            $data[$code]['prdName'] = $sheetData[$prd]['C'];
                                            break;

                                    }

                                    $data[$code]['prdName'] = $sheetData[$prd]['C'];
                                    $tmp = str_con($ROW['prdSize']);
                                    $data[$code]['prdSize'] = (int)$tmp * (int)$ROW['coupangEa'];
                                    $data[$code]['order'] = $sheetData[$prd]['G'];
                                    $data[$code]['posble'] = $sheetData[$prd]['H'];

                                    //박스로 할때에는 입고수량을 업체납품 가능 수량으로 해달라고 해서 변경 처리함 : 2017-11-10
                                    $data[$code]['posEa'] = $sheetData[$prd]['H'];
                                    $data[$code]['weight'] = $data[$code]['prdSize'] * $data[$code]['posble'];
                                    $data[$code]['expiration'] = $sheetData[$k]['R'];
                                    $data[$code]['code'] = $code;
                                    $data[$code]['kind'] = $i;
                                    $data[$code]['warning'] = $ROW['pColor'];
                                } else { //저지우유 홀밀크, 세미밀크 바코드 구하기.
                                    if ($sheetData[$k]['C'] == "5018359900686" || $sheetData[$k]['C'] == "5018359900402") {
                                        $SQL = $db->query("SELECT a.*, b.coupangEa FROM nPrdInfo a left outer join nPrdInfoadd b ON a.idx = b.idx where 1 AND b.boxBarcode = '{$sheetData[$k]['C']}'");

                                        $ROW = $SQL->getRowArray();
                                        $code = $ROW['prdCode'] . $i . "2";

                                        $data[$code]['no'] = $sheetData[$prd]['A'];
                                        $data[$code]['prdName'] = $sheetData[$prd]['C'];
                                        $tmp = str_con($ROW['prdSize']);
                                        $data[$code]['prdSize'] = $tmp * $ROW['coupangEa'];
                                        $data[$code]['order'] = $sheetData[$prd]['G'];
                                        $data[$code]['posble'] = $sheetData[$prd]['H'];

                                        //박스로 할때에는 입고수량을 업체납품 가능 수량으로 해달라고 해서 변경 처리함 : 2017-11-10
                                        $data[$code]['posEa'] = $sheetData[$prd]['H'] / 12;
                                        $data[$code]['weight'] = $data[$code]['prdSize'] * $data[$code]['posble'];
                                        $data[$code]['expiration'] = $sheetData[$k]['R'];
                                        $data[$code]['code'] = $code;
                                        $data[$code]['kind'] = $i;
                                        $data[$code]['warning'] = $ROW['pColor'];
                                    } else if ($sheetData[$i][$k]['C'] == "8809360928120") { //요거조아 구하기.
                                        $SQL = $db->query("SELECT a.*, b.coupangEa FROM nPrdInfo a left outer join nPrdInfoadd b ON a.idx = b.idx where 1 AND b.boxBarcode = '{$sheetData[$k]['C']}'");

                                        $ROW = $SQL->getRowArray();
                                        $code = $ROW['prdCode'] . $i . "2";

                                        $data[$code]['no'] = $sheetData[$prd]['A'];
                                        $data[$code]['prdName'] = $sheetData[$prd]['C'];
                                        $tmp = str_con($ROW['prdSize']);
                                        $data[$code]['prdSize'] = $tmp * $ROW['coupangEa'];
                                        $data[$code]['order'] = $sheetData[$prd]['G'];
                                        $data[$code]['posble'] = $sheetData[$prd]['H'];

                                        //박스로 할때에는 입고수량을 업체납품 가능 수량으로 해달라고 해서 변경 처리함 : 2017-11-10
                                        if (intval($sheetData[$prd]['G'] * 10 % 30) > "0") {
                                            $data[$code]['posEa'] = intval($sheetData[$prd]['H'] * 10 / 30) . "BOX + " . intval($sheetData[$prd]['H'] * 10 % 30) . " ea";
                                        } else {
                                            $data[$code]['posEa'] = intval($sheetData[$prd]['H'] * 10 / 30) . "BOX";
                                        }
                                        $data[$code]['weight'] = $data[$code]['prdSize'] * $data[$code]['posble'];
                                        $data[$code]['expiration'] = $sheetData[$k]['R'];
                                        $data[$code]['code'] = $code;
                                        $data[$code]['kind'] = $i;
                                        $data[$code]['warning'] = $ROW['pColor'];
                                    }
                                }
                            } else {
                                $code = $ROW['prdCode'] . $i . "1";

                                if (substr($sheetData[$prd]['C'], 0, 5) == 'Pack_') {
                                    $tt = preg_match('/한끼레시피/', $ROW['prdRName']);
                                    if ($tt == "1") {
                                        //$sheetData[$prd][F] = $sheetData[$prd][G] / 2;
                                        $sheetData[$prd]['G'] = $sheetData[$prd]['H'] / 2;
                                    }
                                }

                                $data[$code]['no'] = $sheetData[$prd]['A'];
                                $data[$code]['prdName'] = $ROW['prdRName'];
                                $data[$code]['prdSize'] = str_con($ROW['prdSize']);
                                $data[$code]['order'] = $sheetData[$prd]['G'];
                                $data[$code]['posble'] = $sheetData[$prd]['H'];

                                if ($sheetData[$prd]['H'] > "0") {
                                    //echo $sheetData[$i][$prd][H] .":". $ROW[0][coupangEa] .":". $ROW[0][prdBox]."<br />";
                                    $data[$code]['posEa'] = intval($sheetData[$prd]['H'] * $ROW['coupangEa'] / $ROW['prdBox']);
                                } else {
                                    $data[$code]['posEa'] = "0";
                                }
                                $data[$code]['weight'] = $data[$code]['posEa'] * $data[$code]['prdSize'];
                                $data[$code]['expiration'] = $sheetData[$k]['R'];
                                $data[$code]['code'] = $code;
                                $data[$code]['kind'] = $i;

                                //2019-07-19 마형민 주임 특별 요청. 5699239 미납으로 요청함.
                                if ($sheetData[$prd]['B'] == '5699239') {
                                    $data[$code]['warning'] = "yellow";
                                } else {
                                    //$data[$code][$sheetData[$i][G]];
                                    $data[$code]['warning'] = $ROW['pColor'];
                                }

                            }

                        } else {
                            if ($sheetData[$k]['C'] == "28809360921088") {
                                $sheetData[$k]['C'] = "18809360921081";
                                $tmpSize = 10;
                            } else if ($sheetData[$k]['C'] == "28809360921071") {
                                $sheetData[$k]['C'] = "18809360921074";
                                $tmpSize = 10;
                            } else {
                                $tmpSize = 1;
                            }

                            $SQL = $db->query("SELECT a.*, b.coupangEa FROM nPrdInfo a left outer join nPrdInfoadd b ON a.idx = b.idx where 1 AND b.boxBarcode = '{$sheetData[$k]['C']}'");

                            $ROW = $SQL->getRowArray();
                            $code = $ROW['prdCode'] . $i . "2";

                            switch ($sheetData[$k]['C']) {
                                case "18809360923573" :
                                    $data[$code]['prdName'] = "Box_아이배냇 유기농 쌀떡뻥 30g * 6개";
                                    break;

                                default :
                                    $data[$code]['prdName'] = $sheetData[$prd]['C'];
                                    break;

                            }

                            $data[$code]['no'] = $sheetData[$prd]['A'];
                            $tmp = str_con($ROW['prdSize']);
                            $data[$code]['prdSize'] = (int)$tmp * (int)$ROW['coupangEa'] * $tmpSize;
                            $data[$code]['order'] = $sheetData[$prd]['G'];
                            $data[$code]['posble'] = $sheetData[$prd]['H'];

                            //박스로 할때에는 입고수량을 업체납품 가능 수량으로 해달라고 해서 변경 처리함 : 2017-11-10
                            $data[$code]['posEa'] = $sheetData[$prd]['G'];
                            $data[$code]['weight'] = $data[$code]['prdSize'] * $data[$code]['posble'];
                            $data[$code]['expiration'] = $sheetData[$k]['R'];
                            $data[$code]['code'] = $code;
                            $data[$code]['kind'] = $i;

                            $data[$code]['warning'] = $ROW['pColor'];

                        }
                        $tempData=[
                            'no'=>$data[$code]['no'],
                            'kind'=>$data[$code]['kind'],
                            'code'=>$data[$code]['code'],
                            'prdName'=>$data[$code]['prdName'],
                            'prdSize'=>$data[$code]['prdSize'],
                            'order'=>$data[$code]['order'],
                            'posble'=>$data[$code]['posble'],
                            'posEa'=>$data[$code]['posEa'],
                            'weight'=>$data[$code]['weight'],
                            'expiration'=>$data[$code]['expiration'],
                            'warning'=>$data[$code]['warning'],
                        ];

                        $coupangConvert = new CoupangConvertModel();
                        $coupangConvert->save($tempData);
                    }
                }
            }
        }



        $now = date("YmdHis", time());
        $EXCEL_NAME = "IVENET_XLS_" . $now . ".xls";

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$EXCEL_NAME");
        header("Content-Description: PHP4 Generated Data");
        header("Pragma: no-cache");
        header("Expires: 0");
        for ($i = 0; $i < count($this->request->getFileMultiple('excel_file')); $i++) {
            ?>
            <table border="0">
                <tr>
                    <td align="Center" colspan="8"><font size="24"><?= $sheetData[13]['C']; ?></td>
                </tr>
            </table>
            <table border="1">
                <col width="60"/>
                <col/>
                <col width="70"/>
                <col width="70"/>
                <col width="70"/>
                <col width="70"/>
                <col width="160"/>
                <col width="60"/>
                <tr>
                    <td bgcolor="#CCCCCC"><b>발주번호</b></td>
                    <td colspan="2" style='text-align:left; mso-number-format:"\@";'><?= $sheetData[10]['C']; ?></td>
                    <td bgcolor="#CCCCCC"></td>
                    <td colspan="4"><?= $sheetData[10]['H']; ?></td>
                </tr>
                <tr>
                    <td bgcolor="#CCCCCC"><b>발주구분</b></td>
                    <td colspan="2"><?= $sheetData[11]['C']; ?></td>
                    <td bgcolor="#CCCCCC"></td>
                    <td colspan="4"><?= $sheetData[11]['H']; ?></td>
                </tr>
                <tr>
                    <td rowspan="2" bgcolor="#CCCCCC"><b>입고예정<br/></br />일시</b></td>
                    <td bgcolor="#CCCCCC" style="font-size:17px;"><b>물류센터</b></td>
                    <td bgcolor="#CCCCCC"></td>
                    <td colspan="3" bgcolor="#CCCCCC"><b>입고예정일시</b></td>
                    <td colspan="2" bgcolor="#CCCCCC"><b>하차일시</b></td>
                </tr>
                <tr>
                    <td style='mso-number-format:"\@"; font-size:17px;'><?= $sheetData[13]['C']; ?></td>
                    <td></td>
                    <td colspan="3"
                        style='mso-number-format:"\@";'><?= \PhpOffice\PhpSpreadsheet\Style\NumberFormat::toFormattedString(trim($sheetData[13]['F']), 'YYYY-MM-DD H:i'); ?></td>
                    <td colspan="2"
                        style='mso-number-format:"\@";'><?= \PhpOffice\PhpSpreadsheet\Style\NumberFormat::toFormattedString($sheetData[13]['G'], 'YYYY-MM-DD H:i'); ?></td>
                </tr>
                <tr>
                    <td bgcolor="#CCCCCC"></td>
                    <td align="center" bgcolor="#CCCCCC"><b>상품명/옵션<br/>BARCODE</b></td>
                    <td align="center" bgcolor="#CCCCCC"><b><br/>상품 중량</b></td>
                    <td align="center" bgcolor="#CCCCCC"><b><br/>발주 수량</b></td>
                    <td align="center" bgcolor="#CCCCCC"><b>업체납품<br/>가능수량</b></td>
                    <td align="center" bgcolor="#CCCCCC"><b><br/>입고 수량</b></td>
                    <td align="center" bgcolor="#CCCCCC"><b>중량</b></td>
                    <td align="center" bgcolor="#CCCCCC"><b>제조(수입)일자</br /></br /> 유통기한</b></td>
                </tr>
                <?php
                if ($this->request->getPost('kind') == "1") {
                    $code = "code";
                } else {
                    $code = "idx";
                }

                $SQL = $db->query("SELECT * FROM coupangConvert WHERE 1 AND kind = '{$i}' order by '{$code}'");
                $ROW = $SQL->getResultArray();

                $sumorder = 0;
                $sumposble = 0;
                $sumposEa = 0;
                $sumweight = 0;
                for($j = 0; $j < count($ROW); $j++) {

                    if ($ROW[$j]['warning'] == 'yellow') {
                        $color = $ROW[$j]['warning'];
                        $msg = "[ 미출고품목 ]";
                    } else {
                        $color = "#" . $ROW[$j]['warning'];
                        $msg = "";
                    }
                    ?>
                    <tr>

                        <td style="text-align:center;"><?= $ROW[$j]['no']; ?></td>
                        <td style=" background-color:<?= $color; ?>; font-size:17px; word-break :nowrap; font-weight:bold;"><?= $ROW[$j]['prdName']; ?> <?= $msg; ?></td>
                        <!--상품명-->
                        <td style="text-align:right;"><?= $ROW[$j]['prdSize']; ?></td><!--상품중량-->
                        <td style="text-align:right;"><?= $ROW[$j]['order']; ?></td><!--발주수량-->
                        <td style="text-align:right;"><?= $ROW[$j]['posble']; ?></td><!--업체납품-->
                        <td style="text-align:right; font-size:17px; font-weight:bold;"><?= $ROW[$j]['posEa']; ?></td>
                        <!--입고수량-->
                        <td style="text-align:right;"><?= number_format($ROW[$j]['weight']); ?></td><!--중량-->
                        <td><?= $ROW[$j]['expiration']; ?></td><!--제조수입일자-->
                    </tr>
                    <?php

                    $sumorder += $ROW[$j]['order'];
                    $sumposble += $ROW[$j]['posble'];
                    $sumposEa += $ROW[$j]['posEa'];
                    $sumweight += $ROW[$j]['weight'];
                }
                ?>
                <tr>
                    <td colspan="2" style="text-align:center;"><b>합 계</td>
                    <td></td>
                    <td><?= number_format($sumorder); ?></td>
                    <td><?= number_format($sumposble); ?></td>
                    <td style=" font-size:17px; font-weight:bold;"><?= number_format($sumposEa); ?></td>
                    <td><?= number_format($sumweight); ?></td>
                    <td></td>
                </tr>
            </table>
            <?php
        }
        ?>
        <?php
    }

}