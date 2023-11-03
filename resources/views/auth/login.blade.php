<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng nhập hệ thống</title>

    <link rel="shortcut icon" href={{ asset('img/logo.png') }} />
    <link href={{ asset('css/tabler.min.css') }} rel="stylesheet" />
    <link href="{{ asset('libs/toastr/toastr.css') }}" rel="stylesheet" />

</head>

<body>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="card card-md">
                <div class="card-body">
                    <div class="text-center mb-1">
                        <img src={{ asset('img/healthy-food-logo.png') }} alt="">
                    </div>
                    <form action={{ route('auth.login') }} method="post" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tài khoản</label>
                            <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản..."
                                value="admin" autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Mật khẩu
                                <span class="form-label-description"></span>
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" name="password"
                                    placeholder="Nhập mật khẩu..." value="123" autocomplete="off">
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Hiển thị" data-bs-toggle="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-azure text-light w-100">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src={{ asset('js/tabler.min.js') }} defer></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="{{ asset('libs/toastr/toastr.min.js') }}"></script>

    <script>
        toastr.options = {
            "positionClass": "toast-top-center",
        };

        @if (session('warning'))
            toastr.warning('{{ session('warning') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>
</body>
</html>
