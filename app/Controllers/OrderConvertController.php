<?php

namespace App\Controllers;

use \CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use App\Models\EventListModel;
use App\Models\EventComponentsModel;
use App\Models\GodoConvertModel;

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


class OrderConvertController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        echo view('orderConvert/templates/header');
        echo view('orderConvert/godoConvert/godoConvertVenetmealVer4');
        echo view('orderConvert/templates/footer');
    }

    public function godoConvertVenetmealVer4()
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

        $today = date("Y-m-d");

        function time_convert_EXCEL_to_PHP($time)
        {
            $t = ($time - 25569) * 86400 - 60 * 60 * 9;
            $t = round($t * 10) / 10;
            return $t;
        }


        $mealGubun = array("F-A", "F-B", "F-C", "F-D", "F-E", "SKT-A", "SKT-B", "SKT-C", "SKT-D", "SKT-E", "SP-B", "SP-C", "SP-D", "SP-D2", "SP-D3", "SP-DE", "SP-E", "IBK-A", "IBK-B", "IBK-C", "IBK-D", "IBK-E", "acm_A", "acm_B", "acm_C", "acm_D2", "acm_D3", "acm_DE", "acm_F");


        $eventGoods = array(
            "SET-A10", "SET-B10", "SET-C10", "SET-001", "SET-002", "E001-01", "E001-02", "E001-03", "E001-04",
            "HPB-401", "HPB-402", "HPB-601", "HPB-602", "HPC-401", "HPC-402", "HPC-601", "HPC-602",
            "HOB-101", "HOC-101", "HOD-101", "HOD-102", "HOE-101",
            "HNB-101", "HNC-101", "HND-101", "HND-102", "HNE-101",
            "HMB-101", "HMC-101", "HMD-101", "HMD-102", "HME-101",
            "HPD2-401", "HPD2-402", "HPD2-601", "HPD2-602", "HPD3-401", "HPD3-402", "HPD3-601", "HPD3-602",
            "HPDE-401", "HPDE-402", "HPDE-601", "HPDE-602", "HPE-401", "HPE-402", "HPE-601", "HPE-602",
            "HLWB021-001", "HLWC021-001", "HLWD021-001", "HLWD021-002", "HLWE021-001", "HLWF021-001",
            "HPB-901", "HPC-901", "HPD-901", "HPD-902", "HPE-901",
            "EV03-A", "EV03-B", "EV03-C", "EV03-D2", "EV03-D3", "EV03-DE", "EV03-E",
            "EV04-A", "EV04-B", "EV04-C", "EV04-D2", "EV04-D3", "EV04-DE", "EV04-E",
            "EV01-A", "EV01-B", "EV01-C", "EV01-D2", "EV01-D3", "EV01-DE", "EV01-E",
            "EV02-A", "EV02-B", "EV02-C", "EV02-D2", "EV02-D3", "EV02-DE", "EV02-E",
            "EV05-A", "EV05-B", "EV05-C", "EV05-D2", "EV05-D3", "EV05-DE", "EV05-E",
            "ABC001-0012", "ABC001-0013", "ABC001-0011", "EV-CJ",
            "EV10-B", "EV10-C", "EV10-D2", "EV10-D3", "EV10-DE", "EV10-E",
            "CR001-01", "CR001-02", "DR001-01", "DR001-02", "ER001-01", "ER001-02", "CB001-01", "DB001-01", "EB001-01", "CK001-01", "DK001-01", "EK001-01", "CR002-01", "DR002-01", "ER002-01", "CB002-01", "DB002-01", "EB002-01",
            "CK002-01", "DK002-01", "EK002-01", "CR003-01", "DR003-01", "ER003-01", "CB003-01", "DB003-01", "EB003-01", "CK003-01", "DK003-01", "EK003-01", "CB001-02", "DB001-02", "EB001-02", "DK001-02", "EK001-02", "CR002-02",
            "DR002-02", "ER002-02", "CB002-02", "DB002-02", "EB002-02", "CK002-02", "DK002-02", "EK002-02", "CR003-02", "DR003-02", "ER003-02", "CB003-02", "DB003-02", "EB003-02", "CK003-02", "DK003-02", "EK003-02", "HV19-B", "HV19-C", "HV19-D2", "HV19-D3", "HV19-DE", "HV19-E", "ONB006-002", "PSMC001-001", "PSMD001-001", "PSME001-001", "PSMC001-002", "PSMD001-002", "PSME001-002", "PSMC001-003", "PSMC001-001-1", "PSMD001-003", "PSME001-003", "PSME001-003-1", "PSME001-001-1", "PNLB001-001", "PNLC001-001", "PNLD001-001", "PNLE001-001", "PNMC001-001", "PNMD001-001", "PNME001-001", "EV-HW",
            "NOVF021-001", "NOVF021-002", "NOVF021-003", "NOVE021-001", "NOVE021-002",
            "NOVB021-001", "NOVC021-001", "NOVD021-001", "NOVM021-001", "NOVE021-003",
            "NOVB021-002", "NOVC021-002", "NOVD021-002", "NOVD021-003", "NOVE021-004", // 한우기획팩 이벤트 주문 코드 by Cho Sung Jae at 21.11.16
            "DECB021-001", "DECC021-001", "DECD021-001", "DECD021-002", "DECE021-001", // 한우기획팩 이벤트 주문 코드 by Cho Sung Jae at 21.11.30
            "BF021-001", "BF021-002", "BF021-003", "BF021-004", "BF021-005", "BF021-006", "BF021-007",
            "BF021-008", "BF021-009", "BF021-010", // 2021년 11월 16일 블랙프라이데이 주문 코드 추가 by Cho Sung Jae at 21.11.16
            "NOVA021-101", "NOVA021-102", "NOVC021-101", "NOVC021-102", "NOVD021-101", "NOVD021-102", "NOVE021-101", "NOVE021-102", "NOVF021-101", "NOVF021-102", // 2021년 11월 만원의 행복 이벤트 코드 added by Cho Sung Jae at 21.11.15
            "FEBB022-001", "FEBB022-002", "FEBC022-001", "FEBC022-002", "FEBD022-001", "FEBD022-002", "FEBE022-001", "FEBE022-002", //2022년 2월 만원의 행복 기획팩 이벤트 코드 added by Lee Yont Suk at 22.01.27
            "LMNB021-001", "LMNC021-001", "LMND021-001", "LMND021-002", "LMNE021-001", // 레몬트리 기획전 주문 코드 by Cho Sung Jae at 21.12.01
            "TTS0121-001", "TTS0121-002", // 12월 타임세일 단품이벤트 코드 added by Cho Sung Jae at 21.12.03
            "TTS022-001", "TTS022-002", "TTS022-003", // 22년 2월 타임세일(간식세트) 코드 added by LEE Yong Suk at 22.01.28
            "DECB121-001", "DECB121-002", "DECC121-001", "DECC121-002", "DECD121-001", "DECD121-002", "DECE121-001", "DECE121-002", "DECF121-001", "DECF121-002", // 12월 만원의 행복 이벤트 주문코드 추가
            "DECB221-001", "DECB221-002", "DECC221-001", "DECC221-002", "DECD221-001", "DECD221-002", "DECE221-001", "DECE221-002", "DECF221-001", "DECF221-002", // 12월 연휴기획팩 이벤트 주문코드 추가
            "KDS021-011", "KDS021-012", "KDS021-013", "KDS021-021", "KDS021-022", "KDS021-023", "KDS021-031", "KDS021-032", "KDS021-033", // 12월 반찬국세트 주문코드 added by Cho Sung Jae at 21.12.14
            "LIVEB021-001", "LIVEC021-001", "LIVED021-001", "LIVEDE021-001", "LIVEE021-001", "LIVEF021-001", //[12월 27일 네이버 라이브방송] CRM 주문코드 added by Lee Yong Suk at 21.12.15
            "HALFE021-001", "HALFE021-002", "HALFF021-001", "HALFF021-002", "HALFF021-003", "HALFF021-004", //[12월30 2022반값 기획팩] CRM 주문코드 추가 added by Lee Yong Suk at 2021-12-21
            "PLNG001-001", "PLNG001-002", "PLNG001-003", "PLNG001-004", "PLNG001-005", "PLNG001-006", "PLNG001-007", "PLNG001-008", // 밥/국/반찬세트 ERP 코드 추가 added by Cho Sung Jae at 21.12.24
            "PLNG002-001", "PLNG002-002", "PLNG002-003", "PLNG002-004", "PLNG002-005", //반찬국기획팩 CRM 주문코드 추가 added by Lee Yong Suk at 22.02.10
            "FEBF011-001", "FEBF011-002", //반찬&국 체험팩 CRM 주문코드 추가 added by Lee Yong Suk at 22.01.04
            "FEBF012-001", "FEBF012-002", "FEBF012-003", "FEBF012-004", "FEBF012-005", //배냇밥상 기획팩 CRM 주문코드 추가 added by Lee Yong Suk at 22.01.04
            "FEBB002-001", "FEBC002-001", "FEBD002-001", "FEBDE002-001", "FEBE002-001", "FEBF002-001", "FEBG002-001", //2월 기획전(한우가득기획팩) CRM 주문코드 추가 added by Lee Yong Suk at 2022-01-25
            "MARB022-001", "MARC022-001", "MARD022-001", "MARDE022-001", "MARE022-001", "MARF022-001", "MARG022-001", //3월 기획전(한우가득기획팩) CRM 주문코드 추가 added by Lee Yong Suk at 2022-02-18
            "JANB001-001", "JANB001-002", "JANB001-003", "JANC001-001", "JANC001-002", "JANC001-003",    //초기,중기  <!-- [시작] 설연휴 기획팩 CRM 주문 코드 추가 added by Lee Yong Suk at 22.01.10
            "JAND001-001", "JAND001-002", "JAND001-003", "JANDE001-001", "JANDE001-002", "JANDE001-003", //후기, 병행기
            "JANE001-001", "JANE001-002", "JANE001-003", "JANF001-001", "JANF001-002", "JANF001-003",    //완료기,유아식
            "JANG001-001", "JANG001-002", "JANG001-003",                                              //반찬       [끝] -->
            "TGIHB21-001", "TGIHC21-001", "TGIHD21-001", "TGIHD21-002", "TGIHD21-003", "TGIHE21-001"
        );


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
        $pointSum = 0;

        $colIndexHeader = "";
        $colIndex = 'A';
        $columnHeaderArr = $sheetData[1];
        $colIndexArr = array();

        $eventModel = new EventComponentsModel();
        $godoConvert = new GodoConvertModel();
        $db = \Config\Database::connect();
        $builder_MenuCalendar = $db->table('godoFreeEventMenuCalendarTemp');
        $builder_godoConvert = $db->table('godoConvert');

        if ($_CSJ_DEBUG_LEVEL == 1) echo "<tr>";
        foreach ($columnHeaderArr as $_colIndex) {
            $colStr = $colIndexHeader . $colIndex;
            if ($_CSJ_DEBUG_LEVEL == 1) echo $colStr . " : " . $_colIndex . " ";

            switch ($sheetData[1][$colStr]) {
                case "주문상태":
                    $colIndexArr['orderStatus'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderStatus'] . " : " . $colStr . "\n";
                    break;
                case "자체상품코드":
                    $colIndexArr['erpCode'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['erpCode'] . " : " . $colStr . "\n";
                    break; // A
                case "자체옵션코드":
                    $colIndexArr['optionCode'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['optionCode'] . " : " . $colStr . "\n";
                    break; // B
                case "옵션정보":
                    $colIndexArr['optionInfo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['optionInfo'] . " : " . $colStr . "\n";
                    break;
                case "상품명":
                    $colIndexArr['productName'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['productName'] . " : " . $colStr . "\n";
                    break;
                case "회원명":
                    $colIndexArr['memberName'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['memberName'] . " : " . $colStr . "\n";
                    break;
                case "총 결제 금액":
                    $colIndexArr['totalPay'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['totalPay'] . " : " . $colStr . "\n";
                    break;
                case "총 품목 금액":
                    $colIndexArr['totalPrice'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['totalPrice'] . " : " . $colStr . "\n";
                    break;
                case "총 배송 금액":
                    $colIndexArr['totalDeliveryFee'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['totalDeliveryFee'] . " : " . $colStr . "\n";
                    break;
                case "사용된 총 마일리지":
                    $colIndexArr['totalUsedMileage'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['totalUsedMileage'] . " : " . $colStr . "\n";
                    break;
                case "결제방법":
                    $colIndexArr['payMethod'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['payMethod'] . " : " . $colStr . "\n";
                    break;
                case "수취인 이름":
                    $colIndexArr['recipient'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['recipient'] . " : " . $colStr . "\n";
                    break;
                case "수취인 핸드폰 번호":
                    $colIndexArr['recipientPhone'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['recipientPhone'] . " : " . $colStr . "\n";
                    break;
                case "주문자 핸드폰 번호":
                    $colIndexArr['ordererPhone'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['ordererPhone'] . " : " . $colStr . "\n";
                    break;
                case "수취인 우편번호":
                    $colIndexArr['recipientPostNumber'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['recipientPostNumber'] . " : " . $colStr . "\n";
                    break;
                case "수취인 전체주소":
                    $colIndexArr['recipientAddress'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['recipientAddress'] . " : " . $colStr . "\n";
                    break;
                case "새벽배송 공동현관 출입정보":
                    $colIndexArr['dawnDeliveryInfo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['dawnDeliveryInfo'] . " : " . $colStr . "\n";
                    break;
                case "주문시 남기는 글":
                    $colIndexArr['ordererMemo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['ordererMemo'] . " : " . $colStr . "\n";
                    break;
                case "상품주문번호":
                    $colIndexArr['productOrderNo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['productOrderNo'] . " : " . $colStr . "\n";
                    break;
                case "수량":
                case "상품수량":
                    $colIndexArr['productAmount'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['productAmount'] . " : " . $colStr . "\n";
                    break;
                case "주문 품목 개수":
                    $colIndexArr['productKind'] = $colStr;
                    if (!$colStr) {
                        $colIndexArr['productKind'] = "";
                    }
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['productKind'] . " : " . $colStr . "\n";
                    break;
                case "주문일자":
                    $colIndexArr['orderDate'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderDate'] . " : " . $colStr . "\n";
                    break; // S
                case "상품 할인 금액":
                    $colIndexArr['productDiscountPrice'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['productDiscountPrice'] . " : " . $colStr . "\n";
                    break;
                case "총 모바일앱 할인금액":
                case "모바일앱 할인금액":
                case "회원 할인 금액":
                    $colIndexArr['membershipDiscountPrice'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['membershipDiscountPrice'] . " : " . $colStr . "\n";
                    break;
                case "판매가":
                    $colIndexArr['salePrice'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['salePrice'] . " : " . $colStr . "\n";
                    break;
                case "옵션 금액":
                    $colIndexArr['optionPrice'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['optionPrice'] . " : " . $colStr . "\n";
                    break;
                case "쿠폰 할인 금액":
                    $colIndexArr['couponDiscountPrice'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['couponDiscountPrice'] . " : " . $colStr . "\n";
                    break;
                case "사용된 마일리지":
                    $colIndexArr['usedMileage'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['usedMileage'] . " : " . $colStr . "\n";
                    break;
                case "주문 번호":
                    $colIndexArr['orderNo'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['orderNo'] . " : " . $colStr . "\n";
                    break;
                case "회원 아이디":
                    $colIndexArr['memberId'] = $colStr;
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['memberId'] . " : " . $colStr . "\n";
                    break;
                case "새벽배송여부":
                    $colIndexArr['dawnDelivery'] = $colStr;
                    if (!$colStr) {
                        $colIndexArr['dawnDelivery'] = "";
                    }
                    if ($_CSJ_DEBUG_LEVEL == 1) echo $sheetData[1][$colStr] . $colIndexArr['dawnDelivery'] . " : " . $colStr . "\n";
                    break;
                default:
                    // 인식되지 않은 칼럼의 제목값을 출력한다. added by Cho Sung Jae at 21-11-19
                    if ($_CSJ_DEBUG_LEVEL == 1) echo "</tr><tr>"; else echo "<tr>";
                    echo $colStr . " : " . $colStr . " 칸의 제목을 인식하지 못했습니다.";
                    if ($_CSJ_DEBUG_LEVEL == 1) echo "</tr><tr>"; else echo "</tr>";
            }
            if ($colStr == "Z") {
                $colIndexHeader = 'A';
                $colIndex = 'A';
            } else $colIndex = chr(ord($colIndex) + 1);
        }
        if ($_CSJ_DEBUG_LEVEL == 1) print_r($colIndexArr);
        if ($_CSJ_DEBUG_LEVEL == 1) echo "</tr>";


        for ($i = 2; $i <= $total_rows; $i++) {
            $z = $i + 1;

            $time = $sheetData[$i][$colIndexArr['orderDate']];
            $t = date("Y-m-d", time_convert_EXCEL_to_PHP($time));


            if ( // 이유식이나, 영양식 제품이 아닌 것을 확인 하는 필터 부분
                $sheetData[$i][$colIndexArr['productName']] != "이유식"
                && $sheetData[$i][$colIndexArr['productName']] != "영양식"
                && $sheetData[$i][$colIndexArr['productName']] != "뉴플러스 F"
                && $sheetData[$i][$colIndexArr['productName']] != "뉴플러스 Z"
                && $sheetData[$i][$colIndexArr['productName']] != "뉴플러스 V"
                && $sheetData[$i][$colIndexArr['productName']] != "생유산균(5입)"
            ) {

                if (
                    in_array($sheetData[$i][$colIndexArr['erpCode']], $mealGubun)
                    || in_array($sheetData[$i][$colIndexArr['optionCode']], $mealGubun)
                    || in_array($sheetData[$i][$colIndexArr['erpCode']], $eventGoods)
                    || in_array($sheetData[$i][$colIndexArr['optionCode']], $eventGoods)
                ) {


                    $query0 = $eventModel->select('erpCode, ea');
                    if (in_array($sheetData[$i][$colIndexArr['erpCode']], $mealGubun)) {
                        $query0->where('optionCode', "{$sheetData[$i][$colIndexArr['erpCode']]}")
                            ->where('orderDate', "{$t}")
                            ->orderBy('erpCode', 'DESC');
                        $ROW0 = $query0->asArray()->findAll();
                        $CNT = count($ROW0);
                        $ROW0[$CNT]['erpCode'] = "[PHL]FirstOrder";
                        $ROW0[$CNT]['ea'] = "1";
                        $prdCode = $ROW0;
                    } else if (in_array($sheetData[$i][$colIndexArr['erpCode']], $eventGoods)) {
                        $query0->where('optionCode', "{$sheetData[$i][$colIndexArr['erpCode']]}")
                            ->orderBy('erpCode', 'DESC');
                        $ROW0 = $query0->asArray()->findAll();
                        $prdCode = $ROW0;
                    } else if (in_array($sheetData[$i][$colIndexArr['optionCode']], $mealGubun)) {
                        $query0->where('optionCode', "{$sheetData[$i][$colIndexArr['optionCode']]}")
                            ->where('orderBy', "$t")
                            ->orderBy('erpCode', 'DESC');
                        $ROW0 = $query0->asArray()->findAll();
                        $CNT = count($ROW0);
                        $ROW0[$CNT]['erpCode'] = "[PHL]FirstOrder";
                        $ROW0[$CNT]['ea'] = "1";
                        $prdCode = $ROW0;
                    } else {
                        $query0->where('optionCode', "{$sheetData[$i][$colIndexArr['optionCode']]}")
                            ->orderBy('erpCode', 'DESC');
                        $ROW0 = $query0->asArray()->findAll();
                        $prdCode = $ROW0;
                    }

                    // 세트 주문 품목 반복문 내에서 사용할 변수 선언
                    $priceSum = 0;
                    $saleRate = 0;
                    $dangaSum = 0;


                    for ($k = 0; $k < count($prdCode); $k++) {
                        $query1 = $db->query("SELECT * FROM godoConvert WHERE viewYN = 'Y' and erpCode = '{$prdCode[$k]['erpCode']}'");
                        $ROW1 = $query1->getRowArray();

                        $priceSum += $ROW1['price'] * $sheetData[$i][$colIndexArr['productAmount']] * $prdCode[$k]['ea'];
                    }

                    $realPrice = (($sheetData[$i][$colIndexArr['salePrice']] + $sheetData[$i][$colIndexArr['optionPrice']]) * $sheetData[$i][$colIndexArr['productAmount']])
                        - $sheetData[$i][$colIndexArr['productDiscountPrice']] - $sheetData[$i][$colIndexArr['membershipDiscountPrice']] - $sheetData[$i][$colIndexArr['couponDiscountPrice']];


                    if (is_null($priceSum)) {
                        if ((int)$sheetData[$i][$colIndexArr['totalPrice']] > 0) {
                            $priceSum = $sheetData[$i][$colIndexArr['totalPrice']];
                        } else {
                            $priceSum = $realPrice;
                        }
                    }
                    if ($priceSum == 0) {
                        $saleRate = 1;
                    } else {
                        $saleRate = $realPrice / $priceSum; // 할인율: 배송비제외한 실제결제금액을 원래 판매가들의 합으로 나누기
                    }

                    if ($_CSJ_DEBUG_LEVEL == 1) echo "<tr>할인율 : " . $saleRate . " / 판매 가격 : " . $realPrice . " / 총 품목 가격 : " . $priceSum . "</tr>";

                    if ($sheetData[$i][$colIndexArr['usedMileage']] != "0포인트") {
                        $sheetData[$i][$colIndexArr['usedMileage']] = str_replace(",", "", $sheetData[$i][$colIndexArr['usedMileage']]);
                        $sheetData[$i][$colIndexArr['usedMileage']] = str_replace("포인트", "", $sheetData[$i][$colIndexArr['usedMileage']]);
                        $pointSum += $sheetData[$i][$colIndexArr['usedMileage']];
                        //마일리지포인트가 있으면 있을 때마다 마일리지합계에다가 합쳐두었다가 해당 사람의 주문건이 끝나면 마지막에 합산된 마일리지 삽입.
                    }
                    for ($j = 0; $j <= count($prdCode); $j++) {
                        if ($j == count($prdCode)) {
                            $query2 = $db->query("SELECT * FROM godoConvert WHERE viewYN = 'Y' and erpCode = ''");
                            $ROW2 = $query2->getRowArray();

                        } else {
                            $query2 = $db->query("SELECT * FROM godoConvert WHERE viewYN = 'Y' and erpCode = '" . $prdCode[$j]['erpCode'] . "'");
                            $ROW2 = $query2->getRowArray();

                        }

                        $danga = (int)($ROW2['price'] * $saleRate);
                        $rhdrmq = 0; // 공급가?
                        $tax = 0;
                        if ($ROW2['taxYN'] == "Y") { //과세
                            $rhdrmq = (int)($danga / 1.1) * $sheetData[$i][$colIndexArr['productAmount']];
                            $tax = ($danga * $sheetData[$i][$colIndexArr['productAmount']]) - $rhdrmq;
                        } else { //비과세
                            $rhdrmq = $danga * $sheetData[$i][$colIndexArr['productAmount']];
                            $tax = "0";
                        }

                        $dangaSum += $danga;


                        if ($j < count($prdCode)) {
                            /**
                             * @brief 주문 내역 양식 출력부
                             */
                            ?>
                            <tr>
                                <td style='mso-number-format:"\@";'>18500</td>
                                <td style='mso-number-format:"\@";'>
                                    <?php // 창고 코드를 출력하는 부분
                                    if ( // 이벤트 상품 주문, 무료 체험 주문일 경우, 냉장창고 혹은 일반택배 창고 코드를 출력하도록 함
                                        in_array($sheetData[$i][$colIndexArr['erpCode']], $mealGubun)
                                        || in_array($sheetData[$i][$colIndexArr['optionCode']], $mealGubun)
                                        || in_array($sheetData[$i][$colIndexArr['erpCode']], $eventGoods)
                                        || in_array($sheetData[$i][$colIndexArr['optionCode']], $eventGoods)
                                    ) {
                                        // 일반배송상품 목록을 작성하고, 해당 상품인 경우 일반창고코드 30020 을 출력함 by Cho Sung Jae at 2021-11-17
                                        $generalPkgList = array(
                                            "OHB001-004", // 요거트[딸기]
                                            "OHB006-013", // 쌀떡뻥[콜라비]
                                            "OHB019-002", // 찹쌀구름[자색고구마]
                                            "PHB007-002", // 쌩마멧[바나나]
                                            "TOH001-002", // 젖병&주방세제 액상형
                                            "TOH001-008", // 베이비 섬유 세제
                                        );
                                        if ( // ERP 코드 값에 따라 일반배송 창고코드를 출력하도록 수정함 by Cho Sung Jae at 2021-11-17
                                        in_array(trim($ROW2['erpCode']), $generalPkgList)
                                        )
                                            echo "30020"; // 일반택배 창고코드
                                        else // 일반배송 상품 목록에 없는 ERP 코드일 경우, 냉장창고에서 출고하도록 함
                                            echo "61000"; // 충주공장 냉장배송 창고코드
                                    } else if (
                                        $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0012"
                                        || $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0013"
                                        || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0012"
                                        || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0013"
                                        || $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0011"
                                        || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0011"
                                        || $sheetData[$i][$colIndexArr['erpCode']] == "EV-HW"
                                    ) {
                                        echo "30020";
                                    } else {
                                        echo $ROW2["cCode"];
                                    }
                                    ?></td>
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                                <td style='mso-number-format:"\@";'>1001162</td>
                                <td style='mso-number-format:"\@";'>0204002</td>
                                <td style='mso-number-format:"\@";'><?= $ROW2['erpCode']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $ROW2['prdName']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['productAmount']] * $prdCode[$j]['ea'] ?></td>
                                <!-- 수량//-->
                                <td style='mso-number-format:"\@";'><?= $danga; ?></td> <!-- 단가 -->
                                <td style='mso-number-format:"\@";'><?= $rhdrmq * $prdCode[$j]['ea']; ?></td>
                                <!-- 공급가액 -->
                                <td style='mso-number-format:"\@";'><?= $tax * $prdCode[$j]['ea']; ?></td><!-- 부가세-->
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipient']]; ?></td>
                                <!-- 수령자//-->
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['payMethod']]; ?></td>
                                <!-- 결제조건//-->
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d", strtotime("+1 day")); ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientPhone']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientPostNumber']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientAddress']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['ordererMemo']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['orderNo']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['memberId']]; ?></td>
                                <td style='mso-number-format:"\@";'></td>
                                <td align='center'></td>
                                <td align='center'></td>
                                <td align='center'></td>
                                <td align='center'></td>

                            </tr>
                            <?php
                        } // end - if ( $j < count($prdCode) )
                        else if (
                            $j == (count($prdCode) - 1)
                        ) {
                            /**
                             * 주문에 대한 포인트 비용을 출력하는 부분
                             */
                            // 만약 총 할인율을 적용해서 나온 단가들의 합이 총 품목금액과 같다면 그대로 입력.
                            // 만약 총 할인율을 적용해서 나온 단가들의 합이 총 품목금액과 다르다면 빼서 fin값으로
                            $adjust = $dangaSum - (int)($realPrice / $sheetData[$i][$colIndexArr['productAmount']]); //단가의 합은 실결제금액을 수량으로 나눈 값이 되어야함.
                            $finDanga = $danga - $adjust;
                            $finTax = 0;
                            $finRhdrmq = 0;
                            if ($ROW2['taxYN'] == "Y") { //과세
                                $finRhdrmq = (int)($finDanga / 1.1) * $sheetData[$i][$colIndexArr['productAmount']];
                                $finTax = ($finDanga * $sheetData[$i][$colIndexArr['productAmount']]) - $finRhdrmq;
                            } else {
                                $finRhdrmq = $finDanga * $sheetData[$i][$colIndexArr['productAmount']];
                                $finTax = "0";
                            }
                            ?>
                            <tr>
                                <td style='mso-number-format:"\@";'>18500</td>
                                <td style='mso-number-format:"\@";'>
                                    <?php
                                    if (
                                        in_array($sheetData[$i][$colIndexArr['erpCode']], $mealGubun)
                                        || in_array($sheetData[$i][$colIndexArr['optionCode']], $mealGubun)
                                        || in_array($sheetData[$i][$colIndexArr['erpCode']], $eventGoods)
                                        || in_array($sheetData[$i][$colIndexArr['optionCode']], $eventGoods)
                                    ) {
                                        // 블랙 프라이데이로 인해서 일부 상품 택배창고에서 보내기로 요청 들어옮. 2021-11-17 추가 작업 함. hjlee
                                        // 일반배송상품 목록을 작성하고, 해당 상품인 경우 일반창고코드 30020 을 출력함 by Cho Sung Jae at 2021-11-17
                                        $generalPkgList = array(
                                            "OHB001-004", // 요거트[딸기]
                                            "OHB006-013", // 쌀떡뻥[콜라비]
                                            "OHB019-002", // 찹쌀구름[자색고구마]
                                            "PHB007-002", // 쌩마멧[바나나]
                                            "TOH001-002", // 젖병&주방세제 액상형
                                            "TOH001-008", // 베이비 섬유 세제
                                        );
                                        if ( // ERP 코드 값에 따라 일반배송 창고코드를 출력하도록 수정함 by Cho Sung Jae at 2021-11-17
                                        in_array(trim($ROW2['erpCode']), $generalPkgList)
                                        )
                                            echo "30020"; // 일반택배 창고코드
                                        else // 일반배송 상품 목록에 없는 ERP 코드일 경우, 냉장창고에서 출고하도록 함
                                            echo "61000";
                                    } else if (
                                        $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0012"
                                        || $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0013"
                                        || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0012"
                                        || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0013"
                                        || $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0011"
                                        || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0011"
                                        || $sheetData[$i][$colIndexArr['erpCode']] == "EV-HW"
                                    ) {
                                        echo "30020";
                                    } else {
                                        echo $ROW2["cCode"];
                                    }
                                    ?></td>
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                                <td style='mso-number-format:"\@";'>1001162</td>
                                <td style='mso-number-format:"\@";'>0204002</td>
                                <td style='mso-number-format:"\@";'><?= $ROW2['erpCode']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $ROW2['prdName']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['productAmount']] * $prdCode[$j]['ea'] ?></td>
                                <td style='mso-number-format:"\@";'><?= $finDanga; ?></td>
                                <td style='mso-number-format:"\@";'><?= $finRhdrmq * $prdCode[$j]['ea']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $finTax * $prdCode[$j]['ea']; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipient']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['payMethod']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d", strtotime("+1 day")); ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientPhone']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientPostNumber']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientAddress']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['ordererMemo']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['orderNo']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['memberId']]; ?></td>
                                <td style='mso-number-format:"\@";'></td>
                                <td align='center'></td>
                                <td align='center'></td>
                                <td align='center'></td>
                                <td align='center'></td>
                            </tr>
                            <?php
                        }// end if ( $j == ( count($prdCode) - 1) )
                    }

                    /**
                     * @brief 배송비 출력부분
                     */
                    $query = $db->query("SELECT * FROM godoConvert where 1 and viewYN = 'Y' and erpCode = '" . $ROW2['erpCode'] . "'");
                    $ROW = $query->getRowArray();

                    $prdName = ($sheetData[$i][$colIndexArr['erpCode']]) ? $sheetData[$i][$colIndexArr['optionInfo']] . "[" . $sheetData[$i][$colIndexArr['erpCode']] . "]" : $sheetData[$i][$colIndexArr['optionInfo']];

                    if ($_CSJ_DEBUG_LEVEL == 2) echo "<tr> <td>주문번호 " . $sheetData[$z][$colIndexArr['productOrderNo']] . " / " . $sheetData[$i][$colIndexArr['productOrderNo']] . "</td></tr>";

                    /** @brief 배송지 및 사용 마일리지 표시 부분
                     * 주소지가 다른 경우, 별도의 배송건으로 인식하여, 배송비를 추가함.
                     * TODO : 추후 패키지 갯수, 품목 갯수, 주문 수량에 따라 추가로 배송비를 책정해야 할 수 있음
                     */

                    if ($sheetData[$i][$colIndexArr['productOrderNo']]) {
                        ?>
                        <tr>
                            <td style='mso-number-format:"\@"; background:yellow;'>18500</td>
                            <td style='mso-number-format:"\@"; background:yellow;'>
                                <?php
                                if (
                                    in_array($sheetData[$i][$colIndexArr['erpCode']], $mealGubun)
                                    || in_array($sheetData[$i][$colIndexArr['optionCode']], $mealGubun)
                                    || in_array($sheetData[$i][$colIndexArr['erpCode']], $eventGoods)
                                    || in_array($sheetData[$i][$colIndexArr['optionCode']], $eventGoods)
                                ) {
                                    echo "61000";
                                } else if (
                                    $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0012"
                                    || $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0013"
                                    || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0012"
                                    || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0013"
                                    || $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0011"
                                    || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0011"
                                    || $sheetData[$i][$colIndexArr['erpCode']] == "EV-HW"
                                ) {
                                    echo "30020";
                                } else {
                                    echo $ROW["cCode"];
                                }
                                ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= date("Y-m-d"); ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'>1001162</td>
                            <td style='mso-number-format:"\@"; background:yellow;'>0204002</td>
                            <td style='mso-number-format:"\@"; background:yellow;'>SGS001-001</td>
                            <td style='mso-number-format:"\@"; background:yellow;'>[자사몰]배송비</td>
                            <td style='mso-number-format:"\@"; background:yellow;'>1</td>
                            <td style='mso-number-format:"\@"; background:yellow;'>3000</td>
                            <td style='mso-number-format:"\@"; background:yellow;'>2727</td>
                            <td style='mso-number-format:"\@"; background:yellow;'>273</td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['recipient']]; ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['payMethod']]; ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= date("Y-m-d", strtotime("+1 day")); ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['recipientPhone']]; ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['recipientPostNumber']]; ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['recipientAddress']]; ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['ordererMemo']]; ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['orderNo']]; ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['memberId']]; ?></td>
                            <td style='mso-number-format:"\@"; background:yellow;'><?= $sheetData[$i][$colIndexArr['productOrderNo']] ?></td>
                            <td align='center' style="background:yellow;"></td>
                            <td align='center' style="background:yellow;"></td>
                            <td align='center' style="background:yellow;"></td>
                            <td align='center' style="background:yellow;"></td>
                        </tr>
                        <?php
                        if ($sheetData[$i][$colIndexArr['usedMileage']] != "0포인트") {
                            // 사용된 총 마일리지가 있을때. 마일리지를 I열데이터를 가져와서 쓰던 것을 Y열 데이터로 변환
                            // (그게 각 상품별로 나뉘어서 들어간 마일리지라서. I열은 총 주문에 사용된 마일리지를 표기해주는 것이라
                            // 이걸 쓰면 마일리지사용량이 하나를 변환할 때마다 총 사용량으로 들어가면서 뻥튀기됨.)
                            $sheetData[$i][$colIndexArr['usedMileage']] = str_replace(",", "", $sheetData[$i][$colIndexArr['usedMileage']]);
                            $sheetData[$i][$colIndexArr['usedMileage']] = str_replace("포인트", "", $sheetData[$i][$colIndexArr['usedMileage']]);

                            ?>
                            <tr>
                                <td style='mso-number-format:"\@";'>18500</td>
                                <td style='mso-number-format:"\@";'>
                                    <?php
                                    if (
                                        in_array($sheetData[$i][$colIndexArr['erpCode']], $mealGubun)
                                        || in_array($sheetData[$i][$colIndexArr['optionCode']], $mealGubun)
                                        || in_array($sheetData[$i][$colIndexArr['erpCode']], $eventGoods)
                                        || in_array($sheetData[$i][$colIndexArr['optionCode']], $eventGoods)
                                    ) {
                                        echo "61000";
                                    } else if (
                                        $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0012"
                                        || $sheetData[$i][$colIndexArr['erpCode']] == "ABC001-0013"
                                        || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0012"
                                        || $sheetData[$i][$colIndexArr['optionCode']] == "ABC001-0013"
                                        || $sheetData[$i][$colIndexArr['erpCode']] == "EV-HW"
                                    ) {
                                        echo "30020";
                                    } else {
                                        echo $ROW["cCode"];
                                    }
                                    ?></td>
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d"); ?></td>
                                <td style='mso-number-format:"\@";'>1001162</td>
                                <td style='mso-number-format:"\@";'>0204002</td>
                                <td style='mso-number-format:"\@";'>SGS001-002</td>
                                <td style='mso-number-format:"\@";'>[자사몰]마일리지</td>
                                <td style='mso-number-format:"\@";'>1</td><!--마일리지는 수량 무조건 1-->
                                <td style='mso-number-format:"\@";'><?= 0 - $pointSum; ?></td>
                                <td style='mso-number-format:"\@";'><?= 0 - $pointSum; ?></td>
                                <td style='mso-number-format:"\@";'>0</td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipient']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['payMethod']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= date("Y-m-d", strtotime("+1 day")); ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientPhone']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientPostNumber']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['recipientAddress']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['ordererMemo']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['orderNo']]; ?></td>
                                <td style='mso-number-format:"\@";'><?= $sheetData[$i][$colIndexArr['memberId']]; ?></td>
                                <td style='mso-number-format:"\@";'></td>
                                <td align='center' style="background:yellow;"></td>
                                <td align='center' style="background:yellow;"></td>
                                <td align='center' style="background:yellow;"></td>
                                <td align='center' style="background:yellow;"></td>
                            </tr>
                            <?php
                            $pointSum = 0; // 총 마일리지포인트 초기화
                        } // if ( $sheetData[$i]['Y'] != "0포인트" )


                    }
                }
            }
        }
            ?>
            </table>
            <?php


        }// godoConvertVenetmealVer4 method end


    }//class end
?>