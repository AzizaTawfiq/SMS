@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Marks register</h3></div>
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
                       <a href="{{ url('admin/examinations/mark_register') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>

              @if(!empty($getSubject) && !empty($getSubject->count()) )

                <div class="card mb-4">
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Student name</th>
                          @foreach($getSubject as $subject)
                          <th>
                            {{$subject->subject_name}}<sup><span class="badge {{($subject->subject_type == 0) ? 'bg-primary' : 'bg-warning'}}">{{($subject->subject_type == 0) ? 'Theory' : 'Practical'}}</span></sup>
                            <br>
                             {{$subject->passing_mark}} / {{$subject->full_mark}}
                          </th>

                          @endforeach
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(!empty($getStudent) &&!empty($getStudent->count()))
                        @foreach($getStudent as $student)
                        <form name="post" class="submitForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="student_id" value="{{ $student->id}}">
                        <input type="hidden" name="exam_id" value="{{ Request::get('exam_id')}}">
                        <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}">
                        <tr>
                          <td>{{$student->name}} {{$student->last_name}}</td>
                            @php
                            $i = 1;
                            @endphp
                      @foreach($getSubject as $subject)
                            @php
                            $getMark = $subject->getMark(Request::get('exam_id'),Request::get('class_id'),$student->id, $subject->subject_id);
                            @endphp
                          <td>
                            <div class="mb-2">
                                Classwork
                                <input type="hidden" name="mark[{{$i}}][subject_id]" value="{{ $subject->subject_id}}">
                                <input style="width:200px"  name="mark[{{$i}}][class_work]" class="form-control" type="text" value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}" placeholder="Enter mark" />
                            </div>

                            <div class="mb-2">
                                Homework
                                <input style="width:200px" name="mark[{{$i}}][home_work]" class="form-control" type="text" value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}" placeholder="Enter mark" />
                            </div>
                            <div class="mb-2">
                                Test
                                <input style="width:200px" name="mark[{{$i}}][test_work]" class="form-control" type="text" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" placeholder="Enter mark" />
                            </div>
                            <div class="mb-2">
                                Exam
                                <input style="width:200px" name="mark[{{$i}}][exam]" class="form-control" type="text" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" placeholder="Enter mark" />
                            </div>
                         </td>
                         @php
                            $i++;
                        @endphp
                          @endforeach
                          <td class="align-middle"><button type="submit" class="btn btn-primary">Save</button></td>                            </tr>
                        </tr>
                        </form>

                        @endforeach
                        @endif
                        </tbody>
                    </table>
                  </div>
                </div>
                @else
                <x-empty-state message="No marks Registered yet." />
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
            $('.submitForm').submit(function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: "{{url('admin/examinations/submit_mark_register')}}",
                    data: $(this).serialize(),
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
