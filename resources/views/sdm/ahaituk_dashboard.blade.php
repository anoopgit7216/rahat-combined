@extends('layouts.sdm_app')

@section('title', 'Rahat Combined Dashboard')

@section('content')


    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1 rounded" style="background-color: #fbf0e2;">
                        <h4 class="fs-18 fw-semibold mt-4 mb-3 ps-2">अहैतुक सहायता हेतु प्रविष्टियाँ</h4>
                    </div>
                </div>

                <!-- Start Main Widgets -->
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl">
                        <a href="{{ route('smagistrate.death.dashboard') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="widget-first">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="p-2 border border-primary border-opacity-10 bg-primary-subtle rounded-2 me-2">
                                                <div class="bg-primary rounded-circle widget-size text-center">
                                                    <i class="fa-solid fa-list" style="color: white"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-5">
                                                मृतकों की सूचना भरें
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl">
                        <a href="#">
                            <div class="card">
                                <div class="card-body">
                                    <div class="widget-first">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="p-2 border border-secondary border-opacity-10 bg-secondary-subtle rounded-2 me-2">
                                                <div class="bg-secondary rounded-circle widget-size text-center">
                                                    <i class="fa-solid fa-wheelchair-move" style="color: white"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-5">
                                                दिव्यांग व्यक्तियों की सूचना भरें
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl">
                        <a href="#">
                            <div class="card">
                                <div class="card-body">
                                    <div class="widget-first">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="p-2 border border-danger border-opacity-10 bg-danger-subtle rounded-2 me-2">
                                                <div class="bg-danger rounded-circle widget-size text-center">
                                                    <i class="fa-solid fa-user-injured" style="color: white"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-5">
                                                घायलों की सूचना भरें
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12 col-lg-4">
                        <a href="#">
                            <div class="card">
                                <div class="card-body">
                                    <div class="widget-first">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="p-2 border border-warning border-opacity-10 bg-warning-subtle rounded-2 me-2">
                                                <div class="bg-warning rounded-circle widget-size text-center">
                                                    <i class="fa-solid fa-people-group" style="color: white"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-5">
                                                कपड़े और बर्तन/घरेलू सामग्री के अनुदान हेतु परिवार के
                                                मुखिया की सूचना भरें
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-12 col-lg-4 ">
                        <a href="#">
                            <div class="card">
                                <div class="card-body">
                                    <div class="widget-first">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="p-2 border border-success border-opacity-10 bg-success-subtle rounded-2 me-2">
                                                <div class="bg-success rounded-circle widget-size text-center">
                                                    <i class="fa-solid fa-people-group" style="color: white"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-5">
                                                जो परिवार राहत शिविर में नही रह रहे है उनकी आजीविका
                                                हेतु परिवार के मुखिया की सूचना भरें
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <!-- End Main Widgets -->


            </div>
            <!-- container-fluid -->
        </div>
    </div>
@endsection
