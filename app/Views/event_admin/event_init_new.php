<script>
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
</script>

<script>
    AOS.init();
</script>

<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo py-3">
                        <a href="<?=base_url('/')?>"><img src="/assets/images/logo/logo_big.png" alt="Logo" srcset=""></a>
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
                                <a href="component-alert.html">회원관리</a>
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
                                <a href="<?=base_url('convert/godo')?>">고도몰 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-element-select.html">쿠팡 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-element-radio.html">마트 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-element-checkbox.html">세이베베 변환</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-element-textarea.html">레몬트리 변환</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="form-element-textarea.html">식품이력</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="form-element-textarea.html">ERP 변경</a>
                            </li>

                            <li class="submenu-item ">
                                <a href="form-element-textarea.html">자가사용 변경</a>
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
                        <div class="col-6 col-lg-3 col-md-6" data-aos="flip-left" data-aos-delay="50" data-aos-duration="1000">
                            <a href="<?=base_url('/')?>" class="" onmouseover="this.style.opacity='0.7';"
                               onmouseout="this.style.opacity='1';" style=display:block;" data-bs-toggle="tooltip"
                               data-placement="bottom" data-bs-or>
                                <div class="card">
                                    <div class="card-body px-3 py-2-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldHome"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 py-3">
                                                <h6 class="text-muted font-semibold">이벤트 리스트</h6>
                                                <h6 class="font-extrabold mb-0"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <script>
                        function validationRefresh() {
                        location.replace('http://godo.event.admin/event_admin_new/init/<?=$event_code?>');
                        }
                        </script>
                        <div class="col-6 col-lg-3 col-md-6" data-aos="flip-left" data-aos-delay="50" data-aos-duration="1000">
                            <a href="javascript:void(0);" class="" onmouseover="this.style.opacity='0.7';"
                               onmouseout="this.style.opacity='1';" style="display:block;" onclick=" validationRefresh();">

                                <div class="card">
                                    <div class="card-body px-3 py-2-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldPlus"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 py-3">
                                                <h6 class="text-muted font-semibold">세트등록</h6>
                                                <h6 class="font-extrabold mb-0" style="font-size:12px;"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6" data-aos="flip-right" data-aos-delay="50" data-aos-duration="1000">
                            <a href="javascript:void(0);" class="" onmouseover="this.style.opacity='0.7';"
                               onmouseout="this.style.opacity='1';" style=display:block;" onclick="menuCheckDeleteRow();">
                                <div class="card">
                                    <div class="card-body px-3 py-2-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldClose-Square"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 py-3">
                                                <h6 class="text-muted font-semibold">구성품 선택 삭제</h6>
                                                <h6 class="font-extrabold mb-0"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3 col-md-6" data-aos="flip-right" data-aos-delay="50" data-aos-duration="1000">
                            <a href="javascript:void(0);" class="" onmouseover="this.style.opacity='0.7';"
                               onmouseout="this.style.opacity='1';" style="display:block;" onclick="menuAllDeleteRow();">
                                <div class="card">
                                    <div class="card-body px-3 py-2-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldDelete"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 py-3">
                                                <h6 class="text-muted font-semibold">구성품 전체 삭제</h6>
                                                <h6 class="font-extrabold mb-0"></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:4%;">
                        <div>

                            <h4 class="" style="margin-left:3%;">
                                <b class="text-muted font-semibold"><?= $event_name[0]['event_name'] ?>_상세
                                    프로필</b></h4>


                            <hr>

                        </div>
                        <div class="tableAcor" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                            <div class="table__cell">
                                <div class="col-md-12 py-3 border" style="background:white; height:600px;">
                                    <div class="input-group py-2">
                                        <div class="table-wrapper-scroll-y my-custom-scrollbar"
                                             style="position: relative; width: 95%; height:485px; overflow: auto; margin: auto;">
                                            <table class="table table-bordered table-striped text-muted font-semibold">
                                                <thead align="center">
                                                <tr>
                                                    <th>단계</th>
                                                    <th>Item Code</th>


                                                </tr>
                                                </thead>
                                                <tbody align="center">
                                                <?php foreach ($eventList as $row) : ?>
                                                    <tr>
                                                        <td>
                                                            <a href="javascript:void(0);" class="text-muted font-semibold"
                                                               onclick="get_event_profile('<?= $row['optionCode'] ?>')"
                                                                <?php if ($row['optionCode'] == session()->get('item_code')): ?>
                                                                    <?php echo "style='text-decoration:none; color:green !important;'" ?><?php endif; ?>><?= $row['step'] ?></a>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="text-muted font-semibold"
                                                               onclick="get_event_profile('<?= $row['optionCode'] ?>')"
                                                                <?php if ($row['optionCode'] == session()->get('item_code')): ?>
                                                                    <?php echo "style='text-decoration:none; color:green !important;'" ?><?php endif; ?>><?= $row['optionCode'] ?></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr class="input-group" style="margin-left: auto; margin-right:auto; width:97%;">
                                        <div class="btn-con" style="width:100%; float:right; line-height:47px; margin-right: 3%;">
                                            <div class="btn-wrap" style="float:right;">
                                                <!--<button type="button" class="btn btn-secondary" style=""
                                                        onclick="window.location.reload()">세트등록
                                                </button>-->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table__cell text-muted font-semibold" style="background: white; font-size: smaller;">
                                <div class="col-md-12 py-3 border" style="background:white; height:600px;">
                                    <div class="" style="position: relative; width: 95%; height:95%;  margin: auto;">
                                        <div class="form-row text-muted font-semibold">
                                            <div class="input-group text-muted font-semibold">
                                                <input type="search" class="form-control rounded text-muted font-semibold"
                                                       placeholder="메뉴명, ERP코드 검색"
                                                       aria-label="Search"
                                                       aria-describedby="search-addon" id="search" onkeyup="filter()"/>
                                                <button type="button" class="btn btn-primary" id="filterText"
                                                        style="margin-left: 3px; display: none;">검색
                                                </button>
                                                <button type="button" class="btn btn-primary" style="margin-left: 3px;"
                                                        onclick="menuAddRow();">추가
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="input-group col-md-12 py-3">
                                                <select name="inputState" id="inputState" class="form-control text-muted font-semibold" multiple
                                                        size="20">
                                                    <?php foreach ($eventModel as $row) : ?>
                                                        <?php if ($row['menuName']) : ?>
                                                            <option><?= $row['menuName'] . "/" . $row['erpCode'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="table__cell text-muted font-semibold" style="background: white; font-size: smaller;">
                                <form id="submit_form" style="position: relative; width: 95%; height:95%;  margin: auto;">
                                    <div class="col-md-12 py-3 " style="background:white; height:600px;">
                                        <div class="input-group col-md-12">

                                            <div class="input-group py-1" style="height: 40px; text-indent:3px;">
                                                <span style="line-height: 38px;">단 계 입 력 : &nbsp; </span>
                                                <input id="step" name="step" class="form-control text-muted font-semibold"
                                                       type="text" value="<?= set_value('step') ?>"
                                                       style="margin-left: 4.5px;">
                                            </div>

                                            <div class="input-group py-1 " style="height: 40px;">
                                                <span style="line-height: 38px;">아이템 코드 : &nbsp;  </span>&nbsp;
                                                <input id="itemCode" name="itemCode" class="form-control text-muted font-semibold"
                                                       type="text" value="<?= set_value('itemCode') ?>">
                                            </div>

                                            <div class="input-group py-1" style="height: 40px;">
                                                <span style="line-height: 38px;">이벤트 코드 : &nbsp;  </span>&nbsp;
                                                <input id="event_code" name="event_code" class="form-control text-muted font-semibold"
                                                       type="text" value="<?= $event_code ?>" readonly>
                                            </div>


                                            <div class="input-group py-2">
                                                <div class="table-wrapper-scroll-y my-custom-scrollbar"
                                                     style="position: relative; width: 100%; height: 355px; overflow: auto;">
                                                    <table class="table table-bordered table-striped"
                                                           id="event_profile">
                                                        <thead>
                                                        <tr>
                                                            <th>선택</th>
                                                            <th>품목</th>
                                                            <th>ERP코드</th>
                                                            <th>수량</th>
                                                        </tr>

                                                        <tr>
                                                            <?php if (isset($validation)): ?>
                                                                <div class="alert alert-danger col-md-12" role="alert" id="validation">
                                                                    <?= $validation->listErrors() ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </tr>


                                                        </thead>
                                                        <tbody id="menuTable">

                                                        </tbody>


                                                    </table>

                                                </div>


                                            </div>

                                        </div>

                                        <hr class="input-group" style="float:right;">
                                        <div class="btn-con" style="width:100%; float:right; line-height:47px;">
                                            <div class="btn-wrap" style="float:right;">
                                                <button type="button" class="btn btn-secondary" style=""
                                                        onclick="location.href='http://godo.event.admin/'">취소
                                                </button>
                                                <button type="button" class="btn btn-secondary item_save" style=""
                                                        onclick="confirm_insertCheck(0);">저장
                                                </button>
                                                <button type="button" class="btn btn-secondary item_update"
                                                        style="display:none" onclick="confirm_updateCheck(1);">수정
                                                </button>
                                                <button type="button" class="btn btn-secondary item_delete"
                                                        style="display:none" onclick="confirm_deletePackCheck();">삭제
                                                </button>
                                            </div>

                                        </div>


                                    </div>
                                </form>

                                <form action="<?= base_url('/event_admin_new/delete') ?>" name="deletePack" id="deletePack"
                                      method="post">
                                    <input type="hidden" id="item_code" name="item_code" value="">
                                    <input type="hidden" id="event_code" name="event_delete" value="<?= $event_code ?>">
                                </form>

                            </div>


                        </div>
                    </div>
                </div>
            </section>


        </div>

        <?php if (isset($_SESSION)): ?>
            <?php session_destroy();?>
        <?php endif; ?>





