<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3 class="text-title text-muted">ERP 변경 프로그램</h3>
                <p class="text-subtitle text-muted"></p>
                <hr style="border-top:2px solid">
            </div>
            <div class="col-12 col-md-12 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">기타설정</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ERP 변경</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">ERP 주문 변경 프로그램</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text" style="margin-bottom: 0;">* 이카운트 ERP에서 다운로드한 파일을 올려주세요<br>
                                * xls파일 확인 후 업로드 해주시기 바랍니다.
                                <code></code>
                            <hr>
                            <div class="col-12">
                                <img src="/assets2/images/convert/erpConvert.PNG" style="width:100%; margin-bottom: 4%"/>
                            </div>
                            </p>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/erp') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row">
                                <div style="display: flex; margin-bottom: 2%">
                                    <div class="form-check form-check-primary col-2"
                                         style="margin-left: 0.5%">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            자사몰(가비아몰)
                                        </label>
                                        <input class="form-check-input" type="radio" name="gubun"
                                               id="gubun" value="mall">

                                    </div>

                                    <div class="form-check form-check-primary col-1"
                                         style="">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            TM
                                        </label>
                                        <input class="form-check-input" type="radio" name="gubun"
                                               id="gubun" value="tm">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="margin-left: 5%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            사내판매
                                        </label>
                                        <input class="form-check-input" type="radio" name="gubun"
                                               id="gubun" value="office">

                                    </div>
                                    <div class="form-check form-check-primary col-2"
                                         style="">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            맘스다이어리
                                        </label>
                                        <input class="form-check-input" type="radio" name="gubun"
                                               id="gubun" value="mams">

                                    </div>

                                    <div class="form-check form-check-primary col-3"
                                         style="margin-left: 2%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            자사몰(신규가비아몰)
                                        </label>
                                        <input class="form-check-input" type="radio" name="gubun"
                                               id="gubun" value="newmall">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            마미톡
                                        </label>
                                        <input class="form-check-input" type="radio" name="gubun"
                                               id="gubun" value="mami">

                                    </div>
                                </div>

                                <input type="file" class="basic-filepond6" name="excel_file" id="excel_file">
                                <input type="submit" class="btn btn-primary" value="upload"
                                       style="float: right; margin-top:2%;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">ERP B2B 주문 변경 프로그램</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text">* 기존 파일 형식에서 변경이 되시면 반드시 알려주시기 바랍니다.<br>
                                * xls파일 확인 후 업로드 해주시기 바랍니다
                                <code></code>
                            </p>
                            <hr>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/erpB2B') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row">
                                <div class="card-header" style="padding:0 !important;">
                                    <h6 class="text-muted">타입</h6>
                                </div>
                                <div style="display: flex; margin-left:1%;">

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            에브리데이
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="everyday">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            롯데마트
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="lottemart">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            이랜트리테일
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="eland">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            홈플러스
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="homeplus">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            롯데슈퍼
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="lottesuper">

                                    </div>
                                </div>

                                <div style="display: flex; margin-left:1%; margin-bottom: 4%;">
                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            GS리테일
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="gsretail">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            메가마트
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="megamart">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            농협
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="nonghyup">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            씨에스
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="cs">

                                    </div>

                                    <div class="form-check form-check-primary col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            GS편의점
                                        </label>
                                        <input class="form-check-input" type="radio" name="type"
                                               id="type" value="gs">

                                    </div>

                                </div>


                                <div class="card-header" style="padding:0 !important;">
                                    <h6 class="text-muted">구분</h6>
                                </div>

                                <div style="display: flex; margin-left:1%; margin-bottom: 2%;">
                                    <div class="form-check form-check-dark col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            발주
                                        </label>
                                        <input class="form-check-input" type="radio" name="gubun"
                                               id="gubun" value="balju">

                                    </div>

                                    <div class="form-check form-check-success col-2"
                                         style="padding-right: 3%; margin-top:1%;">
                                        <label class="form-check-label" for="primary"
                                               style="font-size: 12px;">
                                            매줄
                                        </label>
                                        <input class="form-check-input" type="radio" name="gubun"
                                               id="gubun" value="buy">

                                    </div>
                                </div>

                                <input type="file" class="basic-filepond7" name="excel_file" id="excel_file">
                                <input type="submit" class="btn btn-primary" value="upload"
                                       style="float: right; margin-top:2%;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
