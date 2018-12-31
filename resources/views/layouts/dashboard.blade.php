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
                @include('layouts.partials._breadcrumbs')

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

<!--Global Theme Bundle -->
<script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app/scripts/bundle/app.bundle.js') }}" type="text/javascript"></script>
<!-- DataTables Js -->
<script src="{{ asset('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<!-- Page specific Js -->
@stack('scripts')
</body>
</html>