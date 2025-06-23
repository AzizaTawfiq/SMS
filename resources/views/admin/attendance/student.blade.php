@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Student attendance</h3></div>
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
                        <label for="class_id" class="form-label fw-bold">Class</label>
                        <select class="form-control" name="class_id" id="getClass">
                          <option value="">Select class</option>
                          @foreach ($getClass as $class)
                            <option
                            {{( Request::get('class_id') == $class->id ? 'selected' : '')}}
                             value="{{ $class->id }}">{{ $class->name }}
                            </option>
                          @endforeach
                        </select>

                      </div>
                      <div class="form-group col-md-3">
                        <label for="getAttendanceDate" class="form-label fw-bold">Attendance date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="getAttendanceDate"
                          placeholder="Search for attendance"
                          name="attendance_date"
                          value="{{ Request::get('attendance_date') }}"
                        />
                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/attendance/student') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
                @include('_message')
              @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')) && !empty($getStudent->count()))

                <div class="card mb-4">
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Student ID</th>
                          <th>Student name</th>
                          <th>Attendance</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(!empty($getStudent) &&!empty($getStudent->count()))
                        @foreach($getStudent as $student)
                        @php
                        $attendance_type = '';
                        $getAttendance = $student->getAttendance($student->id, Request::get('class_id'),Request::get('attendance_date'));
                        if(!empty($getAttendance)) {
                            $attendance_type = $getAttendance->attendance_type;
                        }
                        @endphp

                        <tr>
                          <td>{{$student->id}}</td>
                          <td>{{$student->name}} {{$student->last_name}}</td>
                          <td>
                            <div class="form-check form-check-inline">
                                <input {{ $attendance_type == '1' ? 'checked' : '' }} class="form-check-input saveAttendance" type="radio" name="attendance{{$student->id}}" id="{{$student->id}}" value="1">
                                <label class="form-check-label" for="{{$student->id}}">Present</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ $attendance_type == '2' ? 'checked' : '' }} class="form-check-input saveAttendance" type="radio" name="attendance{{$student->id}}" id="{{$student->id}}" value="2">
                                <label class="form-check-label" for="{{$student->id}}">Late</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ $attendance_type == '3' ? 'checked' : '' }} class="form-check-input saveAttendance" type="radio" name="attendance{{$student->id}}" id="{{$student->id}}" value="3">
                                <label class="form-check-label" for="{{$student->id}}">Absent</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input {{ $attendance_type == '4' ? 'checked' : '' }} class="form-check-input saveAttendance" type="radio" name="attendance{{$student->id}}" id="{{$student->id}}" value="4">
                                <label class="form-check-label" for="{{$student->id}}">Half day</label>
                            </div>
                          </td>
                            <td>
                         </td>
                        </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                  </div>
                </div>
                @else
                <x-empty-state message="No students Registered yet." />
                @endif

              </div>
            </div>
          </div>
        </div>
      </main>

 @endsection

 @section("scripts")
      <script type="text/javascript">
        $(document).ready(function(){
            $('.saveAttendance').change(function(e){
               var student_id = $(this).attr('id');
               var attendance_type = $(this).val();
               var class_id = $('#getClass').val();
               var attendance_date = $('#getAttendanceDate').val();


               $.ajax({
                    type: 'POST',
                    url: "{{url('admin/attendance/student/save')}}",
                    data: {
                        '_token': '{{csrf_token()}}',
                        student_id: student_id,
                        attendance_type: attendance_type,
                        class_id: class_id,
                        attendance_date: attendance_date,
                    },
                    dataType: 'json',
                    success: function(response){
                        if(response.message) {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error){
                        alert('Error saving marks: ' + error);
                    }
                });
            });
        });
      </script>
      @endsection


