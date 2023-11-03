<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @yield('title')
    <!-- CSS files -->
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('libs/toastr/toastr.css') }}" rel="stylesheet" />
    <link href={{ asset('libs/tabler-icons/tabler-icons.min.css') }} rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
        }
    </style>
    <livewire:styles />
</head>

<body class="layout-fluid">
    <div class="page">
        <!-- Navbar -->
        @include('cashier.layouts.header')
        <div class="page-wrapper bg-bitbucket">
            @yield('content')
        </div>
    </div>
    <!-- Libs Script -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="{{ asset('libs/toastr/toastr.min.js') }}"></script>
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
                $('#author_name').val('');
                $('#author_birthday').val('');
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

            window.addEventListener('toastr-danger', event => {
                toastr.danger(event.detail.message, 'Thành công!');
            });

            window.addEventListener('goToMenuTab', event => {
                var tabMenuLink = document.querySelector('a[href="#tabs-menu"]');
                if (tabMenuLink) {
                    tabMenuLink.click();
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>
