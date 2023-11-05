<!-- Navbar -->
<header class="navbar navbar-expand-md navbar-overlap d-print-none" data-bs-theme="dark">
    {{-- <div class="container-xl"> --}}
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{route('admin.dashboard')}}"><img src="{{ asset('img/healthy-food-logo.png') }}" alt="logo-healthy-food" class="navbar-brand-image"></a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <a href=" {{ route('cashier') }} " class="btn btn-outline-azure">
                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                            <path d="M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z"></path>
                        </svg>
                        Bán hàng
                    </a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        </svg>
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ session('user.fullName') }}</div>
                        <div class="mt-1 small text-muted">{{ session('user.role.name') }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="./settings.html" class="dropdown-item">Đổi mật khẩu</a>
                    <a href={{ route('auth.logout') }} class="dropdown-item">Đăng xuất</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Tổng quan
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown {{ request()->routeIs('admin.sys.*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Hệ thống
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('admin.sys.role') }}">
                                        Nhóm người dùng
                                    </a>
                                    <a class="dropdown-item" href={{ route('admin.sys.employee') }}>
                                        Nhân viên
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown  {{ request()->routeIs('admin.directory.*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Danh mục
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('admin.directory.category') }}">
                                        Nhóm hàng hoá
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.directory.unit') }}">
                                        Đơn vị tính
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.directory.supplier') }}">
                                        Nhà cung cấp
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.directory.item') }}">
                                        Hàng hoá
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.directory.price') }}">
                                        Bảng giá
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.directory.ingredient') }}">
                                        Khai báo định lượng
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin.directory.area') }}">
                                        Khu vực
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.directory.table') }}">
                                        Thiết lập Bàn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-warehouse" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 21v-13l9 -4l9 4v13"></path>
                                    <path d="M13 13h4v8h-10v-6h6"></path>
                                    <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Kho hàng
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="{{ route('admin.stock.grn') }}">
                                        Phiếu nhập kho
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Phiếu xuất kho
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Phiếu kiểm kê
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Báo cáo tồn kho
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Báo cáo nhập xuât tồn
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Giá vốn thành phẩm
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                    <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1"></path>
                                    <path d="M12 7v10"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Sổ quỹ
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./accordion.html">
                                        Danh mục chi phí
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Phiếu chi tiền
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Phiếu thu tiền
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Báo cáo sổ quỹ tiền
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Báo cáo tổng hợp chi phí
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Báo cáo kết quả kinh doanh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.promotion') ? 'active' : '' }}">
                        <a class="nav-link" href="/">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gift" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 8m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z"></path>
                                    <path d="M12 8l0 13"></path>
                                    <path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7"></path>
                                    <path d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Khuyến mãi
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-line" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 19l16 0"></path>
                                    <path d="M4 15l4 -6l4 2l4 -5l4 4"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Doanh thu
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item" href="./accordion.html">
                                        Danh sách hóa đơn bán hàng
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Doanh thu theo ngày
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Lịch sử kết ca
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Doanh thu hàng hóa
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Doanh thu chi tiết theo nhóm hàng
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Doanh thu theo khu vực
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Báo cáo trả món
                                    </a>
                                    <a class="dropdown-item" href="./accordion.html">
                                        Báo cáo công nợ khách hàng
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
