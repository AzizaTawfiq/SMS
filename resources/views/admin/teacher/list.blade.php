@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">

          <div class="container-fluid">
            <div class="row">

              <div class="col-sm-6"><h3 class="mb-0">Teachers ({{$getRecord->total()}}) </h3></div>
              <div class="col-sm-6 text-end">
                <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Add Teacher</a>
              </div>
            </div>
          </div>
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
                      <div class="form-group col-md-2">
                        <label for="name" class="form-label text-bold">First name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Search for first name"
                          name="name"
                          value="{{ Request::get('name') }}"
                        />

                      </div>
                      <div class="form-group col-md-2">
                        <label for="last_name" class="form-label text-bold">Last name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="last_name"
                          placeholder="Search for last name"
                          name="last_name"
                          value="{{ Request::get('last_name') }}"
                        />

                      </div>
                      <div class="form-group col-md-2">
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
                      <div class="form-group col-md-2">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" name="gender">
                          <option value="">Select gender</option>
                          <option value="male" {{ Request::get('gender') == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ Request::get('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="mobile_number" class="form-label">Mobile</label>
                        <input
                          type="text"
                          class="form-control"
                          id="mobile_number"
                          placeholder="Search for mobile"
                          name="mobile_number"
                          value="{{ Request::get('mobile_number') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="marital_status" class="form-label text-bold">Marital status</label>
                        <input
                          type="text"
                          class="form-control"
                          id="marital_status"
                          placeholder="Search for marital status"
                          name="last_name"
                          value="{{ Request::get('marital_status') }}"
                        />

                      </div>
                      <div class="form-group col-md-2">
                        <label for="address" class="form-label text-bold">Address</label>
                        <input
                          type="text"
                          class="form-control"
                          id="address"
                          placeholder="Search for address"
                          name="address"
                          value="{{ Request::get('address') }}"
                        />

                      </div>

                      <div class="form-group col-md-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status">
                          <option value="">Select status</option>
                          <option value="100" {{ Request::get('status') == '100' ? 'selected' : '' }}>Active</option>
                          <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Inactive</option>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="admission_date" class="form-label">Admission date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="admission_date"
                          placeholder="Search for admission date"
                          name="admission_date"
                          value="{{ Request::get('admission_date') }}"
                        />
                      </div>
                      <div class="form-group col-md-3">
                        <label for="created_at" class="form-label">created date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="created_at"
                          placeholder="Search for created date"
                          name="created_at"
                          value="{{ Request::get('created_at') }}"
                        />
                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/teacher/list') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')
                <div class="card mb-4">
                  <div class="card-body p-0">
                  @if($getRecord->count() > 0)
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th >#</th>
                          <th>Profile pic</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Gender</th>
                          <th>Date of birth</th>
                          <th>Joining Date</th>
                          <th>Mobile</th>
                          <th>Marital status</th>
                          <th >Current address</th>
                          <th >Permanent address</th>
                          <th >Qualifications</th>
                          <th >Experience</th>
                          <th >Note</th>
                          <th >Status</th>
                          <th >Created date</th>
                          <th >Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($getRecord as $key => $value)
                        <tr>
                            <td>{{ $getRecord->firstItem() + $key }}</td>
                            <td>
                                @if(!empty($value->getProfile()))
                                <img src="{{ $value->getProfile() }}" alt="Profile pic" style="width: 50px; height: 50px; border-radius: 50%;">
                                @endif
                            </td>

                            <td>{{ $value->name }}{{ $value->last_name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->gender }}</td>
                            <td>
                                @if(!empty($value->date_of_birth))
                                {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                @endif
                            </td>
                            <td>
                            @if(!empty($value->admission_date))
                                {{ date('d-m-Y', strtotime($value->admission_date)) }}
                                @endif
                                </td>
                            <td>{{ $value->mobile_number }}</td>
                            <td>{{ $value->marital_status }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->permanent_address }}</td>
                            <td>{{ $value->qualification }}</td>
                            <td>{{ $value->work_experience }}</td>
                            <td>{{ $value->note }}</td>
                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                            <td>
                            @if(!empty($value->created_at))
                                {{ date('d-m-Y', strtotime($value->created_at)) }}
                                @endif
                                </td>
                            <td>
                              <a href="{{url('admin/teacher/edit/' .$value->id)}}" class="text-primary fs-5"><i class="bi bi-pencil"></i></a>
                              <x-confirm-delete
                                :url="url('admin/teacher/delete/' .$value->id)"
                                :id="$value->id"
                                title="Delete Teacher"
                                description="Are you sure you want to delete this teacher?"
                              />
                            </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">

                        {!! $getRecord-> appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    @else
                        <x-empty-state message="No administrators found in the system." />
                    @endif
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
