<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <div class="logo-box d-flex align-items-center gap-3">
                <img src="{{ asset('assets/webimages/rahat_logo_2.png') }}" alt=""
                    style="height: 58px; width: 59px;">
                <h6 style="margin-top: 10px;">राहत आयुक्त कार्यालय उत्तर प्रदेश सरकार</h6>
            </div>

            <ul id="side-menu">
                <li class="menu-title">Menu</li>

                {{-- @php
                $user = Auth::user();
                if ($user->hasRole('Admin')) {
                $dashboardRoute = route('admin.dashboard');
                } elseif ($user->hasRole('Lekhpal')) {
                $dashboardRoute = route('lekhpal.dashboard');
                } elseif ($user->hasRole('Tahsildar')) {
                $dashboardRoute = route('tahsildar.dashboard');
                } elseif ($user->hasRole('Naib Tahsildar')) {
                $dashboardRoute = route('ntahsildar.dashboard');
                } elseif ($user->hasRole('Revenue Inspector')) {
                $dashboardRoute = route('rinspactor.dashboard');
                } elseif ($user->hasRole('Sub Divisional Magistrate')) {
                $dashboardRoute = route('smagistrate.dashboard');
                } elseif ($user->hasRole('Additional District Magistrate')) {
                $dashboardRoute = route('dmagistrate.dashboard');
                } else {
                $dashboardRoute = '#';
                }
                @endphp --}}

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- @if ($user->hasRole('Admin')) --}}
                <li>
                    <a href="{{route('admin.manage_users.index')}}">
                        <i data-feather="user"></i>
                        <span>User Management</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <i data-feather="home"></i>
                        <span>अहैतुक सहायता</span>
                    </a>
                </li>
                {{-- @endif --}}



            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->