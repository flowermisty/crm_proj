$(document).ready(function () {
    $('#searchMainSection').hide();
    $('#date').hide();
    $('#cost').hide();
    $('#statusMain').hide();
    $('#use').hide();
    $('#inNout').hide();
    $('#container').hide();
    $('#downLoad').hide();


    $('nav > .pagination').attr("class", "pagination pagination-primary float-end dataTable-pagination");
    $('nav > .pagination > li').addClass("page-item");
    $('nav > .pagination > li >').addClass("page-link");
    $('nav > .pagination > li').css("margin-right", "0");
    if ($('nav > .pagination > li > a > span').eq(1).text() == "Previous") {
        $('nav > .pagination > li > a > span').eq(1).text('◀');
    }
    if ($('nav > .pagination > li > a > span').eq(-2).text() == "Next") {
        $('nav > .pagination > li > a > span').eq(-2).text('▶');
    }

});

// $('#searchFilterControll>div>button').click(function () {
//     if ($('#searchFilterControll > div > button').text() == "검색조건 펼치기") {
//         $('#wrap').attr('class', 'col-8');
//         $('#searchFilterSpread').slideDown();
//         $('#searchFilterControll > div > button').text('검색조건 접기');
//     } else {
//         $('#wrap').attr('class', 'col-5');
//         $('#searchFilterSpread').slideUp();
//         $('#searchFilterControll > div > button').text('검색조건 펼치기');
//
//     }
//
// });

$('#searchReset').click(function () {
    location.replace("http://godo.event.admin/genuine_out?page=1");
});

function addSearch(obj) {
    if ($(obj).val() == "2") {
        $('#searchMainSection').show();


        $('#date').hide();
        $('#cost').hide();
        $('#statusMain').hide();
        $('#use').hide();
        $('#inNout').hide();
        $('#container').hide();
        $('#downLoad').hide();
    } else if ($(obj).val() == "3") {
        $('#date').show();


        $('#searchMainSection').hide();
        $('#cost').hide();
        $('#statusMain').hide();
        $('#use').hide();
        $('#inNout').hide();
        $('#container').hide();
        $('#downLoad').hide();
    } else if ($(obj).val() == "4") {
        $('#cost').show();


        $('#date').hide();
        $('#searchMainSection').hide();
        $('#statusMain').hide();
        $('#use').hide();
        $('#inNout').hide();
        $('#container').hide();
        $('#downLoad').hide();
    } else if ($(obj).val() == "5") {
        $('#statusMain').show();


        $('#date').hide();
        $('#searchMainSection').hide();
        $('#cost').hide();
        $('#use').hide();
        $('#inNout').hide();
        $('#container').hide();
        $('#downLoad').hide();
    } else if ($(obj).val() == "6") {
        $('#use').show();


        $('#date').hide();
        $('#searchMainSection').hide();
        $('#cost').hide();
        $('#statusMain').hide();
        $('#inNout').hide();
        $('#container').hide();
        $('#downLoad').hide();
    } else if ($(obj).val() == "7") {
        $('#inNout').show();


        $('#date').hide();
        $('#searchMainSection').hide();
        $('#cost').hide();
        $('#statusMain').hide();
        $('#use').hide();
        $('#container').hide();
        $('#downLoad').hide();
    } else if ($(obj).val() == "8") {
        $('#container').show();


        $('#date').hide();
        $('#searchMainSection').hide();
        $('#cost').hide();
        $('#statusMain').hide();
        $('#use').hide();
        $('#inNout').hide();
        $('#downLoad').hide();
    } else if ($(obj).val() == "9") {
        $('#downLoad').show();


        $('#date').hide();
        $('#searchMainSection').hide();
        $('#cost').hide();
        $('#statusMain').hide();
        $('#use').hide();
        $('#inNout').hide();
        $('#container').hide();
    } else {

        $('#searchMainSection').hide();
        $('#date').hide();
        $('#cost').hide();
        $('#statusMain').hide();
        $('#use').hide();
        $('#inNout').hide();
        $('#container').hide();
        $('#downLoad').hide();
    }
}


