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
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row">
                    <form action="{{ url('admin/assign_subject/add') }}" method="POST">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Select Classes</label>
                                <select name="school_class" class="form-select">
                                    <option>Select Class</option>
                                    @foreach ($school_classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold">Select Subjects</label>
                            @foreach ($subjects as $value)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="subjects[]"
                                        value="{{ $value->id }}">
                                    <label class="form-check-label" for="checkDefault">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option>Select Status</option>
                                <option  value="0">Active</option>
                                <option  value="1">InActive</option>
                            </select>
                        </div>
                        <button class="btn btn-success my-2">Save</button>
                    </form>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>

    </main>
@endsection
