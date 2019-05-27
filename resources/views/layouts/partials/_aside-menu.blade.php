<div class="k-aside-menu-wrapper k-grid__item k-grid__item--fluid" id="k_aside_menu_wrapper">
    <div id="k_aside_menu" class="k-aside-menu " data-kmenu-vertical="1" data-kmenu-scroll="1" data-kmenu-dropdown-timeout="500">
        <ul class="k-menu__nav ">
            <li class="k-menu__item {{ Request::is('dashboard*') ? 'k-menu__item--active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="k-menu__link k-menu__toggle">
                    <i class="k-menu__link-icon flaticon2-graphic"></i>
                    <span class="k-menu__link-text">{{ __('general.dashboard') }}</span>
                </a>
            </li>

            <li class="k-menu__item">
                <a href="#" class="k-menu__link ">
                    <i class="k-menu__link-icon flaticon2-gear"></i>
                    <span class="k-menu__link-text">{{ __('general.settings') }}</span>
                </a>
            </li>

            <li class="k-menu__section ">
                <h4 class="k-menu__section-text">{{ __('general.general') }}</h4>
                <i class="k-menu__section-icon flaticon-more-v2"></i>
            </li>

            <li class="k-menu__item {{ Request::is('users*') ? 'k-menu__item--active' : '' }}">
                <a href="{{ route('user.index') }}" class="k-menu__link">
                    <i class="k-menu__link-icon flaticon-users"></i>
                    <span class="k-menu__link-text">{{ __('general.users') }}</span>
                </a>
            </li>

            <li class="k-menu__item {{ Request::is('lessons*') ? 'k-menu__item--active' : '' }}">
                <a href="{{ route('lesson.index') }}" class="k-menu__link">
                    <i class="k-menu__link-icon flaticon-folder"></i>
                    <span class="k-menu__link-text">{{ __('general.lessons') }}</span>
                </a>
            </li>

            <li class="k-menu__item {{ Request::is('documents*') ? 'k-menu__item--active' : '' }}">
                <a href="{{ route('document.index') }}" class="k-menu__link">
                    <i class="k-menu__link-icon flaticon-file-2"></i>
                    <span class="k-menu__link-text">{{ __('general.documents') }}</span>
                </a>
            </li>

{{--            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover">--}}
{{--                <a href="javascript:;" class="k-menu__link k-menu__toggle">--}}
{{--                    <i class="k-menu__link-icon flaticon2-layers-1"></i>--}}
{{--                    <span class="k-menu__link-text">Base</span>--}}
{{--                    <i class="k-menu__ver-arrow la la-angle-right"></i>--}}
{{--                </a>--}}

{{--                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>--}}
{{--                    <ul class="k-menu__subnav">--}}
{{--                        <li class="k-menu__item " aria-haspopup="true">--}}
{{--                            <a href="#" class="k-menu__link ">--}}
{{--                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>--}}
{{--                                <span class="k-menu__link-text">Navs</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </li>--}}

{{--            <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover">--}}
{{--                <a href="javascript:;" class="k-menu__link k-menu__toggle">--}}
{{--                    <i class="k-menu__link-icon flaticon2-list-3"></i>--}}
{{--                    <span class="k-menu__link-text">DataTables</span>--}}
{{--                    <i class="k-menu__ver-arrow la la-angle-right"></i>--}}
{{--                </a>--}}

{{--                <div class="k-menu__submenu "><span class="k-menu__arrow"></span>--}}
{{--                    <ul class="k-menu__subnav">--}}
{{--                        <li class="k-menu__item  k-menu__item--submenu" aria-haspopup="true" data-kmenu-submenu-toggle="hover">--}}
{{--                            <a href="javascript:;" class="k-menu__link k-menu__toggle">--}}
{{--                                <i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>--}}
{{--                                <span class="k-menu__link-text">Extensions</span>--}}
{{--                                <i class="k-menu__ver-arrow la la-angle-right"></i>--}}
{{--                            </a>--}}

{{--                            <div class="k-menu__submenu "><span class="k-menu__arrow"></span>--}}
{{--                                <ul class="k-menu__subnav">--}}
{{--                                    <li class="k-menu__item " aria-haspopup="true">--}}
{{--                                        <a href="#" class="k-menu__link "><i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>--}}
{{--                                            <span class="k-menu__link-text">Buttons</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>