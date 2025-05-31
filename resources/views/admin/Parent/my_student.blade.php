@extends('layout.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">{{ $header_title }}</h3>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="app-content">
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Search Parent</h3>
                                </div>
                                <form action="{{ url('admin/parent/my_student/' . $parent_id . '/assign') }}"
                                    method="get">

                                    <div class="card-body row">
                                        <div class="form-group col-md-2">
                                            <label for="name" class="form-label text-bold">ID</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Student ID" name="student_id"
                                                value="{{ old('first_name') }}" />

                                        </div>


                                        <div class="form-group col-md-2">
                                            <label for="name" class="form-label text-bold"> first Name</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="first name" name="first_name"
                                                value="{{ old('first_name') }}" />

                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="last_name" class="form-label text-bold">Last name</label>
                                            <input type="text" class="form-control" id="last_name"
                                                placeholder="last name" name="last_name" value="{{ old('last_name') }}" />
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" placeholder="email"
                                                name="email" value="{{ old('email') }}" />
                                        </div>

                                        <div class="form-group col-md-3" style="margin-top: 30px;">
                                            <button class="btn btn-primary" onclick="showMessage()"><i
                                                    class="bi bi-search"></i></button>
                                            <a href="{{ url('admin/student/list') }}" class="btn btn-primary"><i
                                                    class="bi bi-arrow-clockwise"></i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @include('_message')
                        @if (!empty($getSearchstudent))
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Students List</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Profile pic</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Created date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getSearchstudent as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>
                                                        @if (!empty($value->getProfile()))
                                                            <img src="{{ $value->getProfile() }}" alt="Profile pic"
                                                                style="width: 50px; height: 50px; border-radius: 50%;">
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>{{ $value->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                    <td>{{ $value->created_at }}</td>
                                                    <td>

                                                        {{-- <a href="{{ url('admin/parent/my_student/' . $value->id . '/' . $parent_id) }}"
                                                            class="btn btn-primary">Add student to parent</a> --}}

                                                        <form
                                                            action="{{ route('parent_stdassign', ['student_id' => $value->id, 'parent_id' => $parent_id, 'check_assign' => $check_assign]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="btn btn-primary">Add student to parent</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <!-- /.card-body -->
                    </div>
                    @endif
                    <div class=" padding:10px; justify-content-center mt-4">

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Parent student list</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile pic</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Parent Name</th>
                                            <th>Status</th>
                                            <th>Created date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @if (!empty($value->getProfile()))
                                                        <img src="{{ $value->getProfile() }}" alt="Profile pic"
                                                            style="width: 50px; height: 50px; border-radius: 50%;">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->parent_name }}</td>
                                                <td>{{ $value->status == 0 ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ $value->created_at }}</td>
                                                <td><a href="{{ url('admin/parent/my_student/' . $value->id . '/' . $parent_id . '/assign_delete') }}"
                                                        class="btn btn-denger">deleted</a></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class=" padding:10px; justify-content-center mt-4">
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        {{-- parent list --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- <script>
        function showMessage() {
            document.getElementById('message').style.display = 'block';
        }
    </script> --}}
@endsection
