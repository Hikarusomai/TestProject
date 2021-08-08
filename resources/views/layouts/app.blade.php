<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name='csrf-token' content='{{ csrf_token() }}'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> 
  <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">   
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> 
  <link rel="stylesheet" href="{{ asset('css/overlayScrollbars/css/OverlayScrollbars.min.css') }}">  
  <link rel="stylesheet" href="{{ asset('dist/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> -->
  <link rel="stylesheet" href="{{ asset('css/style.css' )}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed"> 
<div class="wrapper">  
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> 
      <li class="nav-item dropdown"> 
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-alt"></i> Hi {{ Auth::user()->first_name ? ucfirst(Auth::user()->first_name) : '' }}!
          <!-- <span class="badge badge-warning navbar-badge"></span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div> 
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i> Log out
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
    </ul>
  </nav> 
 
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4"> 
    <a href="" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-bold">ProjectTest</span>
    </a>
 
    <div class="sidebar">
         
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link @if(Route::is('home')) active @endif}}">
                <i class="fas fa-home nav-icon"></i>
                <p>Dashboard</p>
                </a>
            </li>
            @if(auth()->user()->type == 'internal')
            <li class="nav-item">
                <a href="{{ route('companies') }}" class="nav-link @if(Route::is('companies')) active @endif}}">
                <i class="fas fa-building nav-icon"></i>
                <p>Companies</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employees') }}" class="nav-link @if(Route::is('employees')) active @endif}}">
                <i class="fas fa-users nav-icon"></i>
                <p>Employees</p>
                </a>
            </li>
            @endif
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Level 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Level 2
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>  -->
        </ul>
      </nav> 
    </div>
    
  </aside>
 
  <div class="content-wrapper">
    @yield('content')   
  </div> 

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>ProjectTest</b> 
    </div>
    <!-- <strong>ProjectTest</strong> -->
  </footer>
 
  <aside class="control-sidebar control-sidebar-dark"> 
  </aside> 
</div> 
 
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<script src="{{ asset('css/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> 
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script> 
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>  
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('dist/toastr/toastr.min.js') }}"></script>
@yield('scripts')
</body>
</html>
