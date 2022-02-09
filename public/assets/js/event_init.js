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
                clickEventPlus.parentElement.children[0].innerText = count.toString();
                addInputEa.value = addCount.innerText;
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
                addInputEa.value = addCount.innerText;
            });


        }

    }
}

function menuCheckDeleteRow() {
    var menuTable = document.getElementById("menuTable");

    var rowCnt = menuTable.rows.length;
    var deleteMenu = [];
    for (let i = 0; i < rowCnt; i++) {
        var row = menuTable.rows[i];
        var chkBox = row.cells[0].childNodes[0];
        if (chkBox != null && chkBox.checked == true) {
            deleteMenu[i] = row.cells[1].childNodes[0].textContent;
        }
    }
    var j = 0;
    for (let i = 0; i < rowCnt; i++) {
        var row = menuTable.rows[i];
        var chkBox = row.cells[0].childNodes[0];
        if (chkBox != null && chkBox.checked == true) {

            var delMenuStr = deleteMenu.join(",");
            if (j == 0) {
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


window.addEventListener('DOMContentLoaded', function () {
    let menuTable = document.getElementById("menuTable");


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
});


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


function confirm_insertCheck(){

    if(confirm('작성하신 이벤트와 기획팩 구성품을 등록 하시겠습니까?') == true){
        document.getElementById('insertForm').submit();
    }else{
        return false;
    }
}


function confirm_delCheck(){

    if(confirm('이벤트 리스트와 기획팩 구성품이 삭제 됩니다. 계속 진행 하시겠습니까?') == true){
        var eventCode = [];

        $("input:checkbox[name='event_code\[\]']:checked").each(function(i){
            eventCode.push($(this).val());
        });
        var param ={event_code:eventCode};

        $.ajax({
            type: "POST",
            url: "/delete",
            data: param,
            success: function(response){
                if(response.status == 'success'){
                    alert('삭제 되었습니다.');
                    $('.eventListData').html("");
                    load_event();
                }


            }
        });
        /*document.getElementById('deleteForm').submit();*/
    }else{
        return false;
    }
}

function confirm_updateCheck(){

    if(confirm('해당 기획팩 구성품이 변경 됩니다. 계속 진행 하시겠습니까?') == true){
        document.getElementById('updateForm').submit();

    }else{
        return false;
    }
}

function confirm_event_check(){

    if(confirm('이벤트를 등록하시겠습니까?') == true){
        var eventName = document.forms["eventRegist"]["event_name"].value;
        var eventCode = document.forms["eventRegist"]["event_code"].value;
        if(eventName==null || eventName==""){
            alert("이벤트명은 필수입력 필드입니다.");
            return false;
        }
        else if(eventCode==null || eventCode==""){
            alert("이벤트코드는 필수입력 필드입니다.");
            return false;
        }else if(eventName.length < 5 || eventName.length > 20){
            alert("이벤트명은 최소 5자 최대 20자로 작성하여야 합니다.");
            return false;
        }else if(eventCode.length < 5 || eventCode.length > 20){
            alert("이벤트 코드는 최소 5자 최대 20자로 작성하여야 합니다.");
            return false;
        }else{
            $.ajax({
               type: "POST",
               url: "/eventRegist",
               data:{event_name:eventName, event_code:eventCode},
               success: function(response){
                   $('#exampleModalCenter').modal('hide');
                   $('.close').click();

                   if(response.status == 'fail'){
                       alert('동일한 이벤트 또는 코드명이 이미 존재합니다.')
                   }else{
                       alert('등록 되었습니다.');
                       $('.eventListData').html("");
                       load_event()
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
       url:"/getEventList",
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
    if(confirm('해당 구성품 패키지가  삭제 됩니다. 계속 진행 하시겠습니까?') == true){
        document.getElementById('deletePack').submit();
    }else{
        return false;
    }
}



