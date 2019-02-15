@extends('layouts.dashboard')
@section('title', 'Users')
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">Users</span>
    </div>
@endsection

@section('content')
    <div class="k-portlet k-portlet--mobile">
        <div class="k-portlet__head k-portlet__head--lg">
            <div class="k-portlet__head-label">
                <h3 class="k-portlet__head-title">Company Users</h3>
            </div>
            <div class="k-portlet__head-toolbar">
                <a href="{{ route('dashboard.index') }}" class="btn btn-sm-no-icon btn-secondary k-margin-r-10">
                    <i class="la la-arrow-left"></i>
                    <span class="k-hidden-mobile">Back</span>
                </a>
                @can('create', \App\User::class)
                    <div class="btn-group">
                        <a href="{{ route('users.create') }}" class="btn btn-sm-no-icon btn-brand">
                            <i class="la la-plus"></i>
                            <span class="k-hidden-mobile">Create</span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="k-portlet__body">
            <div id="k_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div id="k_table_1_filter" class="dataTables_filter">
                    <label>Search:
                        <input type="search" class="form-control form-control-sm">
                    </label>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped dataTable">
                        <thead>
                        <tr>
                            <th class="sorting_desc">User</th>
                            <th class="sorting">Role</th>
                            <th class="sorting">Email</th>
                            <th class="sorting">Phone</th>
                            <th class="sorting">Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="k-user-card-v2">
                                        <div class="k-user-card-v2__pic">
                                            <img src="https://keenthemes.com/keen/themes/themes/keen/dist/preview/assets/media/users/100_1.jpg" class="k-img-rounded k-marginless" alt="photo">
                                        </div>
                                        <div class="k-user-card-v2__details">
                                            <span class="k-user-card-v2__name">{{ $user->name }}</span>
                                            <a href="mailto:{{ $user->email }}" class="k-user-card-v2__email k-link">{{ $user->email }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->companyRole->name }}</td>
                                <td><a href="mailto:{{ $user->email }}" class="k-user-card-v2__email k-link">{{ $user->email }}</a></td>
                                <td>{{ $user->contacts->first() ? $user->contacts->first()->mobile : '-' }}</td>
                                <td>
                                    @if($user->status === \App\User::ACTIVE)
                                        <span class="k-badge k-badge--success k-badge--inline k-badge--pill">Active</span>
                                    @elseif($user->status === \App\User::PENDING)
                                        <span class="k-badge k-badge--warning k-badge--inline k-badge--pill">Pending</span>
                                    @elseif($user->status === \App\User::SUSPENDED)
                                        <span class="k-badge k-badge--danger k-badge--inline k-badge--pill">Suspended</span>
                                    @endif
                                </td>
                                <td>
                                <span class="dropdown">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <span class="dropdown-menu dropdown-menu-right">
                                        @can('edit', $user)
                                            <a class="dropdown-item" href="{{ route('users.edit', $user) }}"><i class="la la-edit"></i> Edit Details</a>
                                        @endcan
                                        <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                        <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                                    </span>
                                </span>
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                        <i class="la la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
