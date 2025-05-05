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
                    <div class="card mb-4">
                        <div class="card-header">
                        <h3 class="card-title">{{$value['name']}} </h3>
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
                      @foreach($value['exam'] as $exam)
                        <tr>
                            <td>{{ $exam['subject_name'] }}</td>
                            <td>{{ date('l', strtotime($exam['exam_date'])) }}</td>
                            <td>{{ $exam['exam_date'] }}</td>
                            <td>{{ date('H:i A', strtotime($exam['start_time'])) }}</td>
                            <td>{{ date('H:i A', strtotime($exam['end_time'])) }}</td>
                            <td>{{ $exam['room_number'] }}</td>
                            <td>{{ $exam['full_mark'] }}</td>
                            <td>{{ $exam['passing_mark'] }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                        </table>
                      </div>
                    </div>
                    @endforeach

              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection




