@extends('layouts.admin')
@section('content')
  <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                    
                        <div class="row">
                                    <div class="col-xl-12">
                                            <div class="breadcrumb-holder">
                                                    <h1 class="main-title float-left">Medica Max</h1>
                                                    <ol class="breadcrumb float-right">
                                                        <li class="breadcrumb-item">Drugs Management</li>
                                                        <li class="breadcrumb-item active">Composition</li>
                                                    </ol>
                                                    <div class="clearfix"></div>
                                            </div>
                                    </div>
                        </div>
                        <!-- end row -->
                   @yield('action-content')

            </div>
            <!-- END container-fluid -->
        </div>
        <!-- END content -->
 
    </div>
    <!-- END content-page -->
    @endsection
