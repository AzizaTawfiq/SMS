@extends('layout.app')
@section("content")
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->


             <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning p-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="text-white">
                      <h3>{{$TotalStudents}}</h3>
                      <p class="mb-0">Total student</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi-person-video3"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/teacher/my_students')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success p-3" >
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{ $TotalClass }}</h3>
                      <p class="mb-0">Total class</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi bi-building"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/teacher/my_class_subject')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-info p-3" >
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{ $TotalSubject }}</h3>
                      <p class="mb-0">Total Subjects</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi bi-book-half"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/teacher/my_class_subject')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

             <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger p-3" >
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{$totalNoticeBoard}}</h3>
                      <p class="mb-0"> Total Notice Board</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi bi-pin-angle"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/teacher/my_notice_board')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>


          </div>
            <!--end::Row-->
            <!--begin::Row-->

            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>

      @endsection
