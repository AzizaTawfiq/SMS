@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Submitted homework </h3></div>
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
                      <div class="form-group col-md-4">
                        <label for="student_name" class="form-label fw-bold">Student</label>
                        <input
                          type="text"
                          class="form-control"
                          id="student_name"
                          placeholder="Search for student name"
                          name="student_name"
                          value="{{ Request::get('student_name') }}"
                        />
                      </div>
                      <div class="form-group col-md-4">
                        <label for="created_at" class="form-label fw-bold">created date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="created_at"
                          placeholder="Search for date"
                          name="created_at"
                          value="{{ Request::get('created_at') }}"
                        />
                      </div>
                      <div class="form-group col-md-4" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('teacher/homework/submitted_homework/' .$homework_id) }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')
                <div class="card mb-4">
                  <div class="card-body p-0">
                    @if($getRecord->count() > 0)
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Student</th>
                          <th>Document</th>
                          <th>Description</th>
                          <th>Created date</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getRecord as $key => $value)
                        <tr>
                            <td>{{ $getRecord->firstItem() + $key }}</td>

                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                            <td>
                                @if(!empty($value->getDocument()))
                                    <a href="{{ $value->getDocument() }}" class="text-primary" download="">
                                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                    </a>
                                @endif
                            </td>
                            <td>{{ $value->description }}</td>
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
