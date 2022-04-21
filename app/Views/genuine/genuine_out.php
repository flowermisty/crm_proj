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

                </div>

                <div class="card-content">
                    <div class="card-body">
                        <form class="form">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group" style="display: flex;">

                                        <div class="col-8">
                                            <input type="search" id="first-name-column" class="form-control"
                                                   placeholder="담당자, 고객명, 전화번호" name="fname-column">
                                        </div>
                                        <div class="col-8" style="margin-left: 1%; display: flex;">
                                            <button type="button" class="btn btn-primary me-1 mb-1">검색</button>
                                            <div id="searchFilterControll" class="row col-8" style="">
                                                <div class="col-12" style="padding-right: 0; margin-bottom: 1%;">
                                                    <button type="button" class="btn btn-success">검색조건 펼치기</button>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div class="row" id="searchFilterSpread" style="">
                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">날짜</label>
                                                <select name="" id="">
                                                    <option value="">신청날짜</option>
                                                    <option value="">결제날짜</option>
                                                    <option value="">출고날짜</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="city-column">from</label>
                                                <input type="date" id="city-column" class="form-control"
                                                       placeholder="City"
                                                       name="city-column">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="country-floating">to</label>
                                                <input type="date" id="country-floating" class="form-control"
                                                       name="country-floating" placeholder="">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label for="company-column">구매비용</label>
                                                <input type="text" id="company-column" class="form-control"
                                                       name="company-column" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-1 col-12" style="text-align: center; line-height: 73px;">
                                            <label for="company-column"
                                                   style="font-size:20px; font-weight: bold;">⁓</label>
                                        </div>

                                        <div class="col-md-5 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column"></label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                       name="email-id-column" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">

                                        <div class="form-group col-12">
                                            <label for="checkbox5">상태</label>
                                            <div class="form-check">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">재가요청</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                               checked="">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">재가완료</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">출고완료</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">구매완료</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="form-group col-12">
                                            <label for="checkbox5">용도</label>

                                            <div class="form-check">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">체험단</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                               checked="">
                                                    </div>

                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">정품체험</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">증정</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">클레임 증정</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">샘플 상담용</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for=" checkbox5">샘플 연구용</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                    <div class="checkbox py-1 col-3 ">
                                                        <label for="checkbox5">기부</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="form-group col-12">
                                            <label for="checkbox5">입출고 형태</label>
                                            <div class="form-check col-12 ">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">입고</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                               checked="">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">출고</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">회송</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="form-group col-12">
                                            <label for="checkbox5">출고창고</label>
                                            <div class="form-check col-12 ">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">남양주 창고</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">본사 창고</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                               checked="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row"
                                         style="border: 1px solid #dee2e6; margin:auto; margin-bottom:1%; border-radius:5px; padding:1%;">
                                        <div class="form-group col-12">
                                            <label for="checkbox5">결과 내려 받기</label>
                                            <div class="form-check col-12 ">
                                                <div class="row">
                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">YES</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                               checked="">
                                                    </div>

                                                    <div class="checkbox py-1 col-3">
                                                        <label for="checkbox5">NO</label>
                                                        <input type="checkbox" id="checkbox5" class="form-check-input"
                                                        >
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
                                    <select name="" id="" >
                                        <option value="">재가요청</option>
                                        <option value="">제가완료</option>
                                        <option value="">출고완료</option>
                                        <option value="">구매완료</option>
                                    </select>
                                    <button class="btn btn-primary float-end" style="margin-left: 0.5%; width:60%;">상태변경</button>
                                </div>

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
                                        <th style="text-align: center;">사용처/고객명&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">연락처&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">상태&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">택배&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">ERP&nbsp;&nbsp;</th>
                                        <th style="text-align: center;">메모&nbsp;&nbsp;</th>

                                    </tr>
                                    </thead>

                                    <tbody class="employeeList">


                                    <tr>
                                        <td>
                                            <input type="checkbox" id="checkbox5" class="form-check-input" style="margin:auto;">
                                        </td>
                                        <td>
                                                        <span
                                                                class="text-muted font-semibold employeeId"
                                                                style="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span
                                                                class="text-muted font-semibold"
                                                                style="font-size:15px;">

                                                        </span>
                                        </td>
                                        <td>
                                                        <span class="text-muted font-semibold" style="font-size:15px;">

                                                        </span>
                                        </td>
                                        <td>
                                                        <span
                                                                class="text-muted font-semibold"
                                                                style="font-size:15px;">

                                                        </span>
                                        </td>
                                        <td>
                                                        <span
                                                                class="text-muted font-semibold"
                                                                style="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold" style="font-size:15px;">

                                                        </span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              sstyle="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold" style="font-size:15px;">

                                                        </span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;">
                                                        </span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"></span>
                                        </td>

                                        <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"></span>
                                        </td>
                                    </tr>


                                    </tbody>

                                </table>

                            </form>
                            <div class="row" style="margin-left: 0.3%;">
                                <div class="row col-6">
                                    <span class="badge bg-primary col-1">등록</span>
                                    <span class="badge bg-primary col-2" style="margin-left: 0.3%;">다해 ERP 다운로드</span>
                                    <span class="badge bg-primary col-2" style="margin-left: 0.3%;">다해 ERP 작업</span>
                                    <span class="badge bg-primary col-2" style="margin-left: 0.3%;">회수 다운로드</span>
                                    <span class="badge bg-primary col-1" style="margin-left: 0.3%;">복사</span>

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
    </section>


</div>

<script>
    $(document).ready(function () {
        $('#searchFilterSpread').hide();
    });

    $('#searchFilterControll>div>button').click(function () {
        if ($('#searchFilterControll > div > button').text() == "검색조건 펼치기") {
            $('#wrap').attr('class','col-8');
            $('#searchFilterSpread').slideDown();
            $('#searchFilterControll > div > button').text('검색조건 접기');
        } else {
            $('#wrap').attr('class','col-5');
            $('#searchFilterSpread').slideUp();
            $('#searchFilterControll > div > button').text('검색조건 펼치기');

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
