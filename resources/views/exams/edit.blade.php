@extends('layouts.console')
@section('title', __('actions.edit_exam'))
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('exam.index') }}" class="k-content__head-breadcrumb-link">{{ __('models.exams') }}</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">{{ __('actions.edit_exam') }}</span>
    </div>
@endsection

@section('content')
    <form id="document_form" action="{{ route('exam.update', $exam) }}" class="k-form" method="POST">
        {{ method_field('PUT') }}

        <div class="k-portlet k-portlet--mobile">
            <div class="k-portlet__head k-portlet__head--lg">
                <div class="k-portlet__head-label">
                    <h3 class="k-portlet__head-title">{{ __('actions.edit_exam') }}</h3>
                </div>
                <div class="k-portlet__head-toolbar">
                    <a href="{{ route('exam.index') }}" class="btn btn-sm-no-icon btn-outline-secondary k-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="k-hidden-mobile">{{ __('actions.back') }}</span>
                    </a>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-sm-no-icon btn-outline-brand">
                            <i class="la la-check"></i>
                            <span class="k-hidden-mobile">{{ __('actions.save') }}</span>
                        </button>
                    </div>
                </div>
            </div>

            @include('exams.partials._form', ['edit' => false])
        </div>
    </form>
@endsection
