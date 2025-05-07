@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Exams Schedule </h3></div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
              <div class="card card-primary card-outline mb-4">
              <div class="card-header">
                    <h3 class="card-title">Search</h3>
                  </div>
                  <form action="" method="get">

                    <div class="card-body row">
                      <div class="form-group col-md-3">
                        <label for="exam_id" class="form-label text-bold">Exam</label>
                        <select class="form-control" name="exam_id">
                          <option value="">Select exam</option>
                          @foreach ($getExam as $exam)
                            <option
                            {{( Request::get('exam_id') == $exam->id ? 'selected' : '')}}
                             value="{{ $exam->id }}">{{ $exam->name }}</option>
                          @endforeach
                        </select>

                      </div>

                      <div class="form-group col-md-3">
                        <label for="class_id" class="form-label text-bold">Class</label>
                        <select class="form-control" name="class_id">
                          <option value="">Select class</option>
                          @foreach ($getClass as $class)
                            <option
                            {{( Request::get('class_id') == $class->id ? 'selected' : '')}}
                             value="{{ $class->id }}">{{ $class->name }}
                            </option>
                          @endforeach
                        </select>

                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/examinations/exam_schedule') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')
              @if(!empty($getRecord))
              <form action="{{ url('admin/examinations/exam_schedule_insert')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id')}}">
                <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}">
                <div class="card mb-4">
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Date</th>
                          <th>Start time</th>
                          <th>End time</th>
                          <th>Room number</th>
                          <th>Full marks</th>
                          <th>Passing marks</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php
                        $i = 1;
                      @endphp
                      @foreach($getRecord as $value)
                        <tr>
                                <td>
                                    {{ $value['subject_name'] }}
                                    <input name="schedule[{{$i}}][subject_id]" class="form-control" type="hidden" value="{{ $value['subject_id'] ?? '' }}" />
                                </td>
                                <td>
                                    <input name="schedule[{{$i}}][exam_date]" class="form-control" type="date" value="{{ $value['exam_date'] ?? '' }}" />
                                    </td>
                                <td>
                                    <input name="schedule[{{$i}}][start_time]" class="form-control" type="time" value="{{ $value['start_time'] ?? '' }}" />
                                </td>
                                <td>
                                    <input name="schedule[{{$i}}][end_time]" class="form-control" type="time" value="{{ $value['end_time'] ?? '' }}" />
                                </td>
                                <td>
                                    <input name="schedule[{{$i}}][room_number]" class="form-control" type="text" value="{{ $value['room_number'] ?? '' }}" style="width:150px" placeholder="enter room number" />
                                </td>
                                <td>
                                    <input name="schedule[{{$i}}][full_mark]" class="form-control" type="text" value="{{ $value['full_mark'] ?? '' }}" style="width:150px" placeholder="Enter full marks"/>
                                </td>
                                <td>
                                    <input name="schedule[{{$i}}][passing_mark]" class="form-control" type="text" value="{{ $value['passing_mark'] ?? '' }}" style="width:150px" placeholder="Enter passing marks" />
                                </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                      </tbody>
                    </table>
                    <div class="p-3">
                            <button class="btn btn-primary">Add</button>
                        </div>

                  </div>
                </div>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
