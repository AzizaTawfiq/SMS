@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Add notice board</h3></div>
            </div>
        </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row g-4">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <form action="{{ url('admin/communicate/notice_board/add')}}" method="post">
                  {{ csrf_field() }}

                    <div class="card-body">
                      <div class="form-group">
                        <label for="title" class="form-label fw-bold">Title</label>
                        <input
                          type="text"
                          class="form-control"
                          id="title"
                          placeholder="Enter title"
                          name="title"
                        />
                        <div class="text-danger">
                        {{$errors->first('title')}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="notice_date" class="form-label fw-bold">Notice date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="notice_date"
                          placeholder="Enter notice date"
                          name="notice_date"
                        />
                        <div class="text-danger">
                        {{$errors->first('notice_date')}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="publish_date" class="form-label fw-bold">Publish date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="publish_date"
                          placeholder="Enter publish date"
                          name="publish_date"
                        />
                        <div class="text-danger">
                        {{$errors->first('publish_date')}}
                        </div>
                      </div>
                      <div class="form-group my-3">
                        <div for="title" class="form-label fw-bold">Message to</div>
                        <label class="me-3">
                            <input type="checkbox" class="form-check-input" name="message_to[]" value="2"> Teacher
                            </label>
                        <label class="me-3">
                            <input type="checkbox" class="form-check-input" name="message_to[]" value="3"> Student
                            </label>
                        <label class="me-3">
                            <input type="checkbox" class="form-check-input" name="message_to[]" value="4"> Parent
                            </label>
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="message" class="form-label fw-bold">Message</label>
                        <textarea name="message" id="compose-textarea" class="form-control" style="height: 300px">

                    </textarea>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Add</button>
                      <a href="{{ url('admin/communicate/notice_board') }}" class="btn btn-outline-primary ms-2">Cancel</a>
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
