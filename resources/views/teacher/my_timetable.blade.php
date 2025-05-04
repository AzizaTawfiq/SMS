@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">My timetable </h3></div>
                <div class="col-sm-6 text-end">
                    <a href="{{ url('teacher/my_class_subject') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                    <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{$getClass->name}}({{$getSubject->name}}) </h3>
                    </div>
                      <div class="card-body p-0">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Week</th>
                              <th>Start time</th>
                              <th>End time</th>
                              <th>Room number</th>
                            </tr>
                          </thead>
                          <tbody>
                          @php $hasData = false; @endphp
                          @foreach($getRecord as $week)
                              @if(!empty($week['start_time']) || !empty($week['end_time']) || !empty($week['room_number']))
                                @php $hasData = true; @endphp
                                <tr>
                                  <th>{{$week['week_name']}}</th>
                                  <td>{{$week['start_time']}}</td>
                                  <td>{{$week['end_time']}}</td>
                                  <td>{{$week['room_number']}}</td>
                                </tr>
                              @endif
                          @endforeach
                          @if(!$hasData)
                            <tr>
                              <td colspan="4" class="text-center">No timetable data available</td>
                            </tr>
                          @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection





