@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Add Grade</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <form action="{{ url('admin/examinations/marks_grade/add')}}" method="post">
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

                          value="{{ old('name') }}"
                        />
                        <div class="text-danger">
                        {{$errors->first('name')}}
                        </div>
                      </div>
                      <div class="row mt-3">
                      <div class="form-group col-6">
                        <label for="percent_from" class="form-label text-bold">Percent from</label>
                        <input
                          type="number"
                          class="form-control"
                          id="percent_from"
                          placeholder="Enter percent from"
                          name="percent_from"

                          value="{{ old('percent_from') }}"
                        />
                        <div class="text-danger">
                        {{$errors->first('percent_from')}}
                        </div>
                      </div>
                      <div class="form-group col-6">
                        <label for="percent_to" class="form-label text-bold">Percent to</label>
                        <input
                          type="number"
                          class="form-control"
                          id="percent_to"
                          placeholder="Enter percent to"
                          name="percent_to"

                          value="{{ old('percent_to') }}"
                        />
                        <div class="text-danger">
                        {{$errors->first('percent_to')}}
                        </div>
                      </div>
                      </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Add</button>
                      <a href="{{ url('admin/examinations/marks_grade') }}" class="btn btn-outline-primary ms-2">Cancel</a>
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
