<nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <!-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li> -->
          </ul>
          <ul class="navbar-nav ms-auto">
           <!--  <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-chat-text"></i>
                <span class="navbar-badge badge text-bg-danger">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="{{ asset('dist/assets/img/user1-128x128.jpg') }}"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </h3>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>

                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                         src="{{ asset('dist/assets/img/user8-128x128.jpg') }}"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">I got your message bro</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="{{ asset('dist/assets/img/user3-128x128.jpg') }}"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">The subject goes here</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img  src="{{ Auth::user()->getProfile() }}" class="user-image rounded-circle shadow"
                  alt="{{ Auth::user()->name }}'s Profile Picture" />
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <li class="user-header bg-primary text-white">
                  <img src="{{ Auth::user()->getProfile() }}" class="rounded-circle shadow"alt="User Image" />
                  <p>
                     {{ Auth::user()->name }}
                    <small>{{ Auth::user()->email }}</small>
                  </p>
                </li>
                <li class="user-footer">
                  <a href="{{url('admin/account')}}" class="btn btn-default btn-flat">Profile</a>

                <a class="btn btn-default btn-flat float-end" href="{{url('logout')}}">
                  <p>Logout</p>
                </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>


      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <div class="info text-center ">
          <img src="{{ asset($globalSettings->Logo) }}" alt="Logo" style="width: 90px; height: 70px;" class="me-3">
          <h2 class="mb-0" style="color: white; border-bottom: 1px solid white;">{{ $globalSettings->site_name ?? 'University Name' }}</h2>
          </div>
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >

            @if(Auth::user()->role == 1)
            <li class="nav-item">
                  <a href="{{url('admin/dashboard')}}" class="nav-link">
                  <i class="nav-icon bi bi-speedometer2"></i>
                  <p>Dashboard</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/admin/list')}}" class="nav-link {{request()->is('admin/admin/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-person-gear"></i>
                  <p>Admins</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{url('admin/teacher/list')}}" class="nav-link {{request()->is('admin/teacher/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-person-workspace"></i>
                  <p>Teachers</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{url('admin/student/list')}}" class="nav-link {{request()->is('admin/student/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-mortarboard"></i>
                  <p>Students</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('admin/parent/list')}}" class="nav-link {{request()->is('admin/parent/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-people"></i>
                  <p>Parents</p>
                </a>
              </li>


            <li class="nav-item {{request()->is('admin/school_classes/*') || request()->is('admin/subjects/*') || request()->is('admin/assign_subject/*') || request()->is('admin/class_timetable/*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/school_classes/*') || request()->is('admin/subjects/*') || request()->is('admin/assign_subject/*') || request()->is('admin/class_timetable/*') ? 'active' : ''}}">
                <i class="nav-icon bi bi-mortarboard-fill"></i>
                <p>
                Academics
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/school_classes/list')}}" class="nav-link {{request()->is('admin/school_classes/*') ? 'active':''}}">
                    <i class="nav-icon bi bi-journal-text"></i>
                    <p>Classes</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/subjects/list')}}" class="nav-link {{request()->is('admin/subjects/*') ? 'active':''}}">
                    <i class="nav-icon bi bi-book"></i>
                    <p>Subjects</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/assign_subject/list')}}" class="nav-link {{request()->is('admin/assign_subject/*') ? 'active':''}}">
                    <i class="nav-icon bi bi-book"></i>
                    <p>Assign Subjects</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/assign_class_teacher/list')}}" class="nav-link {{request()->is('admin/assign_class_teacher/*') ? 'active':''}}">
                <i class="nav-icon bi bi-person-check"></i>
                    <p>Assign Class Teacher</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/class_timetable/list')}}" class="nav-link {{request()->is('admin/class_timetable/*') ? 'active':''}}">
                <i class="nav-icon bi bi-calendar3"></i>
                    <p>Class Timetable</p>
                </a>
                </li>
            </ul>
            </li>
            <li class="nav-item {{request()->is('admin/fees_collection/*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/fees_collection/*') ? 'active' : ''}}">
            <i class="nav-icon bi bi-cash-stack"></i>
                <p>
                Fees Collection
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/fees_collection/collect_fees')}}" class="nav-link {{request()->is('admin/fees_collection/collect_fees/*') ? 'active':''}}">
                <i class="nav-icon bi bi-wallet2"></i>
                    <p>Collect Fees</p>
                </a>
                </li>


            </ul>
            </li>
            <li class="nav-item {{request()->is('admin/examinations/*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/examinations/*') ? 'active' : ''}}">
            <i class="nav-icon bi bi-file-earmark-text"></i>
                <p>
                Examinations
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/examinations/exam/list')}}" class="nav-link {{request()->is('admin/examinations/exam/*') ? 'active':''}}">
                <i class="nav-icon bi bi-clipboard-check"></i>
                    <p>Exam List</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/examinations/exam_schedule')}}" class="nav-link {{request()->is('admin/examinations/exam_schedule/*') ? 'active':''}}">
                <i class="nav-icon bi bi-calendar2-week"></i>
                    <p>Exam Schedule</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/examinations/mark_register')}}" class="nav-link {{request()->is('admin/examinations/mark_register/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Marks Register</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/examinations/marks_grade')}}" class="nav-link {{request()->is('admin/examinations/marks_grade/*') ? 'active':''}}">
                <i class="nav-icon bi bi-bar-chart-fill"></i>
                    <p>Marks Grade</p>
                </a>
                </li>

            </ul>
            </li>
            <li class="nav-item {{request()->is('admin/attendance/*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/attendance/*') ? 'active' : ''}}">
            <i class="nav-icon bi bi-calendar2-check"></i>
                <p>
                Attendance
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/attendance/student')}}" class="nav-link {{request()->is('admin/attendance/student/*') ? 'active':''}}">
                <i class="nav-icon bi bi-person-check-fill"></i>
                    <p>Student Attendance</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/attendance/report')}}" class="nav-link {{request()->is('admin/attendance/report/*') ? 'active':''}}">
                <i class="nav-icon bi bi-clipboard2-data"></i>
                    <p>Attendance Report</p>
                </a>
                </li>

            </ul>
            </li>
            <li class="nav-item {{request()->is('admin/communicate/*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/communicate/*') ? 'active' : ''}}">
            <i class="nav-icon bi bi-chat-dots-fill"></i>
                <p>
                Communicate
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/communicate/notice_board')}}" class="nav-link {{request()->is('admin/communicate/notice_board/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pin-angle-fill"></i>
                    <p>Notice Board</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/communicate/send_email')}}" class="nav-link {{request()->is('admin/communicate/send_email/*') ? 'active':''}}">
                <i class="nav-icon bi bi-envelope-fill"></i>
                    <p>Send Email</p>
                </a>
                </li>

            </ul>
            </li>

            <li class="nav-item {{request()->is('admin/homework/*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/homework/*') ? 'active' : ''}}">
            <i class="nav-icon bi bi-journal-text"></i>
                <p>
                Homework
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/homework')}}" class="nav-link {{request()->is('admin/homework/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Homework</p>
                </a>
                </li>

                 <li class="nav-item">
                <a href="{{url('admin/homework/homework_report')}}" class="nav-link {{request()->is('admin/homework/homework_report') ? 'active':''}}">
                <i class="nav-icon bi bi-book	"></i>
                    <p>Homework Report</p>
                </a>
                </li>

            </ul>
            </li>

              <li class="nav-item">
                <a href="{{ url('admin/change_password') }}" class="nav-link {{ request()->is('admin/change_password') ? 'active' : '' }}">
                 <i class="nav-icon bi bi-shield-lock"></i>
                 <p>Change Password</p>
               </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/settings') }}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                <i class="nav-icon bi bi-gear"></i>
                 <p>Settings</p>
               </a>
              </li>


                  @elseif(Auth::user()->role == 2)
                  <li class="nav-item">
                  <a href="{{url('teacher/dashboard')}}" class="nav-link">
                  <i class="nav-icon fa fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('teacher/my_students')}}" class="nav-link {{request()->is('teacher/my_students/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-mortarboard"></i>
                  <p>Students</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{url('teacher/my_class_subject')}}" class="nav-link {{request()->is('teacher/my_class_subject/*') ? 'active':''}}">
                    <i class="nav-icon bi bi-book"></i>
                    <p>Classes and Subjects</p>
                </a>
                </li>
                </li>
                <li class="nav-item">
                <a href="{{ url('teacher/change_password') }}" class="nav-link {{ request()->is('admin/change_password') ? 'active' : '' }}">
                 <i class="nav-icon bi bi-shield-lock"></i>
                 <p>Change Password</p>
               </a>
              </li>
              <li class="nav-item">
                <a href="{{url('teacher/my_exam_timetable')}}" class="nav-link {{request()->is('teacher/my_exam_timetable/*') ? 'active':''}}">
                <i class="nav-icon bi bi-file-earmark-text"></i>
                  <p>Exam timetable</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('teacher/my_calendar')}}" class="nav-link {{request()->is('teacher/my_calendar/*') ? 'active':''}}">
                <i class="nav-icon bi bi-calendar-date"></i>
                  <p>Calendar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('teacher/mark_register')}}" class="nav-link {{request()->is('teacher/mark_register/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Marks register</p>
                </a>
                </li>

                <li class="nav-item {{request()->is('teacher/attendance/*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{request()->is('teacher/attendance/*') ? 'active' : ''}}">
                    <i class="nav-icon bi bi-calendar2-check"></i>
                        <p>
                        Attendance
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('teacher/attendance/student')}}" class="nav-link {{request()->is('teacher/attendance/student/*') ? 'active':''}}">
                <i class="nav-icon bi bi-person-check-fill"></i>
                    <p>Student Attendance</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('teacher/attendance/report')}}" class="nav-link {{request()->is('teacher/attendance/report/*') ? 'active':''}}">
                <i class="nav-icon bi bi-clipboard2-data"></i>
                    <p>Attendance Report</p>
                </a>
                </li>

            </ul>
            </li>
            <li class="nav-item {{request()->is('teacher/homework/*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('teacher/homework/*') ? 'active' : ''}}">
            <i class="nav-icon bi bi-journal-text"></i>
                <p>
                Homework
                <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('teacher/homework')}}" class="nav-link {{request()->is('teacher/homework/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Homework</p>
                </a>
                </li>

            </ul>
            </li>
            <li class="nav-item">
                <a href="{{url('teacher/my_notice_board')}}" class="nav-link {{request()->is('teacher/my_notice_board/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pin-angle-fill"></i>
                    <p>Notice Board</p>
                </a>
                </li>

                  @elseif(Auth::user()->role == 3)
                  <li class="nav-item">
                  <a href="{{url('student/dashboard')}}" class="nav-link">
                  <i class="nav-icon fa fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                 </a>
               </li>

            <li class="nav-item">
                 <a href="{{ url('student/fees_collection') }}" class="nav-link {{ request()->is('student/fees_collection') ? 'active' : '' }}">
                 <i class="nav-icon bi bi-cash-stack"></i>
                  <p>Fees Collection</p>
                </a>
            </li>
            <li class="nav-item">
                 <a href="{{ url('student/change_password') }}" class="nav-link {{ request()->is('admin/change_password') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-shield-lock"></i>
                  <p>Change Password</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('student/my_subjects')}}" class="nav-link {{request()->is('student/my_subjects/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-book"></i>
                  <p>Subjects</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="{{url('student/my_timetable')}}" class="nav-link {{request()->is('student/my_timetable/*') ? 'active':''}}">
                <i class="nav-icon bi bi-calendar3"></i>
                  <p>Timetable</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="{{url('student/my_exam_timetable')}}" class="nav-link {{request()->is('student/my_exam_timetable/*') ? 'active':''}}">
                <i class="nav-icon bi bi-file-earmark-text"></i>
                  <p>Exam timetable</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('student/my_exam_result')}}" class="nav-link {{request()->is('student/my_exam_result/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Exam Result</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('student/my_attendance')}}" class="nav-link {{request()->is('student/my_attendance/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Attendance</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('student/my_notice_board')}}" class="nav-link {{request()->is('student/my_notice_board/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pin-angle-fill"></i>
                    <p>Notice Board</p>
                </a>
                </li>
                </li>
                <li class="nav-item">
                <a href="{{url('student/my_homework')}}" class="nav-link {{request()->is('student/my_homework/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Homework</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('student/my_submitted_homework')}}" class="nav-link {{request()->is('student/my_submitted_homework/*') ? 'active':''}}">
                <i class="nav-icon bi bi-pencil-square"></i>
                    <p>Submitted Homework</p>
                </a>
                </li>
              <li class="nav-item">
                <a href="{{url('student/my_calendar')}}" class="nav-link {{request()->is('student/my_calendar/*') ? 'active':''}}">
                <i class="nav-icon bi bi-calendar-date"></i>
                  <p>Calendar</p>
                </a>
              </li>

            <li class="nav-item">
                <a href="{{ url('student/change_password') }}" class="nav-link {{ request()->is('admin/change_password') ? 'active' : '' }}">
                 <i class="nav-icon bi bi-shield-lock"></i>
                 <p>Change Password</p>
               </a>
              </li>

                  @else(Auth::user()->role == 4)
                  <li class="nav-item">
                  <a href="{{url('parent/dashboard')}}" class="nav-link">
                  <i class="nav-icon fa fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
                </li>

                <li class="nav-item">
                  <a href="{{url('parent/account')}}" class="nav-link">
                  <i class="nav-icon bi-person-lines-fill"></i>
                  <p>My Account</p>
                 </a>
               </li>

               <li class="nav-item">
               <a href="{{ url('parent/my_student') }}" class="nav-link">
               <i class="nav-icon bi-people-fill	"></i>
                  <p>My Students</p>
                 </a>
               </li>

                <li class="nav-item">
                 <a href="{{ url('parent/change_password') }}" class="nav-link {{ request()->is('admin/change_password') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-shield-lock"></i>
                  <p>Change Password</p>
                </a>
               </li>

                  @endif

              </li>
            </ul>
          </nav>
        </div>
      </aside>
