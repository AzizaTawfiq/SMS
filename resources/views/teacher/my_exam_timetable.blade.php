@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">My exam timetable </h3></div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                @foreach($getRecord as $value)
                <h2 >{{$value['class_name']}} </h2>
                @foreach($value['exam'] as $exam)
                    <div class="card mb-4">
                        <div class="card-header">
                        <h3 class="card-title">{{$exam['exam_name']}} </h3>
                        </div>
                      <div class="card-body p-0">
                        <table class="table table-striped">
                        <thead>
                        <tr>
                          <th>Subject name</th>
                          <th>Day</th>
                          <th>Date</th>
                          <th>Start time</th>
                          <th>End time</th>
                          <th>Room number</th>
                          <th>Full mark</th>
                          <th>Passing mark</th>
                        </tr>
                          </thead>
                          <tbody>
                      @foreach($exam['subject'] as $subject)
                        <tr>
                            <td>{{ $subject['subject_name'] }}</td>
                            <td>{{ date('l', strtotime($subject['exam_date'])) }}</td>
                            <td>{{ $subject['exam_date'] }}</td>
                            <td>{{ date('H:i A', strtotime($subject['start_time'])) }}</td>
                            <td>{{ date('H:i A', strtotime($subject['end_time'])) }}</td>
                            <td>{{ $subject['room_number'] }}</td>
                            <td>{{ $subject['full_mark'] }}</td>
                            <td>{{ $subject['passing_mark'] }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                        </table>
                      </div>
                    </div>
                    @endforeach
                    @endforeach

              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection




