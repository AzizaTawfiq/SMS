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
              <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-info p-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="text-white">
                      <h3>150</h3>
                      <p class="mb-0">All Time Received Payment</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi-receipt-cutoff"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/admin/payment')}}" class="small-box-footer mt-2 d-block text-white">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 1-->
              </div>

                           <div class="col-lg-3 col-6">
              <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-success p-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>150</h3>
                      <p class="mb-0">Today Received Payment</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi-credit-card-fill"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/admin/')}}" class="small-box-footer mt-2 d-block text-white">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 1-->
              </div>

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
                  <a href="{{url('/admin/student/list')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

             <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary  p-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{$TotalTeachers}}</h3>
                      <p class="mb-0">Total Teachers</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi-person-video2"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/admin/teacher/list')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-secondary p-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{$TotalParents}}</h3>
                      <p class="mb-0">Total Parents</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi-house-heart-fill"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/admin/parent/list')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger p-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{$TotalAdmin}}</h3>
                      <p class="mb-0">Total Admin</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi-person-check-fill"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/admin/admin/list')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-gold p-3" style="background-color: #FFD700; color: #fff;">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{$TotalExam}}</h3>
                      <p class="mb-0">Total Exam</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi bi-journal-check"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/admin/examinations/exam/list')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success p-3" >
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{$TotalClass}}</h3>
                      <p class="mb-0">Total class</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi bi-building"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/admin/school_classes/list')}}" class="small-box-footer mt-2 d-block text-white ">
                    More info <i class="fas fa-arrow-circle-right"></i> </a>
              </div>
            </div>

                        <div class="col-lg-3 col-6">
                <div class="small-box text-bg-info p-3" >
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h3>{{$TotalSubject}}</h3>
                      <p class="mb-0">Total Subjects</p>
                    </div>
                    <div class="ms-3 fs-1">
                      <i class="bi bi-book-half"  style="font-size: 4rem; opacity: 0.4; color: #ffffff;"></i>
                    </div>
                  </div>
                  <a href="{{url('/admin/subjects/list')}}" class="small-box-footer mt-2 d-block text-white ">
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
