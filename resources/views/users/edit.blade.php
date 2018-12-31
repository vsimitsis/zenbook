@extends('layouts.dashboard')
@section('title', 'Edit User')
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('users.index') }}" class="k-content__head-breadcrumb-link">Users</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">Edit User</span>
    </div>
@endsection

@section('content')
    <form action="{{ route('users.update', $user) }}" class="k-form" method="POST">
        <div class="k-portlet k-portlet--mobile">
            <div class="k-portlet__head k-portlet__head--lg">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">Edit User: {{ $user->name }}</h3>
                </div>
                <div class="k-portlet__head-toolbar">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary k-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="k-hidden-mobile">Back</span>
                    </a>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">
                            <i class="la la-check"></i>
                            <span class="k-hidden-mobile">Save</span>
                        </button>
                    </div>
                </div>
            </div>

        @include('users.partials._form')
        </div>
    </form>


@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.k-repeater').each(function(){
                $(this).repeater({
                    show: function () {
                        $(this).slideDown();
                    }
                });
            });
        });
    </script>
@endpush