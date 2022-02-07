<?php if (defined('BASEPATH')) exit('No direct script access allowed');?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<script src="/assets/js/event_init.js"></script>

<section class="testimonial py-5 h-100" id="testimonial">
    <div class="container">

        <div class="col-md-12 py-3 border" style="background:white;">
            <h5 class=""><b>기획팩 프로필 생성 / 수정</b></h5>
            <hr>
            <form action="<?php echo base_url('init'); ?>" method="post" id="insertForm">
                <div class="form-row">
                    <div class="input-group col-md-6">
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
                    <div class="input-group col-md-6 py-3">
                        <select name="inputState" id="inputState" class="form-control" multiple size="20">
                            <?php foreach ($eventModel as $row) : ?>
                                <?php if ($row['menuName']) : ?>
                                    <option><?= $row['menuName'] . "/" . $row['erpCode'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>


                    </div>

                    <div class="input-group col-md-6" style="height: 486px;">



                        <div class="input-group" style="height: 40px;">
                            <span style="line-height: 38px;">세트이름 &nbsp;&nbsp;: &nbsp;  </span>&nbsp;
                            <input id="setName" name="setName" class="form-control" type="text"
                                   value="<?= set_value('setName') ?>">
                        </div>

                        <div class="input-group" style="height: 40px;">
                            <span style="line-height: 38px;">Item Code : &nbsp;  </span>&nbsp;
                            <input id="itemCode" name="itemCode" class="form-control"
                                   type="text" value="<?= set_value('itemCode') ?>">
                        </div>



                        <div class="input-group">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar"
                                 style="position: relative; width: 100%; height: 320px; overflow: auto;">
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
                                    <button type="button" class="btn btn-primary btn-sm" style="height:40px;"
                                            onclick="menuCheckDeleteRow();">선택삭제
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" style="height:40px;"
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
                            <button type="button" class="btn btn-secondary" style="" onclick="confirm_insertCheck();">등록</button>
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
