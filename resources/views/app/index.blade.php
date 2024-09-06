@extends('app.layouts.master')


@section('content')
    <!-- home -->
    @include('app.sections.home')
    <!-- end home -->

    <!-- popular -->
    @include('app.sections.popular')
    <!-- end popular -->

    <!-- classic -->
    @include('app.sections.classic')
    <!-- end classic -->

    <!-- binge -->
    @include('app.sections.binge')
    <!-- end binge -->

    <!-- subscriptions -->
    @include('app.sections.subscriptions')
    <!-- end subscriptions -->

    <!-- plan -->
    @include('app.sections.plan')
    <!-- end plan -->

    <!-- videos -->
    @include('app.sections.videos')
    <!-- end videos -->
@endsection

@include('app.components.swet-alert-success')
@include('app.components.add-favorites')
