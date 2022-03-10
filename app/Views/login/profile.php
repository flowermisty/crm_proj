<div class="col-md-12 col-12" style="padding: 0 10%;">
    <div class="card">
        <div class="card-header" style="padding-bottom:0;">
            <h4 class="card-title">아이배냇 임직원</h4>
        </div>
        <div class="card-content">
            <div class="card-body" style="padding-bottom:0;">
                <form class="form form-vertical">
                    <div class="form-body">
                        <form action="">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group has-icon-left">
                                        <label for="first-name-icon">*이름</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="" id="name" value="<?=$nAdmin['aName']?>">
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
                                            <input type="text" class="form-control" placeholder="" id="id" value="<?=$nAdmin['aId']?>">
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
                                            <input type="text" class="form-control" placeholder="" id="employeeCode" value="<?=$nAdmin['erpCode']?>">
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
                                            <input type="password" class="form-control" placeholder="Password"
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
                                            <input type="password" class="form-control" placeholder="Password"
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
                                                       id="tel" value="<?=$nAdminaddHex['Tel']?>">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-telephone"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-icon-left col-4">
                                            <label for="password-id-icon">*내선번호</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="_ _ _"
                                                       id="inTel" value="<?=$nAdminadd['inTel']?>">

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
                                                       id="mobile" value="<?=$nAdminaddHex['Hp']?>">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-phone"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group dropdown col-4">
                                            <label for="mobile-id-icon"></label>

                                            <button style="width:100%;" class="btn btn-secondary dropdown-toggle me-1"
                                                    type="button" id="dropdownMenuButtonSec" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                수신여부 선택
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec"
                                                 style="margin: 0px;">
                                                <a class="dropdown-item" id="agree" href="javascript:void(0);"
                                                   onclick="agreeCheck(this.innerText)">동의</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="agreeCheck(this.innerText)">비동의</a>
                                            </div>
                                        </div>

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
                                                   id="email" value="<?=$nAdminaddHex['eMail']?>">
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
                                            <input type="date" class="form-control" placeholder="입사일" id="hireDate" value="<?=$nAdminadd['inDate']?>">
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
                                            <button style="width:100%;" class="btn btn-secondary dropdown-toggle me-1"
                                                    type="button" id="dropdownMenuButtonPart" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                부서를 선택 하세요


                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonPart"
                                                 style="margin: 0px;">
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">재무팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">구매관리팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">CS팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">영업1팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">영업2팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">영업3팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">해외영업팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">영업지원</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">마케팅1팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">마케팅2팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">홍보팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">디자인팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">웹디자인팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">연구개발팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">물류팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">생산팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">품질보증팀</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="partCheck(this.innerText)">생산관리팀</a>
                                            </div>
                                        </div>

                                        <div class="form-group dropdown col-6">
                                            <label for="grade-id-icon"></label>
                                            <button style="width:100%;" class="btn btn-secondary dropdown-toggle me-1"
                                                    type="button" id="dropdownMenuButtonGrade" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                직급
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonGrade"
                                                 style="margin: 0px;">
                                                <a class="dropdown-item" id="par" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">기타</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">계약직사원</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">사원</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">주임</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">대리</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">과장</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">차장</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">부장</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">팀장</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">본부장</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">상임고문</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">이사</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">재무이사</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">상무</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">전무</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">고문</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">부사장</a>
                                                <a class="dropdown-item" id="notAgree" href="javascript:void(0);"
                                                   onclick="gradeCheck(this.innerText)">대표이사</a>

                                            </div>
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
                                                       id="postNumber" value="<?=$nAdminadd['zipCode']?>">

                                                <div class="form-control-icon">
                                                    <i class="bi bi-file-earmark-post-fill"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group has-icon-left col-3">
                                            <label for="address-id-icon"></label>
                                            <div class="position-relative ">
                                                <button type="button" class="btn btn-primary" onclick="daum_zipcode()">우편번호 검색</button>
                                            </div>
                                        </div>
                                        <div class="form-group has-icon-left col-6">
                                            <label for="address-id-icon"></label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="도로명 주소"
                                                       id="doroAddress" value="<?=$nAdminadd['adr2']?>">

                                                <div class="form-control-icon">
                                                    <i class="bi bi-file-earmark-post-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-icon-left col-6">

                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="지번 주소"
                                                       id="jibunAddress" value="<?=$nAdminadd['adr1']?>">

                                                <div class="form-control-icon">
                                                    <i class="bi bi-file-earmark-post-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-icon-left col-6">

                                            <div class="position-relative">
                                                <input type="text" class="form-control" placeholder="상세주소(직접입력)"
                                                       id="detailAddress" value="<?=$nAdminadd['adr3']?>">

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

                                                    <input class="form-check-input" type="radio" name="Primary"
                                                           id="statusN" value="#dc3545" style="margin-left: 3%"
                                                           <?php if($nAdmin['aStatus'] == "N"){echo "checked";}?>>
                                                    <label class="form-check-label" for="danger">
                                                        재직
                                                    </label>

                                                    <input class="form-check-input" type="radio" name="Primary"
                                                           id="statusH" value="#dc3545" style="margin-left: 17%;"
                                                           <?php if($nAdmin['aStatus'] == "H"){echo "checked";}?>>
                                                    <label class="form-check-label" for="danger">
                                                        휴직
                                                    </label>

                                                    <input class="form-check-input" type="radio" name="Primary"
                                                           id="statusW" value="#dc3545" style="margin-left: 17%;"
                                                           <?php if($nAdmin['aStatus'] == "W"){echo "checked";}?>>
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
                                                           id="birth" value="<?=$nAdminadd['aBirth']?>">
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
                                                               id="saleCount">

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
                                                               id="saleMoney">

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
                                                   id="page" style="margin-top: 3%;" placeholder="http:// 필수입력">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr style="padding-top: 2px;">
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
            <div class="col-12 d-flex justify-content-end" style="padding:1%;">
                <button type="submit" class="btn btn-primary me-1 mb-1">저장</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">다시입력</button>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>
