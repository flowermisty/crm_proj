<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assetsLogin/style.css">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script src="/assetsLogin/login.js"></script>
    <title>아이배넷 CRM</title>
</head>

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
        border: 1px solid #999;
        border-radius: 0px; /* iOS 둥근모서리 제거 */
        -webkit-appearance: none; /* 네이티브 외형 감추기 */
        -moz-appearance: none;
        appearance: none;
    }

    #daumApi:hover{
        color:green !important;
        font-weight: bold !important;
    }


</style>
<body>
<h1 class="tip" style="color:#373b3e; font-size: revert; font-weight: ">IVENET CRM ADMINISTRATOR</h1>
<div class="cont" style="height:850px;">
    <div class="form sign-in" style="padding-top: 20%;">
        <h2 style="color:#373b3e">로그인</h2>
        <form id="fm" method="post">
            <label>
                <span>아이디</span>
                <input type="text" name="user_id" id="user_id"/>
            </label>
            <label>
                <span>비밀번호</span>
                <input type="password" name="user_pw" id="user_pw"/>
            </label>
            <p class="forgot-pass"><a>패스워드 찾기</a></p>
            <button type="button" class="submit" id="loginBtn">확인</button>
        </form>
        <!--<button type="button" class="fb-btn">Connect with <span>facebook</span></button>-->
    </div>
    <form action="<?= base_url('employeeRegist') ?>" name="fmEmployee" method="post" id="fmEmployee">
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up" style="padding-top:45%;">
                    <h2>회원가입</h2>
                    <p>아이디를 생성 하시려면 아래의 <br>SIGN IN 버튼을 클릭 하세요.</p>
                </div>
                <div class="img__text m--in" style="padding-top:45%;">
                    <h2>로그인</h2>
                    <p>아래의 SIGN IN 버튼을 클릭하시면 로그인폼이 출력 됩니다.</p>
                </div>
                <div class="img__btn" style="margin-top:26%;">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Sign In</span>
                </div>
            </div>
            <div class="form sign-up" style="padding-top: 5%; ">
                <h2 style="color:#373b3e">아이배냇 임직원</h2>
                <div style="display: flex;">
                    <label>
                        <span>*성명</span>
                        <input type="text" name="name" id="name"/>
                    </label>
                    <label>
                        <span>*아이디</span>
                        <input type="text" name="userId" id="userId"/>
                    </label>
                </div>

                <div style="display: flex;">
                    <label>
                        <span>사원코드</span>
                        <input type="text" name="employeeCode" id="employeeCode"/>
                    </label>
                    <label>
                        <span>*이메일</span>
                        <input type="text" placeholder="xxxx@ivenet.co.kr" name="email" id="email"/>
                    </label>
                </div>

                <div style="display: flex;">
                    <label>
                        <span>*비밀번호</span>
                        <input type="password" name="password" id="password"/>
                    </label>
                    <label>
                        <span>*비밀번호확인</span>
                        <input type="password" name="passwordConfirm" id="passwordConfirm"/>
                    </label>
                </div>

                <div style="display: flex;">
                    <label>
                        <span>*전화/내선번호</span>
                        <div style="display: flex;">
                            <input type="text" style="width: 60%;" placeholder="070-0000-0000" name="tel" id="tel"/>
                            <input type="text" style="width: 30%; margin-left: 10%;" placeholder="000" name="inTel"
                                   id="inTel"/>
                        </div>
                    </label>
                    <label>
                        <span>*핸드폰 / 수신여부</span>
                        <div style="display:flex;">
                            <input type="text" style="width: 60%;" name="mobile" id="mobile"/>
                            <select name="mobileAgree" id="mobileAgree"
                                    style="width: 35%; margin-left: 5%; padding: .0em .1em; /* 여백으로 높이 설정 */">
                                <option value="">수신여부</option>
                                <option value="Y">동의</option>
                                <option value="N">비동의</option>
                            </select>
                        </div>
                    </label>
                </div>

                <div style="display: flex;">
                    <label style="width: 95%;">
                    <span>우편번호 / 주소<a href="javascript:void(0);" onclick="daum_zipcode();" id="daumApi"
                                      style="text-decoration:none; background:black; color: whitesmoke; margin-left: 4%; padding: 0.7%; border-radius:5px;">주소검색</a></span>
                        <div style="display: flex;">
                            <input type="text" style="width: 30%;" id="postNumber" name="postNumber"/>
                            <input type="text" style="width: 60%; margin-left: 10%;" id="address" name="address"/>
                        </div>
                    </label>
                </div>

                <div style="display: flex;">
                    <label style="">
                        <span>상세주소</span>
                        <input type="text" id="addressDetail" placeholder="직접입력" name="addressDetail"/>
                    </label>
                    <label style="">
                        <span>입사일</span>
                        <input type="date" id="inDate"  name="inDate"/>
                    </label>
                </div>

                <div style="display: flex; width: 100%;">
                    <label>
                        <span>*부서</span>
                        <div>
                            <select name="part" id="part">
                                <option value="">부서를 선택 하세요</option>
                                <option value="400001">재무팀</option>
                                <option value="800001">CS팀</option>
                                <option value="600001">영업1팀</option>
                                <option value="600002">영업2팀</option>
                                <option value="600003">영업3팀</option>
                                <option value="300001">해외영업팀</option>
                                <option value="600004">영업지원팀</option>
                                <option value="500001">마케팅1팀</option>
                                <option value="500002">마케팅2팀</option>
                                <option value="500003">홍보팀</option>
                                <option value="500004">디자인팀</option>
                                <option value="500005">웹디자인팀</option>
                                <option value="700001">연구개발팀</option>
                                <option value="900001">물류팀</option>
                                <option value="110001">생산팀</option>
                                <option value="110003">품질보증팀</option>
                                <option value="110002">생산관리팀</option>
                            </select>
                        </div>
                    </label>
                    <label>
                        <span>*직급</span>
                        <div>
                            <select name="grade" id="grade">
                                <option value="" >직급을 선택 하세요</option>
                                <option value="1" >기타</option>
                                <option value="2">계약직사원</option>
                                <option value="3">사원</option>
                                <option value="4">주임</option>
                                <option value="5">대리</option>
                                <option value="6">과장</option>
                                <option value="7">차장</option>
                                <option value="8">부장</option>
                                <option value="9">팀장</option>
                                <option value="10">본부장</option>
                                <option value="11">상임고문</option>
                                <option value="12">이사</option>
                                <option value="13">재무이사</option>
                                <option value="14">상무</option>
                                <option value="15">전무</option>
                                <option value="16">고문</option>
                                <option value="17">부사장</option>
                                <option value="18">대표이사</option>
                            </select>
                        </div>
                    </label>
                </div>

                <div style="display: flex;">
                    <label>
                        <span>생년월일</span>
                        <input type="date" name="birth" id="birth"/>
                    </label>
                    <label>
                        <span>판매건수/금액</span>
                        <div style="display: flex;">
                            <input type="text" style="width: 30%;"/>건
                            <input type="text" style="width: 60%; margin-left:10%;"/>원
                        </div>

                    </label>
                </div>

                <div style="display: flex;">
                    <label>
                        <span>메모</span>
                        <input type="text" name="memo" id="memo"/>
                    </label>
                    <label>
                        <span>페이지 지정</span>
                        <input type="text" placeholder="http:// ← 필수입력" name="page" id="page"/>
                    </label>
                </div>

                <button type="button" class="submit" onclick="employeeSubmit();">Sign Up</button>
                <!--<button type="button" class="fb-btn">Join with <span>facebook</span></button>-->
            </div>
        </div>
    </form>
