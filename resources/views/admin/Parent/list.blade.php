@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Parent list (Count: {{$getRecord->total()}}) </h3></div>
              <div class="col-sm-6 text-end">
                <a href="{{ url('admin/parent/add') }}" class="btn btn-outline-primary">Add Now Parent</a>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
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
                  <form action="" method="get">

                    <div class="card-body row">
                      <div class="form-group col-md-2">
                        <label for="name" class="form-label text-bold"> first Name</label>
                        <input  type="text"  class="form-control" id="name"
                          placeholder="Search for name" name="name" value="{{ Request::get('name') }}"  />

                      </div>

                      <div class="form-group col-md-2">
                        <label for="last_name" class="form-label text-bold">Last name</label>
                        <input type="text" class="form-control"  id="last_name" placeholder="Search for last name"
                          name="last_name" value="{{ Request::get('last_name') }}" />
                      </div>

                      <div class="form-group col-md-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control"  id="email"  placeholder="Search for email"
                          name="email"  value="{{ Request::get('email') }}"  />
                      </div>
                     
                      <div class="form-group col-md-2">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" name="gender">
                          <option value="">Select gender</option>
                          <option value="male" {{ Request::get('gender') == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ Request::get('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>

                      <div class="form-group col-md-2">
                        <label for="admission_number" class="form-label">occupation</label>
                        <input  type="text"  class="form-control" id="occupation"
                          placeholder="Search for occupation"
                          name="occupation"  value="{{ Request::get('occupation') }}"  />
                      </div>
                    
                      <div class="form-group col-md-2">
                        <label for="caste" class="form-label">address</label>
                        <input  type="text"  class="form-control" id="address"
                          placeholder="Search for address" name="address"  value="{{ Request::get('address') }}" />
                      </div>
                     
                      <div class="form-group col-md-2">
                        <label for="mobile" class="form-label">Mobile number</label>
                        <input type="text"  class="form-control" id="mobile"
                          placeholder="Search for mobile"  name="mobile" value="{{ Request::get('mobile') }}" />
                      </div>
            
                     
                      <div class="form-group col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status">
                          <option value="">Select status</option>
                          <option value="100" {{ Request::get('status') == '100' ? 'selected' : '' }}>Active</option>
                          <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Inactive</option>
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="created_at" class="form-label">created date</label>
                        <input type="date" class="form-control" id="created_at"
                         placeholder="Search for created date" name="created_at" value="{{ Request::get('created_at') }}" />
                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-outline-primary" type="submit">Search</button>
                       <a href="{{ url('admin/student/list') }}" class="btn btn-outline-success">Reset</a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Parent list</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th >#</th>
                          <th>Profile pic</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>gender</th>
                          <th>Mobile Number</th>
                          <th>occupation</th>
                          <th>address </th>
                          <th >Status</th>
                          <th >Created date</th>
                          <th >Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>
                                @if(!empty($value->getProfile()))
                                <img src="{{ $value->getProfile() }}" alt="Profile pic" style="width: 50px; height: 50px; border-radius: 50%;">
                                @endif
                            </td>
                            <td>{{ $value->name }}{{ $value->last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->gender }}</td>
                            <td>{{ $value->Mobile_Number }}</td>
                            <td>{{ $value->occupation }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td><a href="{{url('admin/parent/edit/' .$value->id)}}" class="btn btn-outline-primary">Edit</a></td>
                            <td><a href="{{url('admin/parent/delete/' .$value->id)}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">

                        {!! $getRecord-> appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
