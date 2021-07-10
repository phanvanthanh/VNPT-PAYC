<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>VNPT TV PAYC - @yield('title')</title>
      <link rel="stylesheet" href="{{ secure_asset('public/vendors/mdi/css/materialdesignicons.min.css') }}">
      <link rel="stylesheet" href="{{ secure_asset('public/vendors/simple-line-icons/css/simple-line-icons.css') }}">
      <link rel="stylesheet" href="{{ secure_asset('public/vendors/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ secure_asset('public/vendors/css/vendor.bundle.base.css') }}">
     <!-- endinject -->
     <!-- inject:css -->
      <link rel="stylesheet" href="{{ secure_asset('public/css/style.css') }}">
     <!-- endinject -->
     <link rel="shortcut icon" href="{{ secure_asset('public/images/favicon.ico') }}">
   </head>

   <body>
      <div class="container-scroller">
         <div class="container-fluid page-body-wrapper">
            <div class="row">
              <div class="content-wrapper full-page-wrapper d-flex align-items-center text-center error-page bg-primary">
                <div class="col-lg-7 mx-auto text-white">
                  @yield('content')
                </div>
              </div>
              <!-- content-wrapper ends -->
            </div>
         <!-- row ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <script type="text/javascript" src="{{ secure_asset('public/vendors/js/vendor.bundle.base.js') }}"></script>
      <!-- endinject -->
      <!-- inject:js -->
      <script type="text/javascript" src="{{ secure_asset('public/js/off-canvas.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/hoverable-collapse.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/misc.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/settings.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('public/js/todolist.js') }}"></script>
      <!-- endinject -->
   </body>

</html>
