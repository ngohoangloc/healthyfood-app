<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <img src="{{ asset('img/healthy-food-logo.png') }}" height="100%" alt="logo-healthy-food" class="navbar-brand-image">
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            @if (session('user.role') && session('user.role.id') === 1 )
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <a href={{ route('admin.dashboard') }} class="btn btn-outline-bitbucket" target="_blank"
                        rel="noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h2"></path>
                            <path
                                d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z">
                            </path>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        </svg>
                        QUẢN LÝ
                    </a>
                </div>
            </div>
            @endif

            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ session('user.fullName') }}</div>
                        <div class="mt-1 small text-muted">{{ session('user.role.name') }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">Kết ca</a>
                    <a href={{ route('auth.logout') }} class="dropdown-item">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
</header>
