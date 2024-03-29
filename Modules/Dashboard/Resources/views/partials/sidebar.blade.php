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

                @role(['administrator'])
                <li class="nav-item {{set_active('dashboard.admin.*','menu-open')}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            @lang('dashboard::sidebar.admin_link_name')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        @ability('administrator', 'currencies-read')
                        <li class="nav-item">
                            <a href="{{route('dashboard.admin.currencies.index')}}"
                               class="nav-link {{set_active('dashboard.admin.currencies.*')}}"
                            >
                                <i class="far fa-money-bill-alt nav-icon"></i>
                                <p>@lang('dashboard::sidebar.currencies_link_name')</p>
                            </a>
                        </li>
                        @endability
                        @ability('administrator', 'users-read')
                        <li class="nav-item">
                            <a href="{{route('dashboard.admin.users.index')}}"
                               class="nav-link {{set_active('dashboard.admin.users.*')}}"
                            >
                                <i class="fas fa-users nav-icon"></i>
                                <p>@lang('dashboard::sidebar.users_link_name')</p>
                            </a>
                        </li>
                        @endability
                        @ability('administrator', 'roles-read')
                        <li class="nav-item">
                            <a href="{{route('dashboard.admin.roles.index')}}"
                               class="nav-link {{set_active('dashboard.admin.roles.*')}}"
                            >
                                <i class="fas fa-user-tie nav-icon"></i>
                                <p>@lang('dashboard::sidebar.roles_link_name')</p>
                            </a>
                        </li>
                        @endability
                        @ability('administrator', 'permissions-read')
                        <li class="nav-item">
                            <a href="{{route('dashboard.admin.permissions.index')}}"
                               class="nav-link {{set_active('dashboard.admin.permissions.*')}}"
                            >
                                <i class="fas fa-ban nav-icon"></i>
                                <p>@lang('dashboard::sidebar.permissions_link_name')</p>
                            </a>
                        </li>
                        @endability
                        @if(config('laratrust.panel.register'))
                        <li class="nav-item">
                            <a href="{{route('laratrust.roles-assignment.index')}}" class="nav-link">
                                <i class="fas fa-user-shield nav-icon"></i>
                                <p>{{__('Laratrust panel')}}</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{route('dashboard.admin.cron-logs.index')}}"
                               class="nav-link {{set_active('dashboard.admin.cron-logs.*')}}">
                                <i class="fas fa-cogs nav-icon"></i>
                                <p>Cron Logs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard.admin.db.dump')}}" class="nav-link">
                                <i class="fas fa-database nav-icon"></i>
                                <p>Backup DB</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                <li class="nav-item">
                    <a href="{{route('dashboard.companies.index')}}" class="nav-link {{set_active('dashboard.companies.*')}}">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>@lang("dashboard::sidebar.companies_link_name")</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


