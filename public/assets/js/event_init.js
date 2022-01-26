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


function confirm_delCheck(){

    if(confirm('이벤트 리스트와 기획팩 구성품이 삭제 됩니다. 계속 진행 하시겠습니까?') == true){
        document.getElementById('deleteForm').submit();
    }else{
        history.go(0);
    }
}

function confirm_updateCheck(){

    if(confirm('해당 기획팩 구성품이 변경 됩니다. 계속 진행 하시겠습니까?') == true){
        document.getElementById('updateForm').submit();
    }else{
        history.go(0);
    }
}



