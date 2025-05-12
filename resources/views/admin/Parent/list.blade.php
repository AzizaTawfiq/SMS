@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Parents</h3></div>
              <div class="col-sm-6 text-end">
                <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add parent</a>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
              <div class="card card-primary card-outline mb-4">
              <div class="card-header">
                    <h3 class="card-title">Search Parent</h3>
                  </div>
                  <form action="{{url('admin/parent/search/')}}" method="get">
              
                    <div class="card-body row">
                      <div class="form-group col-md-2">
                        <label for="name" class="form-label fw-bold"> first Name</label>
                        <input  type="text"  class="form-control" id="name"
                          placeholder="Search for name" name="first_name" value="{{old('first_name')}}" />

                      </div>

                      <div class="form-group col-md-2">
                        <label for="last_name" class="form-label fw-bold">Last name</label>
                        <input type="text" class="form-control"  id="last_name" placeholder="Search for last name"
                          name="last_name" value="{{old('last_name')}}" />
                      </div>

                      <div class="form-group col-md-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control"  id="email"  placeholder="Search for email"
                          name="email" value="{{old('email')}}" />
                      </div>
                     
                      <div class="form-group col-md-2">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" name="gender">
                          <option value="">Select gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>

                      <div class="form-group col-md-2">
                        <label for="admission_number" class="form-label">occupation</label>
                        <input  type="text"  class="form-control" id="occupation"
                          placeholder="Search for occupation"
                          name="occupation" value="{{old('occupation')}}"/>
                      </div>
                    
                      <div class="form-group col-md-2">
                        <label for="caste" class="form-label">address</label>
                        <input  type="text"  class="form-control" id="address"
                          placeholder="Search for address" name="address" value="{{old('address')}}"/>
                      </div>
                     
                      <div class="form-group col-md-2">
                        <label for="mobile" class="form-label">Mobile number</label>
                        <input type="text"  class="form-control" id="mobile"
                          placeholder="Search for mobile"  name="mobile" />
                      </div>
            
                     
                      <div class="form-group col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status">
                          <option value="">Select status</option>
                          <option value="0">Active</option>
                          <option value="1">Inactive</option>
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="created_at" class="form-label">created date</label>
                        <input type="date" class="form-control" id="created_at"
                         placeholder="Search for created date" name="created_at"/>
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
                @if($data->count() > 0)
                  <div class="card-body p-0">
                 
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Profile pic</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>gender</th>
                          <th>Mobile Number</th>
                          <th>occupation</th>
                          <th>address </th>
                          <th>Status</th>
                          <th>Created date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach ($data as $value)
                          <tr>
                            <td>#</td>
                            <td>
                               
                                <img src="{{asset('upload/profile/'.$value->profile_pic)}}" alt="Profile pic" style="width: 50px; height: 50px; border-radius: 50%;">
                           
                            </td>
                            <td>{{ $value->name }}{{ $value->last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->gender }}</td>
                            <td>{{ $value->mobile_number }}</td>
                            <td>{{ $value->occupation }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                              <a href="{{url('admin/parent/edit/' .$value->id)}}" class="text-primary fs-5"><i class="bi bi-pencil"></i></a>
                            </td>
                              <td>
                              <a href="{{url('admin/parent/delete/' .$value->id)}}" class="text-primary fs-5"><i class="bi bi-trash"></i></a>
                            </td>
             
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @else
                    <div class="d-flex justify-content-center mt-4">
                        <x-empty-state message="No Parents found in the system." />
                    </div>
                   @endif
                  </div>
                </div>
                <div class=" padding:10px; justify-content-center mt-4">

                      
                    </div>

                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
