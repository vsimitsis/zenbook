@extends('layouts.console')
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
                <a href="{{ route('dashboard.index') }}" class="btn btn-sm-no-icon btn-outline-secondary k-margin-r-10">
                    <i class="la la-arrow-left"></i>
                    <span class="k-hidden-mobile">Back</span>
                </a>
                @can('create', \App\User::class)
                    <div class="btn-group">
                        <a href="{{ route('user.create') }}" class="btn btn-sm-no-icon btn-outline-brand">
                            <i class="la la-plus"></i>
                            <span class="k-hidden-mobile">Add</span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="k-portlet__body">
            <div id="k_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <form action="{{ route('user.index') }}" method="GET">
                            <div class="row align-items-center">
                                <div class="col-md-3 k-margin-b-20-tablet-and-mobile">
                                    <div class="k-input-icon k-input-icon--left">
                                        <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="Search...">
                                        <span class="k-input-icon__icon k-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                    </div>
                                </div>

                                <div class="col-md-3 k-margin-b-20-tablet-and-mobile">
                                    <select name="role" class="form-control filter-select">
                                        <option value="all" {{ ($role == 'all' || $role == null) ? 'selected' : ''}}>All</option>
                                        <option value="administrator" {{ $role == 'administrator' ? 'selected' : ''}}>Administrator</option>
                                        <option value="teacher" {{ $role == 'teacher' ? 'selected' : ''}}>Teacher</option>
                                        <option value="student" {{ $role == 'student' ? 'selected' : ''}}>Student</option>
                                    </select>
                                </div>

                                <div class="col-md-3 k-margin-b-20-tablet-and-mobile">
                                    <select name="status" class="form-control filter-select">
                                        <option value="all" {{ ($status == 'all' || $status == null) ? 'selected' : ''}}>All</option>
                                        <option value="active" {{ $status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="suspended" {{ $status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
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
                                <td>{{ $user->userRole->name }}</td>
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
                                            <a class="dropdown-item" href="{{ route('user.edit', $user) }}"><i class="la la-edit"></i> Edit Details</a>
                                        @endcan
                                        <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                        <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                                    </span>
                                </span>
                                    <a href="{{ route('user.show', $user) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                        <i class="la la-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($users->isEmpty())
                        <div class="zero-results">No results found.</div>
                    @endif
                </div>
            </div>

            <div class="dataTables_paginate paging_simple_numbers" id="k_table_1_paginate">
                {{ $users->appends(['search' => $search, 'role' => $role, 'status' => $status])->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/filter-submit.js') }}"></script>
@endpush
