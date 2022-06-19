<nav class="navbar navbar-light  top-bar-title">
    <div class="container-fluid  d-flex bd-highlight ">
        <div class="me-auto bd-highlight">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/sea_coff-logo.jpeg') }}" alt="" style="width: 40px">
                Seacoff
            </a>
        </div>
        <div class="bd-highlight px-4">
            <ul class="navbar-nav ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                    </a>
                    <ul class="dropdown-menu position-absolute dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Setting</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="bd-highlight">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->nama }} &nbsp;<i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu position-absolute dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        @if (auth()->user()->hak_akses == 'admin')
                        <li><a class="dropdown-item" href="/admin/setting/meja">
                                <i class="fas fa-qrcode"></i>
                                Pengaturan Qrcode</a></li>
                        <li><a class="dropdown-item" href="/admin/setting/akun">
                                <i class="fas fa-user"></i>
                                Pengaturan Akun </a></li>
                        @endif


                        <li>
                            <form action="/auth/logout" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>