<style>

    tbody {
        padding: 1%;
    }

</style>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3 class="text-title text-muted">상품카테고리 등록 / 관리 프로그램</h3>
                <p class="text-subtitle text-muted"></p>
                <hr style="border-top:2px solid">
            </div>
            <div class="col-12 col-md-12 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">관리자 관리</a></li>
                        <li class="breadcrumb-item active" aria-current="page">상품관리</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header" style="padding-bottom:0 !important;">
                        <h5 class="card-title text-muted">상품관리 설정</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">
                                🔳 1차 카테고리 <span style="margin-left:25.5%;">🔳 2차 카테고리</span>
                                <code></code>
                            </p>
                            <form id="fmSelf" method="post" action="<?= base_url("convert/self/selfConvert") ?>"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="table__cell text-muted font-semibold"
                                             style="background: white; font-size: smaller;">
                                            <div class="col-md-12 py-3 border" style="background:white;">
                                                <div class=""
                                                     style="position: relative; width: 95%; height:95%;  margin: auto;">
                                                    <div class="form-row text-muted font-semibold">
                                                        <div class="input-group text-muted font-semibold">
                                                            <input type="search"
                                                                   class="form-control rounded text-muted font-semibold"
                                                                   placeholder="메뉴명, ERP코드 검색"
                                                                   aria-label="Search"
                                                                   aria-describedby="search-addon" id="search"
                                                                   onkeyup="filter()"/>
                                                            <button type="button" class="btn btn-primary"
                                                                    id="filterText"
                                                                    style="margin-left: 3px; display: none;">검색
                                                            </button>
                                                            <button type="button" class="btn btn-primary"
                                                                    style="margin-left: 3px;"
                                                                    onclick="">추가
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="input-group col-md-12 py-3">
                                                            <select name="cate1" id="sCate1"
                                                                    class="form-control text-muted font-semibold"
                                                                    multiple
                                                                    size="10" onchange="secondCate();">

                                                                <?php foreach ($product as $row): ?>
                                                                    <option value="<?= $row['prdCode'] ?>"><?= $row['prdName'] ?></option>
                                                                <?php endforeach; ?>


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-1" style="margin-top: 10%; text-align: center; padding: 0;">
                                        <span>▶▶▶</span>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="table__cell text-muted font-semibold"
                                             style="background: white; font-size: smaller;">
                                            <div class="col-md-12 py-3 border" style="background:white;">
                                                <div class=""
                                                     style="position: relative; width: 95%; height:95%;  margin: auto;">
                                                    <div class="form-row text-muted font-semibold">
                                                        <div class="input-group text-muted font-semibold">
                                                            <input type="search"
                                                                   class="form-control rounded text-muted font-semibold"
                                                                   placeholder="메뉴명, ERP코드 검색"
                                                                   aria-label="Search"
                                                                   aria-describedby="search-addon" id="search"
                                                                   onkeyup="filter()"/>
                                                            <button type="button" class="btn btn-primary"
                                                                    id="filterText"
                                                                    style="margin-left: 3px; display: none;">검색
                                                            </button>
                                                            <button type="button" class="btn btn-primary"
                                                                    style="margin-left: 3px;"
                                                                    onclick="">추가
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="input-group col-md-12 py-3">
                                                            <select name="cate2" id="sCate2"
                                                                    class="form-control text-muted font-semibold"
                                                                    multiple
                                                                    size="10">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="row col-12 col-md-12"
                                 style="padding:1%; border:1px solid #ccc; margin-top:2%; margin-left: 0.05%;">
                                <table class="info-table-style text-muted  font-semibold">

                                    <tbody>

                                    <tr>
                                        <th class="its-th-align cneter">카테고리코드</th>
                                        <td class="its-td"><input type="text" name="prdCode" id="prdCode" readonly/>
                                        </td>
                                        <th class="its-th-align cneter">상품명</th>
                                        <td class="its-td"><input type="text" name="prdName" id="prdName"
                                                                  size="20"/>
                                        </td>
                                        <th class="its-th-align cneter">분유여부</th>
                                        <td class="its-td">
                                            <input type="radio" name="milkYN" value="Y"> Yes &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="milkYN" value="N" checked> No
                                        </td>
                                        <th class="its-th-align cneter">보여지는이름</th>
                                        <td class="its-td"><input type="text" name="prdRName" id="prdRName"
                                                                  size="30"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="its-th-align cneter">하위 상품 반영</th>
                                        <td class="its-td" colspan="3">
                                            <input type="radio" name="underYN" value="Y" checked> Yes &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="underYN" value="N"> No (분유, 입수, 규격, 제품판매, 과세,
                                            사내판매, TM판매, 각종 가격 )
                                        </td>
                                        <th class="its-th-align cneter">전표색상</th>
                                        <td class="its-td">
                                            <select name="pColor">
                                                <option value="">-------</option>
                                                <option value="ccff99">녹색</option>
                                                <option value="00ff00">노란색</option>
                                                <option value="ccccff">파란색</option>
                                                <option value="ffc000">주황색</option>
                                            </select>
                                        </td>
                                        <th class="its-th-align cneter">입 수</th>
                                        <td class="its-td"><input type="text" name="prdBox" id="prdBox" size="10"
                                                                  class="wr_right"/> 개
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="its-th-align cneter">TM판매여부</th>
                                        <td class="its-td">
                                            <input type="radio" name="tmYN" value="Y" checked> Yes &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="tmYN" value="N"> No
                                        </td>
                                        <th class="its-th-align cneter">규 격</th>
                                        <td class="its-td"><input type="text" name="prdSize" id="prdSize" size="20"/>
                                        </td>
                                        <th class="its-th-align cneter">erp코드</th>
                                        <td class="its-td"><input type="text" name="erpCode" id="erpCode" size="20"/>
                                        </td>
                                        <th class="its-th-align cneter">정 가</th>
                                        <td class="its-td"><input type="text" name="prdPrice" id="prdPrice" size="30"
                                                                  class="wr_right" onBlur="autoComma(this);"/></td>
                                    </tr>
                                    <tr>
                                        <th class="its-th-align cneter">과세여부</th>
                                        <td class="its-td">
                                            <input type="radio" name="taxYN" value="Y" class="taxYN" checked> 과세 &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="taxYN" value="N" class="taxYN"> 비과세
                                        </td>
                                        <th class="its-th-align cneter">제품판매여부</th>
                                        <td class="its-td">
                                            <input type="radio" name="sellYN" value="Y" checked> Yes &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="sellYN" value="N"> No
                                        </td>
                                        <th class="its-th-align cneter">정품출고여부</th>
                                        <td class="its-td">
                                            <input type="radio" name="genuineYN" value="Y" checked> Yes &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="genuineYN" value="N"> No
                                        </td>
                                        <th class="its-th-align cneter">사내판매여부</th>
                                        <td class="its-td">
                                            <input type="radio" name="inSellYN" value="Y" checked> Yes &nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="inSellYN" value="N"> No
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <th class="its-th-align cneter">롯데마트코드</th>
                                        <td class="its-td"><input type="text" name="lotCode" id="lotCode" value=""
                                                                  size="20"/></td>
                                        <th class="its-th-align cneter">홈플러스코드</th>
                                        <td class="its-td"><input type="text" name="homCode" id="homCode" value=""
                                                                  size="20"/></td>
                                        <th class="its-th-align cneter">메가마트코드</th>
                                        <td class="its-td"><input type="text" name="MGCode" id="MGCode" value=""
                                                                  size="20"/></td>
                                        <th class="its-th-align cneter">농협코드</th>
                                        <td class="its-td"><input type="text" name="NHCode" id="NHCode" value=""
                                                                  size="20"/></td>
                                    </tr>
                                    <tr>
                                        <th class="its-th-align cneter">이랜드리테일</th>
                                        <td class="its-td"><input type="text" name="GSCode" id="GSCode" value=""
                                                                  size="20"/></td>
                                        <th class="its-th-align cneter">GS리테일</th>
                                        <td class="its-td"><input type="text" name="GSCode" id="GSCode" value=""
                                                                  size="20"/></td>
                                        <th class="its-th-align cneter">바코드</th>
                                        <td class="its-td"><input type="text" name="BarCode" id="BarCode" value=""
                                                                  size="20"/></td>
                                        <th class="its-th-align cneter">쿠팡입수</th>
                                        <td class="its-td"><input type="text" name="coupang" id="coupang" value=""
                                                                  size="20"/></td>
                                    </tr>

                                </table>
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


    function secondCate() {
        var select = $('#sCate1').val();
        var param = {cate1: select};
        $.ajax({
            type: "POST",
            url: "/product/loadSecond",
            data: param,
            success: function (response) {
                $('#sCate2').html("");
                for (let i = 0; i < Object.keys(response).length; i++) {
                    var prdCode = response[i]['prdName'];
                    $('#sCate2').append("<option>" + prdCode + "</option>");
                }
            }


        });
    }
</script>
<?php

