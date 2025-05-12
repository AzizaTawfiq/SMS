@extends('layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form method="post" action="{{ route('update_change_password') }}">
                            @csrf
                            <div class="card-body">

                                <div class="form-group mb-3">
                                    <label for="old_password" class="form-label fw-bold">Old Password</label>
                                    <input type="password" class="form-control" id="old_password"
                                        placeholder="Enter old password" name="old_password" required />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="new_password" class="form-label fw-bold">New Password</label>
                                    <input type="password" class="form-control" id="new_password"
                                        placeholder="Enter new password" name="new_password" required />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="new_password_confirmation" class="form-label fw-bold">Confirm New Password</label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        placeholder="Confirm new password" name="new_password_confirmation" required />
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ url('admin/school_classes/list') }}" class="btn btn-outline-primary ms-2">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
