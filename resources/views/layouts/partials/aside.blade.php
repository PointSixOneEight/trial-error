<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src=" {{ asset ('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route ('admin.dashboard')}} " class="nav-link {{request()->is('admin/dashboard') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route ('admin.accounts')}} " class="nav-link {{request()->is('admin/accounts') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Trades
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link  {{request()->is('admin/appointments') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Hodle
              </p>
            </a>
          </li>

             <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>