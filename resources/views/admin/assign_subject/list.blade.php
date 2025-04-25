@extends('layout.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <h3 class="mb-0">Add New Assign Subject</h3>
                    </div>
                    <div class="col-sm-6 text-end">
                        <a href="{{ url('admin/assign_subject/add') }}" class="btn btn-primary">+Assign Subject To Class</a>
                    </div>
                </div>
                <!--end::Row-->

                     <!--begin::Row-->
                     <div class="row">
                      <div class="col-sm-6">
                          <p class="mb-0">Search Assign Subjects</p>
                      </div>
                      <form action="{{ route('subjects.search') }}" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search ...">
                            </div>
                            <div class="col-4">
                                <input type="date" class="form-control" name="search_date" value="{{ request('search_by_date') }}" placeholder="Search ...">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-secondary"><i class="las la-search"></i> Search</button>
                                <a href="{{route('subjects.list')}}" class="btn btn-secondary"><i class="las la-ban"></i> Reset</a>
                            </div>
                        </div>
                    </form>
                  </div>
                  <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_message')
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Assign Subjects list</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject Title</th>
                                            <th>Class Name</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                    @foreach ($school_classes as $class)
                                    @foreach ($class->subjects as $subject)
                                    <tr>
                                        <td>#</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $class->name }}</td>
                                        <td>{{ $class->status }}</td>
                                        <td>{{ $subject->user->name }}</td>
                                        <td>{{ $subject->created_at }}</td>
                                        <td>--</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                   </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
