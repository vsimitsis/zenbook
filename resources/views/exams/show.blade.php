@extends('layouts.console')
@section('title', __('models.exams'))
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('exam.index') }}" class="k-content__head-breadcrumb-link">{{ __('models.exams') }}</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">{{ $exam->name }}</span>
    </div>
@endsection

@section('content')
    <div class="k-portlet k-portlet--mobile">
        <div class="k-portlet__head k-portlet__head--lg">
            <div class="k-portlet__head-label">
                <h3 class="k-portlet__head-title">{{ $exam->name }}</h3>
            </div>
            <div class="k-portlet__head-toolbar">
                <a href="{{ route('exam.index') }}" class="btn btn-sm-no-icon btn-outline-secondary k-margin-r-10">
                    <i class="la la-arrow-left"></i>
                    <span class="k-hidden-mobile">{{ __('actions.back') }}</span>
                </a>
                @can('create', \App\Section::class)
                    <div class="btn-group">
                        <a href="{{ route('section.create') }}" class="btn btn-sm-no-icon btn-outline-brand">
                            <i class="la la-plus"></i>
                            <span class="k-hidden-mobile">{{ __('actions.add') }}</span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>

        <div class="k-portlet__body">
            <div id="k_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <form action="{{ route('exam.show', $exam) }}" method="GET">
                            <div class="row align-items-center">
                                <div class="col-md-3 k-margin-b-20-tablet-and-mobile">
                                    <div class="k-input-icon k-input-icon--left">
                                        <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="{{ __('general.search_by_name') }}">
                                        <span class="k-input-icon__icon k-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                                    </div>
                                </div>

                                <div class="col-md-3 k-margin-b-20-tablet-and-mobile">
                                    <select name="status" class="form-control filter-select">
                                        <option value="all" {{ ($status == 'all' || $status == null) ? 'selected' : ''}}>{{ __('general.all') }}</option>
                                        <option value="open" {{ $status == 'open' ? 'selected' : ''}}>{{ __('general.open') }}</option>
                                        <option value="closed" {{ $status == 'closed' ? 'selected' : ''}}>{{ __('general.closed') }}</option>
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
                            <th class="sorting_desc">{{ __('general.name') }}</th>
                            <th class="sorting">{{ __('general.status') }}</th>
                            <th>{{ __('actions.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sections as $section)
                            <tr>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($sections->isEmpty())
                        <div class="zero-results">{{ __('general.no_results_found') }}</div>
                    @endif
                </div>
            </div>

            <div class="dataTables_paginate paging_simple_numbers" id="k_table_1_paginate">
                {{ $sections->appends(['search' => $search, 'access' => $status])->links() }}
            </div>
        </div>
    </div>
@endsection
