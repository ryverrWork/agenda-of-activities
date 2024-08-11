@php
use Illuminate\Support\Facades\Route;
$currentRouteName = Route::currentRouteName();
$activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
$activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
@endphp
<!-- Navbar: Start -->
<nav class="layout-navbar container shadow-none py-0">
  <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-4 px-md-8">
    <!-- Menu logo wrapper: Start -->
    <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-6">
      <!-- Mobile menu toggle: Start-->
      <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="tf-icons ri-menu-fill ri-24px align-middle"></i>
      </button>
      <!-- Mobile menu toggle: End-->
      <a href="javascript:;" class="app-brand-link">
        <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
        <span class="app-brand-text demo menu-text fw-semibold ms-2 ps-1">{{ config('variables.templateName') }}</span>
      </a>
    </div>
    <!-- Menu logo wrapper: End -->
    <!-- Menu wrapper: Start -->
    <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
      <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="tf-icons ri-close-fill"></i>
      </button>
    </div>
    <div class="landing-menu-overlay d-lg-none"></div>
    <!-- Menu wrapper: End -->
    <!-- Toolbar: Start -->
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      @if($configData['hasCustomizer'] == true)
      <!-- Style Switcher -->
      <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
        <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow me-sm-4" href="javascript:void(0);" data-bs-toggle="dropdown">
          <i class='ri-22px text-heading'></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
              <span class="align-middle"><i class='ri-sun-line ri-22px me-3'></i>Light</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
              <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Dark</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
              <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>System</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- / Style Switcher-->
      @endif

      <!-- navbar button: Start -->
      <li>
        <a href="javascript:;" class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4" target="_blank"><span class="tf-icons ri-user-line me-md-1"></span><span class="d-none d-md-block">Login/Register</span></a>
      </li>
      <!-- navbar button: End -->
    </ul>
    <!-- Toolbar: End -->
  </div>
</nav>
<!-- Navbar: End -->
