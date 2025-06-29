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
            <ul id="side-menu" class="nav-menu">

                <li class="nav-item ">
                    <a href="{{ route('smagistrate.death.dashboard') }}" class="leftbar-design">
                        <i class="fa-solid fa-house"></i>
                        <span class="span-class-link"> Dashboard <span class="hindi-text">डैशबोर्ड</span></span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('smagistrate.death.applications') }}" class="leftbar-design">
                        <i class="fa-solid fa-user-group"></i>
                        <span class="span-class-link">All Applications<span class="hindi-text">सभी
                                आवेदन</span></span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
