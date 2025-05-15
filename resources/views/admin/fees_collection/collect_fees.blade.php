@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12"><h3 class="mb-0">Collect fees </h3></div>
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

                      <div class="form-group col-md-4" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/fees_collection/collect_fees') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
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
                          <th>Class</th>
                          <th>Total amount ($)</th>
                          <th>Paid amount($)</th>
                          <th>Created date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getRecord as $key => $value)
                        <tr>
                            <td>{{ $getRecord->firstItem() + $key }}</td>
                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>{{ number_format($value->amount,2) }}</td>
                            <td>10.00</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                              <a href="{{url('admin/fees_collection/collect_fees/add_fees/' .$value->id)}}" class="text-primary fs-5" data-bs-toggle="tooltip" title="Collect fees"><i class="bi bi-cash"></i></a>

                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    @else
                        <x-empty-state message="No Fees found in the system." />
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
