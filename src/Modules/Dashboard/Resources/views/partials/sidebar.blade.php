<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.index')}}" class="brand-link">
        <img src="{{ asset('images/brand/DCLogo.png') }}" alt="DCounter Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('dashboard.name', 'DCounter') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('dashboard.index')}}" class="nav-link {{set_active('dashboard.index')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>@lang("dashboard::sidebar.dashboard_link_name")</p>
                    </a>
                </li>

                @role('superadministrator')
                <li class="nav-item {{set_active('dashboard.admin.*','menu-open')}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            @lang('dashboard::sidebar.admin_link_name')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{route('dashboard.admin.users.index')}}"
                               class="nav-link {{set_active('dashboard.admin.users.*')}}"
                            >
                                <i class="fas fa-users nav-icon"></i>
                                <p>@lang('dashboard::sidebar.users_link_name')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user nav-icon"></i>
                                <p>@lang('dashboard::sidebar.roles_link_name')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-ban nav-icon"></i>
                                <p>@lang('dashboard::sidebar.permissions_link_name')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


