@extends('tahsildar.deathSection.layouts.death_app')

@section('title', 'Rahat Combined Death Dashboard')

@section('content')


    <!-- Chart.js + DataLabels -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        /* ────────────────  STAT CARDS  ──────────────── */
        .stat-card {
            border-radius: 12px;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.1);
            transition: all .3s ease;
            position: relative;
            padding: 20px;
        }

        .stat-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
            transform: translateY(-2px);
        }

        .stat-icon {
            position: absolute;
            top: 16px;
            right: 16px;
            font-size: 20px;
            color: #6c757d;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .stat-hindi {
            font-size: .9rem;
            color: #6c757d;
            margin-top: -4px;
        }

        .stat-badge {
            font-size: .75rem;
            background: #f1f5fb;
            color: #000;
            border-radius: 999px;
            padding: 5px 10px;
            margin-top: 10px;
            display: inline-block;
        }

        html.dark .stat-badge {
            background: #2a2a2a;
            /* dark grey background */
            color: #e0e0e0;
            /* light text */
        }

        /* ────────────────  TABS  ──────────────── */
        .tabs {
            background: #aeceff;
            border-radius: 10px;
            padding: 5px;
            display: flex;
            gap: 5px;
            justify-content: space-between;
        }

        .tabs .tab-link {
            flex: 1;
            border: none;
            background: transparent;
            color: #5a7184;
            font-weight: 500;
            padding: 10px 0;
            border-radius: 8px;
            transition: .3s;
        }

        .tabs .tab-link.active {
            background: #d6d6d6;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .1);
            color: #000000;
        }

        /* ────────────────  CHART CARDS  ──────────────── */
        .chart-card {
            border-radius: 12px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .1);
            padding: 1rem;
            display: flex;
            flex-direction: column;
            min-height: 360px;
        }

        .chart-card h6 {
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .chart-card canvas {
            width: 100% !important;
            height: auto !important;
            max-height: 280px;
        }

        /* Pie specific wrapper to centre chart */
        .pie-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 280px;
        }

        /* Hide tabs by default */
        .tab-content.d-none {
            display: none !important;
        }

        .stage-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stage-index {
            background-color: #e9f1ff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #2b6cb0;
        }

        .stage-labels {
            flex: 1;
            margin-left: 15px;
        }

        .stage-labels .title {
            font-weight: 600;
            font-size: 1rem;
        }

        .status-box {
            text-align: center;
            margin-right: 20px;
        }

        .value {
            font-weight: 600;
            font-size: 16px;
            line-height: 1.2;
        }

        .pending .value {
            color: #f6c23e;
        }

        .delayed .value {
            color: #e74a3b;
        }

        .label {
            font-size: 13px;
            color: #6c757d;
        }

        .view-btn {
            background-color: #f1f5f9;
            color: #000;
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .chart-container {
            border-radius: 12px;
            padding: 20px;
            margin-top: 25px;
        }

        .card {
            border-radius: 10px;
            border: none;
        }

        .badge {
            font-size: 0.9rem;
        }

        .table thead th {}

        .summary-box {
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .summary-critical {
            background-color: #fdeaea;
            color: #dc3545;
        }

        .summary-moderate {
            background-color: #fff9db;
            color: #ffc107;
        }

        .summary-minor {
            background-color: #fff2e0;
            color: #fd7e14;
        }

        .equal-height-row>div {
            display: flex;
            flex-direction: column;
        }

        .equal-height {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        #weeklyDelayTrend {
            height: 100% !important;
            min-height: 240px;
            max-height: 300px;
        }

        .report-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .report-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .report-card h5 {
            font-weight: 600;
        }

        .report-card p {
            flex-grow: 1;
        }

        .btn-generate {
            background-color: rgb(5, 93, 226);
            color: #fff;
            border: none;
        }

        .btn-generate:hover {
            background-color: rgb(3, 76, 164);
            color: #fff !important;
        }

        .chart-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .legend-box {
            flex: 0 0 auto;
            max-width: 200px;
        }

        .chart-box {
            flex: 1;
            min-width: 300px;
            max-width: 400px;
            height: 400px;
        }

        canvas {
            max-width: 100%;
            height: 100%;
        }

        ul#deathLegend {
            list-style: none;
            padding-left: 0;
        }

        ul#deathLegend li {
            margin-bottom: 10px;
            font-size: 15px;
        }

        #deathCause {
            width: 75% !important;
        }
    </style>


    <div class="content-page">
        <div class="container-fluid p-4">

            <!-- ─────────────  STAT CARDS  ───────────── -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card h-100 card">
                        <div class="stat-icon"><i class="bi bi-file-earmark-text"></i></div>
                        <div class="stat-title fw-semibold text-dark">Total Applications</div>
                        <div class="stat-number">{{ $deadpersonscount }}</div>
                        <div class="stat-hindi">कुल आवेदन</div>
                        <span class="stat-badge">+12% from last month</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card h-100 card">
                        <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
                        <div class="stat-title fw-semibold text-dark">Pending Applications</div>
                        <div class="stat-number">{{ $deadpersoncountpending}}</div>
                        <div class="stat-hindi">लंबित आवेदन</div>
                        <span class="stat-badge">Needs attention</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card h-100 card">
                        <div class="stat-icon"><i class="bi bi-exclamation-diamond"></i></div>
                        <div class="stat-title fw-semibold text-dark">Delayed Applications</div>
                        <div class="stat-number text-danger">{{ $deadpersoncountdelayed}}</div>
                        <div class="stat-hindi">विलंबित आवेदन</div>
                        <span class="stat-badge text-danger">High priority</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card h-100 card">
                        <div class="stat-icon"><i class="bi bi-activity"></i></div>
                        <div class="stat-title fw-semibold text-dark">Approved Applications</div>
                        <div class="stat-number text-primary">{{ $deadpersoncountapproved }}</div>
                        <div class="stat-hindi">अनुमोदित आवेदन</div>
                        <span class="stat-badge text-success">High priority</span>
                    </div>
                </div>
            </div>


            <!-- ─────────────  TABS  ───────────── -->
            <div class="tabs mb-4">
                <button class="tab-link active" onclick="switchTab('overview')">Overview</button>
                <button class="tab-link" onclick="switchTab('monitoring')">Stage Monitoring</button>
                <button class="tab-link" onclick="switchTab('delay')">Delay Analysis</button>
                <button class="tab-link" onclick="switchTab('reports')">Reports</button>
            </div>

            <!-- ─────────────  OVERVIEW TAB  ───────────── -->
            <div id="overview" class="tab-content">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="chart-card card">
                            <h6>Monthly Application Trends<br><span class="text-secondary">मासिक आवेदन रुझान</span></h6>
                            <canvas id="monthlyTrend"></canvas>
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <div class="chart-card card">
                            <h6>Death Cause Distribution<br><span class="text-secondary">मृत्यु कारण वितरण</span></h6>
                            <div class="pie-wrapper">
                                <div class="legend-box">
                                    <ul id="deathLegend"></ul>
                                </div>
                                <canvas id="deathCause"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="chart-card card">
                            <h6>Stage Performance vs&nbsp;Target<br><span class="text-secondary">चरण प्रदर्शन बनाम
                                    लक्ष्य</span></h6>
                            <canvas id="stagePerformance"></canvas>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="chart-card card">
                            <h6>Daily Delay Breakdown<br><span class="text-secondary">दैनिक विलंब विश्लेषण</span></h6>
                            <canvas id="dailyDelay"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ─────────────  OTHER PLACEHOLDER TABS  ───────────── -->
            <div id="monitoring" class="tab-content d-none">
                <div class=" px-4 pb-4 text-center">
                    <div class="container ">
                        <div class="card p-3">
                            <h5 class="fw-semibold">Stage-wise Application Status</h5>
                            <p class="text-muted small">चरणवार आवेदन स्थिति - Click on any stage for drill-down</p>

                            <!-- Stage Cards -->
                            <div class="stage-card">
                                <div class="stage-index">1</div>
                                <div class="stage-labels">
                                    <div class="title">Lekhpal</div>
                                    <div class="text-muted small">Average: 3.2 days</div>
                                </div>
                                <div class="status-box pending">
                                    <div class="value">4</div>
                                    <div class="label">Pending</div>
                                </div>
                                <div class="status-box delayed">
                                    <div class="value">4</div>
                                    <div class="label">Delayed</div>
                                </div>
                                <button class="view-btn"><i class="fas fa-eye"></i> View</button>
                            </div>

                            <div class="stage-card">
                                <div class="stage-index">2</div>
                                <div class="stage-labels">
                                    <div class="title">Revenue inspector</div>
                                    <div class="text-muted small">Average: 5.1 days</div>
                                </div>
                                <div class="status-box pending">
                                    <div class="value">38</div>
                                    <div class="label">Pending</div>
                                </div>
                                <div class="status-box delayed">
                                    <div class="value">19</div>
                                    <div class="label">Delayed</div>
                                </div>
                                <button class="view-btn"><i class="fas fa-eye"></i> View</button>
                            </div>

                            <div class="stage-card">
                                <div class="stage-index">3</div>
                                <div class="stage-labels">
                                    <div class="title">Naib Tahsildar</div>
                                    <div class="text-muted small">Average: 7.8 days</div>
                                </div>
                                <div class="status-box pending">
                                    <div class="value">42</div>
                                    <div class="label">Pending</div>
                                </div>
                                <div class="status-box delayed">
                                    <div class="value">28</div>
                                    <div class="label">Delayed</div>
                                </div>
                                <button class="view-btn"><i class="fas fa-eye"></i> View</button>
                            </div>

                            <div class="stage-card">
                                <div class="stage-index">4</div>
                                <div class="stage-labels">
                                    <div class="title">Tahsildar</div>
                                    <div class="text-muted small">Average: 4.3 days</div>
                                </div>
                                <div class="status-box pending">
                                    <div class="value">31</div>
                                    <div class="label">Pending</div>
                                </div>
                                <div class="status-box delayed">
                                    <div class="value">19</div>
                                    <div class="label">Delayed</div>
                                </div>
                                <button class="view-btn"><i class="fas fa-eye"></i> View</button>
                            </div>
                            <div class="stage-card">
                                <div class="stage-index">4</div>
                                <div class="stage-labels">
                                    <div class="title">Sub Divisional Magistrate</div>
                                    <div class="text-muted small">Average: 4.3 days</div>
                                </div>
                                <div class="status-box pending">
                                    <div class="value">31</div>
                                    <div class="label">Pending</div>
                                </div>
                                <div class="status-box delayed">
                                    <div class="value">19</div>
                                    <div class="label">Delayed</div>
                                </div>
                                <button class="view-btn"><i class="fas fa-eye"></i> View</button>
                            </div>
                            <div class="stage-card">
                                <div class="stage-index">4</div>
                                <div class="stage-labels">
                                    <div class="title">Additional District Magistrate</div>
                                    <div class="text-muted small">Average: 4.3 days</div>
                                </div>
                                <div class="status-box pending">
                                    <div class="value">31</div>
                                    <div class="label">Pending</div>
                                </div>
                                <div class="status-box delayed">
                                    <div class="value">19</div>
                                    <div class="label">Delayed</div>
                                </div>
                                <button class="view-btn"><i class="fas fa-eye"></i> View</button>
                            </div>
                            <div class="stage-card">
                                <div class="stage-index">4</div>
                                <div class="stage-labels">
                                    <div class="title">DDO</div>
                                    <div class="text-muted small">Average: 4.3 days</div>
                                </div>
                                <div class="status-box pending">
                                    <div class="value">31</div>
                                    <div class="label">Pending</div>
                                </div>
                                <div class="status-box delayed">
                                    <div class="value">19</div>
                                    <div class="label">Delayed</div>
                                </div>
                                <button class="view-btn"><i class="fas fa-eye"></i> View</button>
                            </div>
                        </div>

                        <!-- Chart Section -->

                        <div class="chart-container mt-4 card p-3">
                            <h6 class="fw-semibold">Stage Performance Metrics</h6>
                            <p class="text-muted small">चरण प्रदर्शन मैट्रिक्स</p>
                            <canvas id="performanceChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div id="delay" class="tab-content d-none">
                <div class=" p-4  pt-0 text-center">
                    <div class="container py-4">
                        <div class="row g-4 equal-height-row">
                            <div class="col-md-6 mt-0 ">
                                <div class="card p-4  equal-height card">
                                    <h5>Weekly Delay Trends<br><span class="text-muted small">साप्ताहिक विलंब रुझान</span>
                                    </h5>
                                    <div class="flex-grow-1 d-flex align-items-center">
                                        <canvas id="weeklyDelayTrend"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-0 ">
                                <div class="card p-4 equal-height">
                                    <h5>Delay Summary<br><span class="text-muted small">विलंब सारांश</span></h5>
                                    <div class="mt-3 d-grid gap-2">
                                        <div
                                            class="summary-box summary-critical d-flex justify-content-between align-items-center">
                                            <span>Critical Delays (>15 days)</span>
                                            <span class="badge bg-danger rounded-pill">23</span>
                                        </div>
                                        <div
                                            class="summary-box summary-moderate d-flex justify-content-between align-items-center">
                                            <span>Moderate Delays (8-15 days)</span>
                                            <span class="badge bg-warning text-dark rounded-pill">45</span>
                                        </div>
                                        <div
                                            class="summary-box summary-minor d-flex justify-content-between align-items-center">
                                            <span>Minor Delays (3-7 days)</span>
                                            <span class="badge bg-light text-dark rounded-pill">21</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card p-4 mt-4">
                            <h5>District-wise Delay Analysis<br><span class="text-muted small">जिलावार विलंब
                                    विश्लेषण</span>
                            </h5>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th>District</th>
                                            <th>Total Applications</th>
                                            <th>Delayed</th>
                                            <th>Avg Delay (Days)</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Lucknow</td>
                                            <td>156</td>
                                            <td>12</td>
                                            <td>8.5</td>
                                            <td><span class="badge bg-light text-dark">Good</span></td>
                                            <td><button class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i>
                                                    View</button></td>
                                        </tr>
                                        <tr>
                                            <td>Kanpur</td>
                                            <td>134</td>
                                            <td>28</td>
                                            <td>15.2</td>
                                            <td><span class="badge bg-danger">Critical</span></td>
                                            <td><button class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i>
                                                    View</button></td>
                                        </tr>
                                        <tr>
                                            <td>Agra</td>
                                            <td>98</td>
                                            <td>15</td>
                                            <td>11.3</td>
                                            <td><span class="badge bg-warning text-dark">Moderate</span></td>
                                            <td><button class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i>
                                                    View</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="reports" class="tab-content d-none">

                <div class="container pb-5">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card report-card p-4">
                                <h5 style="    line-height: 1.4;"><i class="bi bi-file-earmark-text me-2"></i>Daily
                                    Report<br><span class="text-muted small">दैनिक रिपोर्ट</span></h5>
                                <p class="small mt-2">Generate comprehensive daily summary of all death reporting
                                    activities.</p>
                                <button class="btn btn-generate mt-3"><i class="bi bi-download me-1"></i> Generate
                                    Report</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card report-card p-4">
                                <h5 style="    line-height: 1.4;"><i class="bi bi-calendar-week me-2"></i>Weekly
                                    Summary<br><span class="text-muted small">साप्ताहिक सारांश</span></h5>
                                <p class="small mt-2">Weekly analysis with stage-wise performance metrics and delay trends.
                                </p>
                                <button class="btn btn-generate mt-3"><i class="bi bi-download me-1"></i> Generate
                                    Report</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card report-card p-4">
                                <h5 style="    line-height: 1.4;"><i class="bi bi-geo-alt me-2"></i>District
                                    Report<br><span class="text-muted small">जिला रिपोर्ट</span></h5>
                                <p class="small mt-2">District-wise comprehensive analysis of death reporting and fund
                                    disbursement.</p>
                                <button class="btn btn-generate mt-3"><i class="bi bi-download me-1"></i> Generate
                                    Report</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card report-card p-4">
                                <h5 style="    line-height: 1.4;"><i class="bi bi-exclamation-triangle me-2"></i>Delay
                                    Analysis Report<br><span class="text-muted small">विलंब विश्लेषण रिपोर्ट</span></h5>
                                <p class="small mt-2">Detailed analysis of delays at each stage with recommendations.</p>
                                <button class="btn btn-generate mt-3"><i class="bi bi-download me-1"></i> Generate
                                    Report</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card report-card p-4">
                                <h5 style="    line-height: 1.4;"><i class="bi bi-people me-2"></i>Stakeholder
                                    Performance<br><span class="text-muted small">हितधारक प्रदर्शन</span></h5>
                                <p class="small mt-2">Performance analysis of Lekhpal, SDM, DM, and Relief Commissioner.
                                </p>
                                <button class="btn btn-generate mt-3"><i class="bi bi-download me-1"></i> Generate
                                    Report</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card report-card p-4">
                                <h5 style="    line-height: 1.4;"><i class="bi bi-check-circle me-2"></i>Disbursement
                                    Report<br><span class="text-muted small">वितरण रिपोर्ट</span></h5>
                                <p class="small mt-2">Fund disbursement tracking and Digital Signature Certificate usage.
                                </p>
                                <button class="btn btn-generate mt-3"><i class="bi bi-download me-1"></i> Generate
                                    Report</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        /* ----------  TAB SWITCHING ---------- */
        function switchTab(tabId) {
            document.querySelectorAll('.tab-link').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('d-none'));

            document.querySelector(`[onclick="switchTab('${tabId}')"]`).classList.add('active');
            document.getElementById(tabId).classList.remove('d-none');
        }

        /* ----------  CHART: Monthly Trend ---------- */
        const monthlyTrendCtx = document.getElementById('monthlyTrend').getContext('2d');
        new Chart(monthlyTrendCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Applications Processed',
                    data: [120, 140, 170, 160, 180, 170],
                    backgroundColor: 'rgba(10,120,3,.4)',
                    borderColor: 'rgba(10,120,3,.8)',
                    fill: true,
                    tension: .4
                }, {
                    label: 'Applications Submitted',
                    data: [135, 155, 190, 175, 195, 180],
                    backgroundColor: 'rgba(13,110,253,.2)',
                    borderColor: 'rgba(13,110,253,1)',
                    fill: true,
                    tension: .4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 55
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        /* ----------  CHART: Death Cause (Pie) ---------- */
        const deathCauseCtx = document.getElementById('deathCause').getContext('2d');
        new Chart(deathCauseCtx, {
            type: 'pie',
            data: {
                labels: ['बाढ़', 'दुर्घटना', 'आग', 'भूकंप', 'अन्य'],
                datasets: [{
                    data: [45, 28, 15, 8, 4],
                    backgroundColor: ['#2b7bfa', '#e84141', '#fd8d0c', '#915dd1', '#5f6368'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 20,
                        bottom: 20,
                        left: 20,
                        right: 20
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        color: ctx => ctx.chart.data.datasets[0].backgroundColor[ctx.dataIndex],
                        anchor: 'end',
                        align: 'end',
                        offset: 30,
                        formatter: (value, ctx) => {
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const pct = ((value / total) * 100).toFixed(0);
                            return `${ctx.chart.data.labels[ctx.dataIndex]} ${pct}%`;
                        },
                        font: {
                            weight: 'bold',
                            size: 13
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        /* ----------  CHART: Stage Performance ---------- */
        const stagePerfCtx = document.getElementById('stagePerformance').getContext('2d');
        new Chart(stagePerfCtx, {
            type: 'bar',
            data: {
                labels: ['Lekhpal', 'SDM', 'DM', 'Relief Commissioner'],
                datasets: [{
                    label: 'Performance',
                    data: [85, 78, 65, 82],
                    backgroundColor: '#0d6efd'
                }, {
                    type: 'line',
                    label: 'Target',
                    data: [90, 90, 90, 90],
                    borderColor: '#dc3545',
                    borderWidth: 2,
                    fill: false,
                    tension: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 20
                        }
                    }
                }
            }
        });

        /* ----------  CHART: Daily Delay ---------- */
        const dailyDelayCtx = document.getElementById('dailyDelay').getContext('2d');
        new Chart(dailyDelayCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Minor',
                    data: [8, 9, 7, 10, 6, 5, 4],
                    backgroundColor: '#dc3545'
                }, {
                    label: 'Moderate',
                    data: [10, 12, 11, 13, 9, 6, 5],
                    backgroundColor: '#ffc107'
                }, {
                    label: 'Major',
                    data: [9, 10, 9, 12, 7, 5, 4],
                    backgroundColor: '#0d6efd'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Lekhpal', 'SDM', 'DM', 'Relief Commissioner'],
                datasets: [{
                        label: 'Pending',
                        data: [45, 38, 42, 31],
                        backgroundColor: '#f6c23e'
                    },
                    {
                        label: 'Delayed',
                        data: [23, 19, 28, 19],
                        backgroundColor: '#e74a3b'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
    <script>
        const ctx1 = document.getElementById('weeklyDelayTrend').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
                datasets: [{
                    label: 'Delays',
                    data: [13, 19, 17, 22, 20, 27],
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220,53,69,0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#dc3545',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 7
                        }
                    }
                }
            }
        });
    </script>

@endsection
