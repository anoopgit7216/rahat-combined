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
                    <a href="{{ route('lekhpal.death.dashboard') }}" class="leftbar-design">
                        <i class="fa-solid fa-house"></i>
                        <span class="span-class-link"> Dashboard <span class="hindi-text">डैशबोर्ड</span></span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('lekhpal.death.form') }}" class="leftbar-design">
                        <i class="fa-solid fa-file-lines"></i>
                        <span class="span-class-link"> New Application <span class="hindi-text">नया
                                आवेदन</span></span>
                    </a>

                </li>
                <li class="nav-item ">
                    <a href="{{ route('lekhpal.death.applications') }}" class="leftbar-design">
                        <i class="fa-solid fa-user-group"></i>
                        <span class="span-class-link">All Applications<span class="hindi-text">सभी
                                आवेदन</span></span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('lekhpal.death.applications.pending') }}" class="leftbar-design">
                        <i class="fa-solid fa-clock"></i>
                        <span class="span-class-link"> Pending Review <span class="hindi-text">समीक्षाधीन</span></span>
                    </a>

                </li>



                <li class="nav-item ">
                    <a href="{{ route('lekhpal.death.applications.approved') }}" class="leftbar-design">
                        <i class="fa-solid fa-circle-check"></i>
                        <span class="span-class-link"> Approved <span class="hindi-text">अनुमोदित</span></span>
                    </a>

                </li>
                <li class="nav-item ">
                    <a href="{{ route('lekhpal.death.applications.delayed') }}" class="leftbar-design">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span class="span-class-link"> Delays <span class="hindi-text">विलंबित</span></span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('lekhpal.death.applications.reject') }}" class="leftbar-design">
                        <i class="fa-solid fa-circle-xmark"></i>
                        <span class="span-class-link"> Reject <span class="hindi-text">अस्वीकार</span></span>
                    </a>
                </li>
                {{-- <li class="nav-item ">
                   <a href="javascript:void(0)" onclick="switchTab('reports')" class="leftbar-design">
                        <i class="fa-solid fa-chart-column"></i>
                        <span class="span-class-link"> Reports <span class="hindi-text">रिपोर्ट</span></span>
                    </a>

                </li> --}}

            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
