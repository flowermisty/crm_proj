
/**
 * @section into 설명
 *                  - function name => menuAddRow
 *                    가. 이벤트 상세 프로필 단계 패키지 구성품목 추가시 테이블 생성
 *                    나. 각테이블의 valu값을 전달할 input태그와 그의 속성을 동적 생성
 *                    다. 테이블 생성시에 수량 추가 / 제거 버튼의 이벤트 리스너를 발생시켜,
 *                        각 버튼이 독립적으로 자신의 행을 구분할 수 있도록 제어
 */
function menuAddRow() {
    var select = document.getElementById("inputState");
    var select2 = [];
    var j = 0;
    for (let i = 0; i < select.length; i++) {
        if (select.options[i].selected) {
            select2.push(select.options[i].text);
            var menuTable = document.getElementById("menuTable");
            var addRow = menuTable.insertRow();

            var addCell0 = addRow.insertCell(0);
            var addCell1 = addRow.insertCell(1);
            var addCell2 = addRow.insertCell(2);
            var addCell3 = addRow.insertCell(3);

            var addCheckBox = document.createElement("input");
            addCheckBox.setAttribute("type", "checkbox");

            var addInputMenuname = document.createElement("input");
            addInputMenuname.setAttribute("type", "hidden");
            addInputMenuname.setAttribute("name", "menuName[]");

            var addInputErpCode = document.createElement("input");
            addInputErpCode.setAttribute("type", "hidden");
            addInputErpCode.setAttribute("name", "erpCode[]");

            var addInputEa = document.createElement("input");
            addInputEa.setAttribute("type", "hidden");
            addInputEa.setAttribute("name", "ea[]");


            var addPlus = document.createElement("button");
            addPlus.setAttribute("type", "button");
            addPlus.classList.add("btn-primary");
            addPlus.classList.add("btn");
            addPlus.classList.add("btn-sm");
            addPlus.id = "plus";
            addPlus.innerText = "+";
            addPlus.style.float = "right";
            addPlus.style.marginRight = "5px";

            var addMinus = document.createElement("button");
            addMinus.setAttribute("type", "button");
            addMinus.classList.add("btn-primary");
            addMinus.classList.add("btn");
            addMinus.classList.add("btn-sm");
            addMinus.id = "minus";
            addMinus.innerText = "-";
            addMinus.style.width = "27px";
            addMinus.style.float = "right";

            var addCount = document.createElement("span");

            addCell0.appendChild(addCheckBox);


            var cell1_text = select.options[i].text;
            cell1_text = cell1_text.split("/");
            addCell1.innerText = cell1_text[0].trim();

            var cell2_text = select.options[i].text;
            cell2_text = cell2_text.split("/");
            addCell2.innerText = cell2_text[1].trim();

            addCount.innerText = "1";

            var rowCnt = menuTable.rows.length;
            if (rowCnt != 0) {
                j = rowCnt;
            } else {
                j = 0;
            }

            addCell3.id = "quantity" + j;
            addPlus.id = "plus" + j;
            addMinus.id = "minus" + j;
            j++;


            addCell3.appendChild(addCount);
            addCell3.appendChild(addMinus);
            addCell3.appendChild(addPlus);

            addCell1.appendChild(addInputMenuname);
            addInputMenuname.value = addCell1.innerText;

            addCell2.appendChild(addInputErpCode);
            addInputErpCode.value = addCell2.innerText;

            addCell3.appendChild(addInputEa);
            addInputEa.value = addCount.innerText;


            let clickEventPlus = document.getElementById("plus" + (j - 1));
            clickEventPlus.addEventListener('click', function () {
                let count = clickEventPlus.parentElement.textContent[0];
                count = parseInt(count) + 1;
                if (count > 10) {
                    alert('수량은 10개를 초과할 수 없습니다.');
                    count = 10;
                }
                clickEventPlus.parentElement.children[0].innerText = count.toString();
                clickEventPlus.parentElement.children[3].value = clickEventPlus.parentElement.children[0].innerText;
            });

            let clickEventMinus = document.getElementById("minus" + (j - 1));
            clickEventMinus.addEventListener('click', function () {
                let count = clickEventMinus.parentElement.textContent[0];
                count = parseInt(count) - 1;
                if (count < 1) {
                    alert("등록 수량은 0이 될 수 없습니다.")
                    count = 1;
                }
                clickEventMinus.parentElement.children[0].innerText = count.toString();
                clickEventPlus.parentElement.children[3].value = clickEventMinus.parentElement.children[0].innerText;
            });


        }

    }
}

