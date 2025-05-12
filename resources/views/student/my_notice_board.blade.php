@extends('layout.app')
@section("content")
<main class="app-main">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>My notice board</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
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
                      <div class="form-group col-md-3" style="margin-top: 30px;">
                       <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                       <a href="{{ url('student/my_notice_board') }}" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i></a>
                      </div>
                    </div>
                  </form>
                </div>
</div>
            @if($getRecord->count() > 0)
        @foreach($getRecord as $value)
        <div class="col-md-12 mt-3">
          <div class="card card-primary card-outline">

            <div class="card-body p-0">
                <div class="">
                    <h5>{{$value->title}}</h5>
                    <h6 >{{date('d-m-Y', strtotime($value->notice_date))}}</h6>
              </div>

              <div class="">
               {{$value->message}}
              </div>
            </div>

        </div>
        @endforeach
        <div class="d-flex justify-content-center mt-4">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
        @else
                        <x-empty-state message="No notice boards found in the system." />
                    @endif
      </div>

      </div>
    </section>
      </main>

      @endsection
