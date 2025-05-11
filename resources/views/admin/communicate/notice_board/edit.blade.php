@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Edit notice board</h3></div>
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
                        <label for="title" class="form-label text-bold">Title</label>
                        <input
                          type="text"
                          class="form-control"
                          id="title"
                          placeholder="Enter title"
                          name="title"
                          value="{{$getRecord->title}}"
                        />
                        <div class="text-danger">
                        {{$errors->first('title')}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="notice_date" class="form-label text-bold">Notice date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="notice_date"
                          placeholder="Enter notice date"
                          name="notice_date"
                          value="{{$getRecord->notice_date}}"
                        />
                        <div class="text-danger">
                        {{$errors->first('notice_date')}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="publish_date" class="form-label text-bold">Publish date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="publish_date"
                          placeholder="Enter publish date"
                          name="publish_date"
                          value="{{$getRecord->publish_date}}"
                        />
                        <div class="text-danger">
                        {{$errors->first('publish_date')}}
                        </div>
                      </div>
                      @php
                      $message_to_teacher = $getRecord->getMessageToSingle($getRecord->id,2);
                      $message_to_student = $getRecord->getMessageToSingle($getRecord->id,3);
                      $message_to_parent = $getRecord->getMessageToSingle($getRecord->id,4);
                      @endphp
                      <div class="form-group my-3">
                        <div for="title" class="form-label text-bold">Message to</div>
                        <label class="me-3">
                            <input {{!empty($message_to_teacher) ? 'checked' : ''}} type="checkbox" class="form-check-input" name="message_to[]" value="2"> Teacher
                            </label>
                        <label class="me-3">
                            <input {{!empty($message_to_student) ? 'checked' : ''}} type="checkbox" class="form-check-input" name="message_to[]" value="3"> Student
                            </label>
                        <label class="me-3">
                            <input {{!empty($message_to_parent) ? 'checked' : ''}} type="checkbox" class="form-check-input" name="message_to[]" value="4"> Parent
                            </label>
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="message" class="form-label text-bold">Message</label>
                        <textarea name="message" id="compose-textarea" class="form-control" style="height: 300px">
                        {{$getRecord->message}}
                    </textarea>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
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

      @section("script")
      <script src="{{ asset('dist/plugins/summernote/summernote-bs4.min.js') }}"></script>

     <script type="text/javascript">
         $(function () {
    $('#compose-textarea').summernote()
  })
     </script>
      @endsection
