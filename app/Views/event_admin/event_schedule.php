<!DOCTYPE html>
<html>
<head>
    <title>이벤트 스케줄</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <link rel="stylesheet" href="/assets2/css/bootstrap.css">
    <link rel="stylesheet" href="/assets2/css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function(){
            alert('이벤트 색상 / 이벤트 명을 선택하시고 날짜를 클릭 하시면 등록됩니다.')
            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events:"<?= base_url('event_admin_new/schedule/load'); ?>",
                selectable:true,
                selectHelper:true,
                select:function(start, end, allDay, color)
                {

                        var title = $("select[name=event_name] option:selected").text();
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        var color = $("input[name='Primary']:checked").val();
                        if(title==="이벤트를 선택해 주세요"){
                            alert("이벤트명을 선택해주세요")
                            return false;
                        } else{
                            $.ajax({
                                url:"<?= base_url('event_admin_new/schedule/insert'); ?>",
                                type:"POST",
                                data:{title:title, start:start, end:end, color:color},

                                success:function()
                                {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("스케줄이 등록 되었습니다.");
                                    $("select[name=event_name] option:eq(0)").prop("selected", true);
                                    $("input[name='Primary']:eq(0)").prop("checked", true);

                                }
                            })
                        }


                },
                editable:true,
                eventResize:function(event)
                {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    var title = event.title;

                    var id = event.id;

                    $.ajax({
                        url:"<?= base_url('event_admin_new/schedule/update'); ?>",
                        type:"POST",
                        data:{title:title, start:start, end:end, id:id},
                        success:function()
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("이벤트 스케줄이 수정 되었습니다.");
                        }
                    })
                },
                eventDrop:function(event)
                {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    //alert(start);
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    //alert(end);
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"<?= base_url('event_admin_new/schedule/update'); ?>",
                        type:"POST",
                        data:{title:title, start:start, end:end, id:id},
                        success:function()
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("이벤트 스케줄이 수정 되었습니다.");
                        }
                    })
                },
                eventClick:function(event)
                {
                    if(confirm("이벤트 스케줄을 삭제 하시겠습니까?"))
                    {
                        var id = event.id;
                        $.ajax({
                            url:"<?=base_url('event_admin_new/schedule/delete');?>",
                            type:"POST",
                            data:{id:id},
                            success:function()
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert('이벤트 스케줄이 삭제 되었습니다.');
                            }
                        })
                    }
                }
            });
        });

    </script>
    <style>
        .fc-day-grid-event,.fc-h-event, .fc-event, .fc-start, .fc-end, .fc-draggable, .fc-resizable{
            color:white !important;
            font-weight: bold;
        }
    </style>
</head>
<body style="background:white !important; font-weight: bold;">

<div style="display: flex; margin-left: 5%; margin-top:2%; padding-bottom: 2%;">
    이벤트 색상 선택 :
    <div class="form-check form-check-primary" style="padding-left: 5%;">
        <input class="form-check-input" id="firstRadio" type="radio" name="Primary" id="event_color"  value="#435ebe" checked>
        <label class="form-check-label" for="Primary">

        </label>
    </div>
    <div class="form-check form-check-secondary" style="padding-left: 5%;">
        <input class="form-check-input" type="radio" name="Primary" id="event_color" value="#6c757d">
        <label class="form-check-label" for="Secondary">

        </label>
    </div>
    <div class="form-check form-check-warning" style="padding-left: 5%;">
        <input class="form-check-input" type="radio" name="Primary" id="event_color" value="#ffc107">
        <label class="form-check-label" for="warning">

        </label>
    </div>
    <div class="form-check form-check-danger" style="padding-left: 5%;">
        <input class="form-check-input" type="radio" name="Primary" id="event_color" value="#dc3545">
        <label class="form-check-label" for="danger">

        </label>
    </div>
    <div class="form-check form-check-success" style="padding-left: 5%;">
        <input class="form-check-input" type="radio" name="Primary" id="event_color" value="#198754">
        <label class="form-check-label" for="success">

        </label>
    </div>

    <select class="custom-select custom-select-sm" style="margin-left:9%;" name="event_name">
        <option selected>이벤트를 선택해 주세요</option>
        <?php foreach($eventList as $row):?>
        <option value="<?=$row['event_name']?>"><?=$row['event_name']?></option>
        <?php endforeach;?>
    </select>
</div>

<div class="container">
    <div id="calendar"></div>
</div>
</body>
</html>
<script src="/assets2/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets2/js/bootstrap.bundle.min.js"></script>
<script src="/assets2/js/mazer.js"></script>