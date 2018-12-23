<html lang="en">
@include('layouts.partials._head')

<body class="k-header--fixed k-header-mobile--fixed k-aside--enabled k-aside--fixed">
@include('layouts.partials._mobile-header')

<div class="k-grid k-grid--hor k-grid--root">
    <div class="k-grid__item k-grid__item--fluid k-grid k-grid--ver k-page">
        @include('layouts.partials._aside-bar')

        <div class="k-grid__item k-grid__item--fluid k-grid k-grid--hor k-wrapper" id="k_wrapper">
            @include('layouts.partials._top-bar')

            <div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">
                @include('layouts.partials.breadcrumps')

                @yield('content')
            </div>

            @include('layouts.partials._footer')
        </div>
    </div>
</div>

<!--Scroll top button-->
<div id="k_scrolltop" class="k-scrolltop">
    <i class="la la-arrow-up"></i>
</div>

@include('layouts.partials._toolbar-search')
@include('layouts.partials._toolbar-quick-actions')
@include('layouts.partials._toolbar-quick-panel')

<!--begin::Global Theme Bundle -->
<script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--begin::Page Vendors -->
<script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--begin::Page Scripts -->
<script src="assets/app/scripts/custom/dashboard.js" type="text/javascript"></script>
<!--begin::Global App Bundle -->
<script src="assets/app/scripts/bundle/app.bundle.js" type="text/javascript"></script>
@stack('scripts')
</body>

</html>