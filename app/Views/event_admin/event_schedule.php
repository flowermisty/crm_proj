<!DOCTYPE html>
<html>
<head>
    <title>이벤트 스케줄</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function(){
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
                select:function(start, end, allDay)
                {
                    var title = prompt("이벤트명을 입력하세요");
                    if(title)
                    {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH");
                        $.ajax({
                            url:"<?= base_url('event_admin_new/schedule/insert'); ?>",
                            type:"POST",
                            data:{title:title, start:start, end:end},
                            success:function()
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("스케줄이 등록 되었습니다.");
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
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    //alert(start);
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
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
</head>
<body>
<br />
<br />
<div class="container">
    <div id="calendar"></div>
</div>
</body>
</html>