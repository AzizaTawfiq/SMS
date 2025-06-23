@extends('layout.app')
@section("content")

<div class="app-wrapper">
      <main class="app-main">
      <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Add homework</h3></div>
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
                    <div class="col-12 col-md-6 form-group mb-3">
                                <label class="form-label fw-bold">Class</label>
                                <select name="class_id" class="form-select getClass" >
                                    <option value="">Select Class</option>
                                    @foreach ($getClass as $class)
                            <option
                           
                             value="{{ $class->id }}">{{ $class->name }}
                            </option>
                          @endforeach  

                                </select>
                            </div>
                            <div class="col-12 col-md-6 form-group mb-3">
                        <label for="subject_id" class="form-label fw-bold">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control getSubject" required>
                            <option value="">Select subject</option>
                           
                        </select>

                      </div>
                        <div class="col-12 col-md-6 form-group mb-3">
                        <label for="homework_date" class="form-label fw-bold">Homework date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="homework_date"
                          placeholder="Enter homework date"
                          name="homework_date"
                        />
                        <div class="text-danger">
                        {{$errors->first('homework_date')}}
                        </div>
                      </div>  
                        <div class="col-12 col-md-6 form-group mb-3">
                        <label for="submission_date" class="form-label fw-bold">Submission date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="submission_date"
                          placeholder="Enter submission date"
                          name="submission_date"
                        />
                        <div class="text-danger">
                        {{$errors->first('submission_date')}}
                        </div>
                      </div>
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
                      <button type="submit" class="btn btn-primary">Add</button>
                      <a href="{{ url('admin/homework') }}" class="btn btn-outline-primary ms-2">Cancel</a>
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
                              $('.getClass').on('change', function(){
            var class_id = $(this).val();
            $.ajax({
                url: "{{ url('admin/ajaxGetSubject') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    class_id: class_id
                },
                dataType: 'json',

                success: function(response){

                    $('.getSubject').html(response.message);
                }
            });
        });
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

            
