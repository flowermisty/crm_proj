<style>

    #pColor {
        width: 100%; /* 원하는 너비설정 */

        padding: .5em .3em; /* 여백으로 높이 설정 */
        font-family: inherit; /* 폰트 상속 */
        background: url(https://farm1.staticflickr.com/379/19928272501_4ef877c265_t.jpg) no-repeat 95% 50%; /* 네이티브 화살표 대체 */
        border: 1px solid #dce7f1;
        border-radius: .25rem; /* iOS 둥근모서리 제거 */
        -webkit-appearance: none; /* 네이티브 외형 감추기 */
        -moz-appearance: none;
        appearance: none;
    }

    .columInfo {
        padding: 1%;
        padding-left: 0;
        padding-right: 0;
        margin-left: 0;
    }

</style>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3 class="text-title text-muted">분유 카테고리 등록 / 관리 프로그램</h3>
                <p class="text-subtitle text-muted"></p>
                <hr style="border-top:2px solid">
            </div>
            <div class="col-12 col-md-12 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">관리자 관리</a></li>
                        <li class="breadcrumb-item active" aria-current="page">분유관리</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card" style="margin-bottom:0;">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">분유관리 설정</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body" style="padding-bottom: 0;">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-text">
                                        🔳 1차 카테고리
                                        <button type="button" class="btn btn-primary float-end"
                                                style="display:none;" id="buttonCate1"
                                                onclick="newCate1();">카테고리 생성
                                        </button>
                                        <code></code>
                                    </p>
                                    <div class="table__cell text-muted font-semibold"
                                         style="background: white; font-size: smaller;">
                                        <div class="col-md-12 py-3 border"
                                             style="background:white; border-radius: 6px;">
                                            <div class=""
                                                 style="position: relative; width: 95%; height:95%;  margin: auto;">
                                                <div class="form-row text-muted font-semibold">
                                                    <div class="input-group text-muted font-semibold">
                                                        <input type="search"
                                                               class="form-control rounded text-muted font-semibold"
                                                               placeholder="카테고리명 검색"
                                                               aria-label="Search"
                                                               aria-describedby="search-addon" id="search1"
                                                               onkeyup="filter()"/>
                                                        <button type="button" class="btn btn-primary"
                                                                id="filterText"
                                                                style="margin-left: 3px; display: none;">검색
                                                        </button>

                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="input-group col-md-12 py-3" style="height:300px;">
                                                        <select name="cate1[]" id="sCate1"
                                                                class="form-control text-muted font-semibold"
                                                                multiple
                                                                size="10" onchange="secondCateload();">


                                                            <?php foreach ($cate1 as $row): ?>
                                                                <option id="sCate1Option"
                                                                        value="<?= $row['prdCode'] ?>"><?= $row['prdName'] ?></option>
                                                            <?php endforeach; ?>



                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-2" style="margin-top: 15%; text-align: center; padding: 0;">
                                    <span>▶▶▶</span>
                                </div>


                                <div class="col-md-4">
                                    <p class="card-text">
                                        🔳 2차 카테고리
                                        <button type="button" class="btn btn-success float-end"
                                                style="display: none;"
                                                onclick="newCate2();" id="buttonCate2">세부품목 생성
                                        </button>
                                        <code></code>
                                    </p>
                                    <div class="table__cell text-muted font-semibold"
                                         style="background: white; font-size: smaller;">
                                        <div class="col-md-12 py-3 border"
                                             style="background:white; border-radius: 6px;">
                                            <div class=""
                                                 style="position: relative; width: 95%; height:95%;  margin: auto;">
                                                <div class="form-row text-muted font-semibold">
                                                    <div class="input-group text-muted font-semibold">
                                                        <input type="search"
                                                               class="form-control rounded text-muted font-semibold"
                                                               placeholder="품명 검색"
                                                               aria-label="Search"
                                                               aria-describedby="search-addon" id="search2"
                                                               onkeyup="filter2()"/>
                                                        <button type="button" class="btn btn-primary"
                                                                id="filterText"
                                                                style="margin-left: 3px; display: none;">검색
                                                        </button>

                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="input-group col-md-12 py-3" style="height:300px;">
                                                        <select name="cate2[]" id="sCate2"
                                                                class="form-control text-muted font-semibold"
                                                                multiple
                                                                size="10" onchange="productInit();">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-top:2.7%;">
                                    <div class="col-md-12">

                                    </div>
                                    <div class="col-md-12">

                                    </div>
                                </div>


                            </div>

                            <form class="form-row col-12 col-md-12"
                                  style="border:1px solid #dee2e6; margin-top:1%; border-radius: 6px;"
                                  id="nPrdInfoForm" method="post">

                                <div class="row col-12 columInfo"
                                     style="border-bottom:1px solid #dee2e6;">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">카테고리코드</label>
                                            <input type="text" id="prdCode"
                                                   class="form-control"
                                                   placeholder="" name="prdCode" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">상품명</label>
                                            <input type="text" id="prdName"
                                                   class="form-control"
                                                   placeholder="" name="prdName">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">보여지는 이름</label>
                                            <input type="text" id="prdRname"
                                                   class="form-control"
                                                   name="prdRname" placeholder="">
                                        </div>
                                    </div>

                                </div>

                                <div class="row col-12 columInfo"
                                     style="">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="city-column">보여지기 여부</label>
                                            <div class="row col-12" style="margin-top:2%;">
                                                <input class="form-check-input col-md-3" type="radio"
                                                       name="sellYN" id="sellYN_y" value="Y"
                                                       style="padding:0; margin-left:3.5%;" checked>
                                                <label class="form-check-label  col-md-3" for="danger">
                                                    YES
                                                </label>
                                                <input class="form-check-input col-md-3" type="radio"
                                                       name="sellYN" id="sellYN_n" value="N"
                                                       style="padding:0;">
                                                <label class="form-check-label col-md-2" for="danger">
                                                    NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="city-column">자사제품</label>
                                            <div class="row col-12" style="margin-top:2%;">
                                                <input class="form-check-input col-md-3" type="radio"
                                                       name="cpYN" id="cpYN_y" value="Y"
                                                       style="padding:0; margin-left:3.5%;" checked>
                                                <label class="form-check-label  col-md-3" for="danger">
                                                    YES
                                                </label>
                                                <input class="form-check-input col-md-3" type="radio"
                                                       name="cpYN" id="cpYN_n" value="N"
                                                       style="padding:0;">
                                                <label class="form-check-label col-md-2" for="danger">
                                                    NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">정가</label>
                                            <input type="text" id="prdPrice"
                                                   class="form-control"
                                                   name="prdPrice" placeholder="">
                                        </div>
                                    </div>

                                </div>



                                <!--<div class="form-group col-12">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <input type="checkbox" id="checkbox5"
                                                   class="form-check-input" checked="">
                                            <label for="checkbox5">Remember Me</label>
                                        </div>
                                    </div>
                                </div>-->
                                <input type="hidden" name="idx" id="idx">
                                <input type="hidden" name="sell18_tot" id="sell18_tot">
                                <input type="hidden" name="sell18_sup" id="sell18_sup">
                                <input type="hidden" name="sell18_tax" id="sell18_tax">
                                <input type="hidden" name="sell30_tot" id="sell30_tot">
                                <input type="hidden" name="sell30_sup" id="sell30_sup">
                                <input type="hidden" name="sell30_tax" id="sell30_tax">
                                <input type="hidden" name="sell50_tot" id="sell50_tot">
                                <input type="hidden" name="sell50_sup" id="sell50_sup">
                                <input type="hidden" name="sell50_tax" id="sell50_tax">

                            </form>


                            <div class="col-12 d-flex justify-content-end" style="margin-top:1.5%; margin-bottom:2%;">
                                <button type="button" class="btn btn-primary me-1 mb-1" id="submit" onclick="submit_form();" style="display: none;">등록</button>
                                <button type="button" class="btn btn-light-secondary me-1 mb-1" id="reset_delete" onclick="cancel_delete();" style="display: none;">취소</button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">ImgBB Uploader</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic file uploader up, upload here to see how
