function comma(x) {
    var temp = "";
    var x = String(uncomma(x));
    num_len = x.length;
    co = 3;
    while (num_len>0){
        num_len = num_len - co;
        if (num_len<0){
            co = num_len + co;
            num_len = 0;
        }
        temp = ","+x.substr(num_len,co)+temp;
    }

    //계산에서 -, 금액이 발생할 수 있어서 -, 을 - 금액으로만 바뀔수 있게 변경 처리함.
    temp = temp.replace('-,','-');

    return temp.substr(1);
}

function uncomma(x) {
    var reg = /(,)*/g;
    x = parseInt(String(x).replace(reg,""),10);
    return (isNaN(x)) ? 0 : x;
}

function refundRegular() {
    var event = $("input[name=event]").val();
    var totalDiscountWithCoupon = $("input[name=totalDiscountWithCoupon]").val();
    var totalPay = $("input[name=totalPay]").val();
    var pointPay = $("input[name=pointPay]").val();
    var step = $("input[name=step]:checked").val();
    var countsAll = $("input[name=countsAll]").val();
    var already = $("input[name=already]").val();
    $.ajax({
        type: "POST",
        url: "/refundCalc/refund",
        data: {
            event: event,
            totalDiscountWithCoupon: totalDiscountWithCoupon,
            totalPay: totalPay,
            pointPay: pointPay,
            step: step,
            countsAll: countsAll,
            already: already
        },
        success: function (response) {
            var alreadyRatio = (response.alreadyRatio * 100).toFixed(2);
            var cashRatio = (response.cashRatio * 100).toFixed(2);

            $('#calcRegularResult').html("");
            $('#calcRegularResult').append(
                "<div class='modal-header'><h4 class='modal-title'>계산결과</h4></div>" +
                "<div style='margin-top:4%;'></div>" +
                "<div class='col-md-4'><label>기배송된 비율</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id=''class='form-control' name='alreadyRatio' readonly value=" + alreadyRatio + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>%</span></div>" +
                "<div class='col-md-4'><label>(포인트제외)실금액결제비율</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id=''class='form-control' name='cashRatio' readonly value=" + cashRatio + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>%</span></div>" +
                "<div class='col-md-4'><label>(포인트 포함)총환불금액</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id=''class='form-control' name='refundTotal' readonly value=" + response.refundTotal + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>" +
                "<div class='col-md-4'><label>(카드/현금)환불해야할금액</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id=''class='form-control' name='refundCash' readonly value=" + (response.refundCash) + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>" +
                "<div class='col-md-4'><label>환불수수료(창에입력)</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id=''class='form-control' name='cashFees' readonly value=" + (response.cashFees) + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>" +
                "<div class='col-md-4'><label>반환해야할포인트</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id=''class='form-control' name='refundPoint' readonly value=" + (response.refundPoint) + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>point</span></div>" +
                "<div class='col-md-4'><label style='font-size: 14px;'>포인트부가결제수수료(창에입력)</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id=''class='form-control' name='pointFees' readonly value=" + (response.pointFees) + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>point</span></div>");

        }
    });
}


function refundCalc34() {
    var totalEa = $("#tf_totalEa").val(); // 주문서상 전체 이유식 포장팩 수
    var usedEa = $("#tf_usedEa").val(); // 배달받은 이유식 포장팩 수
    var eachPrice = $("#tf_eachPrice").val(); // 개당 정가
    var purchasedPrice = $("#tf_purchasedPrice").val(); // 지불금액
    var specialDiscountRatio = $("#tf_specialDiscountRatio").val(); // 특별할인율
    var generalDiscountRatio = $("#tf_generalDiscountRatio").val(); // 상시할인율
    var usedMileage = $("#tf_usedMileage").val(); // 결제시 사용 마일리지


    /*eachPrice=eachPrice.replace(/\,/,'');
    purchasedPrice=purchasedPrice.replace(/\,/,'');
    usedMileage=usedMileage.replace(/\,/,'');*/

    var deliveredRatio = (usedEa / totalEa) * 100; // 전체 주문 수량대비 배송수취율

    var usedMileageRatio = (usedMileage / purchasedPrice); // 전체 결제비용 대비 결제에 사용된 포인트 비율

    var totalRefundAmount;
    var cashRefundAmount;
    var mileageRefundAmount;
    var cashPaidRatio;
    var paidPointAmount;
    var paidCashAmount; // 카드, 현금으로 지불청구되는 비용
    var requestPrice; // 이미 배송된 이유식에 대해 지불청구되는 비용, 배송율에 따라 달라짐

    if (deliveredRatio <= 60) {
        requestPrice = (eachPrice * usedEa);
        totalRefundAmount = purchasedPrice - requestPrice;
        cashPaidRatio = (1 - usedMileageRatio);
        cashRefundAmount = totalRefundAmount * cashPaidRatio;
        mileageRefundAmount = totalRefundAmount * usedMileageRatio;
    } else if (deliveredRatio > 60 && deliveredRatio <= 80) {
        requestPrice = (eachPrice * (1-(generalDiscountRatio / 100)) * usedEa);
        totalRefundAmount = purchasedPrice - requestPrice;
        cashPaidRatio = (1 - usedMileageRatio);
        cashRefundAmount = totalRefundAmount * cashPaidRatio;
        mileageRefundAmount = totalRefundAmount * usedMileageRatio;
    } else if (deliveredRatio > 80) {
        requestPrice = (eachPrice * (1-(specialDiscountRatio / 100)) * usedEa);
        totalRefundAmount = purchasedPrice - requestPrice;
        cashPaidRatio = (1 - usedMileageRatio);
        cashRefundAmount = totalRefundAmount * cashPaidRatio;
        mileageRefundAmount = totalRefundAmount * usedMileageRatio;
    };

    paidPointAmount = usedMileage - mileageRefundAmount;
    paidCashAmount= requestPrice * cashPaidRatio;
    var substractedCashAmount = paidCashAmount - paidPointAmount;
    $('#calc34Result').html("");
    $('#calc34Result').append(
        "<div class='modal-header'><h4 class='modal-title'>계산결과</h4></div>" +
        "<div style='margin-top:4%;'></div>" +
        "<div class='col-md-4'><label>기배송된 비율</label></div>"+
        "<div class='col-md-7 form-group' style='display:flex;'><input type='text' name='deliveredRatio' id='tf_deliveredRatio' class='form-control' readonly></div>"+
        "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>%</span></div>"+

        "<div class='col-md-4'><label>(포인트제외)실금액결제비율</label></div>"+
        "<div class='col-md-7 form-group' style='display:flex;'><input type='text' name='cashPaidRatio' id='tf_cashPaidRatio' class='form-control' readonly></div>"+
        "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>%</span></div>"+

        "<div class='col-md-4'><label>(포인트포함)총 환불금액</label></div>"+
        "<div class='col-md-7 form-group' style='display:flex;'><input type='text' name='totalRefundAmount' id='tf_totalRefundAmount' class='form-control' readonly></div>"+
        "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>"+

        "<div class='col-md-4'><label>(카드/현금)환불해야할금액</label></div>"+
        "<div class='col-md-7 form-group' style='display:flex;'><input type='text' name='cashRefundAmount' id='tf_cashRefundAmount' class='form-control' readonly></div>"+
        "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>"+

        "<div class='col-md-4'><label>환불수수료(창에입력)</label></div>"+
        "<div class='col-md-7 form-group' style='display:flex;'><input type='text' name='paidCashAmount' id='tf_paidCashAmount' class='form-control' readonly></div>"+
        "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>"+

        "<div class='col-md-4'><label>반환해야할포인트</label></div>"+
        "<div class='col-md-7 form-group' style='display:flex;'><input type='text' name='refundPointAmount' id='tf_refundPointAmount' class='form-control' readonly></div>"+
        "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>point</span></div>"+

        "<div class='col-md-4'><label style='font-size: 14px;'>포인트부가결제수수료(창에입력)</label></div>"+
        "<div class='col-md-7 form-group' style='display:flex;'><input type='text' name='paidPointAmount' id='tf_paidPointAmount' class='form-control' readonly></div>"+
        "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>point</span></div>"


    );

    $("#tf_deliveredRatio").val(comma(deliveredRatio)); // 기배송된 비율
    $("#tf_cashPaidRatio").val(comma(cashPaidRatio*100)); // 실금액결제비율
    $("#tf_totalRefundAmount").val(comma(totalRefundAmount)); // 총 환불금액
    $("#tf_cashRefundAmount").val(comma(cashRefundAmount)); // 카드/현금 환불해야 할 금액
    $("#tf_paidCashAmount").val(comma(substractedCashAmount)); // 환불수수료 (창에 입력)
    $("#tf_refundPointAmount").val(comma(mileageRefundAmount)); // 반환해야 할 포인트
    $("#tf_paidPointAmount").val(comma(paidPointAmount)); // 포인트부가결제수수료 (창에 입력)


}

function refund34Point() {
    var totalCalculatedRefund = $("input[name=totalCalculatedRefund]").val();
    var totalPay = $("input[name=pointTotalPay]").val();
    var pointPay = $("input[name=pointPointPay]").val();

    $.ajax({
        type: "POST",
        url: "/refundCalc/refundPoint",
        data: {
            totalCalculatedRefund: totalCalculatedRefund,
            totalPay: totalPay,
            pointPay: pointPay
        },
        success: function (response) {
            var cashRatio = (response.cashRatio * 100).toFixed(2);
            $('#calc34PointResult').html("");
            $('#calc34PointResult').append(
                "<div class='modal-header'><h4 class='modal-title'>계산결과</h4></div>" +
                "<div style='margin-top:4%;'></div>" +
                "<div class='col-md-4'><label style='font-size: 14px;'>(포인트제외한)실금액결제비율</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id='' class='form-control' name='cashRatio' readonly value=" + cashRatio + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>%</span></div>" +
                "<div class='col-md-4'><label>(포인트 포함)총 환불금액</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id='' class='form-control' name='refundTotal' readonly value=" + (response.totalCalculatedRefund) + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>" +
                "<div class='col-md-4'><label>(카드/현금)환불해야할 금액</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id='' class='form-control' name='refundCash' readonly value=" + response.refundCash + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>" +
                "<div class='col-md-4'><label>환불수수료(창에 입력)</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id='' class='form-control' name='cashFees' readonly value=" + (response.cashFees) + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>원</span></div>" +
                "<div class='col-md-4'><label>반환해야할 포인트</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id='' class='form-control' name='refundPoint' readonly value=" + (response.refundPoint) + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>point</span></div>" +
                "<div class='col-md-4'><label style='font-size: 14px;'>포인트부가결제수수료(창에 입력)</label></div>" +
                "<div class='col-md-7 form-group' style='display:flex;'>" +
                "<input type='text' id='' class='form-control' name='pointFees' readonly value=" + (response.pointFees) + ">" +
                "</div>" +
                "<div class='col-md-1 form-group' style='display:flex;'><span style='line-height: 38px; margin-left: 3%;'>point</span></div>");

        }
    });
}




function calcReset(){
    document.forms['form-horizontal'].reset();
    document.forms['refund3_4'].reset();
    document.forms['pointRate3_4'].reset();
    document.getElementById('calcRegularResult').innerHTML="";
    document.getElementById('calc34Result').innerHTML="";
    document.getElementById('calc34PointResult').innerHTML="";
}