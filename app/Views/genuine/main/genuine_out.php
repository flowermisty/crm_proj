<script>
    AOS.init();
</script>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap"
      rel="stylesheet">


<style>
    select {
        width: 100%; /* 원하는 너비설정 */

        padding: .5em .3em; /* 여백으로 높이 설정 */
        font-family: inherit; /* 폰트 상속 */
        background: url(https://farm1.staticflickr.com/379/19928272501_4ef877c265_t.jpg) no-repeat 95% 50%; /* 네이티브 화살표 대체 */
        border: 1px solid #dfe3e7;
        border-radius: .25rem; /* iOS 둥근모서리 제거 */
        -webkit-appearance: none; /* 네이티브 외형 감추기 */
        -moz-appearance: none;
        appearance: none;
    }

    #route_view {
        line-height: 40px;
        position: absolute;
        top: 13%;
        left: 52%;
        width: 200px;
        height: 40px;
        z-index: 1;
        border-radius: 5px;
        text-align: center;
        color: whitesmoke;
        font-weight: bold;
        display: none;
    }

    .badge:hover {
        opacity: 0.6;
    }

    .badge a {
        color: white;
    }

    .modal-body .form-group-wrapper {
        border-bottom: 1px dotted #ccc;
        margin: 0 auto;
        margin-bottom: 2%;

    }

    .modal-body .form-group-wrapper:last-child {
        border-bottom: 0;
        margin-bottom: 0;

    }


</style>


<!--<div class="page-heading">
    <h3>이벤트 등록 현황</h3>
