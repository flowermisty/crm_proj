<section class="testimonial py-4 h-100" id="testimonial">
    <div class="col-md-8 py-2" style="margin:auto;">

            <h4 class="" style="margin-left:3%;">
                <b style="font-style:oblique; color:#435ebe" ><?= $event_name[0]['event_name'] ?>_상세 프로필</b></h4>


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
                                <th>단계</th>
                                <th>Item Code</th>


                            </tr>
                            </thead>
                            <tbody align="center">
                            <?php foreach ($eventList as $row) : ?>
                                <tr>
                                    <td>
                                        <a href="javascript:void(0);" onclick="get_event_profile('<?= $row['optionCode']?>')"
                                            <?php if($row['optionCode']==session()->get('item_code')):?>
                                                <?php echo "style='text-decoration:none; color:green;'" ?><?php endif;?>><?= $row['step'] ?></a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="get_event_profile('<?= $row['optionCode']?>')"
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
                            <button type="button" class="btn btn-secondary" style="" onclick="window.location.reload()">세트등록</button>

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
            <form id="submit_form">
                <div class="col-md-12 py-3 border" style="background:white; height:600px;">

                    <div class="input-group col-md-12">

                        <div class="input-group py-1" style="height: 40px; text-indent:5px;">
                            <span style="line-height: 38px;">단 계 입 력 : &nbsp; </span>
                            <input id="step" name="step" class="form-control"
                                   type="text" value="<?= set_value('step') ?>" style="margin-left: 4.5px;">
                        </div>

                        <div class="input-group py-1" style="height: 40px;">
                            <span style="line-height: 38px;">아이템 코드 : &nbsp;  </span>&nbsp;
                            <input id="itemCode" name="itemCode" class="form-control"
                                   type="text" value="<?= set_value('itemCode') ?>">
                        </div>

                        <div class="input-group py-1" style="height: 40px;">
                            <span style="line-height: 38px;">이벤트 코드 : &nbsp;  </span>&nbsp;
                            <input id="event_code" name="event_code" class="form-control"
                                   type="text" value="<?= $event_code ?>" readonly>
                        </div>


                        <div class="input-group py-2">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar"
                                 style="position: relative; width: 100%; height: 310px; overflow: auto;">
                                <table class="table table-bordered table-striped" id="event_profile">
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
                            <button type="button" class="btn btn-secondary" style="" onclick="location.href='http://godo.event.admin/'">취소</button>
                            <button type="button" class="btn btn-secondary item_save" style="" onclick="confirm_insertCheck(0);">저장</button>
                            <button type="button" class="btn btn-secondary item_update" style="display:none" onclick="confirm_updateCheck(1);">수정</button>
                            <button type="button" class="btn btn-secondary item_delete" style="display:none" onclick="confirm_deletePackCheck();">삭제</button>
                        </div>

                    </div>


                </div>
            </form>

            <form action="<?=base_url('delete')?>" name="deletePack" id="deletePack" method="post">
                <input type="hidden" id="item_code" name="item_code" value="">
                <input type="hidden" id="event_code" name="event_delete" value="<?= $event_code ?>">
            </form>

        </div>


    </div>


</section>


<?php echo session_destroy();?>
