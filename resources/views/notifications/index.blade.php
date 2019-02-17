@extends('layouts.console')
@section('title', 'Notifications')
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">Notifications</span>
    </div>
@endsection

@section('content')
    <div class="k-portlet k-portlet--mobile">
        <div class="k-portlet__body">
            <div id="k_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <form action="{{ route('notification.index') }}" method="GET">
                            <div class="row align-items-center">
                                <div class="col-md-3 k-margin-b-20-tablet-and-mobile">
                                    <div class="k-input-icon k-input-icon--left">
                                        <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="Search...">
                                        <span class="k-input-icon__icon k-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped dataTable">
                        <thead>
                        <tr>
                            <th class="sorting_desc">Type</th>
                            <th class="sorting">Title</th>
                            <th class="sorting">Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notifications as $notification)
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @endforeach
                        </tbody>
                    </table>

                    @if($notifications->isEmpty())
                        <p class="zero-results">You have no previous notifications.</p>
                    @endif
                </div>
            </div>
            <div class="dataTables_paginate paging_simple_numbers" id="k_table_1_paginate">
                {{ $notifications->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
@endsection