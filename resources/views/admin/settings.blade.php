@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Settings</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
              @include('_message')
                <div class="card card-primary card-outline mb-4">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                      <h3 class="card-title">Settings</h3>
                    </div>
                  {{ csrf_field() }}

                    <div class="card-body">
                      <div class="form-group">
                        <label for="email" class="form-label fw-bold">Paypal business Email</label>
                        <input  type="text"  class="form-control"  id="email"  placeholder="Enter email"
                          name="paypal_email"  value="{{$getRecord->paypal_email}}" />
                        <div class="text-danger">
                        {{$errors->first('paypal_email')}}
                        </div>
                      </div>

                      <div class="form-group">
                          <label class="form-label fw-bold">University Name</label>
                          <input type="text" name="site_name" class="form-control"
                                value="{{ old('site_name', $getRecord->site_name) }}"
                                placeholder="Enter University Name" />
                      </div>
                          <div class="text-danger">{{ $errors->first('site_name') }}</div>

                       <div class="form-group ">
                           <label for="Logo" class="form-label fw-bold"> Logo </label>
                            @if(!empty($getRecord->Logo) && file_exists(public_path($getRecord->Logo)))
                              <div class="mb-2">
                                  <img src="{{ asset($getRecord->Logo) }}" alt="Logo" width="100" />
                              </div>
                            @endif
                             <input type="file" class="form-control"  id="Logo"  name="Logo" />
                       </div>

                        <div class="form-group ">
                           <label for="Favicon_icon" class="form-label fw-bold">Favicon Icon</label>
                               @if(!empty($getRecord->Favicon_icon) && file_exists(public_path($getRecord->Favicon_icon)))
                                <div class="mb-2">
                                    <img src="{{ asset($getRecord->Favicon_icon) }}" alt="Favicon" width="50" />
                                </div>
                            @endif
                             <input type="file" class="form-control"  id="Favicon_icon"  name="Favicon_icon" />
                       </div>
                       
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <a href="{{ url('admin/dashboard') }}" class="btn btn-outline-primary">Cancel</a>
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
