@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Class timetables </h3></div>
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
                        <label for="class_id" class="form-label text-bold">class</label>
                        <select name="class_id" id="class_id" class="form-control getClass" required>
                            <option value="">Select class</option>
                            @foreach($school_classes as $class)
                                <option value="{{ $class->id }}" >{{ $class->name }}</option>
                            @endforeach
                        </select>


                      </div>
                      <div class="form-group col-md-3">
                        <label for="subject_id" class="form-label text-bold">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control getSubject" required>
                            <option value="">Select subject</option>

                        </select>

                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/class_timetable/list') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection

      @section('scripts')
      @section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        // Remove the  statement
        $('.getClass').on('change', function(){
            var class_id = $(this).val();
            console.log('Class ID selected:', class_id);
            $.ajax({
                url: "{{ url('admin/class_timetable/get_subject') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    class_id: class_id
                },
                dataType: 'json',

                success: function(response){

                    $('.getSubject').html(response.html);
                }
            });
        });
    });
</script>
@endsection



