@extends('layouts.console')
@section('title', 'Add Customer')
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('customer.index') }}" class="k-content__head-breadcrumb-link">Customers</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">Add Customer</span>
    </div>
@endsection

@section('content')
    <form action="{{ route('customer.store') }}" class="k-form" method="POST">
        <div class="k-portlet k-portlet--mobile">
            <div class="k-portlet__head k-portlet__head--lg">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">Add Customer</h3>
                </div>
                <div class="k-portlet__head-toolbar">
                    <a href="{{ route('customer.index') }}" class="btn btn-sm-no-icon btn-outline-secondary k-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="k-hidden-mobile">Back</span>
                    </a>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-sm-no-icon btn-outline-brand">
                            <i class="la la-check"></i>
                            <span class="k-hidden-mobile">Save</span>
                        </button>
                    </div>
                </div>
            </div>

            @include('customers.partials._form')
        </div>
    </form>
@endsection
