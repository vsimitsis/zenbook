@extends('layouts.console')
@section('title', __('actions.view') . ' ' . $exam->name)
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('exam.index') }}" class="k-content__head-breadcrumb-link">{{ __('models.exams') }}</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('exam.index') }}" class="k-content__head-breadcrumb-link">{{  $exam->name }}</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">{{ __('actions.view') }}</span>
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
                <div class="btn-group">
                    <a href="javascript:window.print()"
                       class="btn btn-sm-no-icon btn-outline-brand">
                        <i class="la la-print"></i>
                        <span class="k-hidden-mobile">{{ __('actions.print') }}</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="k-portlet__body">
            <div id="k_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                @foreach($exam->sections as $section)
                    {{ $section->name }}
                @endforeach

            </div>
        </div>
    </div>
@endsection
