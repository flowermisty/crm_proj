<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3 class="text-title text-muted">마트 발주/매출 변경 프로그램</h3>
                <p class="text-subtitle text-muted"></p>
                <hr style="border-top:2px solid">
            </div>
            <div class="col-12 col-md-12 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">기타설정</a></li>
                        <li class="breadcrumb-item active" aria-current="page">마트변환</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">

        <div class="row">

            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">마트 발주/매출 변경 프로그램</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text" style="margin-bottom: 0;">
                                <code></code>
                            <hr>
                            <div class="col-12">
                                <img src="/assets2/images/convert/martConvert.png" style="width:73%;"/>
                            </div>
                            </p>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/mart/martConvert') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row">
                                <div style="display: flex;" class="col-10">

                                    <div class="row col-3" style="margin-bottom: 1%;">
                                        <label class="" style="margin-left: 2%;">
                                            <span><b>마트구분</b></span>
                                        </label>
                                        <div class="col-11">
                                            <div class="row" style="display: flex; margin-left: 2%;">
                                                <div class="form-check form-check-success col-6"
                                                     style="padding-right: 3%; margin-top:1%;">
                                                    <label class="form-check-label" for="primary"
                                                           style="font-size: 12px;">
                                                        롯데마트
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="kind"
                                                           id="kind" value="lottemart" checked>


                                                </div>

                                                <div class="form-check form-check-primary col-6"
                                                     style="padding-right: 3%; margin-top:1%;">
                                                    <label class="form-check-label" for="primary"
                                                           style="font-size: 12px;">
                                                        홈플러스
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="kind"
                                                           id="kind" value="homeplus">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-3" style="margin-bottom: 1%;">
                                        <label class="" style="margin-left: 2%;">
                                            <span><b>양식타입</b></span>
                                        </label>
                                        <div class="col-12">
                                            <div class="row" style="display: flex; margin-left: 2%;">
                                                <div class="form-check form-check-success col-6"
                                                     style="padding-right: 3%; margin-top:1%;">
                                                    <label class="form-check-label" for="primary"
                                                           style="font-size: 12px;">
                                                        발주양식
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="type"
                                                           id="type" value="balju" checked>


                                                </div>

                                                <div class="form-check form-check-primary col-6"
                                                     style="padding-right: 3%; margin-top:1%;">
                                                    <label class="form-check-label" for="primary"
                                                           style="font-size: 12px;">
                                                        매입양식
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="type"
                                                           id="type" value="maeip">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <input type="file" class="basic-filepond11" name="excel_file" id="excel_file">
                                <input type="submit" class="btn btn-primary" value="upload"
                                       style="float: right; margin-top:1%;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
</div>

<?php
