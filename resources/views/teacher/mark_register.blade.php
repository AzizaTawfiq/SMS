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
                        <label for="exam_id" class="form-label fw-bold">Exam</label>
                        <select class="form-control" name="exam_id">
                          <option value="">Select exam</option>
                          @foreach ($getExam as $exam)
                            <option
                            {{( Request::get('exam_id') == $exam->exam_id ? 'selected' : '')}}
                             value="{{ $exam->exam_id }}">{{ $exam->exam_name }}</option>
                          @endforeach
                        </select>

                      </div>

                      <div class="form-group col-md-3">
                        <label for="class_id" class="form-label fw-bold">Class</label>
                        <select class="form-control" name="class_id">
                          <option value="">Select class</option>
                          @foreach ($getClass as $class)
                            <option
                            {{( Request::get('class_id') == $class->class_id ? 'selected' : '')}}
                             value="{{ $class->class_id }}">{{ $class->class_name }}
                            </option>
                          @endforeach
                        </select>

                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('teacher/mark_register') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
                @include('_message')

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
                            $totalStudentMark = 0;
                            $totalFullMark = 0;
                            $totalPassingMark = 0;
                            @endphp
                      @foreach($getSubject as $subject)
                            @php
                            $totalMark = 0;
                            $getMark = $subject->getMark(Request::get('exam_id'),Request::get('class_id'),$student->id, $subject->subject_id);
                            if(!empty($getMark)){
                             $totalMark = $getMark->class_work + $getMark->home_work + $getMark->test_work + $getMark->exam;
                            $totalStudentMark += $totalMark;
                            $totalFullMark += $subject->full_mark;
                            $totalPassingMark += $subject->passing_mark;
                            }

                            @endphp
                          <td>
                            <div class="mb-2">
                                Classwork
                                 <input type="hidden" name="mark[{{$i}}][full_mark]" value="{{ $subject->full_mark}}">
                                <input type="hidden" name="mark[{{$i}}][passing_mark]" value="{{ $subject->passing_mark}}">
                                <input type="hidden" name="mark[{{$i}}][subject_id]" value="{{ $subject->subject_id}}">
                                <input type="hidden" name="mark[{{$i}}][id]" value="{{ $subject->id}}">
                                <input style="width:200px" id="class_work_{{ $student->id}}{{ $subject->subject_id}}"  name="mark[{{$i}}][class_work]" class="form-control" type="text" value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}" placeholder="Enter mark" />
                            </div>

                            <div class="mb-2">
                                Homework
                                <input style="width:200px" id="home_work_{{ $student->id}}{{ $subject->subject_id}}" name="mark[{{$i}}][home_work]" class="form-control" type="text" value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}" placeholder="Enter mark" />
                            </div>
                            <div class="mb-2">
                                Test
                                <input style="width:200px" id="test_work_{{ $student->id}}{{ $subject->subject_id}}" name="mark[{{$i}}][test_work]" class="form-control" type="text" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" placeholder="Enter mark" />
                            </div>
                            <div class="mb-2">
                                Exam
                                <input style="width:200px" id="exam{{ $student->id}}{{ $subject->subject_id}}" name="mark[{{$i}}][exam]" class="form-control" type="text" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" placeholder="Enter mark" />
                            </div>
                            <div class="mb-2">
                            <button style="width:200px" type="button" class="btn btn-primary singleSubject"
                            id='{{$student->id}}'
                            data-val='{{$subject->subject_id}}'
                            data-exam="{{ Request::get('exam_id')}}"
                            data-class="{{ Request::get('class_id')}}"
                            data-schedule="{{ $subject->id}}"

                            > Save </button>
                           </div>
                           @if(!empty($getMark))
                           <div class="mb-2">
                            <b>Total mark</b>: {{$totalMark}}/{{$subject->full_mark}}
                            @php
                            $getLoopGrade = App\Models\MarksGradeModel::getGrade($totalMark)
                            @endphp
                            @if($totalMark >= $subject->passing_mark)
                            <span class="badge bg-primary">Passed</span>
                            @else
                            <span class="badge bg-warning">Failed</span>
                            @endif
                            @if($getLoopGrade)
                            <span class="badge bg-primary">Grade {{$getLoopGrade}} </span>
                            @endif
                           </div>
                           @endif
                         </td>
                         @php
                            $i++;
                        @endphp
                          @endforeach
                          <td class="align-middle"><button type="submit" class="btn btn-primary">Save</button> <br/>
                          @if(!empty($totalStudentMark))
                          @php
                          $percentage = $totalStudentMark * 100 / $totalFullMark;
                          $getGrade = App\Models\MarksGradeModel::getGrade($percentage)
                          @endphp
                          <b>Final mark</b> : {{$totalStudentMark}} /{{$totalFullMark}}
                          @if($totalStudentMark >= $totalPassingMark)
                            <span class="badge bg-primary">Passed {{round($percentage,2)}} %</span>
                            @else
                            <span class="badge bg-warning">Failed {{round($percentage,2)}} %</span>
                            @endif
                            @if($getGrade)
                            <span class="badge bg-primary">Grade {{$getGrade}} </span>
                            @endif
                            @endif

                        </td>
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
                    url: "{{url('teacher/submit_mark_register')}}",
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
            $('.singleSubject').click(function(e){
               var id = $(this).attr('data-schedule');
               var student_id = $(this).attr('id');
               var subject_id = $(this).attr('data-val');
               var exam_id = $(this).attr('data-exam');
               var class_id = $(this).attr('data-class');
               var class_work = $('#class_work_'+student_id+subject_id).val();
               var home_work = $('#home_work_'+student_id+subject_id).val();
               var test_work = $('#test_work_'+student_id+subject_id).val();
               var exam = $('#exam'+student_id+subject_id).val();
               $.ajax({
                    type: 'POST',
                    url: "{{url('teacher/single_submit_mark_register')}}",
                    data: {
                        '_token': '{{csrf_token()}}',
                       id: id,
                        subject_id: subject_id,
                        student_id: student_id,
                        exam_id: exam_id,
                        class_id: class_id,
                        class_work: class_work,
                        home_work: home_work,
                        test_work: test_work,
                        exam: exam
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
