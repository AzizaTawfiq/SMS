@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">

              <div class="col-sm-6"><h3 class="mb-0">My Students </h3></div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-body p-0">
                    @if($getRecord->count() > 0)
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
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
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($getRecord as $key => $value)
                        <tr>
                            <td>{{ $getRecord->firstItem() + $key }}</td>
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
                         </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    @else
                        <x-empty-state message="No students found for this teacher." />
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
