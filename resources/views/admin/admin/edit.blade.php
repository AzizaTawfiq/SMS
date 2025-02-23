@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Edit admin</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <form action="" method="post">
                  {{ csrf_field() }}

                    <div class="card-body">
                      <div class="form-group">
                        <label for="name" class="form-label text-bold">Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Enter name"
                          name="name"
                          value="{{old('name') ? old('name') : $getRecord->name}}"

                        />
                        <div class="text-danger">
                        {{$errors->first('name')}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          placeholder="Enter email"
                          name="email"

                          value="{{old('email') ? old('email') : $getRecord->email}}"
                        />
                        <div class="text-danger">
                        {{$errors->first('email')}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" placeholder="Enter password" name="password"  />
                        <div class="text-danger">
                        {{$errors->first('password')}}
                        </div>
                      </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                </div>
              </div>
            </div>
        </div>
        </div>
      </main>
    </div>
      @endsection
