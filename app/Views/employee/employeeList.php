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
                                <a href="<?=base_url('customer/all?page=1')?>">회원관리</a>
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
                                <a href=\"http://godo.event.admin/product\">상품관리</a>
                            </li>
                            <li class=\"submenu-item \">
                                <a href=\"http://godo.event.admin/drymilk\">분유관리</a>
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
                                <a href="<?=base_url('/genuine_out?page=1')?>">정품 출고</a>
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
                        <div class="col-12">
                            <div class="card" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                                <div class="card-header text-muted font-semibold">
                                    아이배냇 임직원 목록
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('delete'); ?>" method="post" id="deleteForm">
                                        <table class="table table-striped text-muted font-semibold" id="table1"
                                               style="border-spacing: 3px; border-collapse: separate; text-align: center;">

                                            <thead style="text-align: center !important;">
                                            <tr>
                                                <th style="text-align: center;">성명</th>
                                                <th style="text-align: center;">아이디</th>
                                                <th style="text-align: center;">부서명</th>
                                                <th style="text-align: center;">직위</th>
                                                <th style="text-align: center;">내선번호</th>
                                                <th style="text-align: center;">이메일</th>
                                                <th style="text-align: center;">계정상태</th>

                                            </tr>
                                            </thead>
                                            <tbody class="employeeList">
                                            <?php foreach ($nadmin as $row): ?>
                                                <tr>
                                                    <td>&nbsp;&nbsp;
                                                        <a href="joinAgreeModalCenter"
                                                           class="font-semibold badge bg-primary employeeName"
                                                           style="width:65px; height:100%;" data-toggle="modal"
                                                           data-target="#joinAgreeModalCenter"
                                                           onclick="dataInsert('<?= $row['aId'] ?>','<?= $row['aStatus'] ?>')"><?= $row['aName'] ?></a>
                                                    </td>
                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold employeeId"><?= $row['aId'] ?></span>
                                                    </td>

                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold"><?php if ($row['orgCode'] == "400001") {
                                                                echo "재무팀";
                                                            } elseif ($row['orgCode'] == "400002") {
                                                                echo "구매관리팀";
                                                            } elseif ($row['orgCode'] == "800001") {
                                                                echo "CS팀";
                                                            } elseif ($row['orgCode'] == "600001") {
                                                                echo "영업1팀";
                                                            } elseif ($row['orgCode'] == "600002") {
                                                                echo "영업2팀";
                                                            } elseif ($row['orgCode'] == "600003") {
                                                                echo "영업3팀";
                                                            } elseif ($row['orgCode'] == "300001") {
                                                                echo "해외영업팀";
                                                            } elseif ($row['orgCode'] == "600004") {
                                                                echo "영업지원팀";
                                                            } elseif ($row['orgCode'] == "500001") {
                                                                echo "마케팅1팀";
                                                            } elseif ($row['orgCode'] == "500002") {
                                                                echo "마케팅2팀";
                                                            } elseif ($row['orgCode'] == "500003") {
                                                                echo "홍보팀";
                                                            } elseif ($row['orgCode'] == "500004") {
                                                                echo "디자인팀";
                                                            } elseif ($row['orgCode'] == "500005") {
                                                                echo "웹디자인팀";
                                                            } elseif ($row['orgCode'] == "700001") {
                                                                echo "연구개발팀";
                                                            } elseif ($row['orgCode'] == "900001") {
                                                                echo "물류팀";
                                                            } elseif ($row['orgCode'] == "110001") {
                                                                echo "생산팀";
                                                            } elseif ($row['orgCode'] == "110003") {
                                                                echo "품질보증팀";
                                                            } elseif ($row['orgCode'] == "110002") {
                                                                echo "생산관리팀";
                                                            } else {
                                                                echo "정보없음";
                                                            } ?></span>
                                                    </td>
                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold"><?php if ($row['grade'] == "1") {
                                                                echo "기타";
                                                            } elseif ($row['grade'] == "2") {
                                                                echo "계약직사원";
                                                            } elseif ($row['grade'] == "3") {
                                                                echo "사원";
                                                            } elseif ($row['grade'] == "4") {
                                                                echo "주임";
                                                            } elseif ($row['grade'] == "5") {
                                                                echo "대리";
                                                            } elseif ($row['grade'] == "6") {
                                                                echo "과장";
                                                            } elseif ($row['grade'] == "7") {
                                                                echo "차장";
                                                            } elseif ($row['grade'] == "8") {
                                                                echo "부장";
                                                            } elseif ($row['grade'] == "9") {
                                                                echo "팀장";
                                                            } elseif ($row['grade'] == "10") {
                                                                echo "본부장";
                                                            } elseif ($row['grade'] == "11") {
                                                                echo "상임고문";
                                                            } elseif ($row['grade'] == "12") {
                                                                echo "이사";
                                                            } elseif ($row['grade'] == "13") {
                                                                echo "재무이사";
                                                            } elseif ($row['grade'] == "14") {
                                                                echo "상무";
                                                            } elseif ($row['grade'] == "15") {
                                                                echo "전무";
                                                            } elseif ($row['grade'] == "16") {
                                                                echo "고문";
                                                            } elseif ($row['grade'] == "17") {
                                                                echo "부사장";
                                                            } elseif ($row['grade'] == "18") {
                                                                echo "대표이사";
                                                            } else {
                                                                echo "정보없음";
                                                            } ?></span>
                                                    </td>
                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold"><?= $row['inTel'] ?></span>
                                                    </td>
                                                    <td>
                                                        <span
                                                                class="text-muted font-semibold"><?= $row['eMail'] ?></span>
                                                    </td>

                                                    <td>
                                                        <span class=" font-semibold badge <?php if ($row['aStatus'] == "A") {
                                                            echo "bg-danger";
                                                        } elseif ($row['aStatus'] == "N") {
                                                            echo "bg-success";
                                                        } elseif ($row['aStatus'] == "H") {
                                                            echo "bg-warning";
                                                        } elseif ($row['aStatus'] == "W") {
                                                            echo "bg-dark";
                                                        } else {
                                                            echo "";
                                                        } ?>" style="width: 65px;">
                                                            <?php if ($row['aStatus'] == "A") {
                                                                echo "승인대기";
                                                            } elseif ($row['aStatus'] == "N") {
                                                                echo "재직";
                                                            } elseif ($row['aStatus'] == "H") {
                                                                echo "휴직";
                                                            } elseif ($row['aStatus'] == "W") {
                                                                echo "퇴사";
                                                            } else {
                                                                echo "";
                                                            } ?>
                                                        </span>
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


        <div class="modal fade" id="joinAgreeModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="joinAgreeModalCenterTitle" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="joinAgreeModalLongTitle">계정 상태 변경</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                onclick="">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('employee/joinAgree') ?>" id="joinAgreeForm" method="post"
                              name="joinAgreeForm">
                            <div class="form-group">
                                <div class="row col-10">
                                    <div style="display: flex; margin-top:2%; margin-left: 3%" class="col-12">
                                        <div class="form-check form-check-primary col-4"
                                             style="padding-right: 3%; margin-top:1%;">
                                            <label class="form-check-label" for="primary"
                                                   style="">
                                                승인대기
                                            </label>
                                            <input class="form-check-input" type="radio" name="status"
                                                   id="status1" value="A" style="">

                                        </div>

                                        <div class="form-check form-check-success col-4"
                                             style="padding-right: 3%; margin-top:1%;">
                                            <label class="form-check-label" for="success"
                                                   style="">
                                                재직
                                            </label>
                                            <input class="form-check-input" type="radio" name="status"
                                                   id="status2" value="N" style="">

                                        </div>

                                        <div class="form-check form-check-warning col-4"
                                             style="padding-right: 3%; margin-top:1%;">
                                            <label class="form-check-label" for="success"
                                                   style="">
                                                휴직
                                            </label>
                                            <input class="form-check-input" type="radio" name="status"
                                                   id="status3" value="H" style="">

                                        </div>

                                        <div class="form-check form-check-danger col-4"
                                             style="padding-right: 3%; margin-top:1%;">
                                            <label class="form-check-label" for="success"
                                                   style="">
                                                퇴사
                                            </label>
                                            <input class="form-check-input" type="radio" name="status"
                                                   id="status4" value="W" style="">

                                        </div>
                                        <input type="hidden" name="aId" id="aId">
                                        <input type="hidden" name="aStatus" id="aStatus">
                                    </div>
                                </div>
                            </div>


                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                        <button type="button" class="btn btn-primary statusSave" onclick="joinAgreeFormSubmit()">변경
                        </button>
                    </div>
                    </form>
                </div>
            </div>

        </div>


        <script src="/assetsEmployee/vendors/simple-datatables/simple-datatables.js"></script>

        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>

        <script>
            function dataInsert(employeeId, status) {
                document.getElementById('aId').value = employeeId;
                document.getElementById('aStatus').value = status;
                var status1 = document.getElementById('status1');
                var status2 = document.getElementById('status2');
                var status3 = document.getElementById('status3');
                var status4 = document.getElementById('status4');
                if (status1.value == status) {
                    status1.checked = true;
                } else if (status2.value == status) {
                    status2.checked = true;
                } else if (status3.value == status) {
                    status3.checked = true;
                } else if (status4.value == status) {
                    status4.checked = true;
                } else {

                }
            }

            function joinAgreeFormSubmit() {
                var form = document.getElementById('joinAgreeForm');
                if (confirm('해당 직원의 계정상태를 변경 하시겠습니까?')) {
                    form.submit();
                } else {
                    return false;
                }
            }
        </script>

        <!--<script>
            $(document).ready(function () {
                $(document).on('click', '.event_save', function () {
                    confirm_event_check();
                });
                $('.dataTable-dropdown').after("<button type='button' class='btn btn-primary' onclick='selectAll()' id='checkAll' style='float:right;'>전체선택</button>");
            });
        </script>-->

<?php
