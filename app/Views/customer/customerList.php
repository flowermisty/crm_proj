<script>
    AOS.init();
</script>


<style>
    select {
        width: 100%; /* 원하는 너비설정 */

        padding: .5em .3em; /* 여백으로 높이 설정 */
        font-family: inherit; /* 폰트 상속 */
        background: url(https://farm1.staticflickr.com/379/19928272501_4ef877c265_t.jpg) no-repeat 95% 50%; /* 네이티브 화살표 대체 */
        border: 1px solid #dfe3e7;
        border-radius: .25rem; /* iOS 둥근모서리 제거 */
        -webkit-appearance: none; /* 네이티브 외형 감추기 */
        -moz-appearance: none;
        appearance: none;
    }

    #route_view {
        line-height: 40px;
        position: absolute;
        top: 13%;
        left: 52%;
        width: 200px;
        height: 40px;
        z-index: 1;
        border-radius: 5px;
        text-align: center;
        color: whitesmoke;
        font-weight: bold;
        display: none;
    }

</style>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo py-3">
                        <a href="<?= base_url('/eventAdmin') ?>"><img src="/assets/images/logo/logo_big.png"
                                                                      alt="Logo" srcset=""></a>
                        <h6 class="font-extrabold mb-0" style="font-size:12px;">이벤트 주문코드 등록 관리자 프로그램</h6>

                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>


                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>회원관리</span>
                        </a>
                        <ul class="submenu" style="display:block;">
                            <li class="submenu-item ">
                                <a href="<?= base_url('customer/all?page=1') ?>">회원관리</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-badge.html">상담관리</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-breadcrumb.html">클레임관리</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-button.html">구매관리</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-card.html">이벤트회원</a>
                            </li>

                        </ul>
                    </li>
                    <?php
                    if ($_SESSION['aIdx'] == "159") {
                        echo "<li class=\"sidebar-item  has-sub\">
                        <a href=\"#\" class='sidebar-link'>
                            <i class=\"bi bi-stack\"></i>
                            <span>관리자 설정</span>
                        </a>
                        <ul class=\"submenu\" style=\"\">
                            <li class=\"submenu-item \">
                                <a href=\"<?=base_url('employee')?>\">직원관리</a>
                            </li>
                            <li class=\"submenu-item \">
                                <a href=\"component-badge.html\">상품관리</a>
                            </li>
                        </ul>
                    </li>";
                    }
                    ?>
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-collection-fill"></i>
                            <span>통계 및 기타관리</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="extra-component-avatar.html">정품 통계</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="extra-component-sweetalert.html">자사몰 세트등록</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="extra-component-toastify.html">배냇밀 이유식 식단</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>재고 관리</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="layout-default.html">재고 관리</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="layout-vertical-1-column.html">롯데마트 재고</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="layout-vertical-navbar.html">홈플러스 재고</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="layout-rtl.html">마트 재고 수량</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="layout-horizontal.html">재고 출고</a>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-hexagon-fill"></i>
                            <span>기타 설정</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="form-element-input.html">바이모션 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?= base_url('convert/godo') ?>">고도몰 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?= base_url('convert/coupang') ?>">쿠팡 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?= base_url('convert/mart') ?>">마트 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-element-checkbox.html">세이베베 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?= base_url('convert/lemonTree') ?>">레몬트리 변환</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="<?= base_url('convert/foodHistory') ?>">식품이력</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="<?= base_url('convert/erpConvert') ?>">ERP 변경</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="<?= base_url('convert/self') ?>">자가사용 변경</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item  has-sub">
                        <a href="form-layout.html" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>개인설정</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="form-element-textarea.html">사내 판매</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="form-element-textarea.html">정품 출고</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="form-element-textarea.html">TM 정품 출고</a>
                            </li>
                        </ul>

                    </li>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <header class="mb-0">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <!--<div class="page-heading">
            <h3>이벤트 등록 현황</h3>
        </div>-->
        <div class="page-content" style="margin-left: 2% !important;">
            <section class="row py-3">
                <div class="col-12 col-lg-12">

                    <div class="row">
                        <div id="route_view" class="bg bg-success" style="" data-aos="zoom-in" data-aos-delay="50"
                             data-aos-duration="1000">

                        </div>
                        <div class="col-12">
                            <div class="card" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                                <div class="card-header text-muted font-semibold">
                                    고객관리 리스트
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('delete'); ?>" method="post" id="deleteForm">
                                        <table class="table table-striped text-muted font-semibold" id="table1"
                                               style="border-spacing: 3px; border-collapse: separate; text-align: center;">

                                            <thead style="text-align: center !important;">
                                            <tr>
                                                <th style="text-align: center;">No.</th>
                                                <th style="text-align: center;">관리번호</th>
                                                <th style="text-align: center;">고객명&nbsp;&nbsp;</th>
                                                <th style="text-align: center;">월령&nbsp;&nbsp;</th>
                                                <th style="text-align: center;">아기이름&nbsp;</th>
                                                <th style="text-align: center;">휴대폰&nbsp;&nbsp;</th>
                                                <th style="text-align: center;">주소</th>
                                                <th style="text-align: center;">담당자&nbsp;</th>
                                                <th style="text-align: center;">상담횟수&nbsp;</th>
                                                <th style="text-align: center;">정품체험&nbsp;</th>
                                                <th style="text-align: center;">등록경로&nbsp;</th>
                                                <th style="text-align: center;">전환&nbsp;&nbsp;</th>

                                            </tr>
                                            </thead>

                                            <tbody class="employeeList">

                                            <?php foreach ($memberList as $row):
                                                $regist_idx_f = sprintf("%05d", $row['regist_idx']);
                                                $writeday_f = substr(str_replace("-", "", $row['writeday']), 2, 6);
                                                if ($row['regist_idx']) $mem_de_code = $row['rute_code'] . $writeday_f . "-" . $regist_idx_f;
                                                else $mem_de_code = "-";
                                                ?>
                                                <tr>
                                                    <td>&nbsp;&nbsp;
                                                        <a href="joinAgreeModalCenter"
                                                           class="font-semibold badge bg-primary employeeName"
                                                           style="width:65px; height:100%;" data-toggle="modal"
                                                           data-target="#joinAgreeModalCenter"
                                                           onclick=""><?= $row['idx'] ?></a>
                                                    </td>
                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold employeeId"
                                                                style="font-size:15px;"><?= $mem_de_code ?></span>
                                                    </td>

                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold"
                                                                style="font-size:15px;">
                                                            <?php
                                                            $name = "{$row['name']}";
                                                            if (mb_strlen($name, "UTF-8") > 3) {
                                                                echo mb_substr($name, 0, 3) . "..";
                                                            } else if (mb_strlen($name, "UTF-8") <= 3) {
                                                                echo $name;
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted font-semibold" style="font-size:15px;">
                                                            <?php

                                                            if (!$row['baby_birth']) {
                                                                echo "-";
                                                            } else {
                                                                echo $row['baby_birth'];
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold"
                                                                style="font-size:15px;">
                                                            <?php

                                                            $baby_name = "{$row['babyName']['baby_name']}";
                                                            if (mb_strlen($baby_name, "UTF-8") > 3) {
                                                                echo mb_substr($baby_name, 0, 3) . "..";
                                                            } else if (mb_strlen($baby_name, "UTF-8") <= 3) {
                                                                echo $baby_name;
                                                            }
                                                            if ($baby_name == "") {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold"
                                                                style="font-size:15px;"><?= $row['hand'] ?></span>
                                                    </td>

                                                    <td>
                                                        <span class="text-muted font-semibold" style="font-size:15px;">
                                                            <?php
                                                            $address = $row['address1'];
                                                            if (mb_strlen($address, "UTF-8") > 25) {
                                                                echo mb_substr($address, 0, 25) . "..";
                                                            } else if (mb_strlen($address, "UTF-8") <= 25) {
                                                                echo $address;
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"><?= $row['adminId'] ?></span>
                                                    </td>

                                                    <td>
                                                        <span class="text-muted font-semibold"
                                                              sstyle="font-size:15px;"><?= $row['csCount'] ?></span>
                                                    </td>

                                                    <td>
                                                        <span class="text-muted font-semibold" style="font-size:15px;">
                                                            <?php
                                                            switch ($row['product_name']['product_name']) {
                                                                case '0':
                                                                    echo '-';
                                                                    break;
                                                                case '1':
                                                                    echo 'only12';# code...
                                                                    break;
                                                                case '2':
                                                                    echo '산양';
                                                                    break;
                                                                case '3':
                                                                    echo '뉴산양';
                                                                    break;
                                                                case '4':
                                                                    echo '(LM)산양';
                                                                    break;
                                                                case '5':
                                                                    echo '컨피던트';
                                                                    break;
                                                                case '6':
                                                                    echo '저지분유';
                                                                    break;
                                                                default:
                                                                    echo '';
                                                                    break;
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"><?php
                                                            switch ($row['rute_code']) {
                                                                case 'H':
                                                                    echo '홈페이지';
                                                                    break;
                                                                case 'M':
                                                                    echo '판촉사원';# code...
                                                                    break;
                                                                case 'D':
                                                                    echo '제휴(클래스)';
                                                                    break;
                                                                case 'E':
                                                                    echo '기타고객';
                                                                    break;
                                                                case 'C':
                                                                    echo '클래임';
                                                                    break;
                                                                case 'S':
                                                                    echo '서수연추천';
                                                                    break;
                                                                case 'A':
                                                                    echo '모아베베';
                                                                    break;
                                                                case 'U':
                                                                    echo '두드림';
                                                                    break;
                                                                case 'O':
                                                                    echo '맘껏스쿨';
                                                                    break;
                                                                case 'K':
                                                                    echo '카파스튜디오';
                                                                    break;
                                                                case 'N':
                                                                    echo '더넥스트웨이브';
                                                                    break;
                                                                case 'B':
                                                                    echo '미즈톡톡';
                                                                    break;
                                                                case 'P':
                                                                    echo '산모피아';
                                                                    break;
                                                                case 'V':
                                                                    echo '배냇밀몰';
                                                                    break;
                                                                case 'F':
                                                                    echo '일등맘';
                                                                    break;
                                                                case 'R':
                                                                    echo '베베나린';
                                                                    break;
                                                                case 'J':
                                                                    echo '조은맘';
                                                                    break;
                                                                case 'G':
                                                                    echo '베베폼';
                                                                    break;
                                                                case 'I':
                                                                    echo '아이보리';
                                                                    break;
                                                                case 'Y':
                                                                    echo '맘스다이어리';
                                                                    break;
                                                                case 'T':
                                                                    echo '성인고객';
                                                                    break;
                                                                case 'X':
                                                                    echo '임산부의날';
                                                                    break;
                                                                case 'Q':
                                                                    echo '지인추천';
                                                                    break;
                                                                case 'W':
                                                                    echo '임신/출산';
                                                                    break;
                                                                case 'L':
                                                                    echo '산후조리원';
                                                                    break;
                                                                default:
                                                                    echo '';
                                                                    break;
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span class="text-muted font-semibold"
                                                              style="font-size:15px;"><?= $row['chgPrd']['chgPrd'] ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>

                                        </table>
                                        <?=$pager->links()?>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger col-md-12" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
            </section>


        </div>


        <script src="/assetsCustomer/vendors/simple-datatables/simple-datatables.js"></script>

        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>


        <script>
            $(document).ready(function () {
                $('.dataTable-dropdown').after("<label class='float-end col-3'> " +
                    "<div style='display: flex;' class='col-12'> " +
                    "<span class='col-4' style='margin-top: 1.5%;'>고객 등록 경로 : </span>" +
                    "<select name=\"part\" id=\"part\" style='color:#555252; font-size: .9025rem;' onchange='route_filter(this)'> " +
                    "<option value=\"all\" <?php if ($rute_code == "all") {
                        echo "selected";
                    } ?>>전체 고객</option>" +
                    "<option value=\"H\" <?php if ($rute_code == "H") {
                        echo "selected";
                    } ?>>홈페이지 고객</option>" +
                    "<option value=\"M\" <?php if ($rute_code == "M") {
                        echo "selected";
                    } ?>>판촉사원 고객</option>" +
                    "<option value=\"D\" <?php if ($rute_code == "D") {
                        echo "selected";
                    } ?>>제휴(클래스)고객</option>" +
                    "<option value=\"E\" <?php if ($rute_code == "E") {
                        echo "selected";
                    } ?>>기타고객</option>" +
                    "<option value=\"C\" <?php if ($rute_code == "C") {
                        echo "selected";
                    } ?>>클래임고객</option>" +
                    "<option value=\"A\" <?php if ($rute_code == "A") {
                        echo "selected";
                    } ?>>모아베베</option>" +
                    "<option value=\"U\" <?php if ($rute_code == "U") {
                        echo "selected";
                    } ?>>두드림</option>" +
                    "<option value=\"O\" <?php if ($rute_code == "O") {
                        echo "selected";
                    } ?>>맘껏스쿨</option>" +
                    "<option value=\"K\" <?php if ($rute_code == "K") {
                        echo "selected";
                    } ?>>카파스튜디오</option>" +
                    "<option value=\"N\" <?php if ($rute_code == "N") {
                        echo "selected";
                    } ?>>더넥스트웨이브</option>" +
                    "<option value=\"B\" <?php if ($rute_code == "B") {
                        echo "selected";
                    } ?>>미즈톡톡</option>" +
                    "<option value=\"P\" <?php if ($rute_code == "P") {
                        echo "selected";
                    } ?>>산모피아</option>" +
                    "<option value=\"V\" <?php if ($rute_code == "V") {
                        echo "selected";
                    } ?>>배냇밀몰</option>" +
                    "<option value=\"F\" <?php if ($rute_code == "F") {
                        echo "selected";
                    } ?>>일등맘</option>" +
                    "<option value=\"R\" <?php if ($rute_code == "R") {
                        echo "selected";
                    } ?>>베베나린</option>" +
                    "<option value=\"J\" <?php if ($rute_code == "J") {
                        echo "selected";
                    } ?>>조은맘</option>" +
                    "<option value=\"G\" <?php if ($rute_code == "G") {
                        echo "selected";
                    } ?>>베베폼</option>" +
                    "<option value=\"T\" <?php if ($rute_code == "T") {
                        echo "selected";
                    } ?>>성인고객</option>" +
                    "<option value=\"I\" <?php if ($rute_code == "I") {
                        echo "selected";
                    } ?>>아이보리</option>" +
                    "<option value=\"Y\" <?php if ($rute_code == "Y") {
                        echo "selected";
                    } ?>>맘스다이어리</option>" +
                    "<option value=\"X\" <?php if ($rute_code == "X") {
                        echo "selected";
                    } ?>>임산부의 날</option>" +
                    "<option value=\"Q\" <?php if ($rute_code == "Q") {
                        echo "selected";
                    } ?>>지인추천</option>" +
                    "<option value=\"L\" <?php if ($rute_code == "L") {
                        echo "selected";
                    } ?>>산후조리원</option>" +
                    "<option value=\"W\" <?php if ($rute_code == "W") {
                        echo "selected";
                    } ?>>임신&출산 축하박스</option>" +
                    "</select>" +
                    "</div>" +
                    "</label>");
                var route_view = $('#part option:checked').text();
                $("#route_view").text(route_view);
                if ($("#route_view").text() != "전체 고객") {
                    $("#route_view").show();
                }

                $('nav > .pagination').attr("class", "pagination pagination-primary float-end dataTable-pagination");
                if ($('nav > .pagination > li > a > span').eq(1).text() == "Previous") {
                    $('nav > .pagination > li > a > span').eq(1).text('◀');
                }
                if ($('nav > .pagination > li > a > span').eq(-2).text() == "Next") {
                    $('nav > .pagination > li > a > span').eq(-2).text('▶');
                }

            });
        </script>



        <script>
            function route_filter(code) {
                var rute_code = code.value;
                location.href = "http://godo.event.admin/customer/" + rute_code + "?page=1";
            }
        </script>

<?php