/**
 * @section into 설명
 *                  - function name => menuCheckDeleteRow
 *                    가. menuAddRow함수에서 동적생성된 로우의 첫번째 td에는 체크박스가 추가 되어 있음
 *                    나. 해당 체크박스의 체크여부를 확인하여 해당 행을 삭제하고
 *                    다. 테이블 생성시에 수량 추가 / 제거 버튼의 이벤트 리스너를 발생시켜,
 *                        각 버튼이 독립적으로 자신의 행을 구분할 수 있도록 제어
 *                    라. 수량 버튼의 구별을 위한 인덱스가 되는 요소의 id값 재정렬
 */
function menuCheckDeleteRow() {
    var menuTable = document.getElementById("menuTable");

    var rowCnt = menuTable.rows.length;
    var deleteMenu = [];
    var delMenuStr = [];
    for (let i = 0; i < rowCnt; i++) {
        var row = menuTable.rows[i];
        var chkBox = row.cells[0].childNodes[0];
        if (chkBox != null && chkBox.checked === true) {
            deleteMenu[i] = row.cells[1].childNodes[0].value;
        }
    }
    var k = 0;
    for (let i = 0; i < deleteMenu.length; i++) {

        if(deleteMenu[i]!=null){
            delMenuStr[k] = deleteMenu[i];
            k++;
        }
    }
    var j = 0;
    for (let i = 0; i < rowCnt; i++) {
        row = menuTable.rows[i];
        chkBox = row.cells[0].childNodes[0];
        if (chkBox != null && chkBox.checked === true) {
            if (j === 0) {
                delMenuStr = delMenuStr.join(',');
                confirm("선택하신 " + "[" + delMenuStr + "]" + "을(를) 삭제 하시겠습니까?");
            }
            j++;

            if (confirm) {
                menuTable.deleteRow(i);
                rowCnt--;
                i--;

            }
        }

        row.cells[3].id = "quantity" + (i + 1);
        row.cells[3].children[2].id = "plus" + (i + 1);
        row.cells[3].children[1].id = "minus" + (i + 1);

    }

}

/**
 * @section into 설명
 *                  - function name => menuAllDeleteRow
 *                    가. 동적 생성된 테이블의 행 전체 삭제를 위한 함수
 */
function menuAllDeleteRow() {
    var menuTable = document.getElementById("menuTable");
    var rowCnt = menuTable.rows.length;
    var j = 0;
    var answer = false;
    for (let i = 0; i < rowCnt; i++) {
        if (j == 0) {
            answer = confirm("테이블의 모든 행이 삭제 됩니다. 계속 진행 하시겠습니까?")
            j++;
        }
        if (answer == true) {
            menuTable.deleteRow(rowCnt - 1);
            rowCnt--;
            i--;
        } else {
            break;
        }

    }
}


/**
 * @section into 설명
 *                  - function name => filter
 *                    가. 동적 생성된 테이블의 행 전체 삭제를 위한 함수
 */
function filter() {
    let search = document.getElementById("search").value;
    let listInner = document.getElementsByTagName("option");
    let menuName = [];
    for (let i = 0; i < listInner.length; i++) {
        menuName[i] = listInner[i].value;

        if (menuName[i].indexOf(search) != -1) {
            listInner[i].style.display = "flex"
        } else {
            listInner[i].style.display = "none"
        }
    }
}

function buttonClickAddEvent(){
    var menuTable = document.getElementById("menuTable");

    for (let i = 1; i <= menuTable.rows.length; i++) {
        let clickEventPlus = document.getElementById("plus" + (i));
        var hiddenEa = clickEventPlus.parentElement.children[3];
        hiddenEa.value = clickEventPlus.parentElement.children[0].innerText;
        clickEventPlus.addEventListener('click', function () {
            let count = clickEventPlus.parentElement.children[0].textContent;

            count = parseInt(count) + 1;
            if (count > 10) {
                alert('수량은 10개를 초과할 수 없습니다.');
                count = 10;
            }
            clickEventPlus.parentElement.children[0].innerText = count.toString();
            var hiddenEa = clickEventPlus.parentElement.children[3];
            hiddenEa.value = clickEventPlus.parentElement.children[0].innerText;
        });

        let clickEventMinus = document.getElementById("minus" + (i));


        clickEventMinus.addEventListener('click', function () {
            let count = clickEventMinus.parentElement.children[0].textContent;
            count = parseInt(count) - 1;
            if (count < 1) {
                alert("등록 수량은 0이 될 수 없습니다.")
                count = 1;
            }
            clickEventMinus.parentElement.children[0].innerText = count.toString();
            var hiddenEa = clickEventPlus.parentElement.children[3];
            hiddenEa.value = clickEventPlus.parentElement.children[0].innerText;

        });
    }
}


