@extends('layout.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <h3 class="mb-0">Assign Class Teacher</h3>
                    </div>
                    <div class="col-sm-6 text-end">
                        <a href="{{ url('admin/assign_class_teacher/add') }}" class="btn btn-primary">Assign class teacher</a>
                    </div>
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
                        <label for="class_name" class="form-label text-bold">Class name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="class_name"
                          placeholder="Search for class name"
                          name="class_name"
                          value="{{ Request::get('class_name') }}"
                        />

                      </div>
                      <div class="form-group col-md-3">
                        <label for="teacher_name" class="form-label text-bold">Teacher name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="teacher_name"
                          placeholder="Search for teacher name"
                          name="teacher_name"
                          value="{{ Request::get('teacher_name') }}"
                        />

                      </div>
                      <div class="form-group col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status">
                          <option value="">Select status</option>
                          <option value="100" {{ Request::get('status') == '100' ? 'selected' : '' }}>Active</option>
                          <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Inactive</option>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="date" class="form-label">Date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="date"
                          placeholder="Search for date"
                          name="date"
                          value="{{ Request::get('date') }}"
                        />
                      </div>
                      <div class="form-group col-md-2" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/assign_class_teacher/list') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
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
                                            <th>Class</th>
                                            <th>Teacher</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($getRecord as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->class_name }}</td>
                                                    <td>{{ $value->teacher_name }}</td>
                                                    <td>
                                                        @if ($value->status == 0)
                                                            <span class="badge bg-primary">Active</span>
                                                        @else
                                                            <span class="badge bg-warning">InActive</span>
                                                        @endif
                                                    </td>

                                                    <td>{{ $value->created_by_name }}</td>
                                                    </td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                    <td>
                                                        <a href="{{url('admin/assign_class_teacher/edit/' .$value->id)}}" class="text-primary fs-5"><i class="bi bi-pencil"></i></a>
                                                        <a href="{{url('admin/assign_class_teacher/edit_single/' .$value->id)}}" class="text-primary fs-5 ms-4"><i class="bi bi-pencil-square"></i></a>
                                                        <x-confirm-delete
                                                            :url="url('admin/assign_class_teacher/delete/' .$value->id)"
                                                            :id="$value->id"
                                                            title="Delete Record"
                                                            description="Are you sure you want to delete this record?"
                                                        />
                            </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    @else
                        <x-empty-state message="No Data found in the system." />
                    @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
