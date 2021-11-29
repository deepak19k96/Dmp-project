
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="/dashboard"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                    <h2 class="brand-text"><?= DASHBOARD_LOGO_TEXT; ?></h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="active nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD; ?>"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span><span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span></a></li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Reporting</span><i data-feather="more-horizontal"></i></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">First Payment</span></a></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Affiliate Join</span></a></li>

            <li class=" navigation-header"><span data-i18n="User Interface">User Interface</span><i data-feather="more-horizontal"></i></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/account"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Account Settings</span></a></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/login"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Login</span></a></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/login/register"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Register</span></a></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/login/forgot"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Forgot Password</span></a></li>

            <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Super Admin Interface</span><i data-feather="more-horizontal"></i></li>

            <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span class="menu-title text-truncate" data-i18n="eCommerce">User Management</span></a>
                <ul class="menu-content">
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/users"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">User List</span></a></li>
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/users/edit/123"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Edit User</span></a></li>
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/users/view/123"; ?>"><i data-feather="eye"></i><span class="menu-title text-truncate" data-i18n="Feather">View User</span></a></li>
                </ul>
            </li>

            <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span class="menu-title text-truncate" data-i18n="eCommerce">Org Management</span></a>
                <ul class="menu-content">
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/orgs"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Org List</span></a></li>
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/orgs/edit/123"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Edit Org</span></a></li>
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/orgs/view/123"; ?>"><i data-feather="eye"></i><span class="menu-title text-truncate" data-i18n="Feather">View Org</span></a></li>
                </ul>
            </li>

            <li class="nav-item has-sub"><a class="d-flex align-items-center" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Invoice</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="<?= DASHBOARD . "/invoices"; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span class="menu-item text-truncate" data-i18n="Preview">Invoice List</span></a></li>
                    <li><a class="d-flex align-items-center" href="<?= DASHBOARD . "/invoices/view/123"; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span class="menu-item text-truncate" data-i18n="Preview">View</span></a></li>
                    <li><a class="d-flex align-items-center" href="<?= DASHBOARD . "/invoices/edit/123"; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span class="menu-item text-truncate" data-i18n="Edit">Edit</span></a></li>
                    <li><a class="d-flex align-items-center" href="<?= DASHBOARD . "/invoices/add/g576675u76u6h5u56gu"; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span class="menu-item text-truncate" data-i18n="Add">Add</span></a></li>
                </ul>
            </li>

            <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">System Settings</span><i data-feather="more-horizontal"></i></li>

            <li class="nav-item has-sub" style=""><a class="d-flex align-items-center" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span class="menu-title text-truncate" data-i18n="eCommerce">Staff Management</span></a>
                <ul class="menu-content">
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/users"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Super Admins</span></a></li>
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/users"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">Permission & Roles </span></a></li>
                </ul>
                    <li class=" nav-item"><a class="d-flex align-items-center" href="<?= DASHBOARD . "/users"; ?>"><i data-feather="type"></i><span class="menu-title text-truncate" data-i18n="Typography">General Settings</span></a></li>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
