<nav class="pcoded-navbar styled-sidebar" style="background-color: {{ $sidebarColor }};">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">

            {{-- User Profile Section --}}
            <div class="main-menu-header py-3 px-3 d-flex align-items-center" style="background-color: {{ $sidebarColor }};">
                @if (Auth::user()->image !== null)
                    <img class="img-fluid rounded-circle border shadow-sm" src="{{ asset('storage/img/' . Auth::user()->image) }}"
                        alt="User-Profile-Image" style="width: 50px; height: 50px;">
                @else
                    <img class="img-fluid rounded-circle border shadow-sm" src="{{ asset('assets/images/user/avatar-2.jpg') }}"
                        alt="User-Profile-Image" style="width: 50px; height: 50px;">
                @endif

                <div class="user-details ms-3">
                    <span class="fw-bold text-white">{{ Auth::user()->name }}</span>
                    <div id="more-details" class="text-light small">
                        @if (Auth::user()->getRoleNames()->isNotEmpty())
                            {{ Auth::user()->getRoleNames()->implode(', ') }}
                        @else
                            No Role Assigned
                        @endif
                        <i class="fa fa-chevron-down ms-1"></i>
                    </div>
                </div>
            </div>

            {{-- Dropdown Links --}}
            <div class="collapse" id="nav-user-link">
                <ul class="list-unstyled px-3 pb-3">
                    <li class="list-group-item bg-transparent border-0 p-0"><a href="{{ route('viewProfie') }}"><i class="feather icon-user me-2"></i>View Profile</a></li>
                    <li class="list-group-item bg-transparent border-0 p-0"><a href="{{ route('userLogout') }}"><i class="feather icon-log-out me-2"></i>Logout</a></li>
                </ul>
            </div>

            {{-- Navigation Items --}}
            <ul class="nav pcoded-inner-navbar mt-3">

                <li class="nav-item pcoded-menu-caption">
                    <label class="text-light ps-3">Navigation</label>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.dashboard') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                @can('software_settings')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link nav-toggle">
                        <span class="pcoded-micon"><i class="feather icon-settings"></i></span>
                        <span class="pcoded-mtext">Software Settings</span>
                    </a>
                    <ul class="pcoded-submenu submenu-animate" style="background-color: {{ $sidebarColor }};">
                        <li><a href="{{ route('logoChangeView') }}">Application Logo</a></li>
                        <li><a href="{{ route('colorChangeView') }}">Application Color</a></li>
                    </ul>
                </li>
                @endcan

                @can('user_configuration')
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link nav-toggle">
                        <span class="pcoded-micon"><i class="feather icon-layout"></i></span>
                        <span class="pcoded-mtext">User Configuration</span>
                    </a>
                    <ul class="pcoded-submenu submenu-animate" style="background-color: {{ $sidebarColor }};">
                        <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                        <li><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li><a href="{{ route('users.index') }}">Users</a></li>
                    </ul>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link nav-toggle">
                        <span class="pcoded-micon"><i class="feather icon-server"></i></span>
                        <span class="pcoded-mtext">System Configuration</span>
                    </a>
                    <ul class="pcoded-submenu submenu-animate" style="background-color: {{ $sidebarColor }};">
                        <li><a href="{{ route('services.index') }}">Services</a></li>
                        <li><a href="{{ route('positions.index') }}">Positions</a></li>
                        <li><a href="{{ route('properties.index') }}">Properties</a></li>
                        <li><a href="{{ route('tenants.index') }}">Tenants</a></li>
                    </ul>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('costs.index') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-dollar-sign"></i></span>
                        <span class="pcoded-mtext">Costs</span>
                    </a>
                </li>

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link nav-toggle">
                        <span class="pcoded-micon"><i class="feather icon-bar-chart-2"></i></span>
                        <span class="pcoded-mtext">Reports</span>
                    </a>
                    <ul class="pcoded-submenu submenu-animate" style="background-color: {{ $sidebarColor }};">
                        <li><a href="{{ route('reports.costs') }}">Cost Report</a></li>
                        <li><a href="{{ route('reports.payments') }}">Payment Report</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

{{-- Stylish Sidebar Animation --}}
<style>
    .styled-sidebar {
        transition: all 0.3s ease-in-out;
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
    }

    .pcoded-inner-navbar > li > a {
        color: #fff;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        transition: background 0.3s;
        border-radius: 0.5rem;
        margin: 0.2rem 0.8rem;
    }

    .pcoded-inner-navbar > li > a:hover,
    .pcoded-inner-navbar > li.active > a {
        background-color: rgba(255, 255, 255, 0.15);
    }

    .pcoded-submenu li a {
        color: #f8f9fa;
        padding: 0.6rem 1.5rem;
        display: block;
        transition: background-color 0.2s ease;
    }

    .pcoded-submenu li a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .pcoded-menu-caption label {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 0.05em;
        color: rgba(255, 255, 255, 0.7);
    }

    .submenu-animate {
        animation: slideIn 0.3s ease forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
