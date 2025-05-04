@extends('layout.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <h3 class="mb-0">Edit assign class teacher</h3>
                    </div>
                </div>
                @include('_message')
                <div class="row">
                    <form action="" method="post">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Select Class</label>
                                <select name="class_id" class="form-select">
                                    <option>Select Class</option>
                                    @foreach ($getClass as $class)
                                        <option {{($getRecord->class_id == $class->id ? 'selected' : '')}} value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold">Select teacher</label>
                            @foreach ($getTeacher as $teacher)
                                <div class="form-check">

                                    <label>
                                        @php
                                        $checked ='';
                                        @endphp
                                        @foreach($getAssignTeacherId as $teacherId )
                                        @if($teacherId->teacher_id == $teacher->id)
                                        @php
                                        $checked ='checked';
                                        @endphp
                                        @endif
                                        @endforeach
                                    <input {{$checked}} type="checkbox" class="form-check-input" name="teacher_id[]"
                                    value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->last_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option>Select Status</option>
                                <option {{($getRecord->status == 0 ? 'selected' : '')}} value="0">Active</option>
                                <option {{($getRecord->status == 1 ? 'selected' : '')}} value="1">InActive</option>
                            </select>
                        </div>
                        <div class="card-footer pt-3">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <a href="{{ url('admin/assign_class_teacher/list') }}" class="btn btn-outline-primary ms-2">Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
