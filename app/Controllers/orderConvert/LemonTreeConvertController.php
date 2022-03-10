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
        $rangeAry = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF");
        if (in_array($column, $rangeAry)) {
            return true;
        }
        return false;
    }
}

class LemonTreeConvertController extends \App\Controllers\BaseController
{

    protected $helpers = ['form'];

    public function index()
    {
        helper(['form', 'alert']);

        if (session()->has('aIdx') == "") {
            alert_move("로그인 후 들어와 주세요 ", "http://godo.event.admin/login");
        }

        echo view('orderConvert/templates/header');
        echo view('orderConvert/lemonTreeConvert');
        echo view('orderConvert/templates/footer');
    }

    public function lemonTreeResult()
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
        for ($i = 2; $i <= $total_rows; $i++) {
            $objWorksheet->getStyle("B" . "{$i}")
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME);
        }
        $today = date("Y-m-d");

        function time_convert_EXCEL_to_PHP($time)
        {
            $t = ($time - 25569) * 86400 - 60 * 60 * 9;
            $t = round($t * 10) / 10;
            return $t;
        }


        function strtokarr($wholeString)
        {
            $retTokArr = array();
            $tokenList = " +-,.()[]";
            $token = strtok($wholeString, $tokenList);
            while ($token !== false) {
                array_push($retTokArr, $token);
                $token = strtok($tokenList);
            }
            return $retTokArr;
        }

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
        $pointSum = 0; // 마일리지포인트를 ERP에 계산해서 넣기 위한 변수선언

        $colIndexHeader = "";
        $colIndex = 'A';

        $columnHeaderArr = $sheetData[1];

        $colIndexArr = array();

        $db = \Config\Database::connect();

        if ($_CSJ_DEBUG_LEVEL == 1) echo "<tr>";

        foreach ($columnHeaderArr as $_colIndex) {
            $colStr = $colIndexHeader . $colIndex;

            if ($_CSJ_DEBUG_LEVEL == 1) echo $colStr . " : " . $_colIndex . " ";

            switch ($sheetData[1][$colStr]) {
                case "주문번호":
                    $colIndexArr['orderNo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderNo'] . " : " . $colStr . "\n";
                    break;
                case "주문일시":
                    $colIndexArr['orderDateTime'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderDateTime'] . " : " . $colStr . "\n";
                    break;
                case "입금확인일":
                    $colIndexArr['accountCheckDate'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['accountCheckDate'] . " : " . $colStr . "\n";
                    break;
                case "구매자명":
                    $colIndexArr['orderer'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderer'] . " : " . $colStr . "\n";
                    break;
                case "일반전화":
                    $colIndexArr['ordererTel'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['ordererTel'] . " : " . $colStr . "\n";
                    break;
                case "연락처":
                    $colIndexArr['ordererContact'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['ordererContact'] . " : " . $colStr . "\n";
                    break;
                case "이메일":
                    $colIndexArr['ordererMail'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['ordererMail'] . " : " . $colStr . "\n";
                    break;
                case "받는사람":
                    $colIndexArr['receiver'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['receiver'] . " : " . $colStr . "\n";
                    break;
                case "받는사람연락처":
                    $colIndexArr['receiverContact'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['receiverContact'] . " : " . $colStr . "\n";
                    break;
                case "배송지우편번호":
                    $colIndexArr['receiverPostCode'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['receiverPostCode'] . " : " . $colStr . "\n";
                    break;
                case "배송지주소":
                    $colIndexArr['receiverAddress'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['receiverAddress'] . " : " . $colStr . "\n";
                    break;
                case "상품명":
                    $colIndexArr['productName'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['productName'] . " : " . $colStr . "\n";
                    break;
                case "구매수량":
                    $colIndexArr['orderAmount'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderAmount'] . " : " . $colStr . "\n";
                    break;
                case "배송비":
                    $colIndexArr['logisticsFee'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['logisticsFee'] . " : " . $colStr . "\n";
                    break;
                case "결제금액":
                    $colIndexArr['payAmount'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['payAmount'] . " : " . $colStr . "\n";
                    break;
                case "택배사":
                    $colIndexArr['logisticsCompany'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['logisticsCompany'] . " : " . $colStr . "\n";
                    break;
                case "송장번호":
                    $colIndexArr['invoiceNo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['invoiceNo'] . " : " . $colStr . "\n";
                    break;
                case "배송메모":
                    $colIndexArr['deliveryMemo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['deliveryMemo'] . " : " . $colStr . "\n";
                    break;
                case "관리자메모":
                    $colIndexArr['adminMemo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['adminMemo'] . " : " . $colStr . "\n";
                    break;
                case "공급자":
                    $colIndexArr['provider'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['provider'] . " : " . $colStr . "\n";
                    break;
                case "결제방법":
                    $colIndexArr['paymentMethod'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['paymentMethod'] . " : " . $colStr . "\n";
                    break;
                case "주문상태":
                    $colIndexArr['orderStatus'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderStatus'] . " : " . $colStr . "\n";
                    break;
                case "주문요청사항":
                    $colIndexArr['orderRequest'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderRequest'] . " : " . $colStr . "\n";
                    break;
                case "장바구니 주문번호":
                    $colIndexArr['basketOrderNo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['basketOrderNo'] . " : " . $colStr . "\n";
                    break;
                case "상품코드":
                    $colIndexArr['productCode'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['productCode'] . " : " . $colStr . "\n";
                    break;
                case "도서산간배송비":
                    $colIndexArr['outbackLogisticsFee'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['outbackLogisticsFee'] . " : " . $colStr . "\n";
                    break;
                case "공급가":
                    $colIndexArr['supplyPrice'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['supplyPrice'] . " : " . $colStr . "\n";
                    break;
                case "개인통관번호":
                    $colIndexArr['personalEntryId'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['personalEntryId'] . " : " . $colStr . "\n";
                    break;
                default:
                    // 인식되지 않은 칼럼의 제목값을 출력한다. added by Cho Sung Jae at 21-11-19
                    if ($_CSJ_DEBUG_LEVEL == 1) {
                        echo "</tr><tr>";
                    } else {
                        echo "<tr>";
                    }

                    echo $colStr . " : " . $colStr . " 칸의 제목을 인식하지 못했습니다.";


                    if ($_CSJ_DEBUG_LEVEL == 1) {
                        echo "</tr><tr>";
                    } else {
                        echo "<tr>";
                    }
            }

            if ($colStr == "Z") {
                $colIndexHeader = 'A';
                $colIndex = 'A';
            } else $colIndex = chr(ord($colIndex) + 1);
        }

        if ($_CSJ_DEBUG_LEVEL == 1) print_r($colIndexArr);
        if ($_CSJ_DEBUG_LEVEL == 1) echo "</tr>";


        $productList["LMNB021-001"] = strtokarr("초기(6개월전후) 한우이유식 10팩 세트+떠먹는고구마 1개 증정");
        $productList["LMNC021-001"] = strtokarr("중기(7~8개월) 한우이유식 10팩 세트+떠먹는고구마 1개 증정");
        $productList["LMND021-001"] = strtokarr("후기(9~10개월) 한우이유식 15팩 세트+떠먹는고구마 1개 증정");
        $productList["LMND021-002"] = strtokarr("병행기(10~11개월) 한우이유식 15팩 세트+떠먹는고구마 1개 증정");
        $productList["LMNE021-001"] = strtokarr("완료기(12~14개월) 한우이유식 15팩 세트+떠먹는고구마 1개 증정");

        for ($i = 2; $i <= $total_rows; $i++) {

            $z = $i + 1; // $z 는 엑셀 양식에서 다음행의 값을 의미함

            $time = $sheetData[$i][$colIndexArr['orderDateTime']];
            $t = date("Y-m-d", time_convert_EXCEL_to_PHP($time));


            $matchingScore = 0;
            $highestScore = 0;
            $highestCode = NULL;

            foreach ($productList as $optionCode => $menuNameArr) {
                $inputMenu = strtokarr($sheetData[$i][$colIndexArr['productName']]);

                foreach ($inputMenu as $menuName) {
                    if (in_array($menuName, $menuNameArr)) $matchingScore++;
                }

                if ($matchingScore > $highestScore) {
                    $highestCode = $optionCode;
                    $highestScore = $matchingScore;
                }

                $matchingScore = 0;

            }

            if ($highestCode !== NULL) {
                $SQL0 = $db->query("SELECT erpCode, ea FROM godoFreeEventMenuCalendarTemp WHERE optionCode='" . $highestCode . "' ORDER BY erpCode DESC");
                $ROW0 = $SQL0->getResultArray();

                $prdCode = $ROW0;

                $priceSum = 0;

                for ($k = 0; $k < count($prdCode); $k++) {
                    $SQL1 = $db->query("SELECT * FROM godoConvert WHERE viewYN = 'Y' and erpCode = '" . $prdCode[$k]['erpCode'] . "'");
                    $ROW1 = $SQL1->getRowArray();
                    $priceSum += $ROW1['price'] * $sheetData[$i][$colIndexArr['orderAmount']] * $prdCode[$k]['ea'];
                }

                switch ($highestCode) {
                    case "LMNB021-001" :
                        $realPrice = 28900;
                        $danga = 2370;
                        break;
                    case "LMNC021-001" :
                        $realPrice = 31900;
                        $danga = 2620;
                        break;
                    case "LMND021-001" :
                        $realPrice = 47900;
                        $danga = 2620;
                        break;
                    case "LMND021-002" :
                        $realPrice = 48900;
                        $danga = 2670;
                        break;
                    case "LMNE021-001" :
                        $realPrice = 49900;
                        $danga = 2730;
                        break;
                    default :
                        echo "<tr> No Code for real price. </tr>"; // Error Printing
                }

                $saleRate = $realPrice / $priceSum;

                switch ($highestCode) {
                    case "LMNB021-001" :
                        $pointSum = 2;
                        break;
                    case "LMNC021-001" :
                        $pointSum = 42;
                        break;
                    case "LMND021-001" :
                        $pointSum = 22;
                        break;
                    case "LMND021-002" :
                        $pointSum = -48;
                        break;
                    case "LMNE021-001" :
                        $pointSum = 32;
                        break;
                    default :
                        echo "<tr> No Code for discount price. </tr>"; // Error Printing
                }

                for ($j = 0; $j < count($prdCode); $j++) {
                    $SQL2 = $db->query("SELECT * FROM godoConvert WHERE viewYN = 'Y' and erpCode = '" . $prdCode[$j]['erpCode'] . "'");
                    $ROW2 = $SQL2->getRowArray();

                    $rhdrmq = 0; // 공급가?
                    $tax = 0;

                    if ($ROW2['taxYN'] == "Y") { //과세
                        $rhdrmq = (int)($danga / 1.1) * $sheetData[$i][$colIndexArr['orderAmount']];
                        $tax = ($danga * $sheetData[$i][$colIndexArr['orderAmount']]) - $rhdrmq;
                    } else { //비과세
                        $rhdrmq = $danga * $sheetData[$i][$colIndexArr['orderAmount']];
                        $tax = "0";
                    }

                    if ($j < count($prdCode)) {
                        /**
                         * @brief 주문 내역 양식 출력부
                         */
                        ?>
                        <tr>
                            <td style='mso-number-format:"\@";'>18500</td>
                            <td style='mso-number-format:"\@";'>
                                <?php // 창고 코드를 출력하는 부분
                                echo "61000"; // 충주공장 냉장배송 창고코드
                                ?></td>
                            <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@";'>1000955</td>
                            <td style='mso-number-format:"\@";'>0214003</td>
                            <td style='mso-number-format:"\@";'><?= $ROW2['erpCode']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $ROW2['prdName']; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['orderAmount']] * $prdCode[$j]['ea'] ?></td>
                            <!-- 수량//-->
                            <td style='mso-number-format:"\@";'><?php if (preg_match("/SGS.*/", trim($ROW2['erpCode']))) echo 0; else echo $danga; ?></td>
                            <!-- 단가 -->
                            <td style='mso-number-format:"\@";'><?php if (preg_match("/SGS.*/", trim($ROW2['erpCode']))) echo 0; else echo $rhdrmq * $prdCode[$j]['ea']; ?></td>
                            <!-- 공급가액 -->
                            <td style='mso-number-format:"\@";'><?php if (preg_match("/SGS.*/", trim($ROW2['erpCode']))) echo 0; else echo $tax * $prdCode[$j]['ea']; ?></td>
                            <!-- 부가세-->
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['receiver']]; ?></td>
                            <!-- 수령자//-->
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['paymentMethod']]; ?></td>
                            <!-- 결제조건//-->
                            <td style='mso-number-format:"\@";'>2021-12-16</td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['ordererTel']]; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['receiverPostCode']]; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['receiverAddress']]; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['deliveryMemo']]; ?></td>
                            <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['orderNo']]; ?></td>
                            <td style='mso-number-format:"\@";'></td><!--//맴버ID-->
                            <td style='mso-number-format:"\@";'></td><!--//제품종류-->
                            <td align='center'></td>
                            <td align='center'></td>
                            <td align='center'></td>
                            <td align='center'></td>
                        </tr>
                        <?php
                    } // end - if ( $j < count($prdCode) )

                }// for ( $j = 0; $j < count($prdCode); $j++)


                $SQL = $db->query("SELECT * FROM godoConvert where 1 and viewYN = 'Y' and erpCode = '" . $ROW2['erpCode'] . "'");
                $ROW = $SQL->getRowArray();

                //$prdName = ($sheetData[$i][$colIndexArr['orderNo']]=="000000") ? $sheetData[$i][$colIndexArr['optionInfo']] . "[]" : $sheetData[$i][$colIndexArr['optionInfo']];
                if ($_CSJ_DEBUG_LEVEL == 2) echo "<tr> <td>주문번호 " . $sheetData[$z][$colIndexArr['productOrderNo']] . " / " . $sheetData[$i][$colIndexArr['productOrderNo']] . "</td></tr>";

                // 마일리지 출력부분 제거
                if ($pointSum) {
                    ?>
                    <tr>
                        <td style='mso-number-format:"\@";'>18500</td>
                        <td style='mso-number-format:"\@";'>
                            <?php // 창고 코드
                            echo "61000"; // 충주 공장
                            ?></td>
                        <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                        <td style='mso-number-format:"\@";'>1000955</td>
                        <td style='mso-number-format:"\@";'>0214003</td>
                        <td style='mso-number-format:"\@";'>SGS001-002</td>
                        <td style='mso-number-format:"\@";'>[자사몰]마일리지</td>
                        <td style='mso-number-format:"\@";'>1</td><!--마일리지는 수량 무조건 1-->
                        <td style='mso-number-format:"\@";'><?= 0 - ($pointSum *$sheetData[$i][$colIndexArr['orderAmount']]); ?></td>
                        <td style='mso-number-format:"\@";'><?= 0 - ($pointSum *$sheetData[$i][$colIndexArr['orderAmount']]); ?></td>
                        <td style='mso-number-format:"\@";'>0</td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['receiver']]; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['paymentMethod']]; ?></td>
                        <td style='mso-number-format:"\@";'>2021-12-16</td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['receiverContact']]; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['receiverPostCode']]; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['receiverAddress']]; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['deliveryMemo']]; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['orderNo']]; ?></td>
                        <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['orderNo']]; ?></td>
                        <td style='mso-number-format:"\@";'></td>
                        <td align='center'></td>
                        <td align='center'></td>
                        <td align='center'></td>
                        <td align='center'></td>
                    </tr>
                    <?php
                    $pointSum = 0; // 총 마일리지포인트 초기화
                }





            }


        }


    }


}