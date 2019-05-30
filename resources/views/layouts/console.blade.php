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

<script>
    let KAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "metal": "#c4c5d6",
                "light": "#ffffff",
                "accent": "#00c5dc",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995",
                "focus": "#9816f4"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!--Global Theme Bundle -->
<script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/app/scripts/bundle/app.bundle.js') }}" type="text/javascript"></script>
<!-- DataTables Js -->
<script src="{{ asset('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<!-- Toastr Config -->
<script src="{{ asset('js/toastr-config.js') }}"></script>

<!-- Custom components -->
<script src="{{ asset('js/sweetalert-delete.js') }}"></script>
<script src="{{ asset('js/filter-submit.js') }}"></script>

<script>
    $(document).ready(function () {
        @if(session('success'))
            let success = "{{ session('success') }}";
            toastr.success(success);
        @endif

        @if(session('error'))
            let error = "{{ session('error') }}";
            toastr.error(error);
        @endif
    });
</script>

<!-- Page specific Js -->
@stack('scripts')
</body>
</html>