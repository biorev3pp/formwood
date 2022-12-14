<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item">
                    <a onclick="toggleMenu()" id="mobileToggleMenu" style="display:none; color: #323232 !important; font-size: 30px;position: relative;top: 6px;" class="nav-link nav-menu-main menu-toggle p-0 m-0 text-white " href="javascript:;"><i class="ft-menu"></i></a>
                    <a class="navbar-brand d-inline-block" href="{{ url('/') }}">
                        <img class="brand-logo" alt="Biorev" src="{{ asset('backend/images/logo.png') }}">
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item">
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1 user-name text-bold-700">Hi {{ Auth::user()->name }},</span>
                            <span class="avatar avatar-online">
                                <img src="{{asset('backend/images/'.Auth::user()->profile_image)}}" alt="{{ Auth::user()->name }}"><i></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('profile')}}">
                                <i class="material-icons">person_outline</i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item waves-effect waves-dark" href="#" id="userDropdown"  onclick="logout()" data-toggle="modal" data-target="#logout">
                                <i class="material-icons">power_settings_new</i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
    <!-- END: Header-->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
                <div class="modal-header border-bottom">
                    <h3 class="modal-title"> Logout Now</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ft-x text-secondary" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <p class="delete_heading">Are you sure you want to logout now?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mt-1 d-flex justify-content-end">
                    <button type="button"  data-dismiss="modal" aria-label="Close" class="btn bg-danger btn-glow btn-md text-white mr-1">No</button>
                        <button type="submit" class="btn btn-dark btn-glow text-white">Yes</button>
                    </div>
                </div>
            </form>  
        </div>
    </div>
</div>