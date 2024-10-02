<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">{{ auth()->user()->role }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">{{ auth()->user()->role }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            <li class="menu-header">Starter</li>
            <li
                class="{{ request()->routeIs('lot.index') || request()->routeIs('lot.create') || request()->routeIs('lot.show') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('lot.index') }}"><i
                        class="far fa-solid fa-sheet-plastic"></i><span>Lot</span></a>
            </li>
            <li
                class="{{ request()->routeIs('label.index') || request()->routeIs('label.create') || request()->routeIs('label.show') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('label.index') }}"><i
                        class="far fa-solid fa-tag"></i><span>Label</span></a>
            </li>
            <li
                class="{{ request()->routeIs('code.index') || request()->routeIs('code.create') || request()->routeIs('code.show') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('code.index') }}"><i
                        class="far fa-solid fa-qrcode"></i><span>Qrcode</span></a>
            </li>
        </ul>
    </aside>
</div>
