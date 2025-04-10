@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Add student</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <form action="{{ url('admin/student/add')}}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="first_name" class="form-label text-bold">First name<span class="text-danger">*</span></label>
                                <input
                                type="text"
                                class="form-control"
                                id="first_name"
                                placeholder="Enter first name"
                                name="name"

                                value="{{ old('name') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('name')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="last_name" class="form-label text-bold">Last name<span class="text-danger">*</span></label>
                                <input
                                type="text"
                                class="form-control"
                                id="last_name"
                                placeholder="Enter last name"
                                name="last_name"

                                value="{{ old('last_name') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('last_name')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="admission_number" class="form-label text-bold">Admission number<span class="text-danger">*</span></label>
                                <input
                                type="text"
                                class="form-control"
                                id="admission_number"
                                placeholder="Enter admission number"
                                name="admission_number"

                                value="{{ old('admission_number') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('admission_number')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="roll_number" class="form-label text-bold">Roll number</label>
                                <input
                                type="text"
                                class="form-control"
                                id="roll_number"
                                placeholder="Enter roll number"
                                name="roll_number"

                                value="{{ old('roll_number') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('roll_number')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="class_id" class="form-label text-bold">Class<span class="text-danger">*</span></label>
                                <select
                                class="form-control"
                                id="class_id"
                                name="class_id"
                                >
                                <option value="">Select class</option>
                                <option value="1" selected>1</option>


                                    </select>
                                    <div class="text-danger">
                                        {{$errors->first('class_id')}}
                                        </div>

                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="gender" class="form-label text-bold">Gender<span class="text-danger">*</span></label>
                                <select
                                class="form-control"
                                id="gender"
                                name="gender"
                                >
                                <option value="">Select gender</option>
                                <option {{(old('gender') == 'Male') ? 'selected' :''}} value="Male">Male</option>
                                <option {{(old('gender') == 'Female') ? 'selected' :''}} value="Female">Female</option>
                              </select>
                              <div class="text-danger">
                                {{$errors->first('gender')}}
                                </div>

                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label for="date_of_birth" class="form-label text-bold">Date of birth<span class="text-danger">*</span></label>
                                <input
                                type="date"
                                class="form-control"
                                id="date_of_birth"
                                placeholder="Enter date of birth"
                                name="date_of_birth"

                                value="{{ old('date_of_birth') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('date_of_birth')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="caste" class="form-label text-bold">Caste</label>
                                <input
                                type="text"
                                class="form-control"
                                id="caste"
                                placeholder="Enter caste"
                                name="caste"

                                value="{{ old('caste') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('caste')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="religion" class="form-label text-bold">Religion</label>
                                <input
                                type="text"
                                class="form-control"
                                id="religion"
                                placeholder="Enter religion"
                                name="religion"

                                value="{{ old('religion') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('religion')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="mobile_number" class="form-label text-bold">Mobile number</label>
                                <input
                                type="text"
                                class="form-control"
                                id="mobile_number"
                                placeholder="Enter mobile number"
                                name="mobile_number"

                                value="{{ old('mobile_number') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('mobile_number')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="admission_date" class="form-label text-bold">Admission date<span class="text-danger">*</span></label>
                                <input
                                type="date"
                                class="form-control"
                                id="admission_date"
                                name="admission_date"

                                value="{{ old('admission_date') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('admission_date')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="profile_pic" class="form-label text-bold">Profile pic</label>
                                <input
                                type="file"
                                class="form-control"
                                id="profile_pic"
                                name="profile_pic"
                                />
                                <div class="text-danger">
                                {{$errors->first('profile_pic')}}
                                </div>

                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="blood_group" class="form-label text-bold">Blood group</label>
                                <input
                                type="text"
                                class="form-control"
                                id="blood_group"
                                name="blood_group"
                                placeholder="Enter blood group"
                                value="{{ old('blood_group') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('blood_group')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="height" class="form-label text-bold">Height<span class="text-danger">*</span></label>
                                <input
                                type="text"
                                class="form-control"
                                id="height"
                                name="height"
                                placeholder="Enter height"
                                value="{{ old('height') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('height')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3 mb-3">
                                <label for="weight" class="form-label text-bold">Weight<span class="text-danger">*</span></label>
                                <input
                                type="text"
                                class="form-control"
                                id="weight"
                                name="weight"
                                placeholder="Enter weight"
                                value="{{ old('weight') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('weight')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3 mb-3">
                                <label for="status" class="form-label text-bold">Status<span class="text-danger">*</span></label>
                                <select
                                class="form-control"
                                id="status"
                                name="status"
                                >
                                <option value="">Select status</option>
                                <option {{(old('status') == 0) ? 'selected' :''}} value="0">active</option>
                                <option {{(old('status') == 1) ? 'selected' :''}} value="1">inactive</option>
                              </select>
                              <div class="text-danger">
                                {{$errors->first('status')}}
                                </div>

                            </div>
                            <hr/>
                      <div class="form-group">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          placeholder="Enter email"
                          name="email"

                          value="{{ old('email') }}"

                        />
                        <div class="text-danger">
                        {{$errors->first('email')}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password"  />
                        <div class="text-danger">
                        {{$errors->first('password')}}
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
        </div>
      </main>
    </div>
      @endsection
