<button class="k-aside-close " id="k_aside_close_btn"><i class="la la-close"></i></button>
<div class="k-aside  k-aside--fixed 	k-grid__item k-grid k-grid--desktop k-grid--hor-desktop" id="k_aside">
    <div class="k-aside__brand	k-grid__item " id="k_aside_brand">
        <div class="k-aside__brand-logo">
            <a href="{{ route('dashboard.index') }}">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-6.png') }}" />
            </a>
        </div>
        <div class="k-aside__brand-tools">
            <button class="k-aside__brand-aside-toggler k-aside__brand-aside-toggler--left" id="k_aside_toggler"><span></span></button>
        </div>
    </div>

    @include('layouts.partials._aside-menu')
    @include('layouts.partials._aside-footer')
</div>