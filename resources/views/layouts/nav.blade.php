<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

    {{-- <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li> --}}
  </ul>

  <!-- SEARCH FORM -->
  {{-- <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form> --}}

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <li class="nav-item">
          <button type="submit" name="logout" class="nav-link btn btn-link">
            <i class="fa fa-sign-out"></i> Logout
          </button>
        </li>
    </form>
    <!-- Notifications Dropdown Menu -->

    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li> -->
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <span class="brand-text font-weight-light">LucuBanget</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      {{-- <div class="image">
        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div> --}}
      <div class="info">
        <a href="#" class="d-block">@if(Auth::user())
          {{Auth::user()->name}}
        @endisset</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if (Auth::user()->isAdmin)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-angle-left right"></i>
              <i class="fa fa-warehouse nav-icon text-primary"></i>
              <p>Gudang</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/items" class="nav-link">
                  <i class="fa fa-boxes nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/items/add" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Tambah Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-angle-left right"></i>
              <i class="fa fa-retweet nav-icon text-success"></i>
              <p>Transaksi</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/transaction/new&method=in" class="nav-link">
                  <i class="fa fa-sign-in-alt nav-icon"></i>
                  <p>Transaksi Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/transaction/new&method=out" class="nav-link">
                  <i class="fa fa-sign-out-alt nav-icon"></i>
                  <p>Pesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/transactions" class="nav-link">
                  <i class="fa fa-history nav-icon"></i>
                  <p>Data Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/admin/vendors/add" class="nav-link">
              <i class="fa fa-user-tie nav-icon text-info"></i>
              <p>Vendor</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/clients/add" class="nav-link">
              <i class="fa fa-users nav-icon text-warning"></i>
              <p>Klien</p>
            </a>
          </li>
        @else
          <li class="nav-item">
            <a href="/client/order" class="nav-link">
              <i class="fa fa-shopping-cart nav-icon text-primary"></i>
              <p>Pesan Barang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/client/orders&user={{Auth::user()->id}}" class="nav-link">
              <i class="fa fa-history nav-icon text-info"></i>
              <p>Histori Pesanan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/client/order" class="nav-link">
              <i class="fa fa-shopping-cart nav-icon text-warning"></i>
              <p>Akun</p>
            </a>
          </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
