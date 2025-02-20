@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Admin list</h3></div>
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
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
