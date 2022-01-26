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
                        <button class="btn btn-primary" onclick="location.href='<?=base_url('init');?>'">등록</button>
                        <button class="btn btn-primary" type="button" onclick="confirm_delCheck();">삭제</button>

                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form action="<?=base_url('delete');?>" method="post" id="deleteForm">

                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th>선택</th>
                                <th>이벤트 명</th>
                                <th>상품코드</th>
                                <th>최초 등록일</th>
                                <th>최종 수정일</th>

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
                                    <td>
                                        <span class="badge bg-success" style="width=100%;"><?= $row['regist_date'] ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger" style="width=100%;"><?= $row['updated_at'] ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

        </section>
    </div>
<?php
