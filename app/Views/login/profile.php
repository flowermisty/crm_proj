<style>
    select {
        width: 100%; /* 원하는 너비설정 */
        margin-top: 3%;
        padding: .15em .3em; /* 여백으로 높이 설정 */
        font-family: inherit; /* 폰트 상속 */
        background: url(https://farm1.staticflickr.com/379/19928272501_4ef877c265_t.jpg) no-repeat 95% 50%; /* 네이티브 화살표 대체 */
        border: 1px solid #999;
        border-radius: 3px; /* iOS 둥근모서리 제거 */
        -webkit-appearance: none; /* 네이티브 외형 감추기 */
        -moz-appearance: none;
        appearance: none;
    }
</style>

<div class="col-md-12 col-12" style="padding: 0 10%;">
    <div class="card">
        <div class="card-header" style="padding-bottom:0;">
            <h4 class="card-title">아이배냇 임직원</h4>
        </div>
        <div class="card-content">
            <div class="card-body" style="padding-bottom:0;">
                <form class="form form-vertical" name="employeeUpdate" method="post" action="<?=base_url('employeeUpdate')?>">
                    <div class="form-body">

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">*이름</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="" id="name" name="name"
                                               value="<?= $nAdmin['aName'] ?>" readonly>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">*아이디</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="" id="userId" name="userId"
                                               value="<?= $nAdmin['aId'] ?>" readonly>
                                        <div class="form-control-icon">
                                            <i class="bi bi-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">사원코드</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="" id="employeeCode" name="employeeCode"
                                               value="<?= $nAdmin['erpCode'] ?>" readonly>
                                        <div class="form-control-icon">
                                            <i class="bi bi-code"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr style="padding-top: 2px;">
                            </div>

                            <div class="col-4">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">*비밀번호</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" placeholder="Password" name="Password"
                                               id="password">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">*비밀번호 확인</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" placeholder="Password" name="passwordConfirm"
                                               id="passwordConfirm">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="form-group has-icon-left col-8">
                                        <label for="password-id-icon">*전화 </label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control"
                                                   placeholder="_ _ _-_ _ _ _-_ _ _ _"
                                                   id="tel" value="<?= $nAdminaddHex['Tel'] ?>" name="tel">
                                            <div class="form-control-icon">
                                                <i class="bi bi-telephone"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-icon-left col-4">
                                        <label for="password-id-icon">*내선번호</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="_ _ _"
                                                   id="inTel" value="<?= $nAdminadd['inTel'] ?>" name="inTel">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr style="padding-top: 2px;">
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="form-group has-icon-left col-6">
                                        <label for="mobile-id-icon">핸드폰</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control"
                                                   placeholder="010-_ _ _ _-_ _ _ _"
                                                   id="mobile" value="<?= $nAdminaddHex['Hp'] ?>" name="mobile">
                                            <div class="form-control-icon">
                                                <i class="bi bi-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($nAdminadd['smsAgree']):?>
                                    <div class="form-group dropdown col-4"
                                         style="margin-left: 0; padding-left:0; padding-right: 0;">
                                        <label for="mobile-id-icon"></label>

                                        <select name="mobileAgree" id="mobileAgree"
                                                style="height: 37px; margin-top: 11%; width: 90%;">
                                            <option value="">수신여부</option>
                                            <option value="Y" <?php if($nAdminadd['smsAgree']=="Y"){echo "selected";}?>>동의</option>
                                            <option value="N" <?php if($nAdminadd['smsAgree']=="N"){echo "selected";}?>>비동의</option>
                                        </select>
                                    </div>
                                    <?php endif; ?>

                                    <div class="form-group dropdown col-2">
                                        <label for="mobile-id-icon"></label>

                                        <button style="width:100%;" class="btn btn-primary" type="button">전송
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr style="padding-top: 2px;">
                            </div>

                            <div class="col-4">

                                <div class="form-group has-icon-left">
                                    <label for="email-id-icon">Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Email"
                                               id="email" value="<?= $nAdminaddHex['eMail'] ?>" name="email">
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">

                                <div class="form-group has-icon-left">
                                    <label for="hireDate-id-icon">입사일</label>
                                    <div class="position-relative">
                                        <input type="date" class="form-control" placeholder="입사일" id="hireDate"
                                               value="<?= $nAdminadd['inDate'] ?>" name="hireDate">
                                        <div class="form-control-icon">
                                            <i class="bi bi-calendar-date"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="row">
                                    <div class="form-group dropdown col-6">
                                        <label for="part-id-icon">부서/직급</label>
                                        <select name="part" id="part" style="height: 37px; margin-top: 0%;" name="part">
                                            <option value="">부서를 선택 하세요</option>
                                            <option value="400001" <?php if($nAdmin['orgCode']=="400001"){echo "selected";}?>>재무팀</option>
                                            <option value="800001" <?php if($nAdmin['orgCode']=="800001"){echo "selected";}?>>CS팀</option>
                                            <option value="600001" <?php if($nAdmin['orgCode']=="600001"){echo "selected";}?>>영업1팀</option>
                                            <option value="600002" <?php if($nAdmin['orgCode']=="600002"){echo "selected";}?>>영업2팀</option>
                                            <option value="600003" <?php if($nAdmin['orgCode']=="600003"){echo "selected";}?>>영업3팀</option>
                                            <option value="300001" <?php if($nAdmin['orgCode']=="300001"){echo "selected";}?>>해외영업팀</option>
                                            <option value="600004" <?php if($nAdmin['orgCode']=="600004"){echo "selected";}?>>영업지원팀</option>
                                            <option value="500001" <?php if($nAdmin['orgCode']=="500001"){echo "selected";}?>>마케팅1팀</option>
                                            <option value="500002" <?php if($nAdmin['orgCode']=="500002"){echo "selected";}?>>마케팅2팀</option>
                                            <option value="500003" <?php if($nAdmin['orgCode']=="500003"){echo "selected";}?>>홍보팀</option>
                                            <option value="500004" <?php if($nAdmin['orgCode']=="500004"){echo "selected";}?>>디자인팀</option>
                                            <option value="500005" <?php if($nAdmin['orgCode']=="500005"){echo "selected";}?>>웹디자인팀</option>
                                            <option value="700001" <?php if($nAdmin['orgCode']=="700001"){echo "selected";}?>>연구개발팀</option>
                                            <option value="900001" <?php if($nAdmin['orgCode']=="900001"){echo "selected";}?>>물류팀</option>
                                            <option value="110001" <?php if($nAdmin['orgCode']=="110001"){echo "selected";}?>>생산팀</option>
                                            <option value="110003" <?php if($nAdmin['orgCode']=="110003"){echo "selected";}?>>품질보증팀</option>
                                            <option value="110002" <?php if($nAdmin['orgCode']=="110002"){echo "selected";}?>>생산관리팀</option>
                                        </select>
                                    </div>

                                    <div class="form-group dropdown col-6">
                                        <label for="grade-id-icon"></label>
                                        <select name="grade" id="grade" style="height: 37px; margin-top: 0%;" name="grade">
                                            <option value="">직급을 선택 하세요</option>
                                            <option value="1" <?php if($nAdminadd['grade']=="1"){echo "selected";}?>>기타</option>
                                            <option value="2" <?php if($nAdminadd['grade']=="2"){echo "selected";}?>>계약직사원</option>
                                            <option value="3" <?php if($nAdminadd['grade']=="3"){echo "selected";}?>>사원</option>
                                            <option value="4" <?php if($nAdminadd['grade']=="4"){echo "selected";}?>>주임</option>
                                            <option value="5" <?php if($nAdminadd['grade']=="5"){echo "selected";}?>>대리</option>
                                            <option value="6" <?php if($nAdminadd['grade']=="6"){echo "selected";}?>>과장</option>
                                            <option value="7" <?php if($nAdminadd['grade']=="7"){echo "selected";}?>>차장</option>
                                            <option value="8" <?php if($nAdminadd['grade']=="8"){echo "selected";}?>>부장</option>
                                            <option value="9" <?php if($nAdminadd['grade']=="9"){echo "selected";}?>>팀장</option>
                                            <option value="10" <?php if($nAdminadd['grade']=="10"){echo "selected";}?>>본부장</option>
                                            <option value="11" <?php if($nAdminadd['grade']=="11"){echo "selected";}?>>상임고문</option>
                                            <option value="12" <?php if($nAdminadd['grade']=="12"){echo "selected";}?>>이사</option>
                                            <option value="13" <?php if($nAdminadd['grade']=="13"){echo "selected";}?>>재무이사</option>
                                            <option value="14" <?php if($nAdminadd['grade']=="14"){echo "selected";}?>>상무</option>
                                            <option value="15" <?php if($nAdminadd['grade']=="15"){echo "selected";}?>>전무</option>
                                            <option value="16" <?php if($nAdminadd['grade']=="16"){echo "selected";}?>>고문</option>
                                            <option value="17" <?php if($nAdminadd['grade']=="17"){echo "selected";}?>>부사장</option>
                                            <option value="18" <?php if($nAdminadd['grade']=="18"){echo "selected";}?>>대표이사</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr style="padding-top: 2px;">
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group has-icon-left col-3">
                                        <label for="address-id-icon">주소</label>
                                        <div class="position-relative ">
                                            <input type="text" class="form-control" placeholder="우편번호"
                                                   id="postNumber" value="<?= $nAdminadd['zipCode'] ?>" name="postNumber">

                                            <div class="form-control-icon">
                                                <i class="bi bi-file-earmark-post-fill"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left col-3">
                                        <label for="address-id-icon"></label>
                                        <div class="position-relative ">
                                            <button type="button" class="btn btn-primary" onclick="daum_zipcode()">
                                                우편번호 검색
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group has-icon-left col-6">
                                        <label for="address-id-icon"></label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="도로명 주소"
                                                   id="doroAddress" value="<?= $nAdminadd['adr2'] ?>" name="doroAddress">

                                            <div class="form-control-icon">
                                                <i class="bi bi-file-earmark-post-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-icon-left col-6">

                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="지번 주소"
                                                   id="jibunAddress" value="<?= $nAdminadd['adr1'] ?>" name="jibunAddress">

                                            <div class="form-control-icon">
                                                <i class="bi bi-file-earmark-post-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-icon-left col-6">

                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="상세주소(직접입력)"
                                                   id="detailAddress" value="<?= $nAdminadd['adr3'] ?>" name="detailAddress">

                                            <div class="form-control-icon">
                                                <i class="bi bi-file-earmark-post-fill"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr style="padding-top: 2px;">
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group has-icon-left">
                                            <label for="status-id-icon">*근무상태</label>
                                            <div class="position-relative" style="padding-top: 2%;">

                                                <input class="form-check-input" type="radio"
                                                       name="status" value="N" style="margin-left: 3%"
                                                    <?php if ($nAdmin['aStatus'] == "N") {
                                                        echo "checked";
                                                    } ?>>
                                                <label class="form-check-label" for="danger">
                                                    재직
                                                </label>

                                                <input class="form-check-input" type="radio"
                                                       name="status" value="H" style="margin-left: 17%;"
                                                    <?php if ($nAdmin['aStatus'] == "H") {
                                                        echo "checked";
                                                    } ?>>
                                                <label class="form-check-label" for="danger">
                                                    휴직
                                                </label>

                                                <input class="form-check-input" type="radio"
                                                       name="status" value="W" style="margin-left: 17%;"
                                                    <?php if ($nAdmin['aStatus'] == "W") {
                                                        echo "checked";
                                                    } ?>>
                                                <label class="form-check-label" for="danger">
                                                    퇴사
                                                </label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group has-icon-left">
                                            <label for="birth-id-icon">*생년월일</label>
                                            <div class="position-relative">
                                                <input type="date" class="form-control"
                                                       id="birth" name="birth" value="<?= $nAdminadd['aBirth'] ?>" readonly>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-calendar-date-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="saleCount-id-icon">판매건수 / 금액</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control"
                                                           id="saleCount" name="saleCount">

                                                </div>
                                            </div>
                                            <div class="col-1" style="line-height: 30px;">
                                                <label for="saleMoney-id-icon"></label>
                                                <span class="form-group">건</span>
                                            </div>
                                            <div class="form-group  col-6">
                                                <label for="password-id-icon"></label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control"
                                                           id="saleMoney" name="saleMoney">

                                                </div>
                                            </div>
                                            <div class="col-1" style="line-height: 30px;">
                                                <label for="password-id-icon"></label>
                                                <span class="form-group">원</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <hr style="padding-top: 2px;">
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="memo-id-icon">메모</label>
                                    <div class="position-relative">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here"
                                                      id="memo"></textarea>
                                            <label for="floatingTextarea">Comments</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="page-id-icon">페이지 지정</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                               id="page" style="margin-top: 3%;" placeholder="http:// 필수입력" name="page">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr style="padding-top: 2px;">
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-12 d-flex justify-content-end" style="padding:1%;">
                <button type="submit" class="btn btn-primary me-1 mb-1">저장</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">다시입력</button>
            </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>
</div>
<style>
    .float-start {
        margin-left: 23%;
    }

    input {
        color: green !important;
        font-weight: bold !important;
    }
</style>

<?php