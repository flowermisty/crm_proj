<?php if (defined('BASEPATH')) exit('No direct script access allowed');?>

<script src="/assets/js/event_init.js"></script>
<div id="main" class="col-md-8" style="margin:auto;">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>이벤트 등록 현황</h3>
                    <p class="text-subtitle text-muted">배냇밀몰 상에 기 등록된 이벤트 리스트 현황 입니다.</p>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end"
                         style="line-height:81.59px;">
                        <button class="btn btn-primary" onclick="selectAll()" id="checkAll">전체선택</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">등록
                        </button>
                        <button class="btn btn-primary" type="button" onclick="confirm_delCheck();">삭제</button>

                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('delete'); ?>" method="post" id="deleteForm">

                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>선택</th>
                                <th>이벤트 명</th>
                                <th>이벤트 코드</th>
                                <th>최초 등록일</th>
                                <th>최종 수정일</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($eventList as $row) : ?>
                                <tr>
                                    <td>&nbsp;&nbsp;<input type="checkbox" name="event_code[]"
                                                           value="<?= $row['event_code'] ?>" id="select"></td>
                                    <td>
                                        <a href="<?= base_url("init/{$row['event_code']}") ?>"><?= $row['event_name'] ?></a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url("init/{$row['event_code']}") ?>"><?= $row['event_code'] ?></a>
                                    </td>
                                    <td>
                                        <h5><span class="badge bg-success "
                                              style="width=100%;"><?= $row['regist_date'] ?></span></h5>
                                    </td>
                                    <td>
                                        <h5><span class="badge bg-danger "
                                              style="width=100%;"><?= $row['updated_at'] ?></span></h5>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <?php if (isset($validation)): ?>
                <div class="alert alert-danger col-md-12" role="alert">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
        </section>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">이벤트 등록</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('eventRegist') ?>" id="eventRegist" method="post" name="eventRegist" >
                        <div class="form-group">
                            <label for="event_name">이벤트명</label>
                            <input type="text" class="form-control" name="event_name" id="event_name" value=""  minlength="5" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="event_code">이벤트코드</label>
                            <input type="text" class="form-control" name="event_code" id="event_code" value="" minlength="5" maxlength="20">
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-primary" onclick="confirm_event_check();">등록</button>
                </div>
                </form>
            </div>
        </div>

    </div>


<?php