</div>-->
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-12 order-md-1 order-last">
            <h3 class="text-title text-muted">정품출고</h3>
            <p class="text-subtitle text-muted"></p>
            <hr style="border-top:2px solid">
        </div>
        <div class="col-12 col-md-12 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">개인설정</a></li>
                    <li class="breadcrumb-item active" aria-current="page">정품출고</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-5" id="wrap">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0;">
                    <span class="text text-muted">검색조건<span>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" name="genuineForm" id="genuineForm">
                            <div class="row">

                                <div class="col-md-12 col-12" id="searchObjContainer" style="padding-left: 0;">
                                    <div class="form-group" style="display: flex;">

                                        <div class="col-10">
                                            <select name="searchObj" id="searchObj" onchange="addSearch(this);">
                                                <option value="">검색조건을 선택 하세요</option>
                                                <option value="2">담당자,고객명 전화번호</option>
                                                <option value="3">날짜(신청날짜,결재날짜,출고날짜)</option>
                                                <option value="4">구매비용</option>
                                                <option value="5">상태</option>
                                                <option value="6">용도</option>
                                                <option value="7">입출고 형태</option>
                                                <option value="8">출고창고</option>
                                                <option value="9">결과 내려받기 여부</option>
                                            </select>
                                        </div>
                                        <div class="col-3" style="margin-left: 1%; padding: 0.5%;">
                                            <button type="button" id="searchSubmit" class="btn btn-primary me-1 mb-1">검색
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-12" id="searchMainSection"
                                     style="display: flex; display:none; margin-right: 0;">
                                    <div class="col-7" style="padding-left: 0">
                                        <input type="text" id="searchMain" name="searchMain" class="form-control"
                                               placeholder="담당자, 고객명, 전화번호">
                                    </div>
                                    <div class="col-3">

                                        <!--<div id="searchFilterControll" class="row col-8" style="">
                                            <div class="col-12" style="padding-right: 0; margin-bottom: 1%;">
                                                <button type="button" class="btn btn-success">검색조건 펼치기</button>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>

                                <div class="row" id="date" style="display:none;">
                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">날짜</label>
                                                <select name="serDate" id="serDate">
                                                    <option value="">유형선택</option>
                                                    <option value="pucDate">신청날짜</option>
                                                    <option value="pucDate1">결제날짜</option>
                                                    <option value="pucDate2">출고날짜</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="">from</label>
                                                <input type="date" id="sPucDate" class="form-control"
                                                       placeholder=""
                                                       name="sPucDate">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="">to</label>
                                                <input type="date" id="ePucDate" class="form-control"
                                                       name="ePucDate" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="cost" style="display:none;">
                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label for="company-column">구매비용</label>
                                                <input type="text" id="sPrice" class="form-control"
                                                       name="sPrice" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-1 col-12" style="text-align: center; line-height: 73px;">
                                            <label for="company-column"
                                                   style="font-size:20px; font-weight: bold;">⁓</label>
                                        </div>

                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label for="company-column"></label>
                                                <input type="text" id="ePrice" class="form-control"
                                                       name="ePrice" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="statusMain" style="display:none;">
                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">

                                        <div class="form-group col-12">
                                            <label for="checkbox5">상태</label>
                                            <div class="form-check">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">재가요청</label>
                                                        <input type="checkbox" name="STATUS[]" class="form-check-input"
                                                               value="S">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">재가완료</label>
                                                        <input type="checkbox" name="STATUS[]" class="form-check-input"
                                                               value="A">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">출고완료</label>
                                                        <input type="checkbox" name="STATUS[]" class="form-check-input"
                                                               value="T">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">구매완료</label>
                                                        <input type="checkbox" name="STATUS[]" class="form-check-input"
                                                               value="E">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row" id="use" style="display:none;">
                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="form-group col-12">
                                            <label for="checkbox5">용도</label>

                                            <div class="form-check">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">체험단</label>
                                                        <input type="checkbox" name="sellType[]"
                                                               class="form-check-input"
                                                               value="101">
                                                    </div>

                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">정품체험</label>
                                                        <input type="checkbox" name="sellType[]"
                                                               class="form-check-input"
                                                               value="102">
                                                    </div>

                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">증정</label>
                                                        <input type="checkbox" name="sellType[]"
                                                               class="form-check-input"
                                                               value="103">
                                                    </div>

                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">클레임 증정</label>
                                                        <input type="checkbox" name="sellType[]"
                                                               class="form-check-input"
                                                               value="201">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">샘플 상담용</label>
                                                        <input type="checkbox" name="sellType[]"
                                                               class="form-check-input"
                                                               value="301">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for=" checkbox5">샘플 연구용</label>
                                                        <input type="checkbox" name="sellType[]"
                                                               class="form-check-input"
                                                               value="302">
                                                    </div>

                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">기부</label>
                                                        <input type="checkbox" name="sellType[]"
                                                               class="form-check-input"
                                                               value="400">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="inNout" style="display:none;">
                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="form-group col-12">
                                            <label for="checkbox5">입출고 형태</label>
                                            <div class="form-check col-12 ">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">입고</label>
                                                        <input type="checkbox" name="InOut[]" class="form-check-input"
                                                               value="In">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">출고</label>
                                                        <input type="checkbox" name="InOut[]" class="form-check-input"
                                                               value="OUT">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">회송</label>
                                                        <input type="checkbox" name="InOut[]" class="form-check-input"
                                                               value="RE">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="container" style="display:none;">
                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="form-group col-12">
                                            <label for="checkbox5">출고창고</label>
                                            <div class="form-check col-12 ">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">남양주 창고</label>
                                                        <input type="checkbox" name="cabage[]" class="form-check-input"
                                                               value="C0001">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">본사 창고</label>
                                                        <input type="checkbox" name="cabage[]" class="form-check-input"
                                                               value="C0005">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="downLoad" style="display:none;">
                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="form-group col-12">
                                            <label for="checkbox5">결과 내려 받기</label>
                                            <div class="form-check col-12 ">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3 form-check form-check-primary">
                                                        <label class="form-check-label" for="primary"
                                                               style="">
                                                            YES
                                                        </label>
                                                        <input type="radio" name="xlsDown" class="form-check-input"
                                                               value="Y">
                                                    </div>

                                                    <div class="checkbox py-1 col-3 form-check form-check-success">
                                                        <label class="form-check-label" for="success"
                                                               style="">
                                                            NO
                                                        </label>
                                                        <input type="radio" name="xlsDown" class="form-check-input"
                                                               value="N">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="page-content" style="">
    <section class="row py-3">
        <div class="col-12 col-lg-12">

            <div class="row">
                <div id="route_view" class="bg bg-success" style="" data-aos="zoom-in" data-aos-delay="50"
                     data-aos-duration="1000">

                </div>
                <div class="col-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                        <div class="card-header text-muted font-semibold">
                            <p style="font-size:11px;">총건수 : <span>0000</span>개 / 검색건수 : <span>0000</span>개</p>
                            <p class="">정품 입 / 출고 신청 리스트</p>

                            <div style="width:100%;">
                                <div style="display: flex; width:15%;" class="float-end">
                                    <select name="" id="">
                                        <option value="">재가요청</option>
                                        <option value="">제가완료</option>
                                        <option value="">출고완료</option>
                                        <option value="">구매완료</option>
                                    </select>
                                    <button class="btn btn-primary float-end" style="margin-left: 0.5%; width:60%;">
                                        상태변경
                                    </button>

                                </div>

                                <?php
                                if ($signal == "search") {
                                    echo "<button id=\"searchReset\" class=\"btn btn-primary\" style=\"margin-left: 0.5%; width:8%;\">
                                                    검색초기화
                                                  </button>";
                                }
                                ?>

                            </div>

                        </div>
                        <div class="card-body">
                            <form action="#" method="post" id="">
                                <table class="table table-striped text-muted font-semibold" id="table1"
                                       style="border-spacing: 3px; border-collapse: separate; text-align: center;">

                                    <thead style="text-align: center !important;">
                                    <tr>
                                        <th style="text-align: center;">No.</th>
                                        <th style="text-align: center;">담당자</th>
                                        <th style="text-align: center;">입출고창고&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">입출고&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">구분&nbsp;</th>
                                        <th style="text-align: center;">품목&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">금액</th>
                                        <th style="text-align: center;">신청날짜&nbsp;</th>
                                        <th style="text-align: center;">결제날짜&nbsp;</th>
                                        <th style="text-align: center;">출고날짜&nbsp;</th>
                                        <th style="text-align: center;">사용용도&nbsp;</th>
                                        <th style="text-align: center;">고객명&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">연락처&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">상태&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">택배&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">ERP&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">메모&nbsp;&nbsp;</th>

                                    </tr>
                                    </thead>

                                    <tbody class="employeeList">

                                    <?php foreach ($orderList as $row) : ?>

                                        <tr>
                                            <td>
                                                <input type="checkbox" id="checkbox5" class="form-check-input"
                                                       style="margin:auto; margin-top:4px;" value="<?= $row['idx'] ?>">
                                                <span class="text-muted font-semibold"
                                                      style="font-size:12px;"><?= $row['idx'] ?></span>
                                            </td>
                                            <td>
                                                        <span
                                                                class="text-muted font-semibold employeeId"
                                                                style="font-size:12px;"><?= $row['aName'] ?></span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= $row['cabage'] ?>

                                                        </span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-semibold"
                                                      style="font-size:12px;"><?= $row['InOut'] ?></span>
                                            </td>
                                            <td>
                                                        <span
                                                                class="text-muted font-semibold"
                                                                style="font-size:12px;"><?= $row['reType'] ?>

                                                        </span>
                                            </td>
                                            <td>
                                                        <span
                                                                class="text-muted font-semibold"
                                                                style="font-size:12px;"><?= $row['prdRName'] ?></span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= number_format($row['resultPrice']) ?>
                                                        </span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= substr("{$row['pucDate']}", 0, 10) ?></span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= substr("{$row['pucDate1']}", 0, 10) ?></span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold" style="font-size:12px;">

                                                        </span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= $row['sellType'] ?>
                                                        </span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?php
                                                            if (strlen($row['mName']) > 9) {
                                                                echo iconv_substr("{$row['mName']}", 0, 3, "utf-8") . "..";
                                                            } else if (strlen($row['mName']) <= 9) {
                                                                echo $row['mName'];
                                                            }
                                                            ?></span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= $row['mHp'] ?></span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= $row['status'] ?></span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= $row['traDown'] ?></span>
                                            </td>

                                            <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:12px;"><?= $row['erpDown'] ?></span>
                                            </td>

                                            <td>
                                                    <span class="text-muted font-semibold" title="<?= $row['memo'] ?>"
                                                          style="font-size:12px;"><?php if (strlen($row['memo']) > 5) {
                                                            echo iconv_substr("{$row['memo']}", 0, 5, "utf-8") . "...";
                                                        } else if (strlen($row['memo']) < 5) {
                                                            echo $row['memo'];
                                                        }
                                                        ?>
                                                        </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>

                                </table>
                                <?= $pager->links() ?>
                            </form>
                            <div class="row" style="margin-left: 0.3%;">
                                <div class="row col-6">
                                    <span class="badge bg-primary col-1"><a href="" data-bs-toggle="modal"
                                                                            data-bs-target="#genuine_regist">등록</a></span>
                                    <span class="badge bg-primary col-3" style="margin-left: 0.3%;"><a href="">다해 ERP 다운로드</a></span>
                                    <span class="badge bg-primary col-3" style="margin-left: 0.3%;"><a
                                                href="">다해 ERP 작업</a></span>
                                    <span class="badge bg-primary col-3" style="margin-left: 0.3%;"><a
                                                href="">회수 다운로드</a></span>
                                    <span class="badge bg-primary col-1" style="margin-left: 0.3%;"><a
                                                href="">복사</a></span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($validation)): ?>
            <div class="alert alert-danger col-md-12" role="alert">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <div class="modal fade text-left show" id="genuine_regist" tabindex="-1" aria-labelledby="myModalLabel33"
             aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">정품 입출고 관리 </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="#">
                        <div class="modal-body">
                            <div class="form-group form-group-wrapper row col-12">
                                <div class="col-4">
                                    <label>부서명 </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>직원명 </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label>고객/ 업체명 </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group form-group-wrapper row col-12">
                                <div class="col-4">
                                    <label>신청일자 </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label>아기이름 </label>
                                    <div class="form-group">
                                        <select name="" id="">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label>체험경로 </label>
                                    <div class="form-group">
                                        <select name="" id="">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group form-group-wrapper row col-12">
                                <div class="col-8">
                                    <div class="row col-12">
                                        <div class="col-4">
                                            <label>입출고 창고선택 </label>
                                            <div class="form-group">
                                                <select name="" id="">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-8">
                                            <label></label>
                                            <div class="form-group"
                                                 style="border : 1px solid #dce7f1; border-radius: 3px; padding:0.4rem;">
                                                <input class="form-check-input col-md-3" type="radio"
                                                       name="" id="" value=""
                                                       style="padding:0;" checked>
                                                <label class="form-check-label  col-md-2" for="danger">
                                                    입고
                                                </label>
                                                <input class="form-check-input col-md-3" type="radio"
                                                       name="" id="" value=""
                                                       style="padding:0;">
                                                <label class="form-check-label col-md-2" for="danger">
                                                    출고
                                                </label>

                                                <input class="form-check-input col-md-3" type="radio"
                                                       name="" id="" value=""
                                                       style="padding:0;">
                                                <label class="form-check-label col-md-2" for="danger">
                                                    회수
                                                </label>

                                                <input class="form-check-input col-md-3" type="radio"
                                                       name="" id="" value=""
                                                       style="padding:0;">
                                                <label class="form-check-label col-md-2" for="danger">
                                                    맞교환
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label>수령방법 </label>
                                    <div class="form-group"
                                         style="border : 1px solid #dce7f1; border-radius: 3px; padding:0.4rem;">
                                        <input class="form-check-input col-md-3" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;" checked>
                                        <label class="form-check-label  col-md-3" for="danger">
                                            직접
                                        </label>
                                        <input class="form-check-input col-md-3" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;">
                                        <label class="form-check-label col-md-2" for="danger">
                                            택배
                                        </label>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group form-group-wrapper row col-12">

                                <div class="col-7">
                                    <label>용도 </label>
                                    <div class="form-group"
                                         style="border : 1px solid #dce7f1; border-radius: 3px; padding:0.4rem;">
                                        <input class="form-check-input col-md-1" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;" checked>
                                        <label class="form-check-label  col-md-2" for="danger">
                                            체험단
                                        </label>
                                        <input class="form-check-input col-md-1" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;">
                                        <label class="form-check-label col-md-2" for="danger">
                                            정품체험
                                        </label>

                                        <input class="form-check-input col-md-1" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;">
                                        <label class="form-check-label col-md-2" for="danger">
                                            증정
                                        </label>

                                        <input class="form-check-input col-md-1" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;">
                                        <label class="form-check-label col-md-3" for="danger">
                                            컨피던트 정품체험
                                        </label>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <label>유형 </label>
                                    <div class="form-group"
                                         style="border : 1px solid #dce7f1; border-radius: 3px; padding:0.4rem;">
                                        <input class="form-check-input col-md-3" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;" checked>
                                        <label class="form-check-label  col-md-2" for="danger">
                                            홍보
                                        </label>
                                        <input class="form-check-input col-md-3" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;">
                                        <label class="form-check-label col-md-2" for="danger">
                                            클레임
                                        </label>

                                        <input class="form-check-input col-md-3" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;">
                                        <label class="form-check-label col-md-2" for="danger">
                                            샘플
                                        </label>

                                        <input class="form-check-input col-md-3" type="radio"
                                               name="" id="" value=""
                                               style="padding:0;">
                                        <label class="form-check-label col-md-2" for="danger">
                                            기부
                                        </label>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group form-group-wrapper row col-12">


                                <div class="col-4">
                                    <label>휴대전화번호 </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Email Address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>전화번호 </label>
                                    <div class="form-group">
                                        <input type="password" placeholder="Password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-wrapper row col-12">
                                <div class="col-12">
                                    <label>배송지 주소 </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Email Address" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-wrapper row col-12">
                                <div class="col-12">
                                    <label>입출고 품목 </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Email Address" class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group form-group-wrapper row col-12">
                                <div class="col-4">
                                    <label>구매상태 </label>
                                    <div class="form-group">
                                        <input type="text" placeholder="Email Address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>금액 </label>
                                    <div class="form-group">
                                        <input type="password" placeholder="Password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label>로그 </label>
                                    <div class="form-group">
                                        <input type="password" placeholder="Password" class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group form-group-wrapper row col-12">
                                <div class="col-6">
                                    <label>배송메세지 </label>
                                    <div class="form-group">
                                        <textarea placeholder="Password" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label>관리메모 </label>
                                    <div class="form-group">
                                        <textarea placeholder="Password" class="form-control"></textarea>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">login</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>


