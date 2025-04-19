<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Login Page v2" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />

    <!-- <link rel="stylesheet" href="{{url('public/dist/css/adminlte.css')}}" /> -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}" />
  </head>
  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1 class="mb-0">Welcome Back</h1>

        </div>
        <div class="card-body login-card-body">
          <p class="login-box-msg">Log in, so we can get to know you </p>
          @include('_message')
          <form action="{{ url('login')}}" method="post">
            {{ csrf_field() }}
            <div class="input-group mb-4">
              <div class="form-floating">
                <input id="loginEmail" type="email" class="form-control" required name="email" value="" placeholder="Enter your email" />
                <label for="loginEmail">Enter your email</label>
              </div>
              <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            <div class="input-group mb-4">
              <div class="form-floating">
                <input id="loginPassword" type="password" class="form-control" name="password" placeholder="" />
                <label for="loginPassword">Enter your password</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="row">
              <div class="col-8 d-inline-flex align-items-center">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember" />
                  <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                </div>
              </div>
              <div class="col-4">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary">Login In</button>
                </div>
              </div>
            </div>
          </form>
          <div class="mb-4"><a class="text-primary" href="{{url('forgot-password')}}">I forgot my password</a></div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
  </body>
</html>
