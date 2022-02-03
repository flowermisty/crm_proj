<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>배냇밀몰 기획팩 등록 관리자 인터페이스</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">

    <link rel="stylesheet" href="/assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<style>
    ul,ol,li{
        list-style: none !important;
        text-decoration: none !important;
    }
    a{
        text-decoration: none !important;
    }

    body{
        font-family: 'Noto Sans KR', sans-serif;
    }

    .main-navbar ul .menu-item{
        padding-left: 40px;
    }

    .main-navbar ul .menu-item:first-child{
        padding-left: 0px;
    }

    .dataTable-selector, .form-select{
        width:80px;
    }
    .dataTable-dropdown{
        display: inline-flex;
        width:100%;
    }
    .dataTable-search{
        width: 100%;
        margin-left:1%;

    }
    .dataTable-container{
        margin-top:1%;

    }

    #menuTable tr td{
        font-size:14px;
    }

    body{
        background:#ccc !important;
    }

    .errors li{
        list-style: none;
        width:100%;
        text-align:center;
    }
    .errors ul{
        padding-left: 0;
        margin-bottom: 0;
    }

</style>


<body>

<div id="app">
    <div id="main" class="layout-horizontal">
        <header class="mb-2">
            <div class="header-top">
                <div class="container">
                    <div class="logo">
                        <a href="<?=base_url('/')?>"><img src="/assets/images/logo/logo_big.png" alt="Logo" srcset=""></a>
                    </div>
                    <div class="header-top-right">

                        <div class="dropdown">
                            <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <div class="avatar avatar-md2">
                                    <img src="/assets/images/faces/1.jpg" alt="Avatar">
                                </div>
                                <div class="text">
                                    <h6 class="user-dropdown-name">이용석</h6>
                                    <p class="user-dropdown-status text-sm text-muted">admin</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">My Account</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="auth-login.html">Logout</a></li>
                            </ul>
                        </div>

                        <!-- Burger button responsive -->
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                    </div>
                </div>
            </div>
            <nav class="main-navbar">
                <div class="container">
                    <ul>


                        <li class="menu-item  ">
                            <a href="https://i.venet.kr/nmember_list.php" class='menu-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>CRM HOME</span>
                            </a>
                        </li>


                        <li class="menu-item">
                            <a href="<?=base_url('event_admin')?>" class='menu-link'>
                                <i class="bi bi-stack"></i>
                                <span>이벤트 리스트</span>
                            </a>
                        </li>


                        <li class="menu-item active">
                            <a href="<?=base_url('init')?>" class='menu-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>기획팩 등록</span>
                            </a>
                        </li>


                        <li class="menu-item  has-sub">
                            <a href="#" class='menu-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>주문서 변환</span>
                            </a>
                            <div class="submenu ">
                                <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                <div class="submenu-group-wrapper">


                                    <ul class="submenu-group">

                                        <li class="submenu-item">
                                            <a href="#" class='submenu-link'>바이모션</a>
                                        </li>

                                        <li class="submenu-item">
                                            <a href="form-layout.html" class='submenu-link'>고도몰</a>

                                        </li>

                                        <li class="submenu-item">
                                            <a href="#" class='submenu-link'>쿠팡</a>
                                        </li>

                                        <li class="submenu-item">
                                            <a href="#" class='submenu-link'>마트</a>
                                        </li>

                                        <li class="submenu-item">
                                            <a href="#" class='submenu-link'>세이베베</a>
                                        </li>

                                        <li class="submenu-item">
                                            <a href="#" class='submenu-link'>레몬트리</a>
                                        </li>

                                        <li class="submenu-item">
                                            <a href="#" class='submenu-link'>식품이력</a>
                                        </li>

                                        <li class="submenu-item">
                                            <a href="#" class='submenu-link'>ERP 변경</a>
                                        </li>

                                        <li class="submenu-item">
                                            <a href="#" class='submenu-link'>자가사용 변경</a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

        </header>