</div>
<style>
    .float-start {
        margin-left: 23%;
    }
    input{
        color: green !important;
        font-weight: bold !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        var part = "<?=$nAdmin['orgCode']?>";
        var agree = "<?=$nAdminadd['smsAgree']?>";
        var grade = "<?=$nAdminadd['grade']?>"
        if(part == "400001"){
            part = "재무팀";
        }else if(part == "400002"){
            part = "영업1팀";
        }else if(part == "800001"){
            part = "CS팀"
        }else if(part == "600001"){
            part = "영업1팀"
        }else if(part == "600002"){
            part = "영업2팀"
        }else if(part == "600003"){
            part = "영업3팀"
        }else if(part == "300001"){
            part = "해외영업팀"
        }else if(part == "600004"){
            part = "영업지원팀"
        }else if(part == "500001"){
            part = "마케팅1팀"
        }else if(part == "500002"){
            part = "마케팅2팀"
        }else if(part == "500003"){
            part = "홍보팀"
        }else if(part == "500004"){
            part = "디자인팀"
        }else if(part == "500005"){
            part = "웹디자인팀"
        }else if(part == "700001"){
            part = "연구개발팀"
        }else if(part == "900001"){
            part = "물류팀"
        }else if(part == "110001"){
            part = "생산팀"
        }else if(part == "110003"){
            part = "품질보증팀"
        }else if(part == "110002"){
            part = "생산관리팀"
        }else{
            part = "부서를 선택 하세요"
        }
        document.getElementById('dropdownMenuButtonPart').innerText = part;

        if(agree=="N"){
            agree = "비동의";
        }else if(agree == "Y"){
            agree = "동의";
        }else{
            agree = "수신 여부 선택";
        }
        document.getElementById('dropdownMenuButtonSec').innerText = agree;

        if(grade == "1"){
            grade = "기타";
        }else if(grade == "2"){
            grade = "계약직사원";
        }else if(grade == "3"){
            grade = "사원";
        }else if(grade == "4"){
            grade = "주임";
        }else if(grade == "5"){
            grade = "대리";
        }else if(grade == "6"){
            grade = "과장";
        }else if(grade == "7"){
            grade = "차장";
        }else if(grade == "8"){
            grade = "부장";
        }else if(grade == "9"){
            grade = "팀장";
        }else if(grade == "10"){
            grade = "본부장";
        }else if(grade == "11"){
            grade = "상임고문";
        }else if(grade == "12"){
            grade = "이사";
        }else if(grade == "13"){
            grade = "재무이사";
        }else if(grade == "14"){
            grade = "상무";
        }else if(grade == "15"){
            grade = "전무";
        }else if(grade == "16"){
            grade = "고문";
        }else if(grade == "17"){
            grade = "부사장";
        }else if(grade == "18"){
            grade = "대표이사";
        }
        document.getElementById('dropdownMenuButtonGrade').innerText = grade;
    });
    function partCheck(checkVal) {
        document.getElementById('dropdownMenuButtonPart').innerText = checkVal;
    }
    function agreeCheck(checkVal) {
        document.getElementById('dropdownMenuButtonSec').innerText = checkVal;
    }
    function gradeCheck(checkVal) {
        document.getElementById('dropdownMenuButtonGrade').innerText = checkVal;
    }
</script>

<?php