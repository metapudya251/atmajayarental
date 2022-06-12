<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0">
      <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-3"><span>AJR</span></div>
      </a>
      <hr class="sidebar-divider my-0" />
      <ul class="navbar-nav text-light" id="accordionSidebar">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pegawai.index') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('customer.read') }}"><i class="fas fa-user"></i><span>Data Customer</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transaksi.index') }}"><i class="fas fa-user"></i><span>Data Verifikasi</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transaksi.indexTransaksi') }}"><i class="fas fa-user"></i><span>Data Transaksi Berjalan</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transaksi.history') }}"><i class="fas fa-user"></i><span>History Transaksi</span></a>
        </li>
      </ul>
      <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
  </nav>