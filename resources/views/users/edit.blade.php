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
    <div class="k-portlet k-portlet--mobile">
        <div class="k-portlet__head">
            <div class="k-portlet__head-label">
                <h3 class="k-portlet__head-title">Edit User: {{ $user->name }}</h3>
            </div>
        </div>

        <form action="{{ route('users.update', $user) }}" class="k-form" method="POST">
            {{ csrf_field()  }}
            @include('users._form')
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $('.k-repeater').each(function(){
            $(this).repeater({
                show: function () {
                    $(this).slideDown();
                }
            });
        });
    </script>
@endpush