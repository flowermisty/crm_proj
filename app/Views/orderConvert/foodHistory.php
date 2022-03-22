<style>
    label {
        text-align: left !important;
    }

    select {
        width: 100%; /* 원하는 너비설정 */
        margin-top: 3%;
        padding: .5em .3em; /* 여백으로 높이 설정 */
        font-family: inherit; /* 폰트 상속 */
        background: url(https://farm1.staticflickr.com/379/19928272501_4ef877c265_t.jpg) no-repeat 95% 50%; /* 네이티브 화살표 대체 */
        border: 1px solid #ccc;
        border-radius: 5px; /* iOS 둥근모서리 제거 */
        -webkit-appearance: none; /* 네이티브 외형 감추기 */
        -moz-appearance: none;
        appearance: none;
    }
</style>


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3 class="text-title text-muted">식품이력 변경 프로그램</h3>
                <p class="text-subtitle text-muted"></p>
                <hr style="border-top:2px solid">
            </div>
            <div class="col-12 col-md-12 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">기타설정</a></li>
                        <li class="breadcrumb-item active" aria-current="page">식품이력</li>
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
                        <h5 class="card-title text-muted">다해 ERP → 식품이력 변경 프로그램</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text" style="margin-bottom: 0;">
                                <code></code>
                            <hr>
                            <div class="col-12">
                            </div>
                            </p>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/foodHistory/foodConvert1') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row">
                                <div style="display: flex;" class="col-12">
                                    <div class="row col-6" style="margin-bottom: 4%;">
                                        <label class="" style="text-align: center;">
                                            <span>상품명 </span>
                                        </label>
                                        <div class="col-10">
                                            <select name="tfood" id="tfood" class="text-muted">
                                                <option value="8809360920117">800g 1단계</option>
                                                <option value="8809360920124">800g 2단계</option>
                                                <option value="8809360920131">800g 3단계</option>
                                                <option value="8809360920216">400g 1단계</option>
                                                <option value="8809360920223">400g 2단계</option>

                                                <option value="8809360928731">저지800g 1단계</option>
                                                <option value="8809360928755">저지800g 2단계</option>
                                                <option value="8809360928779">저지800g 3단계</option>
                                                <option value="8809360928786">저지800g 4단계</option>
                                                <option value="8809360928748">저지400g 1단계</option>
                                                <option value="8809360928762">저지400g 2단계</option>
                                                <option value="8809360928793">저지400g 3단계</option>

                                                <option value="8809360922395">생유산균 5포</option>
                                                <option value="8809360920209">생유산균 30포</option>
                                                <option value="8809360921008">유산균 츄어블</option>
                                                <option value="8809360920988">칼슘 츄어블</option>
                                                <option value="8809360920995">비타젤리</option>
                                                <option value="3191217205300">홍삼젤리</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row col-6" style="margin-bottom: 4%;">
                                        <label class="" style="text-align: center;">
                                            <span>유통기한</span>
                                        </label>
                                        <div class="col-10">
                                            <input type="text" name="magnum"
                                                   style="width:100%; height: 100%; padding:1% 2%; border-radius: 5px; border: 1px solid #ccc;"
                                                   placeholder=" EX : 20200802 년월일 숫자만 입력">
                                        </div>
                                    </div>
                                </div>


                                <input type="file" class="basic-filepond8" name="excel_file" id="excel_file">
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
                        <h5 class="card-title text-muted">다해 ERP 택배 → 식품이력 변경 프로그램</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text" style="margin-bottom: 0;">
                                <code></code>
                            <hr>
                            <div class="col-12">
                            </div>
                            </p>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/foodHistory/foodConvert2') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row">
                                <div style="display: flex;" class="col-12">
                                    <div class="row col-6" style="margin-bottom: 4%;">
                                        <label class="" style="text-align: center;">
                                            <span>상품명 </span>
                                        </label>
                                        <div class="col-10">
                                            <select name="tfood" class="text-muted">
                                                <option value="8809360920117">800g 1단계</option>
                                                <option value="8809360920124">800g 2단계</option>
                                                <option value="8809360920131">800g 3단계</option>
                                                <option value="8809360920216">400g 1단계</option>
                                                <option value="8809360920223">400g 2단계</option>

                                                <option value="8809360928731">저지800g 1단계</option>
                                                <option value="8809360928755">저지800g 2단계</option>
                                                <option value="8809360928779">저지800g 3단계</option>
                                                <option value="8809360928786">저지800g 4단계</option>
                                                <option value="8809360928748">저지400g 1단계</option>
                                                <option value="8809360928762">저지400g 2단계</option>
                                                <option value="8809360928793">저지400g 3단계</option>


                                                <option value="8809360922395">생유산균 5포</option>
                                                <option value="8809360920209">생유산균 30포</option>
                                                <option value="8809360921008">유산균 츄어블</option>
                                                <option value="8809360920988">칼슘 츄어블</option>
                                                <option value="8809360920995">비타젤리</option>
                                                <option value="3191217205300">홍삼젤리</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row col-6" style="margin-bottom: 4%;">
                                        <label class="" style="text-align: center;">
                                            <span>유통기한</span>
                                        </label>
                                        <div class="col-10">
                                            <input type="text" name="magnum"
                                                   style="width:100%; height: 100%; padding:1% 2%; border-radius: 5px; border: 1px solid #ccc;"
                                                   placeholder=" EX : 20200802 년월일 숫자만 입력">
                                        </div>
                                    </div>
                                </div>


                                <input type="file" class="basic-filepond9" name="excel_file" id="excel_file">
                                <input type="submit" class="btn btn-primary" value="upload"
                                       style="float: right; margin-top:2%;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">ERP → 식품이력 변경 프로그램</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text" style="margin-bottom: 0;">
                                <code></code>
                            <hr>
                            <div class="col-12">
                                <img src="/assets2/images/convert/foodHistory.png"/>
                            </div>
                            </p>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/foodHistory/foodConvert3') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row">
                                <div style="display: flex;" class="col-12">
                                    <div class="row col-3" style="margin-bottom: 1%;">
                                        <label class="" style="text-align: center;">
                                            <span>식품이력 추적 "등록증" 번호</span>
                                        </label>
                                        <div class="col-11">
                                            <input type="text" name="magnum"
                                                   style="width:100%; height: 100%; padding:1% 2%; border-radius: 5px; border: 1px solid #ccc;"
                                                   placeholder="">
                                        </div>
                                    </div>

                                    <div class="row col-3" style="margin-bottom: 1%;margin-left: 2%;">
                                        <label class="" style="text-align: center;">
                                            <span>식품이력 추적 "관리" 번호</span>
                                        </label>
                                        <div class="col-11">
                                            <input type="text" name="magnum"
                                                   style="width:100%; height: 100%; padding:1% 2%; border-radius: 5px; border: 1px solid #ccc;"
                                                   placeholder="">
                                        </div>
                                    </div>


                                    <div class="row col-3" style="margin-bottom: 1%; margin-left: 2%;">
                                        <label class="" style="text-align: center;">
                                            <span>상품명 </span>
                                        </label>
                                        <div class="col-11">
                                            <select name="tfood" class="text-muted">
                                                <option value="800_1">800g 1단계</option>
                                                <option value="800_2">800g 2단계</option>
                                                <option value="800_3">800g 3단계</option>
                                                <option value="800_4">800g 4단계</option>
                                                <option value="400_1">400g 1단계</option>
                                                <option value="400_2">400g 2단계</option>
                                                <option value="400_3">400g 3단계</option>

                                                <option value="8809360928731">저지800g 1단계</option>
                                                <option value="8809360928755">저지800g 2단계</option>
                                                <option value="8809360928779">저지800g 3단계</option>
                                                <option value="8809360928786">저지800g 4단계</option>
                                                <option value="8809360928748">저지400g 1단계</option>
                                                <option value="8809360928762">저지400g 2단계</option>
                                                <option value="8809360928793">저지400g 3단계</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row col-3" style="margin-bottom: 1%; margin-left: 2%;">
                                        <label class="" style="text-align: center;">
                                            <span>사용구분</span>
                                        </label>
                                        <div class="col-11">
                                            <div class="row" style="display: flex; margin-left: 2%;">
                                                <div class="form-check form-check-success col-6"
                                                     style="padding-right: 3%; margin-top:1%;">
                                                    <label class="form-check-label" for="primary"
                                                           style="font-size: 12px;">
                                                        자가사용
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="kind"
                                                           id="kind" value="self" checked>


                                                </div>

                                                <div class="form-check form-check-primary col-6"
                                                     style="padding-right: 3%; margin-top:1%;">
                                                    <label class="form-check-label" for="primary"
                                                           style="font-size: 12px;">
                                                        판매현황
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="kind"
                                                           id="kind" value="pur">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <input type="file" class="basic-filepond10" name="excel_file" id="excel_file">
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
