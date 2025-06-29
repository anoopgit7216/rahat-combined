@extends('lekhpal.deathSection.layouts.death_app')


@section('title', 'Rahat Combined Death Dashboard')

@section('content')

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container my-sm-5 my-lg-0  ">
                <div class="designforform shadow-sm mt-3">
                    <h2 class="">
                        <small class="text-muted">Delayed Applications</small>
                    </h2>
                    <h3 class=" mb-4">विलंबित आवेदन
                    </h3>
                    <form>
                        <!-- Basic Information -->
                        <div class="card mb-4 custom-form-card">
                            @forelse ($deadpersondetails as $deadperson)
                                <div class="card-body border rounded mb-3">
                                    <h5 class="card-title mb-2">
                                        {{ $deadperson->name }}
                                        <span class="badge bg-secondary ms-2">{{ $deadperson->application_no }}</span>
                                    </h5>

                                    <p class="card-text mb-2">
                                        <i class="fas fa-user me-2 text-muted"></i>
                                        {{ $deadperson->user->name ?? 'N/A' }}
                                    </p>

                                    <p class="card-text mb-1">
                                        Current Stage: <strong>Relief Commissioner</strong>
                                    </p>
                                    <div class="progress mb-2" style="height: 0.75rem;">
                                        <div class="progress-bar" role="progressbar" style="width: 100%;"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                            100%
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between flex-wrap">
                                        <p class="card-text mb-1">
                                            Cause: <strong>{{ $deadperson->cause_of_death }}</strong>
                                        </p>
                                        <p class="card-text mb-1">
                                            Submitted Date:
                                            <strong>{{ \Carbon\Carbon::parse($deadperson->created_at)->format('d F Y') }}</strong>
                                        </p>
                                        <p class="card-text mb-1">
                                            Days in Stage: <strong>2 days</strong>
                                        </p>
                                        @php
                                            $hours = $deadperson->created_at->diffInHours(now());
                                            $days = $hours / 24;
                                            $roundedDays = $days <= 2.5 ? floor($days) : ceil($days);
                                        @endphp
                                        <p class="card-text mb-3">Total Days:
                                            <strong>{{ $roundedDays }} days </strong>
                                        </p>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-warning text-white me-auto">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            Delayed
                                        </span>
                                        <button type="button" class="btn btn-outline-primary m-2 open-modal"
                                            data-id="{{ $deadperson->application_no }}" data-name="{{ $deadperson->name }}"
                                            data-father="{{ $deadperson->guardian_name }}"
                                            data-gender="{{ $deadperson->gender }}" data-age="{{ $deadperson->age }}"
                                            data-date="{{ $deadperson->death_date }}"
                                            data-time="{{ $deadperson->death_time }}"
                                            data-cause="{{ $deadperson->cause_of_death }}"
                                            data-address="Village {{ $deadperson->address }}, Tehsil Sadar, District Lucknow, UP"
                                            data-contact="{{ $deadperson->contact_no ?? 'N/A' }}"
                                            data-resident="{{ $deadperson->resident }}" data-stage="Lekhpal"
                                            data-amount="{{ $deadperson->grants_rate }}"
                                            data-submitter="{{ $deadperson->user->name ?? 'N/A' }}"
                                            data-area="{{ $deadperson->area_type }}" data-bs-toggle="modal"
                                            data-bs-target="#applicationModal">
                                            <i class="fas fa-eye me-1"></i>
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center p-2">
                                    <h5 class="text-muted">Record Not Found</h5>
                                </div>
                            @endforelse






                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applicationModalLabel">Application Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <small class="text-muted">Complete information for <span id="m-name-title"></span></small>
                    <div class="row row-cols-1 row-cols-md-2 g-3 my-3">
                        <div class="col">
                            <div class="border p-3 rounded bg-white">
                                <h6 class="section-title">Personal Information</h6>
                                <p><strong>Name:</strong> <span id="m-name"></span></p>
                                <p><strong>Father's Name:</strong> <span id="m-father"></span></p>
                                <p><strong>Gender:</strong> <span id="m-gender"></span></p>
                                <p><strong>Age:</strong> <span id="m-age"></span> years</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="border p-3 rounded bg-white">
                                <h6 class="section-title">Death Information</h6>
                                <p><strong>Date of Death:</strong> <span id="m-date"></span></p>
                                <p><strong>Time of Death:</strong> <span id="m-time"></span></p>
                                <p><strong>Cause:</strong> <span id="m-cause"></span></p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="border p-3 rounded bg-white">
                                <h6 class="section-title">Address & Contact</h6>
                                <p><strong>Address:</strong> <span id="m-address"></span></p>
                                <p><strong>Resident of UP:</strong> <span id="m-resident"></span></p>
                                <p><strong>Contact:</strong> <span id="m-contact"></span></p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="border p-3 rounded bg-white">
                                <h6 class="section-title">Application Status</h6>
                                <p><strong>Current Stage:</strong> <span id="m-stage"></span></p>
                                <p><strong>Relief Amount:</strong> ₹<span id="m-amount"></span></p>
                                <p><strong>Submitted By:</strong> <span id="m-submitter"></span></p>
                                <p><strong>Area:</strong> <span id="m-area"></span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card p-3 mb-3">
                        <h6 class="section-title">Stage-wise Progress (Mock)</h6>
                        <div class="timeline">
                            <div class="timeline-step mb-2">
                                <i class="bi bi-check-circle-fill text-success step-icon"></i>
                                <div class="step-status">Lekhpal <span
                                        class="badge status-complete badge-stage">Completed</span></div>
                                <div class="step-date">2024-06-10 (2 days)</div>
                            </div>
                            <div class="timeline-step mb-2">
                                <i class="bi bi-check-circle-fill text-success step-icon"></i>
                                <div class="step-status">SDM <span
                                        class="badge status-complete badge-stage">Completed</span></div>
                                <div class="step-date">2024-06-12 (3 days)</div>
                            </div>
                            <div class="timeline-step mb-2">
                                <i class="bi bi-hourglass-split text-info step-icon"></i>
                                <div class="step-status">DM <span class="badge status-progress badge-stage">In
                                        Progress</span></div>
                                <div class="step-date">2024-06-15 (3 days)</div>
                            </div>
                            <div class="timeline-step mb-2">
                                <i class="bi bi-clock text-warning step-icon"></i>
                                <div class="step-status">Relief Commissioner <span
                                        class="badge status-pending badge-stage">Pending</span></div>
                                <div class="step-date">Pending</div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-3">
                        <h6 class="section-title">Documents</h6>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <button class="btn btn-outline-primary btn-view"><i class="bi bi-eye me-1"></i> Photo
                                    Upload</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-primary btn-view"><i class="bi bi-eye me-1"></i> Panchanama
                                    Report</button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-primary btn-view"><i class="bi bi-eye me-1"></i> Post
                                    Mortem Report</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.open-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('applicationModalLabel').textContent =
                    `Application Details - ${btn.dataset.id}`;
                document.getElementById('m-name-title').textContent = btn.dataset.name;
                document.getElementById('m-name').textContent = btn.dataset.name;
                document.getElementById('m-father').textContent = btn.dataset.father;
                document.getElementById('m-gender').textContent = btn.dataset.gender;
                document.getElementById('m-age').textContent = btn.dataset.age;
                document.getElementById('m-date').textContent = btn.dataset.date;
                document.getElementById('m-time').textContent = btn.dataset.time;
                document.getElementById('m-cause').textContent = btn.dataset.cause;
                document.getElementById('m-address').textContent = btn.dataset.address;
                document.getElementById('m-resident').textContent = btn.dataset.resident;
                document.getElementById('m-contact').textContent = btn.dataset.contact;
                document.getElementById('m-stage').textContent = btn.dataset.stage;
                document.getElementById('m-amount').textContent = btn.dataset.amount;
                document.getElementById('m-submitter').textContent = btn.dataset.submitter;
                document.getElementById('m-area').textContent = btn.dataset.area;
            });
        });
    </script>

@endsection
