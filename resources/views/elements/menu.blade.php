 <!-- BEGIN: Main Menu-->
 <div class="main-menu material-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <div class="d-flex align-items-center justify-content-between side-menu-head-title-wrap">
            <h5 class="side-menu-head-title p-0">Admin Panel</h5>
            <a onclick="toggleMenu()" class="nav-link nav-menu-main menu-toggle p-0 m-0 text-white " href="javascript:;"><i class="ft-menu"></i></a>
        </div>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ (isset($menu) && ($menu == 'home')) ?'active':''}} ">
                <a href="{{ route('home') }}">
                    <span class="menu-title" data-i18n="Dashboard">
                        <i class="la la-tachometer"></i>Dashboard
                    </span>
                </a>
            </li>
            <li class="nav-item {{ (isset($menu) && ($menu == 'components')) ?'active':''}} ">
                <a href="{{ route('product-categories') }}"><span class="menu-title" data-i18n="Components"><i class="la la-sitemap"></i>Components</span></a>
            </li>
            <li class="nav-item {{ (isset($menu) && ($menu == 'logic-graph')) ?'active':''}} ">
                <a href="{{ route('logic-graph') }}"><span class="menu-title" data-i18n="Logic Graph"><i class="la la-code"></i>Logic Graph</span></a>
            </li>
            <li class="nav-item {{ (isset($menu) && ($menu == 'enquiries')) ?'active':''}} ">
                <a href="{{ route('enquiries') }}"><span class="menu-title" data-i18n="Inquiries"><i class="la la-envelope"></i>Inquiries</span></a>
            </li>
            <li class="nav-item {{ (isset($menu) && ($menu == 'analytics')) ?'active':''}} ">
                <a href="{{ route('analytics') }}"><span class="menu-title" data-i18n="Analytics"><i class="la la-line-chart"></i>Analytics</span></a>
            </li>
            <li class="nav-item {{ (isset($menu) && ($menu == 'configurations')) ?'active':''}} ">
                <a href="{{ route('configurations') }}"><span class="menu-title" data-i18n="configurations"><i class="ft-command"></i>Configurations</span></a>
            </li>
            <li class="nav-item {{ (isset($menu) && ($menu == 'settings')) ?'active':''}} ">
                <a href="{{ route('settings') }}"><span class="menu-title" data-i18n="settings"><i class="ft-settings"></i>Settings</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
@push('scripts');
<script type="text/javascript">
    if(window.innerWidth > 768){
        $('body').addClass('menu-open');
    }
    else{
        $('body').addClass('menu-hide');
    }
    function toggleMenu() {
        if ($('body').hasClass('menu-open')) {
            $('body').removeClass('menu-open').addClass('menu-hide');
        } else {
            $('body').addClass('menu-open').removeClass('menu-hide');
        }
    }
</script>
@endpush