<code>.imgbb-filepond</code>-based basic file uploader look. You must use
                                <code>name=image</code> or by FormData fieldName for your
                                                                                     input <code>type=file</code> to upload in imgBB.
                            </p>
imgBB file uploader
<input type="file" name="image" class="imgbb-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Multiple Files</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
<code>.multiple-files-filepond</code>-based basic file uploader look. You can use
                                <code>allowMultiple</code> or <code>multiple</code> attribute too to implement multiple
                                upload.
                            </p>
File uploader with multiple files upload
<input type="file" class="multiple-files-filepond" multiple>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">With Validation</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
<code>.with-validation-filepond</code>-based basic file uploader look. You can use
                                <a href="https://pqina.nl/filepond/docs/patterns/plugins/file-validate-size/#properties"
                                   target="_blank">see here</a>
                                or <code>required (to make your input required), data-max-file-size (to limit your input
                                    file size),
                                    data-max-files (to limit your uploaded files), etc (start with data-)</code>
attribute
                                too to implement validation.
                            </p>
File uploader with validation
<input type="file" class="with-validation-filepond" required multiple
                                   data-max-file-size="1MB" data-max-files="3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Preview</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
<code>.image-preview-filepond</code>-based basic file uploader look. This
                                preview for uploaded or dropped images.
                            </p>
