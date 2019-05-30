@extends('layouts.console')
@section('title', __('models.documents'))
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">{{ __('models.documents') }}</span>
    </div>
@endsection

@section('content')
    <div class="k-portlet k-portlet--mobile">
        <div class="k-portlet__head k-portlet__head--lg">
            <div class="k-portlet__head-label">
                <h3 class="k-portlet__head-title">{{ __('models.documents') }}</h3>
            </div>
            <div class="k-portlet__head-toolbar">
                <a href="{{ route('dashboard.index') }}" class="btn btn-sm-no-icon btn-outline-secondary k-margin-r-10">
                    <i class="la la-arrow-left"></i>
                    <span class="k-hidden-mobile">{{ __('actions.back') }}</span>
                </a>
                @can('create', \App\User::class)
                    <div class="btn-group">
                        <a href="{{ route('document.create') }}" class="btn btn-sm-no-icon btn-outline-brand">
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
                        <form action="{{ route('document.index') }}" method="GET">
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
                                    <select name="access" class="form-control filter-select">
                                        <option value="all" {{ ($access == 'all' || $access == null) ? 'selected' : ''}}>{{ __('general.all') }}</option>
                                        <option value="public" {{ $access == 'public' ? 'selected' : ''}}>{{ __('general.public') }}</option>
                                        <option value="private" {{ $access == 'private' ? 'selected' : ''}}>{{ __('general.private') }}</option>
                                        <option value="shared" {{ $access == 'shared' ? 'selected' : ''}}>{{ __('general.shared') }}</option>
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
                            <th class="sorting">{{ __('general.access') }}</th>
                            <th class="sorting">{{ __('general.type') }}</th>
                            <th>{{ __('actions.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($documents as $document)
                            <tr>
                                <td><a href="{{ route('document.show', $document) }}" target="_blank">{{ $document->original_filename }}</a></td>
                                <td>{!! $document->accessToHtml() !!}</td>
                                <td>{{ $document->mime_type }}</td>
                                <td>
                                    @can('edit', $document)
                                        <form action="{{ route('document.destroy', $document) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <span class="dropdown">
                                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                                    <i class="la la-ellipsis-h"></i>
                                                </a>

                                                <span class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('document.edit', $document) }}"><i class="la la-edit"></i> {{ __('actions.edit') }}</a>
                                                    <a href="#" class="dropdown-item delete-alert" data-action="delete"><i class="la la-trash"></i> {{ __('actions.delete') }}</a>
                                                </span>
                                            </span>
                                            <a href="{{ route('document.download', $document) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('actions.download') }}">
                                                <i class="la la-download"></i>
                                            </a>
                                        </form>
                                    @else
                                        <a href="{{ route('document.download', $document) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('actions.download') }}">
                                            <i class="la la-download"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($documents->isEmpty())
                        <div class="zero-results">{{ __('general.no_results_found') }}</div>
                    @endif
                </div>
            </div>

            <div class="dataTables_paginate paging_simple_numbers" id="k_table_1_paginate">
                {{ $documents->appends(['search' => $search, 'access' => $access])->links() }}
            </div>
        </div>
    </div>
@endsection
