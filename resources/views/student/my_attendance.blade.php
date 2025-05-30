@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">My Attendance</h3></div>
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
                    <div class="row card-body">
                      <div class="col-md-3 form-group">
                        <label for="class_id" class="form-label fw-bold">Class</label>
                        <select class="form-control" name="class_id" id="class_id">
                          <option value="">Select class</option>
                          @foreach ($getClass as $class)
                            <option
                            {{( Request::get('class_id') == $class->class_id ? 'selected' : '')}}
                             value="{{ $class->class_id }}">{{ $class->class_name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-2 form-group">
                        <label for="attendance_type" class="form-label fw-bold">Attendance type</label>
                        <select name="attendance_type" class="form-control">
                            <option value="">Select type</option>
                            <option @if(Request::get('attendance_type') == 1) selected @endif value="1">Present</option>
                            <option @if(Request::get('attendance_type') == 2) selected @endif value="2">Late</option>
                            <option @if(Request::get('attendance_type') == 3) selected @endif value="3">Absent</option>
                            <option @if(Request::get('attendance_type') == 1) selected @endif value="4">Half day</option>

                        </select>
                      </div>
                      <div class="col-md-2 form-group">
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
                      <div class="col-md-3 form-group" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('student/my_attendance') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
                </div>
                <div class="card mb-4">
                  <div class="card-body p-0">
                  @if($getRecord->count() > 0)
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Class</th>
                          <th>Attendance</th>
                          <th>Attendance date</th>
                          <th>Created date</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($getRecord as $value)
                        <tr>
                            <td>{{ $value->class_name }}</td>
                            <td>
                                @if ($value->attendance_type == 1)
                                    <span class="badge bg-primary">Present</span>
                                @elseif ($value->attendance_type == 2)
                                    <span class="badge bg-warning">Late</span>
                                @elseif ($value->attendance_type == 3)
                                    <span class="badge bg-danger">Absent</span>
                                @elseif ($value->attendance_type == 4)
                                    <span class="badge bg-info">Half day</span>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->attendance_date)) }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    @else
                        <x-empty-state message="No students found in the system." />
                    @endif
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </main>

 @endsection




