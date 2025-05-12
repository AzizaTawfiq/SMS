@extends('layout.app')
@section("content")
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Notice board</h3></div>
              <div class="col-sm-6 text-end">
                <a href="{{ url('admin/communicate/notice_board/add') }}" class="btn btn-primary">Add notice board</a>
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
                        <label for="title" class="form-label fw-bold">title</label>
                        <input
                          type="text"
                          class="form-control"
                          id="title"
                          placeholder="Search for title"
                          name="title"
                          value="{{ Request::get('title') }}"
                        />

                      </div>
                      <div class="form-group col-md-3">
                        <label for="notice_date_from" class="form-label">Notice date from</label>
                        <input
                          type="date"
                          class="form-control"
                          id="notice_date_from"
                          name="notice_date_from"
                          value="{{ Request::get('notice_date_from') }}"
                        />
                      </div>
                      <div class="form-group col-md-3">
                        <label for="notice_date_to" class="form-label">Notice date to</label>
                        <input
                          type="date"
                          class="form-control"
                          id="notice_date_to"
                          name="notice_date_to"
                          value="{{ Request::get('notice_date_to') }}"
                        />
                      </div>
                      <div class="form-group col-md-3">
                        <label for="publish_date_from" class="form-label">Publish date from</label>
                        <input
                          type="date"
                          class="form-control"
                          id="publish_date_from"
                          name="publish_date_from"
                          value="{{ Request::get('publish_date_from') }}"
                        />
                      </div>
                      <div class="form-group col-md-3">
                        <label for="publish_date_to" class="form-label">Publish date to</label>
                        <input
                          type="date"
                          class="form-control"
                          id="publish_date_to"
                          name="publish_date_to"
                          value="{{ Request::get('publish_date_to') }}"
                        />
                      </div>
                      <div class="form-group col-md-3">
                        <label for="created_date" class="form-label">Created date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="created_date"
                          name="created_date"
                          value="{{ Request::get('created_date') }}"
                        />
                      </div>
                      <div class="form-group col-md-2">
                        <label for="status" class="form-label">Message to</label>
                        <select class="form-control" name="message_to">
                          <option value="">Select</option>
                          <option value="2" {{ Request::get('message_to') == '2' ? 'selected' : '' }}>Teacher</option>
                          <option value="3" {{ Request::get('message_to') == '3' ? 'selected' : '' }}>Student</option>
                          <option value="4" {{ Request::get('message_to') == '4' ? 'selected' : '' }}>Parent</option>
                        </select>
                      </div>
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('admin/communicate/notice_board') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
              @include('_message')
                <div class="card mb-4">
                  <div class="card-body p-0">
                  @if($getRecord && $getRecord->count() > 0)
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Notice date</th>
                          <th>Publish date</th>
                          <th>Message to</th>
                          <th>Created by</th>
                          <th>Created date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($getRecord as $key => $value)
                        <tr>
                            <td>{{ $getRecord->firstItem() + $key }}</td>
                            <td>{{ $value->title }}</td>
                            <td>
                                {{ date('d-m-Y H:i A', strtotime($value->notice_date)) }}
                            </td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->publish_date)) }}</td>
                            <td>
                                @foreach($value->getMessage as $message)
                                @if(  $message->message_to == 2)
                                <span class="badge bg-primary">Teacher</span>
                                @elseif($message->message_to == 3)
                                <span class="badge bg-primary">Student</span>
                                @elseif($message->message_to == 4)
                                <span class="badge bg-primary">Parent</span>
                                @endif
                                @endforeach
                            </td>
                            <td>{{$value->created_name }}</td>
                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>

                            <td>
                              <a href="{{url('admin/communicate/notice_board/edit/' .$value->id)}}" class="text-primary fs-5"><i class="bi bi-pencil"></i></a>
                              <x-confirm-delete
                                :url="url('admin/communicate/notice_board/delete/' .$value->id)"
                                :id="$value->id"
                                title="Delete notice board"
                                description="Are you sure you want to delete this notice board?"
                              />
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    @else
                        <x-empty-state message="No notice boards found in the system." />
                    @endif

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      @endsection
