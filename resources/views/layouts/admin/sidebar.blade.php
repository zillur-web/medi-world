<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ route('dashboard') }}" class="app-brand-link">
        <span class="app-brand-logo demo text-center">
            <h1 style="font-size: 25px; text-align: center; margin: auto; vertical-align: middle; font-weight: 800; color: #7578ff; text-transform: uppercase;">Admin Panel</h1>
        </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item active">
        <a href="{{ route('dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Categories</span>
      </li>
      <li class="menu-item {{ Request::is('admin/categories') ? 'open active' : '' }}  {{ Request::is('admin/sub-categories') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Categories</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('admin/categories') ? 'active' : '' }}">
            <a href="{{ route('categories') }}" class="menu-link">
              <div data-i18n="Account">Categroy List</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('admin/sub-categories') ? 'active' : '' }}">
            <a href="{{ route('subcategories') }}" class="menu-link">
              <div data-i18n="Notifications">Sub Categroy List</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Brand & Assembly & Origin</span>
      </li>
      <li class="menu-item {{ Request::is('admin/brands') ? 'open active' : '' }}  {{ Request::is('admin/origin') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Brand & Assembly & Origin</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Request::is('admin/brands') ? 'active' : '' }}">
                <a href="{{ route('brand.index') }}" class="menu-link">
                  <div data-i18n="Notifications">Brand List</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('admin/origin') ? 'active' : '' }}">
                <a href="{{ route('origin.index') }}" class="menu-link">
                    <div data-i18n="Notifications">Origin List</div>
                </a>
            </li>
        </ul>
      </li>

      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Products</span></li>
      <!-- Cards -->
      <li class="menu-item {{ Request::is('admin/product*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Products</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('admin/product*') ? 'active' : '' }}">
            <a href="{{ route('product.index') }}" class="menu-link">
              <div data-i18n="Account">Product</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('admin/product*') ? 'active' : '' }}">
            <a href="{{ route('product.reagent.create') }}" class="menu-link">
              <div data-i18n="Account">Reagent Product</div>
            </a>
          </li>

        </ul>
      </li>


       <!-- Components -->
       <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>
       <!-- Cards -->
       <li class="menu-item {{ Request::is('admin/settings*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Site Settings</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('admin/settings') ? 'active' : '' }}">
            <a href="{{ route('settings.index') }}" class="menu-link">
              <div data-i18n="Account">Site Settings </div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('admin/settings/pages/about-us') ? 'active' : '' }}">
            <a href="{{ route('settings.pages.about.index') }}" class="menu-link">
              <div data-i18n="Account">About Us Page</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('admin/settings/pages/director-message') ? 'active' : '' }}">
            <a href="{{ route('settings.pages.director_message.index') }}" class="menu-link">
              <div data-i18n="Account">Director Message Page</div>
            </a>
          </li>

        </ul>
      </li>

    </ul>
</aside>
