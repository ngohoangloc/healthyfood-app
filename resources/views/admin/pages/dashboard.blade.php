@extends('admin')

@section('title')
    <title>Tổng quan | Healthy Food</title>
@endsection

@section('content')
    <!-- Page header -->
<div class="page-header d-print-none text-white">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Navbar overlap layout
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="#" class="btn btn-dark">
                            New view
                        </a>
                    </span>
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block"
                        data-bs-toggle="modal" data-bs-target="#modal-report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Create new report
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-report" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Sales</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Last 7 days</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Last 7 days</a>
                                        <a class="dropdown-item" href="#">Last 30 days</a>
                                        <a class="dropdown-item" href="#">Last 3 months</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h1 mb-3">75%</div>
                        <div class="d-flex mb-2">
                            <div>Conversion rate</div>
                            <div class="ms-auto">
                                <span class="text-green d-inline-flex align-items-center lh-1">
                                    7% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 17l6 -6l4 4l8 -8" />
                                        <path d="M14 7l7 0l0 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: 75%" role="progressbar"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                aria-label="75% Complete">
                                <span class="visually-hidden">75% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Revenue</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Last 7 days</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Last 7 days</a>
                                        <a class="dropdown-item" href="#">Last 30 days</a>
                                        <a class="dropdown-item" href="#">Last 3 months</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-0 me-2">$4,300</div>
                            <div class="me-auto">
                                <span class="text-green d-inline-flex align-items-center lh-1">
                                    8% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1"
                                        width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 17l6 -6l4 4l8 -8" />
                                        <path d="M14 7l7 0l0 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="chart-revenue-bg" class="chart-sm"></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">New clients</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Last 7 days</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Last 7 days</a>
                                        <a class="dropdown-item" href="#">Last 30 days</a>
                                        <a class="dropdown-item" href="#">Last 3 months</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">6,782</div>
                            <div class="me-auto">
                                <span class="text-yellow d-inline-flex align-items-center lh-1">
                                    0% <!-- Download SVG icon from http://tabler-icons.io/i/minus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1"
                                        width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div id="chart-new-clients" class="chart-sm"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Active users</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Last 7 days</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Last 7 days</a>
                                        <a class="dropdown-item" href="#">Last 30 days</a>
                                        <a class="dropdown-item" href="#">Last 3 months</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">2,986</div>
                            <div class="me-auto">
                                <span class="text-green d-inline-flex align-items-center lh-1">
                                    4% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1"
                                        width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 17l6 -6l4 4l8 -8" />
                                        <path d="M14 7l7 0l0 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div id="chart-active-users" class="chart-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
