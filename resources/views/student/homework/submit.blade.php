@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">submit homework</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <form action="" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    <div class="row card-body">
                        <div class="form-group mb-3">
                        <label for="document_file" class="form-label fw-bold mb-3">Document</label>
                        <input
                          type="file"
                          class="form-control"
                          id="document_file"
                          name="document_file"
                        />
                        <div class="text-danger">
                        {{$errors->first('document_file')}}
                        </div>
                      </div>

                      <div class="form-group fw-bold mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="compose-textarea" class="form-control" style="height: 300px">

                    </textarea>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="{{ url('student/my_homework') }}" class="btn btn-outline-primary ms-2">Cancel</a>
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

      @section("scripts")
      <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
            <script>
                $(document).ready(function() {

                    $('#compose-textarea').summernote({
                        height: 300,
                        callbacks: {
                            onInit: function() {
                                console.log('Summernote initialized');
                            }
                        }
                    });
                });
            </script>
            @endsection


