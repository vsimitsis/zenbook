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
        <div class="k-portlet__head">
            <div class="k-portlet__head-label">
                <h3 class="k-portlet__head-title">Users Table</h3>
            </div>
        </div>
        <div class="k-portlet__body">
            <div id="k_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div id="k_table_1_filter" class="dataTables_filter">
                    <label>Search:
                        <input type="search" class="form-control form-control-sm">
                    </label>
                </div>
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
                                        <span class="k-user-card-v2__name">Vagelis Simitsis</span>
                                        <a href="mailto:{{ $user->email }}" class="k-user-card-v2__email k-link">vagelis@example.com</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->companyRole->name }}</td>
                            <td><a href="mailto:{{ $user->email }}" class="k-user-card-v2__email k-link">{{ $user->email }}</a></td>
                            <td>07874675263</td>
                            <td>
                                <span class="k-badge k-badge--success k-badge--inline k-badge--pill">Active</span>
                            </td>
                            <td>
                                <span class="dropdown">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <span class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('users.edit', $user) }}"><i class="la la-edit"></i> Edit Details</a>
                                        <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                        <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                                    </span>
                                </span>
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                    <i class="la la-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
