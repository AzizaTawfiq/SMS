@extends('layout.app')
@section('content')

    <div class="app-wrapper">
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Add Subject</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline mb-4">
                                <form action="{{ url('admin/subjects/add') }}" method="post">
                                    {{ csrf_field() }}

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label text-bold">Subject Title</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="subject title" name="name" value="{{ old('name') }}" />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Type</label>
                                            <select name="type" class="form-control">
                                                <option>Select Type</option>
                                                <option value="0">Theory</option>
                                                <option value="1">Practical</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control">
                                                <option>Select Status</option>
                                                <option value="0">Active</option>
                                                <option value="1">InActive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <a href="{{ url('admin/subjects/list') }}" class="btn btn-outline-primary ms-2">Cancel</a>

                                    </div>
                                    <!--end::Footer-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
