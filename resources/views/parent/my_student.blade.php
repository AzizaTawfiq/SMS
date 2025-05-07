@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">My Student List </h3></div>
            </div>
        </div>
        </div>

        <div class="app-content">
        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
              @include('_message')
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">My Student List</h3>
                  </div>
                  <div class="card-body p-0" >
                  <table class="table table-striped " style="overflow:auto;">
                      <thead>
                        <tr>
                          <th>Profile pic</th>
                          <th>Student Name</th>
                          <th>Email</th>
                          <th>Admission number</th>
                          <th>Roll number</th>
                          <th>Class</th>
                          <th>Gender</th>
                          <th>Date of birth</th>
                          <th>Caste</th>
                          <th>Religion</th>
                          <th>Mobile</th>
                          <th>Admission Date</th>
                          <th>Blood group</th>
                          <th>Height</th>
                          <th>Weight</th>
                          <th >Created date</th>
                          <th >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($getRecored as $value)
                        <tr>
                            <td>
                                @if(!empty($value->getProfile()))
                                <img src="{{ $value->getProfile() }}" alt="Profile pic" style="width: 50px; height: 50px; border-radius: 50%;">
                                @endif
                            </td>
                            <td>{{ $value->name }}<!-- {{ $value->last_name }} --></td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->admission_number }}</td>
                            <td>{{ $value->roll_number }}</td>
                            <td>{{ $value->class_id }}</td>
                            <td>{{ $value->gender }}</td>
                            <td>
                                @if(!empty($value->date_of_birth))
                                {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                @endif
                            </td>
                            <td>{{ $value->caste }}</td>
                            <td>{{ $value->religion }}</td>
                            <td>{{ $value->mobile }}</td>
                            <td>
                                @if(!empty($value->admission_date))
                                {{ date('d-m-Y', strtotime($value->admission_date)) }}
                                @endif
                            </td>
                            <td>{{ $value->blood_group }}</td>
                            <td>{{ $value->height }}</td>
                            <td>{{ $value->weight }}</td>

                            <td>{{ date('d.m-y H:i A ', strtotime($value->created_at)) }}</td>
                            <td>
                              <a class="btn btn-primary btn-sm" href="{{url('parent/my_student/my_student_subject/'. $value->id)}}">
                              <i class="bi bi-journal-bookmark-fill"></i>  Subject</a>
                            </td>
                        </tr>
                        @endforeach

                      </tbody>
                    </table>
                    <div class=" padding:10px; justify-content-center mt-4">
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