function selectAll() {
    var select = document.querySelectorAll('input[type="checkbox"]');
    var checked = select.checked;
    var trans = document.getElementById('checkAll');
    if (trans.innerText=="전체해제") {
        select.forEach((select) => {
            select.checked = false;
            var trans = document.getElementById('checkAll');
            trans.innerText = "전체선택";
        })
    }else{
        select.forEach((select) => {
            select.checked = true;
            checked = select.checked;
            if (checked == true) {
                trans.innerText = "전체해제";
            }

        })
    }

}


function confirm_insertCheck(mode){

    var theForm = document.getElementById('submit_form');
    var event_code = document.getElementById('event_code').value;
    if(mode=="0"){
        theForm.method = "post";
        theForm.target = "_self";
        theForm.action = "/event_admin_new/init/"+event_code;
    }
    if(confirm('작성하신 이벤트와 기획팩 구성품을 등록 하시겠습니까?') == true){
        theForm.submit();
    }else{
        return false;
    }
}


function confirm_delCheck(){

    if(confirm('이벤트 리스트와 기획팩 구성품이 삭제 됩니다. 계속 진행 하시겠습니까?') == true){
        var eventCode_arr = $("input[name='event_code[]']");
        var chk_data = [];
        for( var i=0; i<eventCode_arr.length; i++ ) {
            if( eventCode_arr[i].checked == true ) {
                chk_data.push(eventCode_arr[i].value);
            }
        }
        var param ={event_code:chk_data};

        $.ajax({
            type: "POST",
            url: "/delete",
            data: param,
            success: function(response){
                if(response.status == 'success'){
                    alert('삭제 되었습니다.');
                    window.location.reload();
                }


            }
        });
        /*document.getElementById('deleteForm').submit();*/
    }else{
        return false;
    }
}

function confirm_updateCheck(mode){
    var theForm = document.getElementById('submit_form');
    var event_code = document.getElementById('event_code').value;
    var item_code = document.getElementById('itemCode').value;

    if(mode=="1"){
        theForm.method = "post";
        theForm.target = "_self";
        theForm.action = "/event_admin_new/update/"+item_code+"/"+event_code;
    }
    if(confirm('해당 기획팩 구성품이 변경 됩니다. 계속 진행 하시겠습니까?') == true){
        theForm.submit();
    }else{
        return false;
    }

}

