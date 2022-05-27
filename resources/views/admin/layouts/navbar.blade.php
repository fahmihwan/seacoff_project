@include('admin.layouts.topbar')
<nav class="bottom-navbar ">
    <div class="container ">
        <ul class="nav page-navigation d-flex justify-content-center  ">
            <li class="nav-item  me-3 p-0 ">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-home"></i>
                    <span class="menu-title mt-2">Dashboard</span>
                </a>
            </li>
            <li class="nav-item me-3 ">
                <a class="nav-link" href="/admin/item">
                    <i class="fa-solid fa-champagne-glasses"></i>
                    <span class="menu-title mt-2">Menu</span>
                </a>
            </li>
            <li class="nav-item me-3 ">
                <a class="nav-link" href="/admin/penjualan">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span class="menu-title mt-2 mt-2">Penjualan</span>
                </a>
            </li>
            <li class="nav-item  me-3 ">
                <a href="#" class="nav-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span class="menu-title mt-2">Laporan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu ">
                    <ul class="submenu-item">
                        <li class="nav-item"><a class="nav-link" href="">laporan</a></li>
                        <li class="nav-item"><a class="nav-link" href="">laporan pemesanan</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item me-3 ">
                <a href="#" class="nav-link">
                    <i class="far fa-calendar-alt"></i>
                    <span class="menu-title mt-2">Event</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item"><a class="nav-link" href="">Event</a></li>
                        <li class="nav-item"><a class="nav-link" href="">Kelola Event</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
