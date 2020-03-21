@extends('layouts.console')
@section('title', __('models.classrooms'))
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">{{ __('models.classrooms') }}</span>
    </div>
@endsection

@section('content')
    <div class="k-portlet k-portlet--mobile">
        <div class="k-portlet__head k-portlet__head--lg">
            <div class="k-portlet__head-label">
                <h3 class="k-portlet__head-title">{{ __('models.classrooms') }}</h3>
            </div>
            <div class="k-portlet__head-toolbar">
                <a href="{{ route('dashboard.index') }}" class="btn btn-sm-no-icon btn-outline-secondary k-margin-r-10">
                    <i class="la la-arrow-left"></i>
                    <span class="k-hidden-mobile">{{ __('actions.back') }}</span>
                </a>
                @can('create', \App\Classroom::class)
                    <div class="btn-group">
                        <a href="{{ route('classroom.create') }}"
                           class="btn btn-sm-no-icon btn-outline-brand">
                            <i class="la la-plus"></i>
                            <span class="k-hidden-mobile">{{ __('actions.create_classroom') }}</span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>

        <div class="k-portlet__body">
            <div id="k_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <form action="{{ route('classroom.index') }}" method="GET">
                            <div class="row align-items-center">
                                <div class="col-md-3 k-margin-b-20-tablet-and-mobile">
                                    <div class="k-input-icon k-input-icon--left">
                                        <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="{{ __('general.search_by_name') }}">
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
                            <th class="sorting_desc">{{ __('general.name') }}</th>
                            <th class="sorting">{{ __('models.teachers') }}</th>
                            <th class="sorting">{{ __('models.students') }}</th>
                            <th>{{ __('actions.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classrooms as $classroom)
                            <tr>
                                <td>{{ $classroom->name }}</td>
                                <td>{{ $classroom->teachers()->count() }}</td>
                                <td>{{ $classroom->students()->count() }}</td>
                                <td>
                                    <form action="{{ route('classroom.destroy', $classroom) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{ route('classroom.show', $classroom) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="{{ __('actions.view') }}">
                                            <i class="la la-eye"></i>
                                        </a>

                                        <span class="dropdown">
                                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                                <i class="la la-ellipsis-h"></i>
                                            </a>

                                            <span class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item"
                                                   href="{{ route('classroom.edit', $classroom) }}"><i class="la la-edit"></i> {{ __('actions.edit') }}</a>
                                                <a href="#" class="dropdown-item"><i class="fa fa-chart-bar"></i> {{ __('models.report') }}</a>
                                                <a href="#" class="dropdown-item delete-alert" data-action="delete"><i class="la la-trash"></i> {{ __('actions.delete') }}</a>
                                            </span>
                                        </span>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($classrooms->isEmpty())
                        <div class="zero-results">{{ __('general.no_results_found') }}</div>
                    @endif
                </div>
            </div>

            <div class="ml-auto mt-5">
                {{ $classrooms->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
@endsection
