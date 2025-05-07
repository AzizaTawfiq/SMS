@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">My Exam result</h3></div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
                @foreach($getRecord as $value)
              <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{$value['exam_name']}}
                        </h3>
                    </div>
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th>Classwork</th>
                          <th>Homework</th>
                          <th>Test work</th>
                          <th>Exam</th>
                          <th>Total mark</th>
                          <th>Passing mark</th>
                          <th>Full mark</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $totalScore = 0;
                        $fullMark = 0;
                        $result_validation = 0;
                        @endphp
                        @foreach($value['subject'] as $subject)
                        @php
                        $totalScore += $subject['total_score'];
                        $fullMark += $subject['full_mark'];
                        @endphp
                        <tr>
                            <td>{{$subject['subject_name']}}</td>
                            <td>{{$subject['class_work']}}</td>
                            <td>{{$subject['home_work']}}</td>
                            <td>{{$subject['test_work']}}</td>
                            <td>{{$subject['exam']}}</td>
                            <td>{{$subject['total_score']}}</td>
                            <td>{{$subject['passing_mark']}}</td>
                            <td>{{$subject['full_mark']}}</td>
                            <td>
                               @if($subject['total_score'] >= $subject['passing_mark'] )
                               <span class="badge bg-primary">Passed </span>
                            @else
                            @php
                        $result_validation = 1;
                        @endphp
                            <span class="badge bg-warning">Failed </span>
                               @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><b>Final score : </b>{{$totalScore}} / {{$fullMark}} </td>
                            <td colspan="2"><b>Final percent : </b>{{ $fullMark > 0 ? round(($totalScore * 100) / $fullMark, 2) : 0 }} % </td>
                            <td colspan="5"><b>Final status : </b>
                                @if($result_validation == 0)
                                    <span class="badge bg-primary">Passed</span>
                                @else
                                    <span class="badge bg-warning">Failed</span>
                                @endif
                            </td>
                        </tr>

                      </tbody>
                    </table>


                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </main>

      @endsection
