<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Atma Jaya Rental</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}" />
    
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js') }}"></script>
  </head>

  @auth
    <body id="page-top">
      <div id="wrapper">
      <!-- Sidebar --> 
      @if (Auth::guard('pegawai')->user()->role->nama_role == "Manager")
        @include('partials.sidebarManager')
      @endif
      @if (Auth::guard('pegawai')->user()->role->nama_role == "Admin")
        @include('partials.sidebarAdmin')
      @endif
      @if (Auth::guard('pegawai')->user()->role->nama_role == "Customer Service")
        @include('partials.sidebarCs') 
      @endif
      
        <!-- Navbar -->
        <div class="d-flex flex-column" id="content-wrapper">
          <div id="content">
              <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                  <div class="container-fluid">
                    <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button><strong>Selamat Datang,&nbsp;</strong>
                    <ul class="navbar-nav flex-nowrap ms-auto">
                      <li class="nav-item dropdown no-arrow">
                        <div class="nav-item dropdown no-arrow">
                          <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                            <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::guard('pegawai')->user()->nama_pegawai }}</span>
                            @if (Auth::guard('pegawai')->user()->img == NULL)
                              <img class="border rounded-circle img-profile" src="{{ url('assets/img/avatars/avatar6.jpeg') }}"/>
                            @else
                              <img class="border rounded-circle img-profile" src="{{ url('fotopgw/',Auth::guard('pegawai')->user()->img) }}"/>
                            @endif
                            
                          </a>
                          <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                            <a class="dropdown-item" href="{{ route('pegawai.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                              <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                            </a>
                            <form action="{{ route('pegawai.logout') }}" id="logout-form" method="post">@csrf</form>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </nav>

            <!-- content -->
            <div class="container-fluid">
              {{-- @if (Auth::guard('pegawai')->user()->role_id == 1) --}}
                @yield('pegawai-view')
              {{-- @endif --}}
              
            </div>
          </div>
          <footer class="bg-white sticky-footer">
            <div class="container my-auto">
              <div class="text-center my-auto copyright"><span>Copyright © Atma Jaya Rental 2022</span></div>
            </div>
          </footer>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
      <script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
      <script src="{{ url('assets/js/theme.js') }}"></script>
    </body> 
  @endauth
  
</html>
