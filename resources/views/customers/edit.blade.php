@extends('layouts.console')
@section('title', 'Edit Customer')
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('customer.index') }}" class="k-content__head-breadcrumb-link">Customers</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">Edit Customer</span>
    </div>
@endsection

@section('content')
    <form action="{{ route('customer.update', $customer) }}" class="k-form" method="POST">
        {{ method_field('PUT') }}
        <div class="k-portlet k-portlet--mobile">
            <div class="k-portlet__head k-portlet__head--lg">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">Edit Customer: {{ $customer->name }}</h3>
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

    @can('manage', $customer->company)
        <div class="k-portlet">
            <div class="k-portlet__body">
                <div class="accordion accordion-light" id="account_actions_accordion">
                    <div class="card">
                        <div class="card-header" id="heading">
                            <div class="card-title collapsed text-danger" data-toggle="collapse" data-target="#account_actions" aria-expanded="false" aria-controls="account_actions">
                                <i class="flaticon-lock"></i> Account Actions
                            </div>
                        </div>
                        <div id="account_actions" class="collapse" aria-labelledby="heading" data-parent="#account_actions_accordion">
                            <div class="card-body">
                                <h4 class="text-muted">Delete Customer</h4>
                                <p class="text-muted">This action cannot be undone.</p>

                                <form action="{{ route('customer.delete', $customer) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-alert"
                                            data-action="delete">Delete Customer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
