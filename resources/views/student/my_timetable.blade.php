@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">My timetable </h3></div>
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
                              <th>Week</th>
                              <th>Start time</th>
                              <th>End time</th>
                              <th>Room number</th>
                            </tr>
                          </thead>
                          <tbody>
                          @php $hasData = false; @endphp
                          @foreach($value['week'] as $week)
                              @if(!empty($week['start_time']) || !empty($week['end_time']) || !empty($week['room_number']))
                                @php $hasData = true; @endphp
                          <tr>
                            <th>{{$week['week_name']}}</th>
                            <td>{{$week['start_time']}}</td>
                            <td>{{$week['end_time']}}</td>
                            <td>{{$week['room_number']}}</td>
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
                    @endforeach

              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection





