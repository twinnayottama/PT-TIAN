<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ auth()->user()->role }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ auth()->user()->role }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            <li class="menu-header">Pengguna</li>
            <li
                class="{{ request()->routeIs('admin.account.index') || request()->routeIs('admin.account.create') || request()->routeIs('admin.account.edit') ? 'active' : '' }}">
                <a href="{{ route('admin.account.index') }}" class="nav-link"><i
                        class="fas fa-solid fa-user"></i><span>Manajemen Pengguna</span></a>
            </li>
        </ul>
    </aside>
</div>
