<nav class="navbar top-navbar col-lg-12 col-12 p-0">
    <div class="container-fluid">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between" style="height:50px">
            <ul class="navbar-nav navbar-nav-left ">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center  mx-3">
                    <img src="{{ asset('assets/images/sea_coff-logo.jpeg') }}" alt="" width="40px">
                </div>
                <li class="nav-item ms-0 me-5 d-lg-flex d-none ">
                    <a href="#" class="nav-link horizontal-nav-left-menu text-dark">
                        Sea Coff
                    </a>
                </li>
                {{-- message --}}
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                        id="messageDropdown" href="#" data-bs-toggle="dropdown">
                        <i class="mdi mdi-email mx-0"></i>
                        <span class="count bg-primary">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                        aria-labelledby="messageDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    The meeting is cancelled
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    New product launch
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                                </h6>
                                <p class="font-weight-light small-text text-muted mb-0">
                                    Upcoming board meeting
                                </p>
                            </div>
                        </a>
                    </div>
                </li> --}}
                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link count-indicator "><i class="mdi mdi-message-reply-text"></i></a>
                </li> --}}
            </ul>
            <ul class="navbar-nav navbar-nav-right ">
                {{-- <li class="nav-item dropdown  d-lg-flex d-none">
                    <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>
                </li>
                <li class="nav-item dropdown d-lg-flex d-none">
                    <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown"
                        href="#" data-bs-toggle="dropdown">
                        Reports
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                        aria-labelledby="nreportDropdown">
                        <p class="mb-0 font-weight-medium float-left dropdown-header">Reports</p>
                        <a class="dropdown-item">
                            <i class="mdi mdi-file-pdf text-primary"></i>
                            Pdf
                        </a>
                        <a class="dropdown-item">
                            <i class="mdi mdi-file-excel text-primary"></i>
                            Exel
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown d-lg-flex d-none">
                    <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
                </li> --}}
                <li class="nav-item dropdown ">
                    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                        id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="count bg-success">2</span>
                    </a>
                    {{-- <div class="dropdown-menu dropdown-menu-right border border-primary navbar-dropdown preview-list" --}}
                    <div class="dropdown-menu position-absolute end-50 top-100  navbar-dropdown preview-list"
                        aria-labelledby="notificationDropdown">
                        <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="fas fa-bell"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    Just now
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-warning">
                                    <i class="fas fa-cog"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">Settings</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    Private message
                                </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-info">
                                    <i class="mdi mdi-account-box mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                <p class="font-weight-light small-text mb-0 text-muted">
                                    2 days ago
                                </p>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                        <span class="nav-profile-name">Johnson</span>

                        <i class="fa-solid fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a href="/admin/setting/meja" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            Settings
                        </a>
                        <a class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="horizontal-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</nav>
