<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Uploader - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">

    <link rel="stylesheet" href="/assets/vendors/toastify/toastify.css">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="/assets2/js/refundCalc.js"></script>
</head>

<style>
    body::-webkit-scrollbar {
        display: none;
    }

    /* Track */
    body::-webkit-scrollbar-track {
        border-radius: 5px;
    }

    /* Handle */
    body::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 5px;
    }

    body{
        font-family: "Noto Sans KR";
    }

</style>

<body>


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
                                <a href="<?=base_url('convert/godo')?>">고도몰 변환</a>
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
                                <a href="<?=base_url('/genuine_out?page=1')?>">TM 정품 출고</a>
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

<?php
