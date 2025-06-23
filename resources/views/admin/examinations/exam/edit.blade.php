@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Edit exam</h3></div>
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
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          placeholder="Enter name"
                          name="name"

                          value="{{ $getRecord->name }}"
                        />
                        <div class="text-danger">
                        {{$errors->first('name')}}
                        </div>
                      </div>
                      <div class="form-group">
                                <label for="note" class="form-label fw-bold">Notes</label>
                                <textarea
                                class="form-control"
                                id="note"
                                name="note"
                                placeholder="Enter note"
                                >{{ $getRecord->note }}</textarea>
                                <div class="text-danger">
                                {{$errors->first('note')}}
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <a href="{{ url('admin/examinations/exam/list') }}" class="btn btn-outline-primary ms-2">Cancel</a>
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
