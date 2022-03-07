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
    <title>아이배넷 CRM</title>
</head>
<body>
<h1 class="tip" style="color:#373b3e; font-size: revert; font-weight: ">IVENET CRM ADMINISTRATOR</h1>
<div class="cont" style="height:750px;">
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
        <div class="form sign-up" style="padding-top: 10%; ">
            <h2 style="color:#373b3e">아이배냇 임직원</h2>
            <div style="display: flex;">
                <label>
                    <span>성명</span>
                    <input type="text"/>
                </label>
                <label>
                    <span>아이디</span>
                    <input type="text"/>
                </label>
            </div>

            <div style="display: flex;">
                <label>
                    <span>사원코드</span>
                    <input type="text"/>
                </label>
                <label>
                    <span>이메일</span>
                    <input type="email"/>
                </label>
            </div>

            <div style="display: flex;">
                <label>
                    <span>비밀번호</span>
                    <input type="password"/>
                </label>
                <label>
                    <span>비밀번호확인</span>
                    <input type="password"/>
                </label>
            </div>

            <div style="display: flex;">
                <label>
                    <span>전화/내선번호</span>
                    <input type="password"/>
                </label>
                <label>
                    <span>핸드폰 / 수신여부</span>
                    <input type="password"/>
                </label>
            </div>

            <div style="display: flex;">
                <label>
                    <span>주소</span>
                    <input type="password"/>
                </label>
                <label>
                    <span>부서/직급</span>
                    <input type="password"/>
                </label>
            </div>

            <div style="display: flex;">
                <label>
                    <span>생년월일</span>
                    <input type="password"/>
                </label>
                <label>
                    <span>판매건수/금액</span>
                    <input type="password"/>
                </label>
            </div>

            <div style="display: flex;">
                <label>
                    <span>메모</span>
                    <input type="password"/>
                </label>
                <label>
                    <span>페이지 지정</span>
                    <input type="password"/>
                </label>
            </div>

            <button type="button" class="submit">Sign Up</button>
            <!--<button type="button" class="fb-btn">Join with <span>facebook</span></button>-->
        </div>
    </div>
</div>

<a href="https://dribbble.com/shots/3306190-Login-Registration-form" target="_blank" class="icon-link">
    <img src="http://icons.iconarchive.com/icons/uiconstock/socialmedia/256/Dribbble-icon.png">
</a>
<a href="https://twitter.com/NikolayTalanov" target="_blank" class="icon-link icon-link--twitter">
    <img src="https://cdn1.iconfinder.com/data/icons/logotypes/32/twitter-128.png">
</a>

<script src="/assetsLogin/script.js"></script>
</body>
</html>
<script>

    $(document).ready(function () {
        $("#user_id").focus();
    });

    $("#user_pw").keypress(function () {
        if (event.keyCode == 13) {
            goLoginChk();
        }
    });

    $("#loginBtn").click(function() {
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
            data: {Mode:Mode, user_id:user_id, user_pw:user_pw},
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


<?php
