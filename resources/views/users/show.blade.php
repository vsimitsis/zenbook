@extends('layouts.console')
@section('title', $user->name)
@section('breadcrumbs')
    <div class="k-content__head-breadcrumbs">
        <a href="{{ route('dashboard.index') }}" class="k-content__head-breadcrumb-home"><i class="flaticon2-shelter"></i></a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <a href="{{ route('user.index') }}" class="k-content__head-breadcrumb-link">Users</a>
        <span class="k-content__head-breadcrumb-separator"></span>
        <span class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">{{ $user->name }}</span>
    </div>
@endsection

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="k-portlet k-portlet--mobile">
            <div class="k-portlet__body">
                <div class="k-user-card k-margin-b-50 k-margin-b-30-tablet-and-mobile" style="background-image: url(../assets/media/misc/head_bg.jpg)">
                    <div class="k-user-card__wrapper">
                        <div class="k-user-card__pic">
                            {!! $currentUser->avatar() !!}
                        </div>
                        <div class="k-user-card__details">
                            <div class="k-user-card__name">{{ $user->name }}</div>
                            <div class="k-user-card__position">{{ $user->companyRole->name }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="k-portlet k-portlet--mobile">
                <div class="k-portlet__body">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-primary" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#k_tabs_8_1" role="tab"><i class="fas fa-clipboard-list"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#k_tabs_8_2" role="tab"><i class="fab fa-viber"></i> Activity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#k_tabs_8_3" role="tab"><i class="fa fa-puzzle-piece"></i> Logs</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="k_tabs_8_1" role="tabpanel">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                        </div>
                        <div class="tab-pane fade" id="k_tabs_8_2" role="tabpanel">
                            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </div>
                        <div class="tab-pane fade" id="k_tabs_8_3" role="tabpanel">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection