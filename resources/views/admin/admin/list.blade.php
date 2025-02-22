@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Admin list (Count: {{$getRecord->total()}}) </h3></div>
              <div class="col-sm-6 text-end">
                <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">Add Admin</a>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
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
                      <div class="form-group col-md-3">
                        <label for="name" class="form-label text-bold">Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Search for name"
                          name="name"
                          value="{{ Request::get('name') }}"
                        />

                      </div>
                      <div class="form-group col-md-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          placeholder="Search for email"
                          name="email"
                          value="{{ Request::get('email') }}"
                        />
                      </div>
                      <div class="form-group col-md-3">
                        <label for="created_at" class="form-label">Date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="created_at"
                          placeholder="Search for date"
                          name="created_at"
                          value="{{ Request::get('created_at') }}"
                        />
                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit">Search</button>
                       <a href="{{ url('admin/admin/list') }}" class="btn btn-success">Reset</a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Admins list</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th >#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th >Created date</th>
                          <th >Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td><a href="{{url('admin/admin/edit/' .$value->id)}}" class="btn btn-primary">Edit</a></td>
                            <td><a href="{{url('admin/admin/delete/' .$value->id)}}" class="btn btn-danger">Delete</a></td>
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
