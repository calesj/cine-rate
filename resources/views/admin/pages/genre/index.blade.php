@extends('admin.layouts.master')

@section('content')
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Todos Os Gêneros</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


@endsection

@include('app.components.toggle-switch')