File uploader with image preview
<input type="file" class="image-preview-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Exif Orientation</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
<code>.image-exif-filepond</code>-based basic file uploader look. This
                                helps in correctly orienting photos taken on mobile devices.
                            </p>
Auto image crop file uploader
<input type="file" class="image-exif-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Crop</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
<code>.image-crop-filepond</code>-based basic file uploader look. You can use
                                <code>imageCropAspectRatio</code> or <code>image-crop-aspect-ratio</code> to
                                set aspect ratio.
                            </p>
Auto crop image file uploader
<input type="file" class="image-crop-filepond" image-crop-aspect-ratio="1:1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Filter</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
<code>.image-filter-filepond</code>-based basic file uploader look.
                            </p>
Auto filter image file uploader
<input type="file" class="image-filter-filepond">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Image Auto Resize</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">Using the basic table up, upload here to see how
<code>.image-resize-filepond</code>-based basic file uploader look.
                            </p>
Auto resize image file uploader
<input type="file" class="image-resize-filepond">
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </section>
</div>

<script>
    function filter() {
        let search = document.getElementById("search1").value;
        let listInner = document.getElementById("sCate1");
        let menuName = [];
        for (let i = 0; i < listInner.length; i++) {
            menuName[i] = listInner[i].innerText;
            if (menuName[i].indexOf(search) != -1) {
                listInner[i].style.display = "flex"
            } else {
                listInner[i].style.display = "none"
            }
        }
    }

    function filter2() {
        let search = document.getElementById("search2").value;
        let listInner = document.getElementById("sCate2");
        let menuName = [];
        for (let i = 0; i < listInner.length; i++) {
            menuName[i] = listInner[i].innerText;
            if (menuName[i].indexOf(search) != -1) {
                listInner[i].style.display = "flex"
            } else {
                listInner[i].style.display = "none"
            }
        }
    }


    function secondCateload() {
        var select = $('#sCate1').val();
        var param = {cate1: select};
        $.ajax({
            type: "POST",
            url: "/drymilk/loadSecond",
            data: param,
            success: function (response) {
                $('#sCate2').html("");
                for (let i = 0; i < Object.keys(response).length; i++) {
                    var prdRName = response[i]['prdRName'];
                    var prdCode = response[i]['prdCode'];
                    $('#sCate2').append("<option value='" + prdCode + "'>" + prdRName + "</option>");
                }
            }


        });
    }


    function productInit() {
        var select = $('#sCate2').val();
        var param = {cate2: select};
        $.ajax({
            type: "POST",
            url: "/drymilk/productInit",
            data: param,
            success: function (response) {
                $('#prdCode').val(response.prdInfo[0]['prdCode'])
                $('#prdName').val(response.prdInfo[0]['prdName'])
                $('#prdRname').val(response.prdInfo[0]['prdRName']);


                if (response.prdInfo[0]['viewYN'] == $('#viewYN_y').val()) {
                    $('#viewYN_y').attr('checked', 'true');
                } else if (response.prdInfo[0]['viewYN'] == $('#viewYN_n').val()) {
                    $('#viewYN_n').attr('checked', 'true');
                }
                if (response.prdInfo[0]['cpYN'] == $('#cpYN_y').val()) {
                    $('#cpYN_y').attr('checked', 'true');
                } else if (response.prdInfo[0]['cpYN'] == $('#cpYN_n').val()) {
                    $('#cpYN_n').attr('checked', 'true');
                }

                $('#sell18_tot').val(response.prdInfo[0]['sell18_tot']);
                $('#sell18_sup').val(response.prdInfo[0]['sell18_sup']);
                $('#sell18_tax').val(response.prdInfo[0]['sell18_tax']);
                $('#sell30_tot').val(response.prdInfo[0]['sell30_tot']);
                $('#sell30_sup').val(response.prdInfo[0]['sell30_sup']);
                $('#sell30_tax').val(response.prdInfo[0]['sell30_tax']);
                $('#sell50_tot').val(response.prdInfo[0]['sell50_tot']);
                $('#sell50_sup').val(response.prdInfo[0]['sell50_sup']);
                $('#sell50_tax').val(response.prdInfo[0]['sell50_tax']);


                $('#prdPrice').val(response.prdInfo[0]['prdPrice']);
                $('#idx').val(response.prdInfo[0]['idx']);

                $('#submit').text('수정');
                $('#submit').show();
                $('#reset_delete').text('삭제');
                $('#reset_delete').show();

            }


        });
    }

    $('#button').on('click', function () {
        location.reload();
    });


    function newCate1() {
        var param = {cate1: "addNewCate1"};
        $.ajax({
            type: "POST",
            data: param,
            url: "/drymilk/addNewCate1",
            success: function (response) {
                var newCate1Num = parseInt(response.lastCateNum[0]['prdCode']) + 1;
                if ($('#prdName').val() == "") {
                    $('#prdCode').val(newCate1Num);
                } else {
                    if (confirm('카테고리 등록페이지로 이동 하시겠습니까?') == true) {
                        location.reload();
                    } else {
                        return false;
                    }
                }

            }

        });
    }


    function newCate2() {
        var selected = $("#sCate1").attr('selected', 'true').val();
        if (selected == null) {
            alert('1차 카테고리를 선택해 주세요.');
            return false;
        } else if (selected.length != 1) {
            alert('1개의 카테고리를 선택 하셔야 합니다.');
            return false;
        } else {
            var param = {cate1: selected};
            $.ajax({
                type: "POST",
                data: param,
                url: "/drymilk/addNewCate2",
                success: function (response) {
                    var newCate2NumFirst = response.lastCateNum[0]['prdCode'].substr(3,5);
                    if(newCate2NumFirst=="001"){
                        var newCate2Num = parseInt(response.lastCateNum[0]['prdCode']);
                        if ($('#prdName').val() == "") {
                            $('#prdCode').val(newCate2Num);
                        } else {
                            if (confirm('카테고리 등록페이지로 이동 하시겠습니까?') == true) {
                                location.reload();
                            } else {
                                return false;
                            }
                        }
                    }else{
                        var newCate2Num = parseInt(response.lastCateNum[0]['prdCode']) + 1;
                        if ($('#prdName').val() == "") {
                            $('#prdCode').val(newCate2Num);
                        } else {
                            if (confirm('카테고리 등록페이지로 이동 하시겠습니까?') == true) {
                                location.reload();
                            } else {
                                return false;
                            }
                        }
                    }


                }

            });
        }

    }


    function submit_form() {
        var mode = $('#submit').text();
        if (mode == "등록") {
            $('#nPrdInfoForm').attr("action", "http://godo.event.admin/drymilk/insert");
        } else if (mode == "수정") {

            $('#nPrdInfoForm').attr("action", "http://godo.event.admin/drymilk/update");
        } else {
            alert('notDefined');
        }
        $('#nPrdInfoForm').submit();

    }

    function cancel_delete() {
        var mode = $('#reset_delete').text();
        if (mode == "취소") {
            $('#nPrdInfoForm')[0].reset();
        } else if (mode == "삭제") {
            $('#nPrdInfoForm').attr("action", "http://godo.event.admin/drymilk/delete");
            $('#nPrdInfoForm').submit();
        }else{
            alert('notDefined');
        }

    }


    $('#prdPrice').on('keyup', function(){
        var prdPrice = parseInt($('#prdPrice').val());
        var sell18_tot = parseInt(Math.round(prdPrice * 0.82));
        var sell18_sup = parseInt(Math.round(sell18_tot/11*10));
        var sell18_tax = parseInt(Math.round(sell18_sup/10));
        var sell30_tot = parseInt(Math.round(prdPrice * 0.70));
        var sell30_sup = parseInt(Math.round(sell30_tot/11*10));
        var sell30_tax = parseInt(Math.round(sell30_sup/10));
        var sell50_tot = parseInt(Math.round(prdPrice * 0.50));
        var sell50_sup = parseInt(Math.round(sell50_tot/11*10));
        var sell50_tax = parseInt(Math.round(sell50_sup/10));
        $('#sell18_tot').val(sell18_tot);
        $('#sell18_sup').val(sell18_sup);
        $('#sell18_tax').val(sell18_tax);
        $('#sell30_tot').val(sell30_tot);
        $('#sell30_sup').val(sell30_sup);
        $('#sell30_tax').val(sell30_tax);
        $('#sell50_tot').val(sell50_tot);
        $('#sell50_sup').val(sell50_sup);
        $('#sell50_tax').val(sell50_tax);
        if($('#sell18_tot').val() == "NaN" || $('#prdPrice').val() == "0"){
            $('#sell18_tot').val(0);
            $('#sell18_sup').val(0);
            $('#sell18_tax').val(0);
            $('#sell30_tot').val(0);
            $('#sell30_sup').val(0);
            $('#sell30_tax').val(0);
            $('#sell50_tot').val(0);
            $('#sell50_sup').val(0);
            $('#sell50_tax').val(0);
        }
    });
</script>
