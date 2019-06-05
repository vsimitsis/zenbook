@extends('layouts.console')
@section('title', __('models.modules'))
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('exam.index') }}" class="k-content__head-breadcrumb-link">{{ __('models.exams') }}</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route($parentModel->getModelName() . '.show', $parentModel) }}" class="k-content__head-breadcrumb-link">{{  $parentModel->name }}</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">{{ $section->name }}</span>
    </div>
@endsection

@section('content')
        <div class="k-portlet k-portlet--mobile">
            <div class="k-portlet__head k-portlet__head--lg">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">{{ __('models.modules') }}</h3>
                </div>
                <div class="k-portlet__head-toolbar">
                    <a href="{{ route($parentModel->getModelName() . '.show', $parentModel) }}" class="btn btn-sm-no-icon btn-outline-secondary k-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="k-hidden-mobile">{{ __('actions.back') }}</span>
                    </a>
                    @can('edit', $parentModel)
                        <div class="btn-group">
                            <a href="{{ route('module.create', ['parent' => $parentModel->getModelUrlName(), 'parent_id' => $parentModel->id, 'section' => $section]) }}"
                               class="btn btn-sm-no-icon btn-outline-brand">
                                <i class="la la-plus"></i>
                                <span class="k-hidden-mobile">{{ __('actions.create_module') }}</span>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="k-portlet__body">
                <div id="k_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <form action="{{ route('section.show', ['parent_type' => $parentModel->getModelUrlName(), 'parent_id' => $parentModel->id, 'section' => $section]) }}" method="GET">
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
                                        <select name="visibility" class="form-control filter-select">
                                            <option value="all" {{ ($visibility == 'all' || $visibility == null) ? 'selected' : ''}}>{{ __('general.all') }}</option>
                                            <option value="visible" {{ $visibility == 'visible' ? 'selected' : ''}}>{{ __('general.visible') }}</option>
                                            <option value="hidden" {{ $visibility == 'hidden' ? 'selected' : ''}}>{{ __('general.hidden') }}</option>
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
                                <th class="sorting">{{ __('models.module_type') }}</th>
                                <th class="sorting">{{ __('general.visibility') }}</th>
                                <th>{{ __('actions.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{ $module->name }}</td>
                                    <td>{{ __('models.'. $module->moduleType->name) }}</td>
                                    <td>{!! $module->visibilityToHtml() !!}</td>
                                    <td>
                                        <form action="{{ route('module.destroy', $module) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <span class="dropdown">
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                                        <i class="la la-ellipsis-h"></i>
                                                    </a>

                                                    <span class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                           href="{{ route('module.edit', ['parent' => $parentModel->getModelUrlName(), 'parent_id' => $parentModel->id, 'section' => $section, 'module' => $module]) }}"><i
                                                                    class="la la-edit"></i> {{ __('actions.edit') }}</a>
                                                        <a href="#" class="dropdown-item delete-alert" data-action="delete"><i class="la la-trash"></i> {{ __('actions.delete') }}</a>
                                                    </span>
                                                </span>
                                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('models.report') }}">
                                                <i class="fa fa-chart-bar"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @if($modules->isEmpty())
                            <div class="zero-results">{{ __('general.no_results_found') }}</div>
                        @endif
                    </div>
                </div>

                <div class="dataTables_paginate paging_simple_numbers mx-auto mt-5">
                    {{ $modules->appends(['search' => $search, 'visibility' => $visibility])->links() }}
                </div>
            </div>
        </div>
@endsection
