<nav class="navbar navbar-expand-md border  menu-bar  ">
    <div class="d-flex justify-content-center  container-fluid">
        <div class=" d-flex flex-wrap  responsive-toggle ">
            <a class=" navbar-brand repsonsive-img d-md-none text-dark" href="#">
                <img src="{{ asset('assets/images/sea_coff-logo.jpeg') }}" alt="" style="width: 40px">
                Seacoff
            </a>
            <div class="mx-auto d-flex ">
                <ul class="navbar-nav me-4 mb-2 mb-lg-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-md-none text-dark" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-bell"></i>
                        </a>

                        <ul class="dropdown-menu position-absolute navbar-setting  " aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Dashboard</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>

                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-md-none text-dark" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </a>

                        <ul class="dropdown-menu position-absolute navbar-setting " aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Dashboard</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-menu-seacoff me-auto mb-2 mb-md-0 py-0  ">
                    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="/admin/dashboard"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/item*') ? 'active' : '' }}">
                        <a class="nav-link" href="/admin/item"> <i class="fas fa-coffee"></i> Menu</a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/penjualan') ? 'active' : '' }}">
                        <a class="nav-link " href="/admin/penjualan"><i class="fas fa-cart-arrow-down"></i>
                            Penjualan</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i> Laporan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/admin/laporan/penjualan">Laporan Penjualan</a></li>
                            <li><a class="dropdown-item" href="/admin/laporan/e-money">Laporan pembayaran e-money</a>
                            </li>
                            <li><a class="dropdown-item" href="/admin/laporan/cash">Laporan pembayaran cash</a>
                            </li>
                            <li><a class="dropdown-item" href="/admin/laporan/grafik-penjualan">Grafik Penjualan</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link " href="/admin/event">
                            <i class="far fa-calendar-alt"></i>
                            Event</a>
                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-calendar-alt"></i>
                            Event</a>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="">Laporan Penjualan</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul> --}}
                    </li>


                </ul>

            </div>
        </div>
    </div>
</nav>
<div class="compare-visible-sticky">


</div>
