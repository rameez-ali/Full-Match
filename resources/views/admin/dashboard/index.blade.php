@extends('admin.layouts.app')

@section('content')
    <div class="col s12">
        <div class="container">
            <div class="section">
                <!--card stats start-->
                <div id="card-stats" class="pt-0">
                    <div class="row">
                        <div class="col s12 m6 l6 xl3">
                            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                                <div class="padding-4">
                                    <div class="row">
                                        <div class="col s7 m7">
                                            <i class="material-icons background-round mt-5">add_shopping_cart</i>
                                            <p>Orders</p>
                                        </div>
                                        <div class="col s5 m5 right-align">
                                            <h5 class="mb-0 white-text">690</h5>
                                            <p class="no-margin">New</p>
                                            <p>6,00,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6 xl3">
                            <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                                <div class="padding-4">
                                    <div class="row">
                                        <div class="col s7 m7">
                                            <i class="material-icons background-round mt-5">perm_identity</i>
                                            <p>Clients</p>
                                        </div>
                                        <div class="col s5 m5 right-align">
                                            <h5 class="mb-0 white-text">1885</h5>
                                            <p class="no-margin">New</p>
                                            <p>1,12,900</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6 xl3">
                            <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
                                <div class="padding-4">
                                    <div class="row">
                                        <div class="col s7 m7">
                                            <i class="material-icons background-round mt-5">timeline</i>
                                            <p>Sales</p>
                                        </div>
                                        <div class="col s5 m5 right-align">
                                            <h5 class="mb-0 white-text">80%</h5>
                                            <p class="no-margin">Growth</p>
                                            <p>3,42,230</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6 xl3">
                            <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
                                <div class="padding-4">
                                    <div class="row">
                                        <div class="col s7 m7">
                                            <i class="material-icons background-round mt-5">attach_money</i>
                                            <p>Profit</p>
                                        </div>
                                        <div class="col s5 m5 right-align">
                                            <h5 class="mb-0 white-text">$890</h5>
                                            <p class="no-margin">Today</p>
                                            <p>$25,000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--card stats end-->
                <!--yearly & weekly revenue chart start-->
                <div id="sales-chart">
                    <div class="row">
                        <div class="col s12 m8 l8">
                            <div id="revenue-chart" class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header mt-0">
                                        REVENUE FOR 2020
                                        <span class="purple-text small text-darken-1 ml-1">
                                                    <i class="material-icons">keyboard_arrow_up</i> 15.58 %</span>
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow right">Details</a>
                                    </h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="yearly-revenue-chart">
                                                <canvas id="thisYearRevenue" class="firstShadow" height="350"></canvas>
                                                <canvas id="lastYearRevenue" height="350"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4 l4">
                            <div id="weekly-earning" class="card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="header m-0">Earning <i class="material-icons right grey-text lighten-3">more_vert</i></h4>
                                    <p class="no-margin grey-text lighten-3 medium-small">Mon 15 - Sun 21</p>
                                    <h3 class="header">$899.39 <i class="material-icons deep-orange-text text-accent-2">arrow_upward</i>
                                    </h3>
                                    <canvas id="monthlyEarning" class="" height="150"></canvas>
                                    <div class="center-align">
                                        <p class="lighten-3">Total Weekly Earning</p>
                                        <a class="waves-effect waves-light btn gradient-45deg-purple-deep-orange gradient-shadow">View
                                            Full</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--yearly & weekly revenue chart end-->
                <!-- Member online, Currunt Server load & Today's Revenue Chart start -->
                <div id="daily-data-chart">
                    <div class="row">
                        <div class="col s12 m4 l4">
                            <div class="card pt-0 pb-0 animate fadeLeft">
                                <div class="dashboard-revenue-wrapper padding-2 ml-2">
                                    <span class="new badge gradient-45deg-light-blue-cyan gradient-shadow mt-2 mr-2">+ 42.6%</span>
                                    <p class="mt-2 mb-0">Members online</p>
                                    <p class="no-margin grey-text lighten-3">360 avg</p>
                                    <h5>3,450</h5>
                                </div>
                                <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                                    <canvas id="custom-line-chart-sample-one" class="center"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4 l4 animate fadeUp">
                            <div class="card pt-0 pb-0">
                                <div class="dashboard-revenue-wrapper padding-2 ml-2">
                                    <span class="new badge gradient-45deg-purple-deep-orange gradient-shadow mt-2 mr-2">+ 12%</span>
                                    <p class="mt-2 mb-0">Current server load</p>
                                    <p class="no-margin grey-text lighten-3">23.1% avg</p>
                                    <h5>+2500</h5>
                                </div>
                                <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                                    <canvas id="custom-line-chart-sample-two" class="center"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4 l4">
                            <div class="card pt-0 pb-0 animate fadeRight">
                                <div class="dashboard-revenue-wrapper padding-2 ml-2">
                                    <span class="new badge gradient-45deg-amber-amber gradient-shadow mt-2 mr-2">+ $900</span>
                                    <p class="mt-2 mb-0">Today's revenue</p>
                                    <p class="no-margin grey-text lighten-3">$40,512 avg</p>
                                    <h5>$ 22,300</h5>
                                </div>
                                <div class="sample-chart-wrapper" style="margin-bottom: -14px; margin-top: -75px;">
                                    <canvas id="custom-line-chart-sample-three" class="center"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--end container-->
            </div>
        </div>
        <div class="content-overlay"></div>
    </div>
@endsection
