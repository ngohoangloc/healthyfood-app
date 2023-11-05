<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @yield('title')
    <!-- CSS files -->
    <link rel="shortcut icon" href={{ asset('img/logo.png') }}>
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/toastr/toastr.css') }}" rel="stylesheet" />
    <link href={{ asset('libs/tabler-icons/tabler-icons.min.css') }} rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />

    <livewire:styles />
</head>

<body>
    <div class="page">
        @include('admin.layouts.header')
        <div class="page-wrapper">
            @yield('content')

            @include('admin.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('libs/jquery/jquery.min.js') }}" ></script>
    <script src="{{ asset('libs/toastr/toastr.min.js') }}" ></script>
    <!-- Tabler Core -->
    <script src="{{ asset('js/tabler.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <livewire:scripts />
    <script>
        $(document).ready(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            };

            window.addEventListener('show-form', event => {
                $('#form').modal('show');
            });

            window.addEventListener('show-delete-modal', event => {
                $('#delete-modal').modal('show');
            });

            window.addEventListener('hide-form', event => {
                $('#form').modal('hide');
                toastr.success(event.detail.message, 'Thành công!');
            });

            window.addEventListener('hide-delete-modal', event => {
                $('#delete-modal').modal('hide');
                toastr.success(event.detail.message, 'Thành công!');
            });
            window.addEventListener('toastr-success', event => {
                toastr.success(event.detail.message);
            });

            window.addEventListener('toastr-warning', event => {
                toastr.warning(event.detail.message);
            });

            window.addEventListener('toastr-error', event => {
                toastr.error(event.detail.message);
            });
        });

        document.getElementById('addItemImage').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('imageInput').click();
        });
    </script>
    @yield('script')
</body>
</html>
