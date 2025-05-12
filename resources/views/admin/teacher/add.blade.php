@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Add teacher</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <form action="{{ url('admin/teacher/add')}}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="first_name" class="form-label fw-bold">First name<span class="text-danger">*</span></label>
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
                                <label for="last_name" class="form-label fw-bold">Last name<span class="text-danger">*</span></label>
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
                                <label for="gender" class="form-label fw-bold">Gender<span class="text-danger">*</span></label>
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
                                <label for="date_of_birth" class="form-label fw-bold">Date of birth<span class="text-danger">*</span></label>
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
                                <label for="admission_date" class="form-label fw-bold">Joining date<span class="text-danger">*</span></label>
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
                                <label for="mobile_number" class="form-label fw-bold">Mobile number</label>
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
                            <div class="col-md-6 form-group">
                                <label for="marital_status" class="form-label fw-bold">Marital status<span class="text-danger">*</span></label>
                                <input
                                type="text"
                                class="form-control"
                                id="marital_status"
                                placeholder="Enter marital status"
                                name="marital_status"

                                value="{{ old('marital_status') }}"
                                />
                                <div class="text-danger">
                                {{$errors->first('marital_status')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="profile_pic" class="form-label fw-bold">Profile pic</label>
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
                                <label for="address" class="form-label fw-bold">Current address<span class="text-danger">*</span></label>
                                <textarea

                                class="form-control"
                                id="address"
                                name="address"
                                placeholder="Enter address"
                                >
                                {{ old('address') }}
                                </textarea>
                                <div class="text-danger">
                                {{$errors->first('address')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="permanent_address" class="form-label fw-bold">Permanent address<span class="text-danger">*</span></label>
                                <textarea

                                class="form-control"
                                id="permanent_address"
                                name="permanent_address"
                                placeholder="Enter permanent address"
                                >
                                {{ old('permanent_address') }}
                                </textarea>
                                <div class="text-danger">
                                {{$errors->first('permanent_address')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="qualification" class="form-label fw-bold">Qualifications</label>
                                <textarea
                                class="form-control"
                                id="qualification"
                                name="qualification"
                                placeholder="Enter qualification"
                                >
                                {{ old('qualification') }}
                            </textarea>
                                <div class="text-danger">
                                {{$errors->first('qualification')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3 mb-3">
                                <label for="work_experience" class="form-label fw-bold">Experience</label>
                                <textarea
                                class="form-control"
                                id="work_experience"
                                name="work_experience"
                                placeholder="Enter experience"
                                >
                                {{ old('work_experience') }}
                                </textarea>
                                <div class="text-danger">
                                {{$errors->first('work_experience')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3 mb-3">
                                <label for="note" class="form-label fw-bold">Notes</label>
                                <textarea
                                class="form-control"
                                id="note"
                                name="note"
                                placeholder="Enter note"
                                >
                                {{ old('note') }}
                                </textarea>
                                <div class="text-danger">
                                {{$errors->first('note')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group mt-3 mb-3">
                                <label for="status" class="form-label fw-bold">Status<span class="text-danger">*</span></label>
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
                      <a href="{{ url('admin/teacher/list') }}" class="btn btn-outline-primary ms-2">Cancel</a>

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