function confirm_event_check(){

    if(confirm('이벤트를 등록하시겠습니까?') == true){
        var eventName = document.forms["eventRegist"]["event_name"].value;
        var eventCode = document.forms["eventRegist"]["event_code"].value;
        if(eventName==null || eventName==""){
            var error_event_name = "이벤트명은 필수입력 필드 입니다."
            document.getElementById('error_event_name').innerText = error_event_name;
            document.getElementById('event_name').focus();
            window.addEventListener("keyup",(e)=>{
                document.getElementById('error_event_name').innerText = "";
            });
            return false;
        }
        else if(eventCode==null || eventCode==""){
            var error_event_code = "이벤트코드는 필수입력 필드 입니다."
            document.getElementById('error_event_code').innerText = error_event_code;
            document.getElementById('event_code').focus();
            window.addEventListener("keyup",(e)=>{
                document.getElementById('error_event_code').innerText = "";
            });
            return false;
        }else if(eventName.length < 5 || eventName.length > 20){
            var error_event_name = "이벤트명은 최소 5자 최대 20자로 작성하여야 합니다."
            document.getElementById('error_event_name').innerText = error_event_name;
            document.getElementById('event_name').focus();
            window.addEventListener("keyup",(e)=>{
                document.getElementById('error_event_name').innerText = "";
            });
            return false;
        }else if(eventCode.length < 5 || eventCode.length > 20){
            var error_event_code = "이벤트 코드는 최소 5자 최대 20자로 작성하여야 합니다."
            document.getElementById('error_event_code').innerText = error_event_code;
            document.getElementById('event_code').focus();
            window.addEventListener("keyup",(e)=>{
                document.getElementById('error_event_code').innerText = "";
            });
            return false;
        }else{
            $.ajax({
               type: "POST",
               url: "/event_admin_new/eventRegist",
               data:{event_name:eventName, event_code:eventCode},
               success: function(response){

                   if(response.status == 'fail'){
                       var error_duplicate = "데이터 중복 에러 : 동일한 이벤트명 또는 코드명이 이미 존재합니다.";
                       document.getElementById('error_duplicate').innerText = error_duplicate;
                       window.addEventListener("keyup",(e)=>{
                           document.getElementById('error_duplicate').innerText = "";
                       });
                       return false;
                   }else{
                       $('#exampleModalCenter').modal('hide');
                       $('.close').click();
                       alert('등록 되었습니다.');
                       window.location.reload();
                   }


               }
            });
            /*document.getElementById('eventRegist').submit();*/
        }
    }else{
        return false;
    }



}

function load_event(){
    $.ajax({
       type:"GET",
       url:"/event_admin_new/getEventList",
       success:function(response){
           $.each(response.eventList, function(key,value){
               $('.eventListData').append('<tr>' +
                   '<td> <input type="checkbox" name="event_code[]" value="'+value['event_code']+'" id="select"></td>' +
                   '<td><a href="/init/'+value['event_code']+'">'+value['event_name']+'</a></td>'+
                   '<td><a href="/init/'+value['event_code']+'">'+value['event_code']+'</a></td>'+
                   '<td><h5><span class="badge bg-success "style="width=100%;">'+value['regist_date']+'</span></h5></td>'+
                   '<td><h5><span class="badge bg-danger "style="width=100%;">'+value['updated_at']+'</span></h5></td>'+
                   '</tr>');
           });
       }
    });
}


function confirm_deletePackCheck(){
    var item_code = document.getElementById('itemCode').value;
    document.getElementById('item_code').value = item_code;
    if(confirm('해당 구성품 패키지가  삭제 됩니다. 계속 진행 하시겠습니까?') == true){
        document.getElementById('deletePack').submit();
    }else{
        return false;
    }
}

function get_event_profile(itemCode){
    var event_code = document.getElementById("event_code").value;
    var item_code = itemCode;
    var index = 1;
    $.ajax({
        type: "GET",
        url: "/event_admin_new/update/"+item_code+"/"+event_code,
        success: function(response){
            $('.item_save').hide();
            $('.item_update').show();
            $('.item_delete').show();
            $('#menuTable').html("");
            $.each(response.joinData, function(key,value){
                $('#step').val(value['step']);
                $('#itemCode').val(value['optionCode']);
                $('#event_code').val(value['event_code']);
                $('#menuTable').append('<tr>' +
                    '<td><input type="checkbox"></td>' +
                    '<td><input type="hidden" name="menuName[]" value="'+value['menuName']+'">'+value['menuName']+'</td>'+
                    '<td><input type="hidden" name="erpCode[]" value="'+value['erpCode']+'">'+value['erpCode']+'</td>'+
                    '<td id="quantity'+index+'">'+
                    '<span>'+value['ea']+'</span>'+
                    '<button type="button" class="btn-primary btn btn-sm" id="minus'+index+'" style="width: 27px; float: right;">-</button>'+
                    '<button type="button" class="btn-primary btn btn-sm" id="plus'+index+'" style="width: 27px; float: right; margin-right: 5px;">+</button>'+
                    '<input type="hidden" name="ea[]" value="'+value['ea']+'">'+
                    '</td>'+
                    '</tr>');
                    index++;


            });
            buttonClickAddEvent();

        }

    });


}

window.addEventListener("keyup",(e)=>{
    $('.alert-danger').hide();
});

function modal_reset(){
    document.getElementById('error_event_name').innerText="";
    document.getElementById('error_event_code').innerText="";
    document.getElementById('error_duplicate').innerText="";
    document.forms['eventRegist'].reset();
}



