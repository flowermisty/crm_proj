<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="/assets/js/event_init.js"></script>

<style>

    body {
        height: 100vh;
        width: 100vw;
        overflow: hidden;
    }

    .tableAcor {
        display: flex;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;

    }

    .table__cell {
        position: relative;
        display: flex;
        width: 20%;

        transition: width 500ms cubic-bezier(0.2, 0, 0.2, 1);
    }

    .table__cell > * {
        opacity: 0.4;
    }

    .table__cell:nth-child(1) {
        background-color: #393a3a;
    }

    .table__cell:nth-child(2) {
        background-color: #393a3a;
    }

    .table__cell:nth-child(3) {
        background-color: #393a3a;
    }

    #menuTable > tr > td > button{
        visibility: hidden;
    }

    .table__cell:nth-child(4) {
        background-color: #EED974;
    }

    .table__cell:nth-child(5) {
        background-color: #005397;
    }

    .table__cell:nth-child(1):hover {
        width: 30%;
    }

    .table__cell:nth-child(1):hover > * {
        opacity: 1;
    }

    .table__cell:nth-child(2):hover {
        width: 30%;
    }

    .table__cell:nth-child(2):hover > * {
        opacity: 1;
    }

    .table__cell:nth-child(3):hover {
        width: 30%;
    }

    .table__cell:nth-child(3):hover > * {
        opacity: 1;
    }

    .table__cell:nth-child(3):hover #menuTable > tr > td > button{
        visibility: visible;
        opacity: 1;
    }

    .table__cell span {
        opacity: 1;
        transition: opacity 300ms cubic-bezier(0.7, 0, 0.7, 1);
        transition-delay: 0ms;
    }

    .table__cell:hover span {
        opacity: 1;
        transition-delay: 300ms;
    }

    .container {

    }
</style>

<section class="testimonial py-4 h-100" id="testimonial">
    <div class="col-md-8 py-2" style="margin:auto;">
        <h4 class="" style="margin-left:3%;"><b>이벤트 상세 프로필</b></h4>
        <hr>
    </div>
    <div class="tableAcor">
        <div class="table__cell">
            <div class="col-md-12 py-3 border" style="background:white; height:600px;">
                <div class="input-group py-2">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar"
                         style="position: relative; width: 100%; height:500px; overflow: auto;">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>선택</th>
                                <th>이벤트 명</th>
                                <th>상품코드</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($eventList as $row) : ?>
                                <tr>
                                    <td>&nbsp;&nbsp;<input type="checkbox" name="item_code[]" value="<?=$row['item_code']?>" id="select"></td>
                                    <td>
                                        <a href="<?= base_url("update/{$row['item_code']}") ?>"><?= $row['event_name'] ?></a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url("update/{$row['item_code']}") ?>"><?= $row['item_code'] ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="table__cell">
            <div class="col-md-12 py-3 border" style="background:white; height:600px;">

                <form action="<?php echo base_url('init'); ?>" method="post" id="insertForm">
                    <div class="form-row">
                        <div class="input-group col-md-12">
                            <input type="search" class="form-control rounded " placeholder="메뉴명, ERP코드 검색"
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
                            <select name="inputState" id="inputState" class="form-control" multiple size="20">
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


        <div class="table__cell">

            <div class="col-md-12 py-3 border" style="background:white; height:600px;">

                <div class="input-group col-md-12">

                    <div class="input-group" style="height: 40px;">
                        <span style="line-height: 38px;">세 트 이 름 &nbsp;: &nbsp;  </span>&nbsp;
                        <input id="setName" name="setName" class="form-control" type="text"
                               value="<?= set_value('setName') ?>">
                    </div>

                    <div class="input-group py-1" style="height: 40px;">
                        <span style="line-height: 38px;">아이템 코드 : &nbsp;  </span>&nbsp;
                        <input id="itemCode" name="itemCode" class="form-control"
                               type="text" value="<?= set_value('itemCode') ?>">
                    </div>
                    <div class="input-group py-1" style="height: 40px;">
                        <span style="line-height: 38px;">이벤트 코드 : &nbsp;  </span>&nbsp;
                        <input id="itemCode" name="itemCode" class="form-control"
                               type="text" value="<?= set_value('itemCode') ?>">
                    </div>


                    <div class="input-group py-2">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar"
                             style="position: relative; width: 100%; height: 310px; overflow: auto;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>품목</th>
                                    <th>ERP코드</th>
                                    <th>수량</th>
                                </tr>
                                </thead>
                                <tbody id="menuTable">


                                </tbody>
                            </table>

                        </div>

                        <div class="btn-con" style="width:100%; float:right; line-height:47px;">
                            <div class="btn-wrap" style="float:right;">
                                <button type="button" class="btn btn-primary btn-sm"
                                        style="height:40px;"
                                        onclick="menuCheckDeleteRow();">선택삭제
                                </button>
                                <button type="button" class="btn btn-primary btn-sm"
                                        style="height:40px;"
                                        onclick="menuAllDeleteRow();">전체삭제
                                </button>

                            </div>

                        </div>

                    </div>

                </div>
                <hr class="input-group" style="float:right;">
                <div class="btn-con" style="width:100%; float:right; line-height:47px;">
                    <div class="btn-wrap" style="float:right;">
                        <button type="button" class="btn btn-secondary" style="">취소</button>
                        <button type="button" class="btn btn-secondary" style=""
                                onclick="confirm_insertCheck();">등록
                        </button>
                    </div>

                </div>


                </form>
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger col-md-12" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>


    </div>


</section>


<?php
