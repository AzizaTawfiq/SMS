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
                <img
                  src="{{ asset('dist/assets/img/user2-160x160.jpg') }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>    
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <li class="user-header bg-primary text-white">  
                  <img
                    src="{{ asset('dist/assets/img/user2-160x160.jpg') }}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    {{ Auth::user()->name }}
                    <small>{{ Auth::user()->email }}</small>
                  </p>
                </li>
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                 
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
      <div class="info text-center mt-4">
            <i class="bi bi-mortarboard-fill fs-1 text-white" style="opacity: .8"></i>
            <!-- <a href="#" class="ms-2">{{Auth::user()-> name}}</a> -->
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
                  <p>Admin</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{url('admin/teacher/list')}}" class="nav-link {{request()->is('admin/teacher/*') ? 'active':''}}">
                  <i class="nav-icon fa fa-user"></i>
                  <p>Teacher</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="{{url('admin/student/list')}}" class="nav-link {{request()->is('admin/student/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-mortarboard"></i>
                  <p>Student</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('admin/parent/list')}}" class="nav-link {{request()->is('admin/parent/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-people"></i>
                  <p>Parent</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('admin/school_classes/list')}}" class="nav-link {{request()->is('admin/school_classes/*') ? 'active':''}}">
                  <i class="nav-icon bi bi-journal-text"></i>
                  <p>School Classes</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="{{url('admin/account')}}" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>My account</p>
                </a>
                </li>

              <li class="nav-item">
                <a href="{{url('admin/subjects/list')}}" class="nav-link {{request()->is('admin/subjects/*') ? 'active':''}}">
                  <i class="nav-icon fa fa-user"></i>
                  <p>School Subjects</p>
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
                  <a href="{{url('teacher/account')}}" class="nav-link">
                  <i class="nav-icon far fa-user"></i>
                  <p>My account</p>
                </a>
                </li>
                  @elseif(Auth::user()->role == 3)
                  <li class="nav-item">
                  <a href="{{url('student/dashboard')}}" class="nav-link">
                  <i class="nav-icon fa fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
            </li>
                  @else(Auth::user()->role == 4)
                  <li class="nav-item">
                  <a href="{{url('parent/dashboard')}}" class="nav-link">
                  <i class="nav-icon fa fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
                </li>
                  @endif

              </li>
            </ul>
          </nav>
        </div>
      </aside>
