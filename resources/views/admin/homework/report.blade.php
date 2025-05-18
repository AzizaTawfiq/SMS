@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12"><h3 class="mb-0">Homework Report  </h3></div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
              <div class="card card-primary card-outline mb-2">
              <div class="card-header">
                    <h3 class="card-title">Search</h3>
                  </div>
                  <form action="" method="get">

                    <div class="card-body row">

                    <div class="form-group col-md-2">
                        <label for="class" class="form-label fw-bold">Student First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                        placeholder="Search for first name to student"  value="{{ Request::get('first_name') }}" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="class" class="form-label fw-bold">Student Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                        placeholder="Search for last name to student"  value="{{ Request::get('last_name') }}" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="class" class="form-label fw-bold">Student Class</label>
                        <input type="text" class="form-control" id="class" name="class_name"
                        placeholder="Search for class"  value="{{ Request::get('class_name') }}" />

                      </div>
                      <div class="form-group col-md-2">
                        <label for="subject_name" class="form-label fw-bold">Subject</label>
                        <input type="text" class="form-control" id="subject_name" name="subject_name"
                        placeholder="Search for subject"  value="{{ Request::get('subject_name') }}" />

                      </div>

                      <div class="form-group col-md-2">
                        <label for="homework_date" class="form-label fw-bold"> from Homework date</label>
                        <input
                          type="date" class="form-control" id="homework_date_from" name="homework_date_from"
                          value="{{ Request::get('homework_date_from') }}" />
                      </div>

                       <div class="form-group col-md-2">
                        <label for="homework_date" class="form-label fw-bold"> to Homework date</label>
                        <input
                          type="date" class="form-control" id="homework_date_to" name="homework_date_to"
                          value="{{ Request::get('homework_date_to') }}" />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="submission_date" class="form-label fw-bold">from Submission date</label>
                        <input
                          type="date"  class="form-control" id="submission_date"
                          name="submission_date"  value="{{ Request::get('submission_date') }}"  />
                      </div>
                        <div class="form-group col-md-2">
                        <label for="submission_date" class="form-label fw-bold">to Submission date</label>
                        <input
                          type="date"  class="form-control" id="submission_date"
                          name="submission_date"  value="{{ Request::get('submission_date') }}"  />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="created_at" class="form-label fw-bold">from created date</label>
                        <input
                          type="date"  class="form-control"  id="created_at"  placeholder="Search for date"
                          name="created_at"  value="{{ Request::get('created_at') }}"  />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="created_at" class="form-label fw-bold">to created date</label>
                        <input
                          type="date"  class="form-control"  id="created_at"  placeholder="Search for date"
                          name="created_at"  value="{{ Request::get('created_at') }}"  />
                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/homework/homework_report') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')
                <div class="card mb-4">
                  <div class="card-body p-0">
                  @if($getRecord->count() != 0)
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Student Name</th>
                          <th>Class</th>
                          <th>Subject</th>
                          <th>Homework date</th>
                          <th>Submission date</th>
                          <th>Document</th>
                          <th>Description</th>
                          <th>Created date</th>
                          <th>Submitted document</th>
                          <th>Submitted description</th>
                          <th>Submitted created date</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach($getRecord as $key => $value)
                        <tr>
                            <td>{{ $getRecord->firstItem() + $key }}</td>
                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>{{ $value->subject_name }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->getHomework->homework_date)) }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->getHomework->submission_date)) }}</td>
                            <td>
                                @if(!empty($value->getHomework->getDocument()))
                                <a href="{{ $value->getHomework->getDocument() }}" class="text-primary" download="">
                                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                </a>
                                @endif
                            </td>
                            <td>{!! $value->getHomework->description !!}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->getHomework->created_at)) }}</td>
                            <td>
                                @if(!empty($value->getDocument()))
                                <a href="{{ $value->getDocument() }}" class="text-primary" download="">
                                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                </a>
                                @endif
                            </td>
                            <td>{!! $value->description !!}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                     {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>

                            @else
                                <x-empty-state message="No homework found in the system." />
                            @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
