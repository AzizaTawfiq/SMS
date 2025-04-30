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
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    placeholder="Search ...">
                            </div>
                            <div class="col-4">
                                <input type="date" class="form-control" name="search_date"
                                    value="{{ request('search_by_date') }}" placeholder="Search ...">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-secondary"><i class="las la-search"></i>
                                    Search</button>
                                <a href="{{ route('subjects.list') }}" class="btn btn-secondary"><i class="las la-ban"></i>
                                    Reset</a>
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
                                                    <td>
                                                        @if ($subject->pivot->status == 0)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">InActive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ \App\Models\User::getNameById($subject->pivot->user_id) }}
                                                    </td>
                                                    <td>{{ $subject->pivot->created_at }}</td>
                                                    <td>
                                                        <form
                                                            action="{{ route('assign_subjects.destroy', ['class_id' => $class->id, 'subject_id' => $subject->id]) }}"
                                                            method="POST" style="display: inline !important;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal2{{ $class->id }}"
                                                                style="width:75px !important;">Delete</button>
                                                            <div class="modal fade" id="exampleModal2{{ $class->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="exampleModalLabel">
                                                                                Delete Class</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are you sure you want to delete <span
                                                                                style="color:red;">{{ $class->name }}
                                                                                && {{ $subject->name }}</span>?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cancel</button>
                                                                            <button class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
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
