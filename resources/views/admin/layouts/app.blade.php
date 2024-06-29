
<!--
=========================================================
* Soft UI Dashboard Tailwind - v1.0.5
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard-tailwind
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>
  <head>
    @php($appData = \App\Helpers\Anyhelpers::AppInfo())
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <input type="hidden" id="baseL" value="{{ url('') }}" />
    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}" />
    <link rel="shortcut icon" href="{{ asset($appData->icon) }}"/>
    <title>@yield('title') | {{ $appData->app_name }}</title>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

    <style>
        #loading-bar-spinner.spinner {
            left: 50%;
            margin-left: -20px;
            top: 50%;
            margin-top: -20px;
            position: absolute;
            z-index: 59 !important;
            animation: loading-bar-spinner 400ms linear infinite;
        }

        #loading-bar-spinner.spinner .spinner-icon {
            width: 40px;
            height: 40px;
            border:  solid 4px transparent;
            border-top-color:  #00C8B1 !important;
            border-left-color: #00C8B1 !important;
            border-radius: 50%;
        }

        @keyframes loading-bar-spinner {
        0%   { transform: rotate(0deg);   transform: rotate(0deg); }
        100% { transform: rotate(360deg); transform: rotate(360deg); }
        }

    </style>

    @stack('css')
  </head>

  <body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <!-- sidenav  -->
    @include('admin.layouts.partials.sidenav')

    <!-- end sidenav -->

    <main class="ease-soft-in-out margin-left relative h-full max-h-screen rounded-xl transition-all duration-200">
      <!-- Navbar -->
      @include('admin.layouts.partials.navbar')

      <!-- end Navbar -->

      <!-- cards -->
        @yield('content')
      <!-- end cards -->

      <!-- footer -->
      @include('admin.layouts.partials.footer')
      <!-- end footer -->
    </main>

  </body>
  <!-- plugin for scrollbar  -->
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
  <!-- github button -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Alpine.js -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

  <script src="{{ asset('assets/js/global.js') }}"></script>
  <script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5') }}" async></script>

  <script>
    $('#pengaturan_menu').click(async function() {
        try {
            let { data } = await getRequestData(`${baseL}/api/user/${userID}`);

            let html = `
            <form id="settingModal" enctype="multipart/form-data">
                <div style="display: flex; align-items: center; margin: 2rem 2.1rem; width: 420px;">
                    <label>Nama</label>
                    <input class="swal2-input" style="flex:1;" placeholder="Nama" name="name" value="${data.name}"> <br/>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 3rem;">
                    <label>Email</label>
                    <input type="email" class="swal2-input" style="flex:1;" placeholder="Email" name="email" value="${data.email}"> <br/>
                </div>
                <div style="display: flex; align-items: center; margin-bottom: 3rem;">
                    <label>Password</label>
                    <input type="password" class="swal2-input" style="flex:1;" placeholder="Password" name="password" value=""> <br/>
                </div>
                <input type="hidden" name="_method" value="PUT">
            </form>
            `;

            modal({
                title: "Akun",
                formId: "settingModal",
                method: "POST",
                url: `/api/user/${userID}`,
                html,
                callback: () => { window.location.reload(); },
            });
        } catch (error) {
            notif("error", "Galat!", error);
        }
    });
  </script>

  @stack('js')
</html>
