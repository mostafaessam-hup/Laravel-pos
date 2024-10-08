<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <img src="{{ asset('dashboard/media/avatars/300-3.jpg') }}" class="rounded-3" alt="user" />
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="{{ asset('dashboard/media/avatars/300-3.jpg') }}" />
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">{{ auth('admin')->user()->full_name }}
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Role</span>
                    </div>
                    <a href="#"
                        class="fw-semibold text-muted text-hover-primary fs-7">{{ auth('admin')->user()->email }}</a>
                </div>
            </div>
        </div>
        <div class="separator my-2"></div>
        <div class="menu-item px-5">
            <a href="{{ route('admin.profile.view') }}" class="menu-link px-5">{{ __('admin.profile') }}</a>
        </div>
        <div class="separator my-2"></div>
        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
            <a href="#" class="menu-link px-5">
                <span class="menu-title position-relative">{{ __('admin.theme_mode') }}
                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                        <i class="ki-duotone ki-night-day theme-light-show fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span></span>
            </a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                data-kt-menu="true" data-kt-element="theme-mode-menu">
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-duotone ki-night-day fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                                <span class="path6"></span>
                                <span class="path7"></span>
                                <span class="path8"></span>
                                <span class="path9"></span>
                                <span class="path10"></span>
                            </i>
                        </span>
                        <span class="menu-title">{{ __('admin.light') }}</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-duotone ki-moon fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">{{ __('admin.dark') }}</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3 my-0">
                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                        <span class="menu-icon" data-kt-element="icon">
                            <i class="ki-duotone ki-screen fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">{{ __('admin.system') }}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
            @if (app()->getLocale() == 'ar')
                <a href="#" class="menu-link px-5">
                    <span class="menu-title position-relative">{{ __('admin.language') }}
                        <span
                            class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                            {{ __('admin.arabic') }}
                            <img class="w-15px h-15px rounded-1 ms-2"
                                src="{{ asset('dashboard/media/flags/syria.svg') }}" alt="" />
                        </span>
                    </span>
                </a>
            @else
                <a href="#" class="menu-link px-5">
                    <span class="menu-title position-relative">{{ __('admin.language') }}
                        <span
                            class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                            {{ __('admin.english') }}
                            <img class="w-15px h-15px rounded-1 ms-2"
                                src="{{ asset('dashboard/media/flags/united-states.svg') }}" alt="" />
                        </span>
                    </span>
                </a>
            @endif

            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                <div class="menu-item px-3">
                    <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                        class="menu-link d-flex px-5">
                        <span class="symbol symbol-20px me-4">
                            <img class="rounded-1" src="{{ asset('dashboard/media/flags/syria.svg') }}"
                                alt="" />
                        </span>{{ __('admin.arabic') }}</a>
                </div>
                <div class="menu-item px-3">
                    <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                        class="menu-link d-flex px-5">
                        <span class="symbol symbol-20px me-4">
                            <img class="rounded-1" src="{{ asset('dashboard/media/flags/united-states.svg') }}"
                                alt="" />
                        </span>{{ __('admin.english') }}</a>
                </div>
            </div>
        </div>
        <div class="menu-item px-5">
            <a href="{{ route('admin.logout') }}" class="menu-link px-5">{{ __('admin.logout') }}</a>
        </div>
    </div>
</div>
