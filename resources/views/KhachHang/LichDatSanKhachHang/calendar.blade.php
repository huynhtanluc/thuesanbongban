@extends('KhachHang.Share.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    getData();

    function getData() {
        axios
            .get('/khach-hang/chu-san/data-calendar')
            .then((res) => {
                var data = res.data.data;
                loadCalendar(data);
            })
            .catch(function(error) {
                console.log(error);
            });
    }
    function loadCalendar(data)
    {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            navLinks: true,
            selectable: true,
            selectHelper: true,
            editable: true,
            eventLimit: true,
            events: data,
            eventClick: function(calEvent, jsEvent, view) {
                alert('Chi tiết đặt sân: ' + calEvent.title);
            },
            // dayClick: function(date, jsEvent, view) {
            //     alert('Đã chọn ngày: ' + date.format());
            // }
        });
    }

});
</script>

<style>
.fc-event {
    cursor: pointer;
    padding: 5px;
    margin: 3px 0;
    border-radius: 3px;
}
.fc-day-grid-event .fc-content {
    white-space: normal;
    overflow: hidden;
}
</style>
@endsection
