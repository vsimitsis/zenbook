<div class="k-content__head	k-grid__item">
    <div class="k-content__head-main">
        @yield('breadcrumbs')
    </div>
    <div class="k-content__head-toolbar">
        <div class="k-content__head-wrapper">
            <a href="#" class="btn btn-sm btn-elevate btn-brand">
                <span class="k-opacity-8">{{ \App\DateHelper::calendarDayTranslator() }}</span>&nbsp;
                <span class="k-font-bold">{{ \Carbon\Carbon::now()->format('H:i') }}</span>
                <i class="flaticon-calendar-with-a-clock-time-tools k-padding-l-5 k-padding-r-0"></i>
            </a>
        </div>
    </div>
</div>