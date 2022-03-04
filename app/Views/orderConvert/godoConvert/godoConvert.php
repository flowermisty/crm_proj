<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3 class="text-title text-muted">고도몰 변환 프로그램</h3>
                <p class="text-subtitle text-muted"></p>
                <hr style="border-top:2px solid">
            </div>
            <div class="col-12 col-md-12 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">기타설정</a></li>
                        <li class="breadcrumb-item active" aria-current="page">고도몰 변환</li>
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
                        <h5 class="card-title text-muted">고도몰 식단</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text">* 고도몰에서 다운로드한 원본 파일을 그대로 올려주세요.<br>
                                * 상품 준비중 리스트에서 다운 받은 파일을 올려주시면 됩니다!
                                <code></code>
                            </p>
                            <!-- Basic file uploader -->
                            <input type="file" class="basic-filepond1">
                            <input type="submit" class="btn btn-primary" value="upload"
                                   style="float: right; margin-top:2%;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">고도몰 ERP 주문 변경프로그램 Ver4</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text">* 고도몰에서 다운로드한 원본 파일을 그대로 올려주세요.<br>
                                * 상품 준비중 리스트에서 다운 받은 파일을 올려주시면 됩니다!
                                <code></code>
                            </p>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/godo/venetmeal_v4') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row">
                                <input type="file" class="basic-filepond2" name="excel_file" id="excel_file">
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
                        <h5 class="card-title text-muted">홈플러스 온라인몰 ERP 주문 변경 프로그램 Ver1</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text">* 홈플러스 온라인몰에서 다운로드한 원본파일을 그대로 올려주세요.<br>
                                * (단, xls파일로 저장되어 있어야 합니다.)
                                <code></code>
                            </p>
                            <!-- Basic file uploader -->
                            <input type="file" class="basic-filepond3">
                            <input type="submit" class="btn btn-primary" value="upload"
                                   style="float: right; margin-top:2%;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">환불 금액 / 포인트 비율 계산기</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 1%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text">* 정기 배송 / 3,4 이벤트 부분 환불 금액 및 포인트 비율을 계산하기 위한 계산 프로그램 모음 입니다.<br>
                                * 각 버튼 클릭시 해당 계산기가 출력 됩니다.
                                <code></code>
                            </p>

                            <div style="margin-top:15%;font-size:12px;">
                                <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#refundRegular">정기배송 부분환불 금액 계산
                                </button>
                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#refund3_4">3,4 이벤트 환불 금액 계산
                                </button>
                                <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal"
                                        data-bs-target="#pointRate3_4">3,4 이벤트 현금/포인트 비율 계산
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">이벤트 제품 출고</h5>
                    </div>
                    <div class="card-content" style="padding-bottom: 2%;">
                        <div class="card-body" style="padding-top: 0 !important;">
                            <p class="card-text">* 이현일 과장만 사용하세요.<br>
                                * xls파일 확인 및 반드시 상품코드 전부 입력한 뒤 업로드버튼 눌러주세요!
                                <code></code>
                            </p>
                            <!-- Basic file uploader -->
                            <form action="<?= base_url('convert/godo/eventout') ?>" method="post"
                                  enctype="multipart/form-data" class="form-row" name="eventProductOut">
                                <div class="row" id="eventOut">
                                    <div class="" style="line-height: 40px; width:auto; padding-right: 6%;">
                                        <label>상품</label>
                                    </div>
                                    <div class="col-md-10 form-group" style="display:flex;">
                                        <input type="text" class="form-control col-md-4" name="gubun" required>
                                    </div>

                                    <div class="" style="line-height: 40px; width:auto;">
                                        <label>작성일자</label>
                                    </div>
                                    <div class="col-md-4 form-group" style="display:flex;">
                                        <input type="date" class="form-control" name="sdate" required>
                                    </div>


                                    <div class="" style="line-height: 40px; width:auto; padding-left: 6%;">
                                        <label>납기요청</label>
                                    </div>
                                    <div class="col-md-4 form-group" style="display:flex;">
                                        <input type="date" class="form-control" name="fdate" required>
                                    </div>
                                </div>

                                <input type="file" class="basic-filepond4" name="excel_file">
                                <input type="submit" class="btn btn-primary" value="upload"
                                       style="float: right; margin-top:2%;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="refundRegular" tabindex="-1" role="dialog"
                 aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">정기배송 부분환불 금액 계산</h4>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="" name="form-horizontal">
                                            <div class="form-body">
                                                <div class="row" id="refundRegular">
                                                    <div class="col-md-4">
                                                        <label>쿠폰 할인 금액</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" id="totalDiscountWithCoupon"
                                                               class="form-control" name="totalDiscountWithCoupon"
                                                               placeholder="쿠폰 할인 금액">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">원</span>
                                                    </div>

                                                    <div class="col-md-4 py-2">
                                                        <label>총 결제금액</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="email" id="totalPay" class="form-control"
                                                               name="totalPay" placeholder="(쿠폰할인 제외, 포인트 포함)총 결제금액">
                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">원</span>
                                                    </div>
                                                    <div class="col-md-4 py-2">
                                                        <label>주문에 사용된 포인트</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" id="pointPay" class="form-control"
                                                               name="pointPay" placeholder="(총 결제금액 중 포인트로 결제된 금액)">
                                                    </div>

                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 45px; margin-left: 3%;">point</span>
                                                    </div>


                                                    <div class="col-md-4" style="display:flex; margin-top:1%;">
                                                        <label>단계</label>
                                                    </div>
                                                    <div class="col-md-8 form-group" style="display:flex;">


                                                        <div class="form-check form-check-primary"
                                                             style="padding-right: 3%; margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                준비기
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="A">

                                                        </div>

                                                        <div class="form-check form-check-primary"
                                                             style="padding-right:3%; margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                초기
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="B" checked>

                                                        </div>

                                                        <div class="form-check form-check-primary"
                                                             style="padding-right: 3%; margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                중기
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="C">

                                                        </div>

                                                        <div class="form-check form-check-primary"
                                                             style="padding-right: 3%; margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                후기2식
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="D2">

                                                        </div>

                                                        <div class="form-check form-check-primary"
                                                             style="padding-right: 1%; margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                후기3식
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="D3">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-4" style="display:flex; margin-top:1%;">
                                                        <label></label>
                                                    </div>
                                                    <div class="col-md-8 form-group" style="display:flex;">
                                                        <div class="form-check form-check-primary"
                                                             style="padding-right: 3%; margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                병행기
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="DE">

                                                        </div>

                                                        <div class="form-check form-check-primary"
                                                             style="padding-right: 3%; margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                완료기
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="E">

                                                        </div>

                                                        <div class="form-check form-check-primary"
                                                             style="padding-right: 3%; margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                유아식
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="F">

                                                        </div>

                                                        <div class="form-check form-check-primary"
                                                             style="margin-top:1%;">
                                                            <label class="form-check-label" for="primary"
                                                                   style="font-size: 12px;">
                                                                국반찬
                                                            </label>
                                                            <input class="form-check-input" type="radio" name="step"
                                                                   id="step" value="I">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>총 수령 팩수</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" id=""
                                                               class="form-control" name="countsAll"
                                                               placeholder="총 수령 팩수">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 1%;">pack</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>이미 수령받은 팩수</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" id=""
                                                               class="form-control" name="already"
                                                               placeholder="이미 수령받은 팩수">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">pack</span>
                                                    </div>

                                                    <div class="row" id="calcRegularResult">

                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="event" value="not">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        onclick="calcReset();">닫기
                                </button>
                                <button type="button" class="btn btn-primary" onclick="refundRegular()">계산하기</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="refund3_4" tabindex="-1" role="dialog"
                 aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">3,4 이벤트 환불금액 계산</h4>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="" name="refund3_4">
                                            <div class="form-body">
                                                <div class="row" id="refund3_4">
                                                    <div class="col-md-4">
                                                        <label>이유식 개당 정가</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="eachPrice" id="tf_eachPrice"
                                                               class="form-control"
                                                               placeholder="">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">원</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>구입가</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="purchasedPrice" id="tf_purchasedPrice"
                                                               class="form-control"
                                                               placeholder="마일리지 포함 가격 입력">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">원</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>사용마일리지</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="usedMileage" id="tf_usedMileage"
                                                               class="form-control"
                                                               placeholder="">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">point</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>특별할인율</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="specialDiscountRatio"
                                                               id="tf_specialDiscountRatio"
                                                               class="form-control"
                                                               placeholder="" value="35">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">%</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>상시할인율</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="generalDiscountRatio"
                                                               id="tf_generalDiscountRatio"
                                                               class="form-control"
                                                               placeholder="" value="12">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">%</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>총 식수</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="totalEa" id="tf_totalEa"
                                                               class="form-control"
                                                               placeholder="">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">EA</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>배달완료 식수</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="usedEa" id="tf_usedEa"
                                                               class="form-control"
                                                               placeholder="">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">EA</span>
                                                    </div>

                                                    <div class="row" id="calc34Result">

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        onclick="calcReset();">닫기
                                </button>
                                <button type="button" class="btn btn-primary" onclick="refundCalc34()">계산하기</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="pointRate3_4" tabindex="-1" role="dialog"
                 aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">3,4 이벤트 현금/포인트 비율 계산</h4>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="" name="pointRate3_4">
                                            <div class="form-body">
                                                <div class="row" id="refund3_4">
                                                    <div class="col-md-4">
                                                        <label>(포인트 포함)총 결제금액</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="pointTotalPay"
                                                               class="form-control"
                                                               placeholder="">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">원</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>주문에 사용된 포인트</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="pointPointPay"
                                                               class="form-control"
                                                               placeholder="(총 결제금액 중 포인트로 결제된 금액)">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">point</span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label style="font-size:14px;">(포인트 포함)총 계산된 환불금액</label>
                                                    </div>
                                                    <div class="col-md-7 form-group" style="display:flex;">
                                                        <input type="text" name="totalCalculatedRefund"
                                                               class="form-control"
                                                               placeholder="">

                                                    </div>
                                                    <div class="col-md-1 form-group" style="display:flex;"><span
                                                                style="line-height: 38px; margin-left: 3%;">원</span>
                                                    </div>


                                                    <div class="row" id="calc34PointResult">

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        onclick="calcReset();">닫기
                                </button>
                                <button type="button" class="btn btn-primary" onclick="refund34Point()">계산하기</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!--<div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">ImgBB Uploader</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic file uploader up, upload here to see how
                                <code>.imgbb-filepond</code>-based basic file uploader look. You must use
                                <code>name=image</code> or by FormData fieldName for your
                                input <code>type=file</code> to upload in imgBB.
                            </p>
                             imgBB file uploader
                            <input type="file" name="image" class="imgbb-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Multiple Files</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.multiple-files-filepond</code>-based basic file uploader look. You can use
                                <code>allowMultiple</code> or <code>multiple</code> attribute too to implement multiple
                                upload.
                            </p>
                             File uploader with multiple files upload
                            <input type="file" class="multiple-files-filepond" multiple>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">With Validation</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.with-validation-filepond</code>-based basic file uploader look. You can use
                                <a href="https://pqina.nl/filepond/docs/patterns/plugins/file-validate-size/#properties"
                                   target="_blank">see here</a>
                                or <code>required (to make your input required), data-max-file-size (to limit your input
                                    file size),
                                    data-max-files (to limit your uploaded files), etc (start with data-)</code>
                                attribute
                                too to implement validation.
                            </p>
                             File uploader with validation
                            <input type="file" class="with-validation-filepond" required multiple
                                   data-max-file-size="1MB" data-max-files="3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Preview</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-preview-filepond</code>-based basic file uploader look. This
                                preview for uploaded or dropped images.
                            </p>
                             File uploader with image preview
                            <input type="file" class="image-preview-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Exif Orientation</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-exif-filepond</code>-based basic file uploader look. This
                                helps in correctly orienting photos taken on mobile devices.
                            </p>
                             Auto image crop file uploader
                            <input type="file" class="image-exif-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Crop</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-crop-filepond</code>-based basic file uploader look. You can use
                                <code>imageCropAspectRatio</code> or <code>image-crop-aspect-ratio</code> to
                                set aspect ratio.
                            </p>
                             Auto crop image file uploader
                            <input type="file" class="image-crop-filepond" image-crop-aspect-ratio="1:1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Filter</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-filter-filepond</code>-based basic file uploader look.
                            </p>
                             Auto filter image file uploader
                            <input type="file" class="image-filter-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Resize</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
                                <code>.image-resize-filepond</code>-based basic file uploader look.
                            </p>
                             Auto resize image file uploader
                            <input type="file" class="image-resize-filepond">
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </section>
</div>

<?php
