<script>
    AOS.init();
</script>

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
                                <a href="<?=base_url('customer/all')?>">회원관리</a>
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
                    if($_SESSION['aIdx']=="159"){
                        echo "<li class=\"sidebar-item  has-sub\">
                        <a href=\"#\" class='sidebar-link'>
                            <i class=\"bi bi-stack\"></i>
                            <span>관리자 설정</span>
                        </a>
                        <ul class=\"submenu\" style=\"\">
                            <li class=\"submenu-item \">
                                <a href=\"http://godo.event.admin/employee\">직원관리</a>
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
                                <a href="<?=base_url('convert/coupang')?>">쿠팡 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('convert/mart')?>">마트 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-element-checkbox.html">세이베베 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('convert/lemonTree')?>">레몬트리 변환</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="<?=base_url('convert/foodHistory')?>">식품이력</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="<?=base_url('convert/erpConvert')?>">ERP 변경</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="<?=base_url('convert/self')?>">자가사용 변경</a>
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
            <section class="row">
                <div class="col-12 col-lg-11">
                    <div class="row">
                        <div class="col-6 col-lg-2 col-md-6" data-aos="flip-left" data-aos-delay="50"
                             data-aos-duration="1000">
                            <a href="http://i.venet.kr/nlogin.php" class="" onmouseover="this.style.opacity='0.7';"
                               onmouseout="this.style.opacity='1';" style=display:block;" data-bs-toggle="tooltip"
                               data-placement="bottom" data-bs-or>
                                <div class="card">
                                    <div class="card-body px-3 py-2-3">
                                        <div class="row" style="margin-left:4%;">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldHome"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 py-3">
                                                <h6 class="text-muted font-semibold">CRM HOME</h6>
                                                <h6 class="font-extrabold mb-0"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-lg-2 col-md-6" data-aos="flip-left" data-aos-delay="50"
                             data-aos-duration="1000" style="margin-left:4%;">
                            <a href="exampleModalCenter" class="" onmouseover="this.style.opacity='0.7';"
                               onmouseout="this.style.opacity='1';" style=display:block;" data-toggle="modal"
                               data-target="#exampleModalCenter">
                                <div class="card">
                                    <div class="card-body px-3 py-2-3">
                                        <div class="row" style="margin-left:4%;">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldPlus"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 py-3">
                                                <h6 class="text-muted font-semibold">이벤트 등록</h6>
                                                <h6 class="font-extrabold mb-0" style="font-size:12px;"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 col-md-6" data-aos="flip-right" data-aos-delay="50"
                             data-aos-duration="1000" style="margin-left:4%;">
                            <a href="javascript:void(0);" class="" onmouseover="this.style.opacity='0.7';"
                               onmouseout="this.style.opacity='1';" style=display:block;" onclick="confirm_delCheck();">
                                <div class="card">
                                    <div class="card-body px-3 py-2-3">
                                        <div class="row" style="margin-left:4%;">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldDelete"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 py-3">
                                                <h6 class="text-muted font-semibold">이벤트삭제</h6>
                                                <h6 class="font-extrabold mb-0"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 col-md-6" data-aos="flip-right" data-aos-delay="50"
                             data-aos-duration="1000" style="margin-left:4%;">
                            <a href="eventSchedule" class="" onmouseover="this.style.opacity='0.7';" data-toggle="modal"
                               data-target="#eventSchedule"
                               onmouseout="this.style.opacity='1';" style=display:block;">
                                <div class="card">
                                    <div class="card-body px-3 py-2-3">
                                        <div class="row" style="margin-left:4%;">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldCalendar"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 py-3">
                                                <h6 class="text-muted font-semibold">이벤트스케줄</h6>
                                                <h6 class="font-extrabold mb-0"></h6>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-6 col-lg-2 col-md-6" data-aos="flip-right" data-aos-delay="50"
                             data-aos-duration="1000" style="margin-left:4%;">
                                <div class="card">
                                    <div class="card-body px-3 py-2-3" style="padding-bottom: 17%;">
                                        <div class="d-flex align-items-center" style="padding-left: 4%;">
                                            <div class="stats-icon gray">
                                                <a href="<?= base_url('profile')?>"><i class="iconly-boldProfile" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="정보변경"
                                                   onmouseover="this.style.opacity='0.3';"
                                                   onmouseout="this.style.opacity='1';"></i></a>
                                            </div>
                                            <?php if (isset($_SESSION['aIdx'])): ?>

                                            <div class="ms-3 name">
                                                <h6 class="font-bold text-muted"><?=$_SESSION['aName']?> 님</h6>
                                                <a href="<?=base_url("logout")?>" onmouseover="this.style.fontStyle='italic';" onmouseout="this.style.fontStyle='normal';"><h6 class="text-primary mb-0">Log-Out</h6></a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-12">
                            <div class="card" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                                <div class="card-header text-muted font-semibold">
                                    배냇밀몰에 등록된 이벤트 리스트 목록 입니다.
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('delete'); ?>" method="post" id="deleteForm">
                                        <table class="table table-striped text-muted font-semibold" id="table1"
                                               style="border-spacing: 3px; border-collapse: separate; text-align: center;">

                                            <thead style="text-align: center !important;">
                                            <tr>
                                                <th style="text-align: center;">선택</th>
                                                <th style="text-align: center;">이벤트명</th>
                                                <th style="text-align: center;">이벤트코드</th>
                                                <th style="text-align: center;">최초 등록일</th>
                                                <th style="text-align: center;">최종 수정일</th>
                                            </tr>
                                            </thead>
                                            <tbody class="eventListData">
                                            <?php foreach ($eventList as $row) : ?>
                                                <tr>
                                                    <td>&nbsp;&nbsp;<input type="checkbox" name="event_code[]"
                                                                           value="<?= $row['event_code'] ?>"
                                                                           id="select"></td>
                                                    <td>
                                                        <a href="<?= base_url("event_admin_new/init/{$row['event_code']}") ?>"
                                                           class="text-muted font-semibold"><?= $row['event_name'] ?></a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url("event_admin_new/init/{$row['event_code']}") ?>"
                                                           class="text-muted font-semibold"><?= $row['event_code'] ?></a>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success"><?= $row['regist_date'] ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-danger"><?= $row['updated_at'] ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
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

        <!-- 이벤트 등록 모달 Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">이벤트 등록</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                onclick="modal_reset();">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('eventRegist') ?>" id="eventRegist" method="post" name="eventRegist">
                            <div class="form-group">
                                <label for="event_name">이벤트명</label> <span id="error_event_name"
                                                                           class="text-danger ms-3"></span>
                                <input type="text" class="form-control" name="event_name" id="event_name" value=""
                                       minlength="5" maxlength="20">
                            </div>
                            <div class="form-group">
                                <label for="event_code">이벤트코드</label> <span id="error_event_code"
                                                                            class="text-danger ms-3"></span>
                                <input type="text" class="form-control" name="event_code" id="event_code" value=""
                                       minlength="5" maxlength="20">
                            </div>

                        </form>
                        <span id="error_duplicate" class="text-danger ms-3">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                        <button type="button" class="btn btn-primary event_save">등록</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="modal fade" id="eventSchedule" tabindex="-1" role="dialog"
             aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">이벤트 스케줄</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                onclick="modal_reset();">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <embed type="text/html" src="<?= base_url('event_admin_new/schedule'); ?>"
                               style="height:650px; width:-webkit-fill-available;">
                    </div>

                </div>
            </div>

        </div>


        <script src="/assets2/vendors/simple-datatables/simple-datatables.js"></script>

        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>

        <script>
            $(document).ready(function () {
                $(document).on('click', '.event_save', function () {
                    confirm_event_check();
                });
                $('.dataTable-dropdown').after("<button type='button' class='btn btn-primary' onclick='selectAll()' id='checkAll' style='float:right;'>전체선택</button>");
            });
        </script>


        <?php if (isset($_SESSION['item_code'])): ?>
            <?php
            $session = session();
            $session->remove('item_code');
            ?>
        <?php endif; ?>
