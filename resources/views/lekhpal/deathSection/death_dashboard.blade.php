@extends('lekhpal.deathSection.layouts.death_app')

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
                        <div class="stat-number">{{ $deadpersoncountpending }}</div>
                        <div class="stat-hindi">लंबित आवेदन</div>
                        <span class="stat-badge">Needs attention</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card h-100 card">
                        <div class="stat-icon"><i class="bi bi-exclamation-diamond"></i></div>
                        <div class="stat-title fw-semibold text-dark">Delayed Applications</div>
                        <div class="stat-number text-danger">{{ $deadpersoncountdelayed }}</div>
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
                            <h6>Application Status<br><span class="text-secondary">आवेदन की स्थिति</span></h6>
                            <div class="pie-wrapper">
                                <div class="legend-box">
                                    <ul id="deathLegend"></ul>
                                </div>
                                <canvas id="appStatusChart"></canvas>
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

                            @foreach ($results as $stage)
                                <div class="stage-card">
                                    <div class="stage-index">{{ $stage['index'] }}</div>
                                    <div class="stage-labels">
                                        <div class="title">{{ $stage['title'] }}</div>
                                        <div class="text-muted small">Average: {{ $stage['average'] }} days</div>
                                    </div>
                                    <div class="status-box pending">
                                        <div class="value">{{ $stage['pending'] }}</div>
                                        <div class="label">Pending</div>
                                    </div>
                                    <div class="status-box delayed">
                                        <div class="value">{{ $stage['delayed'] }}</div>
                                        <div class="label">Delayed</div>
                                    </div>
                                    {{-- <button class="view-btn">
                                        <i class="fas fa-eye"></i> View
                                    </button> --}}
                                </div>
                            @endforeach
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
                                            <span class="badge bg-danger rounded-pill">0</span>
                                        </div>
                                        <div
                                            class="summary-box summary-moderate d-flex justify-content-between align-items-center">
                                            <span>Moderate Delays (8-15 days)</span>
                                            <span class="badge bg-warning text-dark rounded-pill">0</span>
                                        </div>
                                        <div
                                            class="summary-box summary-minor d-flex justify-content-between align-items-center">
                                            <span>Minor Delays (3-7 days)</span>
                                            <span class="badge bg-light text-dark rounded-pill">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card p-4 mt-4">
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
                        </div> --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                labels: @json($months),
                datasets: [{
                    label: 'Applications Processed',
                    data: @json($processedData),
                    backgroundColor: 'rgba(10,120,3,.4)',
                    borderColor: 'rgba(10,120,3,.8)',
                    fill: true,
                    tension: .4
                }, {
                    label: 'Applications Submitted',
                    data: @json($submittedData),
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
                    title: {
                        display: true,
                        text: 'मासिक आवेदन रुझान',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
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
                            stepSize: 20
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
        const appStatusCtx = document.getElementById('appStatusChart').getContext('2d');

        new Chart(appStatusCtx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    data: [{{ $deadpersoncountpending }}, {{ $deadpersoncountapproved }},
                        {{ $deadpersoncountdelayed }}
                    ],
                    backgroundColor: ['#f1c40f', '#2ecc71', '#e74c3c'],
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
                        display: true
                    },
                    datalabels: {
                        color: ctx => ctx.chart.data.datasets[0].backgroundColor[ctx.dataIndex],
                        anchor: 'end',
                        align: 'end',
                        offset: 20,
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

        $.ajax({
            url: '{{ route('lekhpal.dashboard.stage-performance') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                new Chart(stagePerfCtx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Performance',
                            data: data.performance,
                            backgroundColor: '#0d6efd'
                        }, {
                            type: 'line',
                            label: 'Target',
                            data: data.target,
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
                                display: true
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    stepSize: 20
                                }
                            }
                        }
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading chart data:', error);
            }
        });
        /* ----------  CHART: Daily Delay ---------- */
        const dailyDelayCtx = document.getElementById('dailyDelay').getContext('2d');

        $.ajax({
            url: '{{ route('lekhpal.dashboard.daily-delay') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                new Chart(dailyDelayCtx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                                label: 'Minor (1-2 days)',
                                data: data.minor,
                                backgroundColor: '#0d6efd'
                            },
                            {
                                label: 'Moderate (3-5 days)',
                                data: data.moderate,
                                backgroundColor: '#ffc107'
                            },
                            {
                                label: 'Major (6+ days)',
                                data: data.major,
                                backgroundColor: '#dc3545'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                beginAtZero: true,
                                stacked: true,
                                title: {
                                    display: true,
                                    text: 'Applications Count'
                                }
                            }
                        }
                    }
                });
            },
            error: function(err) {
                console.error('Failed to load daily delay data:', err);
            }
        });
    </script>

    <script>
        const ctx = document.getElementById('performanceChart').getContext('2d');

        $.ajax({
            url: '{{ route('lekhpal.dashboard.stage-performance-metric') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Pending',
                            data: data.pending,
                            backgroundColor: '#f6c23e'
                        }, {
                            label: 'Delayed',
                            data: data.delayed,
                            backgroundColor: '#e74a3b'
                        }]
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
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        }
                    }
                });
            },
            error: function(err) {
                console.error('Chart load failed:', err);
            }
        });
    </script>


    <script>
        const ctx1 = document.getElementById('weeklyDelayTrend').getContext('2d');

        $.ajax({
            url: '{{ route('lekhpal.dashboard.weekly-delay-trend') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: response.labels,
                        datasets: [{
                            label: 'Delays',
                            data: response.data,
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
                                    stepSize: 5
                                }
                            }
                        }
                    }
                });
            },
            error: function(err) {
                console.error("Weekly Delay Chart Load Failed", err);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('lekhpal.dashboard.delay-summary') }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('.summary-critical .badge').text(data.critical);
                    $('.summary-moderate .badge').text(data.moderate);
                    $('.summary-minor .badge').text(data.minor);
                },
                error: function(xhr) {
                    console.error("Error loading delay summary", xhr);
                }
            });
        });
    </script>



@endsection
