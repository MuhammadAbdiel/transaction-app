<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('home') }}" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize">Dashboard</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
      <a href="{{ route('home') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Home</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('barang.*') ? 'active' : '' }}">
      <a href="{{ route('barang.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-package"></i>
        <div data-i18n="Analytics">Barang</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('customer.*') ? 'active' : '' }}">
      <a href="{{ route('customer.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Analytics">Customer</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('transaction.*') ? 'active' : '' }}">
      <a href="{{ route('transaction.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-credit-card"></i>
        <div data-i18n="Analytics">Transaksi</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->