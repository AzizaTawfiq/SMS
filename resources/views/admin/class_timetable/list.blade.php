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
              @include('_message')
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
                                <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id }}" >{{ $class->name }}</option>
                            @endforeach
                        </select>


                      </div>
                      <div class="form-group col-md-3">
                        <label for="subject_id" class="form-label text-bold">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-control getSubject" required>
                            <option value="">Select subject</option>
                            @if(!empty($getSubject))
                            @foreach($getSubject as $subject)
                                <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : ''}} value="{{ $subject->subject_id }}" >{{ $subject->subject_name }}</option>
                            @endforeach
                            @endif
                        </select>

                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/class_timetable/list') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
                @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
                <form action="{{ url('admin/class_timetable/add')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="subject_id" value="{{ Request::get('subject_id')}}">
                <input type="hidden" name="class_id" value="{{ Request::get('class_id')}}">
                    <div class="card mb-4">
                      <div class="card-body p-0">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                              <th>Week</th>
                              <th>Start time</th>
                              <th>End time</th>
                              <th>Room number</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($week as  $value)
                            <tr>
                                <th>
                                <input type="hidden" name="timetable[{{$i}}][week_id]" value="{{ $value['week_id'] }}">
                                    {{ $value['week_name'] }}
                                </th>
                                <td>
                                    <input name="timetable[{{$i}}][start_time]" class="form-control" type="time" value="{{ $value['start_time'] ?? '' }}" />
                                </td>
                                <td>
                                    <input name="timetable[{{$i}}][end_time]" class="form-control" type="time" value="{{ $value['end_time'] ?? '' }}" />
                                </td>
                                <td>
                                    <input name="timetable[{{$i}}][room_number]" class="form-control" type="text" value="{{ $value['room_number'] ?? '' }}" style="width:150px" />
                                </td>
                            </tr>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                          </tbody>
                        </table>
                        <div class="p-3">
                            <button class="btn btn-primary">Add</button>
                        </div>
                      </div>
                    </div>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection

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