</div>

<script>
    $(document).ready(function () {
        $('#searchMainSection').hide();
        $('#date').hide();
        $('#cost').hide();
        $('#statusMain').hide();
        $('#use').hide();
        $('#inNout').hide();
        $('#container').hide();
        $('#downLoad').hide();


        $('nav > .pagination').attr("class", "pagination pagination-primary float-end dataTable-pagination");
        $('nav > .pagination > li').addClass("page-item");
        $('nav > .pagination > li >').addClass("page-link");
        $('nav > .pagination > li').css("margin-right", "0");
        if ($('nav > .pagination > li > a > span').eq(1).text() == "Previous") {
            $('nav > .pagination > li > a > span').eq(1).text('◀');
        }
        if ($('nav > .pagination > li > a > span').eq(-2).text() == "Next") {
            $('nav > .pagination > li > a > span').eq(-2).text('▶');
        }

    });

    // $('#searchFilterControll>div>button').click(function () {
    //     if ($('#searchFilterControll > div > button').text() == "검색조건 펼치기") {
    //         $('#wrap').attr('class', 'col-8');
    //         $('#searchFilterSpread').slideDown();
    //         $('#searchFilterControll > div > button').text('검색조건 접기');
    //     } else {
    //         $('#wrap').attr('class', 'col-5');
    //         $('#searchFilterSpread').slideUp();
    //         $('#searchFilterControll > div > button').text('검색조건 펼치기');
    //
    //     }
    //
    // });

    $('#searchReset').click(function () {
        location.replace("http://godo.event.admin/genuine_out?page=1");
    });

    function addSearch(obj) {
        if ($(obj).val() == "2") {
            $('#searchMainSection').show();


            $('#date').hide();
            $('#cost').hide();
            $('#statusMain').hide();
            $('#use').hide();
            $('#inNout').hide();
            $('#container').hide();
            $('#downLoad').hide();
        } else if ($(obj).val() == "3") {
            $('#date').show();


            $('#searchMainSection').hide();
            $('#cost').hide();
            $('#statusMain').hide();
            $('#use').hide();
            $('#inNout').hide();
            $('#container').hide();
            $('#downLoad').hide();
        } else if ($(obj).val() == "4") {
            $('#cost').show();


            $('#date').hide();
            $('#searchMainSection').hide();
            $('#statusMain').hide();
            $('#use').hide();
            $('#inNout').hide();
            $('#container').hide();
            $('#downLoad').hide();
        } else if ($(obj).val() == "5") {
            $('#statusMain').show();


            $('#date').hide();
            $('#searchMainSection').hide();
            $('#cost').hide();
            $('#use').hide();
            $('#inNout').hide();
            $('#container').hide();
            $('#downLoad').hide();
        } else if ($(obj).val() == "6") {
            $('#use').show();


            $('#date').hide();
            $('#searchMainSection').hide();
            $('#cost').hide();
            $('#statusMain').hide();
            $('#inNout').hide();
            $('#container').hide();
            $('#downLoad').hide();
        } else if ($(obj).val() == "7") {
            $('#inNout').show();


            $('#date').hide();
            $('#searchMainSection').hide();
            $('#cost').hide();
            $('#statusMain').hide();
            $('#use').hide();
            $('#container').hide();
            $('#downLoad').hide();
        } else if ($(obj).val() == "8") {
            $('#container').show();


            $('#date').hide();
            $('#searchMainSection').hide();
            $('#cost').hide();
            $('#statusMain').hide();
            $('#use').hide();
            $('#inNout').hide();
            $('#downLoad').hide();
        } else if ($(obj).val() == "9") {
            $('#downLoad').show();


            $('#date').hide();
            $('#searchMainSection').hide();
            $('#cost').hide();
            $('#statusMain').hide();
            $('#use').hide();
            $('#inNout').hide();
            $('#container').hide();
        } else {

            $('#searchMainSection').hide();
            $('#date').hide();
            $('#cost').hide();
            $('#statusMain').hide();
            $('#use').hide();
            $('#inNout').hide();
            $('#container').hide();
            $('#downLoad').hide();
        }
    }


    $('#searchSubmit').click(function () {
        var mode = "<?=$signal?>";
        if (mode == "list") {
            if ($('#searchObj').val() == "") {
                alert('검색 조건을 선택 하세요');
                return false;
            } else {
                $('#genuineForm').attr("action", "http://godo.event.admin/genuine_out/search?page=1");
                $('#genuineForm').submit();

            }

        } else if (mode == "search") {
            if ($('#searchObj').val() == "") {
                alert('검색 조건을 선택 하세요');
                return false;
            } else {
                $('#genuineForm').attr("action", "http://godo.event.admin/genuine_out/resultSearch");
                $('#genuineForm').submit();

            }
        }

    });
</script>
<script src="/assetsCustomer/vendors/simple-datatables/simple-datatables.js"></script>

<!--        <script>-->
<!--            // Simple Datatable-->
<!--            let table1 = document.querySelector('#table1');-->
<!--            let dataTable = new simpleDatatables.DataTable(table1);-->
<!--        </script>-->


<?php