</div>

<!--<a href="https://dribbble.com/shots/3306190-Login-Registration-form" target="_blank" class="icon-link">
    <img src="http://icons.iconarchive.com/icons/uiconstock/socialmedia/256/Dribbble-icon.png">
</a>
<a href="https://twitter.com/NikolayTalanov" target="_blank" class="icon-link icon-link--twitter">
    <img src="https://cdn1.iconfinder.com/data/icons/logotypes/32/twitter-128.png">
</a>-->

<script src="/assetsLogin/script.js"></script>

<script>
    $(document).ready(function () {
        $("#user_id").focus();
    });

    $("#user_pw").keypress(function () {
        if (event.keyCode == 13) {
            goLoginChk();
        }
    });

    $("#loginBtn").click(function () {
        goLoginChk();
    });


    function agree() {
        document.location.href = "/nemployee.php"
    }

    function goLoginChk() {
        var Mode = "login";
        var user_id = $('#user_id').val();
        var user_pw = $('#user_pw').val();
        $.ajax({
            url: "/login/init",
            type: "POST",
            data: {Mode: Mode, user_id: user_id, user_pw: user_pw},
            success: function (response) {
                if (response.STATUS == "SUC") {
                    window.location.href = "http://godo.event.admin/eventAdmin/";

                } else {
                    alert(response.MSG);

                }
            }
        });
    }

</script>
</body>
</html>
<?php