function modeCheckSubmit(signal) {
    var mode = signal;
    if (mode == "list") {
        if ($('#searchObj').val() == "") {
            alert('검색 조건을 선택 하세요');
            return false;
        } else {
            $('#genuineForm').attr("action", "http://godo.event.admin/genuine_out/search?page=1");
            $('#genuineForm').submit();

        }

    } else if (mode == "search") {
        if ($('#searchObj').val() == "") {
            alert('검색 조건을 선택 하세요');
            return false;
        } else {
            $('#genuineForm').attr("action", "http://godo.event.admin/genuine_out/resultSearch");
            $('#genuineForm').submit();

        }
    }
}


$('#plus').click(function () {
    var clone = $('#0').clone();
    var number = parseInt($('.inNoutProduct').last().attr('id')) + 1;

    $(".inNoutProductWrap").append(clone);
    $(".inNoutProduct").last().attr('id', number);

    var buttonChange = $(".inNoutProduct").last().find('#plus');
    buttonChange.text('-');
    buttonChange.attr('id', 'minus');

    var buttonChangeAfter = $(".inNoutProduct").last().find('#minus');
    buttonChangeAfter.click(function () {
        minusClick();
    });
});

function minusClick() {
    $(".inNoutProduct").last().remove();
}

function modalClose(){
    var first = $("#0");
    first.nextAll().remove();
}


function getCategory2(){
    var select = $('#pcate1').val();
    var param = {pcate1: select};


    $.ajax({
        type: "POST",
        url: "/genuine_out/getCategory2",
        data: param,
        success: function (response) {
            $('#pcate2 > option').remove();
            for(var i = 0; i < response.cate2.length; i++){
                var prdRName = response.cate2[i]['prdRName'];
                var prdCode = response.cate2[i]['prdCode'];
                $('#pcate2').append("<option style=\"font-size:12px;\" value=\""+prdCode+"\">"+prdRName+"</option>");
            }
            // $('#prdCode').val(response.prdInfo[0]['prdCode'])
            // $('#prdName').val(response.prdInfo[0]['prdName'])
            // $('#prdRname').val(response.prdInfo[0]['prdRName']);
            //
            //
            // if (response.prdInfo[0]['viewYN'] == $('#viewYN_y').val()) {
            //     $('#viewYN_y').attr('checked', 'true');
            // } else if (response.prdInfo[0]['viewYN'] == $('#viewYN_n').val()) {
            //     $('#viewYN_n').attr('checked', 'true');
            // }
            // if (response.prdInfo[0]['cpYN'] == $('#cpYN_y').val()) {
            //     $('#cpYN_y').attr('checked', 'true');
            // } else if (response.prdInfo[0]['cpYN'] == $('#cpYN_n').val()) {
            //     $('#cpYN_n').attr('checked', 'true');
            // }
            //
            // $('#sell18_tot').val(response.prdInfo[0]['sell18_tot']);
            // $('#sell18_sup').val(response.prdInfo[0]['sell18_sup']);
            // $('#sell18_tax').val(response.prdInfo[0]['sell18_tax']);
            // $('#sell30_tot').val(response.prdInfo[0]['sell30_tot']);
            // $('#sell30_sup').val(response.prdInfo[0]['sell30_sup']);
            // $('#sell30_tax').val(response.prdInfo[0]['sell30_tax']);
            // $('#sell50_tot').val(response.prdInfo[0]['sell50_tot']);
            // $('#sell50_sup').val(response.prdInfo[0]['sell50_sup']);
            // $('#sell50_tax').val(response.prdInfo[0]['sell50_tax']);
            //
            //
            // $('#prdPrice').val(response.prdInfo[0]['prdPrice']);
            // $('#idx').val(response.prdInfo[0]['idx']);
            //
            // $('#submit').text('수정');
            // $('#submit').show();
            // $('#reset_delete').text('삭제');
            // $('#reset_delete').show();

        }


    });
}
