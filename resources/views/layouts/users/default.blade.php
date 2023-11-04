<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SHA Assam : Users</title>
  <link rel="stylesheet" href="{{ asset('users/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('users/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('users/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('users/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('users/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="{{ asset('users/select.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('users/css/vertical-layout-light/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('users/images/favicon.png') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/css/bootstrap/zebra_datepicker.min.css" integrity="sha512-m/itLbtr4RKMErTLBb2BL6uQXIW1xBC3IXnlBe+/JTBktlOH5s5wpmsh0Z0D9zZs5wH1FKcNWF2za5njkkLEbQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @yield('pageCss')
</head>
<body>
<div class="container-scroller">
    @include('layouts.users.top_nav')
    <div class="container-fluid page-body-wrapper">
    @include('layouts.users.nav')
    <div class="main-panel">
        <div class="content-wrapper">
        @if(Session::has('message'))
                <div class="row">
                    <div class="col-lg-12">
                       <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                             {!! Session::get('message') !!}
                       </div>
                    </div>
                </div>
            @endif
            @yield('main_content')
            @include('layouts.users.footer')
        </div>
    </div>
</div>

<!-- plugins:js -->
<script src="{{ asset('users/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('users/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('users/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('users/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('users/js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('users/js/off-canvas.js') }}"></script>
  <script src="{{ asset('users/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('users/js/template.js') }}"></script>
  <script src="{{ asset('users/js/settings.js') }}"></script>
  <script src="{{ asset('users/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('users/js/dashboard.js') }}"></script>
  <script src="{{ asset('users/js/Chart.roundedBarCharts.js') }}"></script>
  <!-- End custom js for this page-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/zebra_datepicker.min.js" integrity="sha512-KtN0FO60US4/jwC1DajXPg9ZANJxs2DDC4utQFTfFdf7Ckpmt4gLKzTJhfEK0yEeCq2BvcMKWdMGRmiGiPnztQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('input.datepicker').Zebra_DatePicker();
  </script>
  
  @yield('pageJs')
</body>

</html>

        