@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">

              <div class="col-sm-6"><h3 class="mb-0">Students ({{$getRecord->total()}}) </h3></div>
              <div class="col-sm-6 text-end">
                <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add Student</a>
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
                      <div class="form-group col-md-2">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Search for name"
                          name="name"
                          value="{{ Request::get('name') }}"
                        />

                      </div>
                      <div class="form-group col-md-2">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          placeholder="Search for email"
                          name="email"
                          value="{{ Request::get('email') }}"
                        />
                      </div>

                      <div class="form-group col-md-2">
                        <label for="admission_number" class="form-label fw-bold">Admission number</label>
                        <input
                          type="text"
                          class="form-control"
                          id="admission_number"
                          placeholder="Search for admission number"
                          name="admission_number"
                          value="{{ Request::get('admission_number') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="roll_number" class="form-label fw-bold">Roll number</label>
                        <input
                          type="text"
                          class="form-control"
                          id="roll_number"
                          placeholder="Search for roll number"
                          name="roll_number"
                          value="{{ Request::get('roll_number') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="class_id" class="form-label fw-bold">Class</label>
                        <input
                          type="text"
                          class="form-control"
                          id="class_id"
                          placeholder="Search for class"
                          name="class_id"
                          value="{{ Request::get('class_id') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="gender" class="form-label fw-bold">Gender</label>
                        <select class="form-control" name="gender">
                          <option value="">Select gender</option>
                          <option value="male" {{ Request::get('gender') == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ Request::get('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="date_of_birth" class="form-label fw-bold">Date of birth</label>
                        <input
                        type="date"
                          class="form-control"
                          id="date_of_birth"
                          placeholder="Search for date of birth"
                          name="date_of_birth"
                          value="{{ Request::get('date_of_birth') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="caste" class="form-label fw-bold">Caste</label>
                        <input
                          type="text"
                          class="form-control"
                          id="caste"
                          placeholder="Search for caste"
                          name="caste"
                          value="{{ Request::get('caste') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="religion" class="form-label fw-bold">Religion</label>
                        <input
                          type="text"
                          class="form-control"
                          id="religion"
                          placeholder="Search for religion"
                          name="religion"
                          value="{{ Request::get('religion') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="mobile" class="form-label fw-bold">Mobile</label>
                        <input
                          type="text"
                          class="form-control"
                          id="mobile"
                          placeholder="Search for mobile"
                          name="mobile"
                          value="{{ Request::get('mobile') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="admission_date" class="form-label fw-bold">Admission date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="admission_date"
                          placeholder="Search for admission date"
                          name="admission_date"
                          value="{{ Request::get('admission_date') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="blood_group" class="form-label fw-bold">Blood group</label>
                        <input
                          type="text"
                          class="form-control"
                          id="blood_group"
                          placeholder="Search for blood group"
                          name="blood_group"
                          value="{{ Request::get('blood_group') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="height" class="form-label fw-bold">Height</label>
                        <input
                          type="text"
                          class="form-control"
                          id="height"
                          placeholder="Search for height"
                          name="height"
                          value="{{ Request::get('height') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="weight" class="form-label fw-bold">Weight</label>
                        <input
                          type="text"
                          class="form-control"
                          id="weight"
                          placeholder="Search for weight"
                          name="weight"
                          value="{{ Request::get('weight') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="status" class="form-label fw-bold">Status</label>
                        <select class="form-control" name="status">
                          <option value="">Select status</option>
                          <option value="100" {{ Request::get('status') == '100' ? 'selected' : '' }}>Active</option>
                          <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Inactive</option>
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="created_at" class="form-label fw-bold">created date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="created_at"
                          placeholder="Search for created date"
                          name="created_at"
                          value="{{ Request::get('created_at') }}"
                        />
                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/student/list') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')
                <div class="card mb-4">
                  <div class="card-body p-0">
                    @if($getRecord->count() > 0)
                   <div class="table-responsive">
                    <table class="table table-striped text-center align-middle " style="table-layout: auto;">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Profile pic</th>
                          <th>Student Name</th>
                          <th>Parent Name</th>
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
                          <th>Status</th>
                          <th>Actions</th>
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
                            <td>{{ $value->parent_name }}{{ $value->parent_last_name }}</td>
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
                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                            <td>
                              <a href="{{url('admin/student/edit/' .$value->id)}}" class="text-primary fs-5"><i class="bi bi-pencil"></i></a>
                              <x-confirm-delete
                                :url="url('admin/student/delete/' .$value->id)"
                                :id="$value->id"
                                title="Delete Student"
                                description="Are you sure you want to delete this student?"
                              />
                              @if(Auth::id() != $value->id)
                              <a href="{{url('chat?receiver_id='.base64_encode($value->id))}}" class="text-primary ms-4"><i class="bi bi-chat-dots"></i></a>
                              @endif                            </td>
                            <!-- <td><a href="{{url('admin/student/edit/' .$value->id)}}" class="btn btn-primary">Edit</a></td>
                            <td><a href="{{url('admin/student/delete/' .$value->id)}}" class="btn btn-danger">Delete</a></td> -->
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    @else
                        <x-empty-state message="No students found in the system." />
                    @endif
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
