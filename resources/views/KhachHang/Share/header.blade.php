<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="topbar-logo-header">
                <div class="">
                    <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                </div>
                <div class="">
                    <h4 class="logo-text">Bóng Bàn</h4>
                </div>
            </div>
            <!-- <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div>
            </div> -->
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#">	<i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-large">

                    </li>
                    <li class="nav-item dropdown dropdown-large">

                    </li>
                    <li class="nav-item dropdown dropdown-large">

                    </li>
                </ul>
            </div>
            <div class="user-box dropdown"> 
                @if(Auth::guard('khach_hang')->check())
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::guard('khach_hang')->user()->anh != null)
                            <img src="{{ Auth::guard('khach_hang')->user()->anh }}" class="user-img" alt="user avatar">
                        @else
                            <img src="{{ Auth::guard('khach_hang')->user()->gioi_tinh == 1 ? '/assets/images/avatars/avatar-1.png' : '/assets/images/avatars/avatar-2.png' }}" class="user-img" alt="user avatar">
                        @endif
                        <div class="user-info ps-3">
                            <p class="user-name mb-0">{{ Auth::guard('khach_hang')->user()->ho_va_ten }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/khach-hang/profile"><i class="bx bx-user"></i><span>Thông tin cá nhân</span></a>
                        </li>
                        <li><a class="dropdown-item" href="/khach-hang/ngan-hang"><i class="fa-solid fa-sack-dollar"></i><span>Ngân Hàng</span></a>
                        </li>
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <li><a class="dropdown-item" href="/khach-hang/logout"><i class='bx bx-log-out-circle'></i><span>Đăng xuất</span></a>
                        </li>
                    </ul>
                @else
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="/login">
                        <div class="user-info ps-3">
                            <button class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </a>
                @endif
            </div>
        </nav>
    </div>
</header>
