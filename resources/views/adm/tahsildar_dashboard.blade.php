@extends('layouts.adm_app')

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
                    <!-- <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                              </div> -->
                </div>

                <!-- Start Main Widgets -->
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl">
                        <div class="card">

                            <div class="card-body">
                                <div class="widget-first">
                                    <div class="d-flex align-items-center mb-2">
                                        <div
                                            class="p-2 border border-primary border-opacity-10 bg-primary-subtle rounded-2 me-2">
                                            <div class="bg-primary rounded-circle widget-size text-center">
                                                <i class="fa-solid fa-building-wheat" style="color: white"></i>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-dark fs-5">कृषि अनुदान</p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="mb-0 fs-22 text-dark me-3">0</h3>
                                        <div class="text-center">
                                            <span class="text-primary fs-14"><i class="mdi mdi-trending-up fs-14"></i>
                                                5%</span>
                                            <p class="text-dark fs-13 mb-0">Last days</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="col-md-6 col-lg-4 col-xl">
                        <a href="{{route('dmagistrate.ahaituk.dashboard')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="widget-first">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="p-2 border border-secondary border-opacity-10 bg-secondary-subtle rounded-2 me-2">
                                                <div class="bg-secondary rounded-circle widget-size text-center">
                                                    <i class="fa-solid fa-briefcase-medical" style="color: white"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-5">अहैतुक सहायता</p>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="mb-0 fs-22 text-dark me-3">2,839</h3>
                                            <div class="text-center">
                                                <span class="text-danger fs-14 me-2"><i
                                                        class="mdi mdi-trending-down fs-14"></i>
                                                    1.5%</span>
                                                <p class="text-dark fs-13 mb-0">Last 7 days</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl">
                        <div class="card">
                            <div class="card-body">
                                <div class="widget-first">
                                    <div class="d-flex align-items-center mb-2">
                                        <div
                                            class="p-2 border border-danger border-opacity-10 bg-danger-subtle rounded-2 me-2">
                                            <div class="bg-danger rounded-circle widget-size text-center">
                                                <i class="fa-solid fa-house-crack" style="color: white"></i>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-dark fs-5">
                                            क्षतिग्रस्त मकान हेतु सहायता
                                        </p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="mb-0 fs-22 text-dark me-3">0</h3>
                                        <div class="text-center">
                                            <span class="text-primary fs-14 me-2"><i class="mdi mdi-trending-up fs-14"></i>
                                                8%</span>
                                            <p class="text-dark fs-13 mb-0">Last days</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl">
                        <div class="card">
                            <a href="#">
                                <div class="card-body">
                                    <div class="widget-first">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="p-2 border border-warning border-opacity-10 bg-warning-subtle rounded-2 me-2">
                                                <div class="bg-warning rounded-circle widget-size text-center">
                                                    <i class="fa-solid fa-cow" style="color: white"></i>
                                                </div>
                                            </div>
                                            <p class="mb-0 text-dark fs-5">पशुपालन सहायता</p>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="mb-0 fs-22 text-dark me-3">0</h3>

                                            <div class="text-muted">
                                                <span class="text-danger fs-14 me-2"><i
                                                        class="mdi mdi-trending-down fs-14"></i>
                                                    18%</span>
                                                <p class="text-dark fs-13 mb-0">Last days</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>

                </div>
                <!-- End Main Widgets -->




            </div>
            <!-- container-fluid -->
        </div>
    </div>
@endsection
