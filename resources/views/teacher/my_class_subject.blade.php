@extends('layout.app')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <h3 class="mb-0">My classes and subjects</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('_message')
                        <div class="card mb-4">
                            <div class="card-body p-0">
                            @if($getRecord->count() > 0)
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Class name</th>
                                            <th>Subject name</th>
                                            <th>Subject type</th>
                                            <th>Class timetable</th>
                                            <th>Created date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($getRecord as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->class_name }}</td>
                                                    <td>{{ $value->subject_name }}</td>
                                                    <td>
                                                        @if ($value->subject_type== 0)
                                                        <span class="badge bg-primary">Theory</span>
                                                        @else
                                                        <span class="badge bg-warning">Practical</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                        $classSubject = $value->getMyTimetable($value->class_id,$value->subject_id);
                                                        @endphp
                                                        @if(!empty($classSubject))
                                                        {{ date('h:i A', strtotime($classSubject->start_time))}} : {{ date('h:i A', strtotime($classSubject->end_time))}}
                                                        @endif
                                                    </td>

                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                    <td>
                                                        <a href="{{url('teacher/my_class_subject/class_timetable/' .$value->class_id. '/' .$value->subject_id)}}" class="text-primary fs-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Class Timetable">
                                                            <i class="nav-icon bi bi-calendar3"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                @else
                        <x-empty-state message="No classes assigned to teacher yet." />
                    @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
