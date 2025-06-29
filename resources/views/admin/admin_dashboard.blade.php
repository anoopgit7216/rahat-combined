@extends('layouts.admin_app')

@section('title', 'Rahat Combined Dashboard')

@section('content')


    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid my-4">
                <div class="container my-4">
                    <div class="row g-3">

                        <!-- Card 1: Total Works -->
                        <div class="col-md-3">
                            <div class="card  p-3 mb-2  cards-shadow ">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Total Works</h6>
                                    <div class="bg-primary text-white icon2">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                </div>
                                <h3 class="fw-bold mt-2">156</h3>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="fw-bold">+12 this month</small>
                                    <div class="bg-dark text-white icon">
                                        <i class="bi bi-arrow-up-right icon-size"></i>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Completed -->
                        <div class="col-md-3">
                            <div class="card  p-3 mb-2  cards-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Completed1</h6>
                                    <div class=" text-white icon2"style="background-color: #0fe50f ;">
                                        <i class="fa-solid fa-calendar-check"></i>
                                    </div>
                                </div>
                                <h3 class="fw-bold mt-2">89</h3>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="fw-bold">68% completion rate</small>
                                    <div class="bg-dark text-white icon">
                                        <i class="bi bi-arrow-up-right icon-size"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: In Progress -->
                        <div class="col-md-3">
                            <div class="card  p-3 mb-2  cards-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>In Progress</h6>
                                    <div class="bg-warning text-white icon2">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                </div>
                                <h3 class="fw-bold mt-2">45</h3>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="fw-bold">32% of total works</small>
                                    <div class="bg-primary text-dark icon">
                                        <i class="bi bi-arrow-up-right icon-size"></i>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Delayed -->
                        <div class="col-md-3">
                            <div class="card  p-3 mb-2  cards-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Delayed</h6>
                                    <div class="bg-danger text-white icon2">
                                        <i class="fa-solid fa-map-pin"></i>
                                    </div>
                                </div>
                                <h3 class="fw-bold mt-2">22</h3>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="fw-bold">Avg delay: 18 days</small>
                                    <div class="bg-danger text-white icon">
                                        <i class="bi bi-arrow-up-right icon-size"></i>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card  p-3 mb-2  cards-shadow ">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Flood Areas</h6>
                                    <div class=" text-white icon2" style="background-color: #8585db;">
                                        <i class="fa-solid fa-water"></i>
                                    </div>
                                </div>
                                <h3 class="fw-bold mt-2">8</h3>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="fw-bold">Monitoring Active</small>
                                    <div class="bg-primary text-white icon">
                                        <i class="bi bi-arrow-up-right icon-size"></i>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Completed -->
                        <div class="col-md-3">
                            <div class="card  p-3 mb-2  cards-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Heat Wave Alerts</h6>
                                    <div class="bg-success text-white icon2">
                                        <i class="fa-solid fa-temperature-high"></i>
                                    </div>
                                </div>
                                <h3 class="fw-bold mt-2">12</h3>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="fw-bold">3 districts affected</small>
                                    <div class="bg-dark text-white icon">
                                        <i class="bi bi-arrow-up-right icon-size"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: In Progress -->
                        <div class="col-md-3">
                            <div class="card  p-3 mb-2  cards-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Water Supply</h6>
                                    <div class="bg-warning text-white icon2">
                                        <i class="fa-solid fa-hand-holding-droplet"></i>
                                    </div>
                                </div>
                                <h3 class="fw-bold mt-2">94%</h3>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="fw-bold">coverage in districts</small>
                                    <div class="bg-dark text-white icon">
                                        <i class="bi bi-arrow-up-right icon-size"></i>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Delayed -->
                        <div class="col-md-3">
                            <div class="card  p-3 mb-2  cards-shadow">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Emergency Response</h6>
                                    <div class="bg-danger text-white icon2">
                                        <i class="fa-solid fa-kit-medical"></i>
                                    </div>
                                </div>
                                <h3 class="fw-bold mt-2">24/7</h3>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="fw-bold">Teams deployed</small>
                                    <div class="bg-primary text-white icon">
                                        <i class="bi bi-arrow-up-right icon-size"></i>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- ================== -->


                <div class=" d-flex justify-content-center media justify-content-around gap-2 px-2 py-2 rounded-3 flex-wrap"
                    style="margin: 0px;">
                    <ul class="nav nav-pills mb-1 d-flex flex-wrap gap-lg-0 gap-md-3 justify-content-center justify-content-md-around"
                        id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-dark border-black px-3 px-md-4" id="pills-dashboard-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-dashboard" type="button" role="tab"
                                aria-controls="pills-dashboard" aria-selected="true">
                                Dashboard
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark border-black px-3 px-md-4" id="pills-work-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-work" type="button" role="tab"
                                aria-controls="pills-work" aria-selected="false">
                                Work Management
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark border-black px-3 px-md-4" id="pills-analytics-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-analytics" type="button" role="tab"
                                aria-controls="pills-analytics" aria-selected="false">
                                Progress Analytics
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark border-black px-3 px-md-4" id="pills-analytics-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-analytics" type="button" role="tab"
                                aria-controls="pills-analytics" aria-selected="false">
                                Progress Analytics
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark border-black px-3 px-md-4" id="pills-analytics-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-analytics" type="button" role="tab"
                                aria-controls="pills-analytics" aria-selected="false">
                                Progress Analytics
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark border-black px-3 px-md-4" id="pills-delay-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-delay" type="button" role="tab"
                                aria-controls="pills-delay" aria-selected="false">
                                Delay Tracking
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark border-black px-3 px-md-4" id="pills-photo-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-photo" type="button" role="tab"
                                aria-controls="pills-photo" aria-selected="false">
                                Photo Upload
                            </button>
                        </li>

                    </ul>
                </div>


                <div class="container mt-5">
                    <div class="row g-4">

                        <!-- Monthly Progress -->
                        <div class="col-md-3">
                            <div class="p-3 h-100  card">
                                <h5><strong>Monthly Progress</strong></h5>
                                <p class="text-muted">Works completion trends over the last 6 months</p>
                                <div>

                                    <canvas id="barChart" style="width: 260px; height: 305px;"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Status Distribution -->
                        <div class="col-md-3">
                            <div class="p-3  h-100 card">
                                <h5><strong>Status Distribution</strong></h5>
                                <p class="text-muted">Current status of all works</p>
                                <canvas id="doughnutChart"></canvas>
                            </div>
                        </div>

                        <!-- Recent Activities -->
                        <div class="col-md-6">
                            <div class="p-3 h-100 card">
                                <h5><strong><i class="bi bi-clock-history"></i> Recent Activities</strong></h5>

                                <div class="bg-success-subtle p-2 mt-3 mb-3 rounded-3" style="background-color: #fdecea;">
                                    <div><strong>Road Construction - Phase 2</strong>
                                        <span class="status-badge bg-danger  mt-2 text-white float-end">High
                                            Priority</span>
                                        <div class="text-muted">Status updated to 85% complete</div>
                                    </div>




                                </div>

                                <div class="bg-danger-subtle p-2 mb-3 rounded-3" style="background-color:#f2f3f4;">
                                    <div><strong>Flood Alert - Gorakhpur</strong>
                                        <span class="status-badge bg-danger mt-2 text-white float-end">High
                                            Priority</span>
                                        <div class="text-muted">Water level rising – Relief camps activated </div>

                                    </div>
                                </div>

                                <div class="bg-warning-subtle p-2 rounded mb-3" style="background-color: #cdf7dc;">
                                    <div><strong>Heat Wave Alert - Allahabad</strong>
                                        <span class="status-badge mt-2 bg-warning text-white float-end px-4">Active</span>
                                        <div class="text-muted">Temperature 47°C – Cooling centers opened</div>
                                    </div>

                                </div>

                                <div class="bg-primary-subtle p-2 rounded" style="background-color:rgb(247, 232, 187)">
                                    <div><strong>Water Supply - Kanpur</strong>
                                        <span class="status-badge mt-2 bg-warning text-white float-end">In
                                            Progress</span>
                                        <div class="text-muted">8 new tankers deployed for coverage improvement
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
