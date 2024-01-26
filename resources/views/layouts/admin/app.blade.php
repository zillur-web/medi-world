<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

@include('layouts.admin.head')
@include('layouts.admin.css')


<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('layouts.admin.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('layouts.admin.nav')
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">

                <!-- Content -->
                @yield('content')
                <!-- / Content -->

                <!-- Footer -->
                @include('layouts.admin.footer')
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('layouts.admin.script')
    @include('layouts.admin.flasher')
    @stack('scripts')

  </body>

</html>
