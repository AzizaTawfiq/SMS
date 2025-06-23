@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Send email</h3></div>
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
                        <label for="subject" class="form-label fw-bold">Subject</label>
                        <input
                          type="text"
                          class="form-control"
                          id="subject"
                          placeholder="Enter subject"
                          name="subject"
                        />
                        <div class="text-danger">
                        {{$errors->first('subject')}}
                        </div>
                      </div>
                      <div class="form-group">
                        <label>User (Teacher / Student / Parent)</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
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
                      <button type="submit" class="btn btn-primary">Send email</button>
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
      <script src="{{ asset('dist/plugins/summernote/summernote-bs4.min.js') }}"></script>

     <script type="text/javascript">
         $(function () {
    $('#compose-textarea').summernote()
  })
     </script>
      @endsection
