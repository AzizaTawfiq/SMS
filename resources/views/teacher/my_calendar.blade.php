@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">My calendar</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
                <div id="calendar">

                </div>

              </div>
            </div>
        </div>
        </div>
      </main>
    </div>
      @endsection

@section('scripts')
<!-- <script src="{{url('public/dist/fullCalendar/index.global.js')}}"></script> -->
<script src="{{ asset('dist/fullCalendar/index.global.js') }}"></script>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var events = new Array();
     @foreach($getClassTimetable as $value)
          events.push( {
          title: '{{$value->class_name}} - {{$value->subject_name}}',
          daysOfWeek: [{{$value->fullcalendar_day}}],
          startTime: '{{$value->start_time}}',
          endTime: '{{$value->end_time}}',
        })
    @endforeach

        @foreach($getExamClassTimetable as $exam)
          events.push( {
          title: '{{$exam->class_name}} - {{$exam->exam_name}} - {{$exam->subject_name}} ({{ date('H:i A', strtotime($exam->start_time)) }} : {{ date('H:i A', strtotime($exam->end_time)) }})',
          start: '{{$exam->exam_date}}',
          end: '{{$exam->exam_date}}',
          color: 'purple',
          url: '{{url('teacher/my_exam_timetable')}}'
        })
        @endforeach

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialDate: '<?=date('Y-m-d')?>',
      navLinks: true,
      editable: true,
      events: events,
    });

    calendar.render();
  });
</script>
@endsection
