<?php if (defined('BASEPATH')) exit('No direct script access allowed');?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="/assets/css/sweep.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/assets/js/event_init.js"></script>

<section class="testimonial py-4 h-100" id="testimonial">
    <div class="col-md-8 py-2" style="margin:auto;">
        <h4 class="" style="margin-left:3%;"><b style="font-style:oblique; color:#435ebe" ><?=$event_name[0]['event_name']?>_상세 프로필 수정 / 삭제</b></h4>
        <hr>
    </div>
    <div class="tableAcor">
        <div class="table__cell">
            <div class="col-md-12 py-3 border" style="background:white; height:600px;">
                <div class="input-group py-2">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar"
                         style="position: relative; width: 100%; height:485px; overflow: auto;">
                        <table class="table table-bordered table-striped">
                            <thead align="center">
                            <tr>
                                <th>단계 / 패키지 구분 </th>
                                <th>ITEM CODE</th>
                            </tr>
                            </thead>
                            <tbody align="center">
                                <?php foreach ($setList as $row) : ?>

                                    <tr>

                                        <td>
                                            <a href="<?= base_url("update/{$row['optionCode']}/$event_code") ?>"
                                                <?php if($row['optionCode']==session()->get('item_code')):?>
                                                    <?php echo "style='text-decoration:none; color:green;'" ?><?php endif;?>><?= $row['step'] ?></a>
                                        </td>
                                        <td>
                                            <a href="<?= base_url("update/{$row['optionCode']}/$event_code") ?>"
                                                <?php if($row['optionCode']==session()->get('item_code')):?>
                                                    <?php echo "style='text-decoration:none; color:green;'" ?><?php endif;?>><?= $row['optionCode'] ?></a>
                                        </td>


                                    </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>


                    </div>
                    <hr class="input-group" style="float:right;">
                    <div class="btn-con" style="width:100%; float:right; line-height:47px;">
                        <div class="btn-wrap" style="float:right;">
                            <button type="button" class="btn btn-secondary" style="" onclick="location.href='http://godo.event.admin/init/<?= $eventList['event_code']?>'">등록</button>

                        </div>

                    </div>

                </div>

            </div>
        </div>
        <div class="table__cell">
            <div class="col-md-12 py-3 border" style="background:white; height:600px;">


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
            <form action="<?php echo base_url("update/{$item_code}/{$event_code}"); ?>" method="post" id="updateForm">
            <div class="col-md-12 py-3 border" style="background:white; height:600px;">

                <div class="input-group col-md-12">

                    <div class="input-group" style="height: 40px; text-indent:0.2rem;">
                        <span style="line-height: 38px;">단 계 입 력 : &nbsp; </span>&nbsp;
                        <input id="step" name="step" class="form-control" type="text"
                               value="<?=$step[0]['step']?>">
                    </div>

                    <div class="input-group py-1" style="height: 40px;">
                        <span style="line-height: 38px;">아이템 코드 : &nbsp;  </span>&nbsp;
                        <input id="itemCode" name="itemCode" class="form-control"
                               type="text" value="<?= $item_code ?>" readonly>
                    </div>
                    <div class="input-group py-1" style="height: 40px;">
                        <span style="line-height: 38px;">이벤트 코드 : &nbsp;  </span>&nbsp;
                        <input id="event_code" name="event_code" class="form-control"
                               type="text" value="<?= $eventList['event_code']?>" readonly>
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
                                <tr>
                                    <?php if (isset($validation)): ?>
                                        <div class="alert alert-danger col-md-12" role="alert">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody id="menuTable">
                                <?php $index=1; ?>
                                <?php foreach ($joinData as $row) : ?>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><input type="hidden" name="menuName[]" value="<?=$row['menuName']?>"><?=$row['menuName']?></td>
                                        <td><input type="hidden" name="erpCode[]" value="<?=$row['erpCode']?>"><?=$row['erpCode']?></td>
                                        <td id="quantity<?=$index?>">
                                            <span><?=$row['ea']?></span>
                                            <button type="button" class="btn-primary btn btn-sm" id="minus<?=$index?>" style="width: 27px; float: right;">-</button>
                                            <button type="button" class="btn-primary btn btn-sm" id="plus<?=$index?>" style="float: right; margin-right: 5px;">+</button>
                                            <input type="hidden" name="ea[]" value="">
                                        </td>

                                    </tr>
                                    <?php $index++;?>
                                <?php endforeach;?>

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
                        <button type="button" class="btn btn-secondary" style="" onclick="confirm_updateCheck()">수정</button>
                        <button type="button" class="btn btn-secondary" style="" onclick="confirm_deletePackCheck()">삭제</button>
                    </div>

                </div>


                </form>

                <form action="<?=base_url('delete')?>" name="deletePack" id="deletePack" method="post">
                    <input type="hidden" name="item_code" value="<?= $item_code ?>">
                    <input type="hidden" name="event_delete" value="<?= $eventList['event_code']?>">
                </form>


            </div>
        </div>


    </div>


</section>


<?php
