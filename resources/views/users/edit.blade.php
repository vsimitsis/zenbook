@extends('layouts.console')
@section('title', 'Edit User')
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('user.index') }}" class="k-content__head-breadcrumb-link">Users</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">Edit User</span>
    </div>
@endsection

@section('content')
    <form action="{{ route('user.update', $user) }}" class="k-form" method="POST">
        {{ method_field('PUT') }}
        <div class="k-portlet k-portlet--mobile">
            <div class="k-portlet__head k-portlet__head--lg">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">Edit User: {{ $user->name }}</h3>
                </div>
                <div class="k-portlet__head-toolbar">
                    <a href="{{ route('user.index') }}" class="btn btn-sm-no-icon btn-outline-secondary k-margin-r-10">
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

            @include('users.partials._form')
        </div>
    </form>

    @can('manage', $user->company)
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
                                @if(!$currentUser->is($user))
                                    <h4 class="text-muted">Status</h4>
                                    <p class="text-muted">
                                        Suspend or re-active the account anytime.
                                        By suspending the account you just block the access of this user at your company.
                                        No data are lost and you can re-activate the account at anytime.
                                    </p>
                                    @if($user->status === \App\User::ACTIVE)
                                        <form action="{{ route('user.status', $user) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="status" value="{{ \App\User::SUSPENDED }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Suspend the account</button>
                                        </form>
                                    @elseif($user->status === \App\User::SUSPENDED)
                                        <form action="{{ route('user.status', $user) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="status" value="{{ \App\User::ACTIVE }}">
                                            <button type="submit" class="btn btn-sm btn-outline-success">Activate the account</button>
                                        </form>
                                    @endif
                                @endif

                                <h4 class="text-muted">Delete Account</h4>
                                <p class="text-muted">This action cannot be undone.</p>

                                <form action="{{ route('user.destroy', $user) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="button" class="btn btn-sm btn-outline-danger delete-alert"
                                            data-action="delete">Delete the account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
