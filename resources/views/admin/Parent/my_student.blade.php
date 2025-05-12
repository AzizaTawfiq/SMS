@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Parent student list  ({{ $paernt->name }}  {{ $paernt->last_name }})</h3></div>
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
                    <h3 class="card-title">Search student</h3>
                  </div>
                  <form action="" method="get">

                    <div class="card-body row">
                      <div class="form-group col-md-2">
                        <label > Student ID</label>
                        <input  type="text"  class="form-control" id="id"
                          placeholder="search student_id" name="id" value="{{ Request::get('student_id') }}"  />
                      </div>

                      <div class="form-group col-md-2">
                        <label for="name" class="form-label fw-bold"> first Name</label>
                        <input  type="text"  class="form-control" id="name"
                          placeholder="Search for name" name="name" value="{{ Request::get('name') }}"  />
                      </div>

                      <div class="form-group col-md-2">
                        <label for="last_name" class="form-label fw-bold">Last name</label>
                        <input type="text" class="form-control"  id="last_name" placeholder="Search for last name"
                          name="last_name" value="{{ Request::get('last_name') }}" />
                      </div>

                      <div class="form-group col-md-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control"  id="email"  placeholder="Search for email"
                          name="email"  value="{{ Request::get('email') }}"  />
                      </div>
    
                      <div class="form-group col-md-3">
                        <label for="created_at" class="form-label">created date</label>
                        <input type="date" class="form-control" id="created_at"
                         placeholder="Search for created date" name="created_at" value="{{ Request::get('created_at') }}" />
                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit">Search</button>
                       <a href="{{ url('admin/Parent/my_student/' .$parent_id) }}" class="btn btn-success">Reset</a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')

  @if(!empty($getSearchstudent))            
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title"> student list</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-striped ">
                      <thead>
                        <tr>
                          <th >#</th>
                          <th>Profile pic</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Parent Name</th>
                          <th >Created date</th>
                          <th >Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($getSearchstudent as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>
                                @if(!empty($value->getProfile()))
                                <img src="{{ $value->getProfile() }}" alt="Profile pic" style="width: 50px; height: 50px; border-radius: 50%;">
                                @endif
                            </td>
                            <td>{{ $value->name }}  {{ $value->last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->parent_name }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                            <td><a href="{{url('admin/parent/assign_student_parent/' .$value->id .'/'.$parent_id )}}" class="btn btn-primary">Add student to parent</a></td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                    <div class=" padding:10px; justify-content-center mt-4">
                    </div>

                  </div>
                  <!-- /.card-body -->
                </div>
    @endif            

                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Parent student list</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                  <table class="table table-striped ">
                      <thead>
                        <tr>
                          <th >#</th>
                          <th>Profile pic</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Parent Name</th>
                          <th >Created date</th>
                          <th >Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($getRecored as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>
                                @if(!empty($value->getProfile()))
                                <img src="{{ $value->getProfile() }}" alt="Profile pic" style="width: 50px; height: 50px; border-radius: 50%;">
                                @endif
                            </td>
                            <td>{{ $value->name }}  {{ $value->last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->parent_name }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                            <td><a href="{{url('admin/parent/assign_student_parent_delete/' .$value->id)}}" class="btn btn-denger">deleted</a></td>
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
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
