@extends('layouts.backend.mastar')

@section('title')
{{__('backend/dashboard.Home') }}
@endsection

@section('css')

@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 style="font-family: 'Cairo', sans-serif"> {{__('backend/dashboard.control_panel') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('dashboard')}}" class="default-color"> {{__('backend/dashboard.home') }}</a></li>
                    <li class="breadcrumb-item active">{{__('backend/dashboard.control_panel') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- main body -->
    <!-- widgets -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                  <span class="text-danger">
                    <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>
                  </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">cxvxcvxc</p>
                            <h4>65,650</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> 81% lower growth
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                  <span class="text-warning">
                    <i class="fa fa-shopping-cart highlight-icon" aria-hidden="true"></i>
                  </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">Orders</p>
                            <h4>656</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i> Total sales
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                  <span class="text-success">
                    <i class="fa fa-dollar highlight-icon" aria-hidden="true"></i>
                  </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">Revenue</p>
                            <h4>$65656</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-calendar mr-1" aria-hidden="true"></i> Sales Per Week
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                  <span class="text-primary">
                    <i class="fa fa-twitter highlight-icon" aria-hidden="true"></i>
                  </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">Followers</p>
                            <h4>62,500+</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <i class="fa fa-repeat mr-1" aria-hidden="true"></i> Just Updated
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Orders Status widgets-->
    <div class="row">
        <div class="col-xl-4 mb-30">
            <div class="card card-statistics h-100">
                <!-- action group -->
                <div class="btn-group info-drop">
                    <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="text-primary ti-reload"></i>Refresh</a>
                        <a class="dropdown-item" href="#"><i class="text-secondary ti-eye"></i>View all</a>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Market summary</h5>
                    <h4>$50,500 </h4>
                    <div class="row mt-20">
                        <div class="col-4">
                            <h6>Apple</h6>
                            <b class="text-info">+ 82.24 % </b>
                        </div>
                        <div class="col-4">
                            <h6>Instagram</h6>
                            <b class="text-danger">- 12.06 % </b>
                        </div>
                        <div class="col-4">
                            <h6>Google</h6>
                            <b class="text-warning">+ 24.86 % </b>
                        </div>
                    </div>
                </div>
                <div id="sparkline2" class="scrollbar-x text-center"></div>
            </div>
        </div>
        <div class="col-xl-8 mb-30">
            <div class="card h-100">
                <div class="btn-group info-drop">
                    <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="text-primary ti-reload"></i>Refresh</a>
                        <a class="dropdown-item" href="#"><i class="text-secondary ti-eye"></i>View all</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-block d-md-flexx justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title">Site Visits Growth </h5>
                        </div>
                        <div class="d-flex">
                            <div class="clearfix mr-30">
                                <h6 class="text-success">Income</h6>
                                <p>+584</p>
                            </div>
                            <div class="clearfix  mr-50">
                                <h6 class="text-danger"> Outcome</h6>
                                <p>-255</p>
                            </div>
                        </div>
                    </div>
                    <div id="morris-area" style="height: 320px;"></div>
                </div>
            </div>
        </div>
    </div>



@endsection



@section('js')

@endsection
