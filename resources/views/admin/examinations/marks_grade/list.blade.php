@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Marks grade</h3></div>
              <div class="col-sm-6 text-end">
                <a href="{{ url('admin/examinations/marks_grade/add') }}" class="btn btn-primary">Add Grade</a>
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
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/examinations/marks_grade') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
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
                          <th>Grade name</th>
                          <th>Percent from <b>(%)</b></th>
                          <th>Percent to <b>(%</b>)</th>
                          <th>Created by</th>
                          <th>Created date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getRecord as $value)
                        <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->percent_from }}</td>
                            <td>{{ $value->percent_to }}</td>
                            <td>{{ $value->created_name}}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                            <td>
                              <a href="{{url('admin/examinations/marks_grade/edit/' .$value->id)}}" class="text-primary fs-5"><i class="bi bi-pencil"></i></a>
                              <x-confirm-delete
                                :url="url('admin/examinations/marks_grade/delete/' .$value->id)"
                                :id="$value->id"
                                title="Delete Grade"
                                description="Are you sure you want to delete this grade?"
                              />
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    @else
                        <x-empty-state message="No grades found in the system." />
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
