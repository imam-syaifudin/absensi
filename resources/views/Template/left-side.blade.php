<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/karisma.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @if ( auth()->user()->level == "user")
           <a href="#" class="d-block">{{ auth()->user()->name . " ". auth()->user()->pengaturan->sesi }}</a>
           @else 
           <a href="#" class="d-block">{{ auth()->user()->name }}</a>
          @endif
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            @if ( auth()->user()->level == "admin")
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Data Peserta
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('setting')}}" class="nav-link active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Pengaturan</p>
                </a>
              </li>
              @endif
            @if ( auth()->user()->level == "user")
              <li class="nav-item">
                <a href="{{ url('users/' . auth()->user()->id . '/absen') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tempat Absen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('users/' . auth()->user()->id . '/pulang') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Absen Pulang</p>
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a href="{{ route('logout')}}" class="nav-link active">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Log Out</p>
                </a>
              </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>