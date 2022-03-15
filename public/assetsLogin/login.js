
function employeeSubmit(){
    var name = document.getElementById('name').value.trim();
    var userId = document.getElementById('userId').value.trim();
    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value.trim();
    var passwordConfirm = document.getElementById('passwordConfirm').value.trim();
    var tel = document.getElementById('tel').value.trim();
    var mobile = document.getElementById('mobile').value.trim();
    var mobileAgree = document.getElementById('mobileAgree').value.trim();
    var part = document.getElementById('part').value.trim();
    var grade = document.getElementById('grade').value.trim();
    var fmEmployee = document.getElementById('fmEmployee');

    if(name==null || name==""){
        alert('성함은 필수입력 사항입니다.');
        document.getElementById('name').focus();
        return false;
    }else if(userId==null || userId==""){
        alert('아이디는 필수 입력 사항입니다.');
        document.getElementById('userId').focus();
        return false;
    }else if(email==null || email==""){
        alert('eamil은 필수 입력 사항입니다.');
        document.getElementById('email').focus();
        return false;
    }else if(password==null || password==""){
        alert('password는 필수 입력 사항입니다.');
        document.getElementById('password').focus();
        return false;
    }else if(passwordConfirm==null || passwordConfirm==""){
        alert('password확인을 입력 해주셔야 합니다.');
        document.getElementById('passwordConfirm').focus();
        return false;
    }else if(passwordConfirm != password) {
        alert('입력하신 패스워드와 패스워드 확인이 일치 하지 않습니다.');
        document.getElementById('password').focus();
        return false;
    }else if(tel == null || tel=="") {
        alert('부서 전화번호는 필수입력 사항 입니다.');
        document.getElementById('tel').focus();
        return false;
    }else if(mobile == null || mobile =="") {
        alert('핸드폰 번호는 필수 입력 사항 입니다.');
        document.getElementById('mobile').focus();
        return false;
    }else if(mobileAgree == null || mobileAgree =="") {
        alert('수신여부 동의를 선택해 주셔야 합니다.');
        document.getElementById('mobile').focus();
        return false;
    }else if(part == null || part =="") {
        alert('부서를 선택해 주세요');
        return false;
    }else if(grade == null || grade =="") {
        alert('직급을 선택해 주세요');
        return false;
    }else if(document.getElementById('idCheckFlag').value != "ok"){
        alert('아이디 중복 여부를 확인 해주세요.');
    }else{
        if(confirm('기입하신 정보로 가입 하시겠습니까?')==true){
            fmEmployee.submit();
        }else{
            return false;
        }

    }
}


function daum_zipcode() {

    new daum.Postcode({
        oncomplete: function (data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var roadAddr = data.roadAddress; // 도로명 주소 변수
            var extraRoadAddr = ''; // 참고 항목 변수

            // 법정동명이 있을 경우 추가한다. (법정리는 제외)
            // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
            if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                extraRoadAddr += data.bname;
            }
            // 건물명이 있고, 공동주택일 경우 추가한다.
            if (data.buildingName !== '' && data.apartment === 'Y') {
                extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
            }
            // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
            if (extraRoadAddr !== '') {
                extraRoadAddr = ' (' + extraRoadAddr + ')';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('postNumber').value = data.zonecode;
            document.getElementById('address').value = roadAddr;


            // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
            if (roadAddr !== '') {
                document.getElementById("sample4_extraAddress").value = extraRoadAddr;
            } else {
                document.getElementById("sample4_extraAddress").value = '';
            }

            var guideTextBox = document.getElementById("guide");
            // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
            if (data.autoRoadAddress) {
                var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
                guideTextBox.style.display = 'block';

            } else if (data.autoJibunAddress) {
                var expJibunAddr = data.autoJibunAddress;
                guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
                guideTextBox.style.display = 'block';
            } else {
                guideTextBox.innerHTML = '';
                guideTextBox.style.display = 'none';
            }
        }
    }).open();

}