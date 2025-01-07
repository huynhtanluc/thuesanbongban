<div class="nav-container primary-menu">
    <div class="mobile-topbar-header">
        <div>
            <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rukada</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    @php
        $user = Auth::guard('khach_hang')->user();
        if($user){
            $check_chu_san = \App\Models\ChuSan::where('id_khach_hang', $user->id)
                                               ->where('trang_thai_duyet', 1)
                                               ->first();
        }
    @endphp
    <nav class="navbar navbar-expand-xl w-100">
        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <div class="parent-icon"><i class="fa-solid fa-house"></i>
                    </div>
                    <div class="menu-title">Trang chủ</div>
                </a>
            </li>
            @if($user)
            <li class="nav-item dropdown">
                <a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                    data-bs-toggle="dropdown">
                    <div class="parent-icon"><i class="fa-solid fa-table-tennis-paddle-ball"></i>
                    </div>
                    <div class="menu-title">Sân Bóng</div>
                </a>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="/khach-hang/san-bong"><i
                                class="bx bx-right-arrow-alt"></i>Sân Bóng</a>
                    </li>
                    @if ($check_chu_san)
                        <li> <a class="dropdown-item" href="/khach-hang/san-bong/cau-hinh-dia-chi"><i
                                    class="bx bx-right-arrow-alt"></i>Cấu hình địa chỉ</a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                    data-bs-toggle="dropdown">
                    <div class="parent-icon"><i class="fa-solid fa-location-crosshairs"></i>
                    </div>
                    <div class="menu-title">Quản Lý Sân Đăng Kí</div>
                </a>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="/khach-hang/chu-san"><i
                                class="bx bx-right-arrow-alt"></i>Đơn Đăng Kí</a>
                    </li>
                    @if ($check_chu_san)
                        <li> <a class="dropdown-item" href="/khach-hang/chu-san/lich-thue-khach-hang"><i
                                    class="bx bx-right-arrow-alt"></i>Lịch Thuê Khách Hàng</a>
                        </li>

                        <li> <a class="dropdown-item" href="/khach-hang/chu-san/calendar"><i
                            class="bx bx-right-arrow-alt"></i>Lịch</a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/khach-hang/lich-dat-san">
                    <div class="parent-icon"><i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="menu-title">Lịch Đặt Sân</div>
                </a>
            </li>
            @if($check_chu_san)
                <li class="nav-item">
                    <a class="nav-link" href="/khach-hang/bai-viet">
                        <div class="parent-icon"><i class="fa-solid fa-newspaper"></i>
                        </div>
                        <div class="menu-title">Quản Lý Bài Viết</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/khach-hang/khach-hang">
                        <div class="parent-icon"><i class="fa-solid fa-user"></i>
                        </div>
                        <div class="menu-title">Khách Hàng</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/khach-hang/thong-ke">
                        <div class="parent-icon"><i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <div class="menu-title">Thống Kê</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/khach-hang/mat-bang">
                        <div class="parent-icon"><i class="fa-solid fa-landmark"></i>
                        </div>
                        <div class="menu-title">Cấu hình mặt bằng</div>
                    </a>
                </li>
            @endif
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/lien-he">
                    <div class="parent-icon"><i class="fa-solid fa-bookmark"></i>
                    </div>
                    <div class="menu-title">Liên Hệ</div>
                </a>
            </li>
        </ul>
    </nav>
</div>
