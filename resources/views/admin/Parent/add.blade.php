@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Add New Parent</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <form action="{{ url('admin/Parent/add')}}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="first_name" class="form-label text-bold">First name<span class="text-danger">*</span></label>
                                <input type="text"  class="form-control" id="first_name"
                                placeholder="Enter first name"  name="name" value="{{ old('name') }}" />
                                <div class="text-danger">
                                {{$errors->first('name')}}
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="last_name" class="form-label text-bold">Last name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name"
                                placeholder="Enter last name"  name="last_name" value="{{ old('last_name') }}"  />
                                <div class="text-danger">
                                {{$errors->first('last_name')}}
                                </div>
                            </div>
                            
                            <div class="col-md-6 form-group mt-3">
                                <label for="gender" class="form-label text-bold">Gender<span class="text-danger">*</span></label>
                                <select class="form-control" id="gender" name="gender" >
                                <option value="">Select gender</option>
                                <option {{(old('gender') == 'Male') ? 'selected' :''}} value="Male">Male</option>
                                <option {{(old('gender') == 'Female') ? 'selected' :''}} value="Female">Female</option>
                              </select>
                              <div class="text-danger">
                                {{$errors->first('gender')}}
                                </div>

                            </div>

                           
                            <div class="col-md-6 form-group mt-3">
                                <label for="caste" class="form-label text-bold">occupation</label>
                                <input type="text" class="form-control" id="occupation"
                                placeholder="Enter occupation"
                                name="occupation"  value="{{ old('occupation') }}" />
                                <div class="text-danger">
                                {{$errors->first('occupation')}}
                                </div>
                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label for="mobile_number" class="form-label text-bold">Mobile number</label>
                                <input  type="text"  class="form-control"  id="mobile_number"
                                placeholder="Enter mobile number" name="mobile_number" 
                                value="{{ old('mobile_number') }}" />
                                <div class="text-danger">
                                {{$errors->first('mobile_number')}}
                                </div>
                            </div>

                            <div class="col-md-6 form-group mt-3">
                                <label for="caste" class="form-label text-bold">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address"placeholder="Enter Address"
                                name="address" value="{{ old('address') }}" />
                                <div class="text-danger">
                                {{$errors->first('address')}}
                                </div>
                            </div>
                           
                            <div class="col-md-6 form-group mt-3">
                                <label for="profile_pic" class="form-label text-bold">Profile pic</label>
                                <input type="file" class="form-control" id="profile_pic" name="profile_pic" />
                                <div class="text-danger">
                                {{$errors->first('profile_pic')}}
                                </div>

                            </div>
                            
                            <div class="col-md-6 form-group mt-3 mb-3">
                                <label for="status" class="form-label text-bold">Status<span class="text-danger">*</span></label>
                                <select class="form-control" id="status" name="status">
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
                          type="text" class="form-control" id="email"
                          placeholder="Enter email" name="email" value="{{ old('email') }}"  />
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
                      <button type="submit" class="btn btn-outline-primary">Submit</button>
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
