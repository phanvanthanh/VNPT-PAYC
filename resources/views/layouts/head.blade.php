<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Báo cáo tuần - @yield('title')</title>
      <link rel="stylesheet" href="{{ asset('public/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/fontawesome-stars.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/bars-1to10.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/bars-horizontal.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/bars-movie.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/bars-pill.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/bars-reversed.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/bars-square.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/bootstrap-stars.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/css-stars.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-bar-rating/fontawesome-stars-o.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/font-awesome/css/font-awesome.min.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/dropify/dropify.min.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-file-upload/uploadfile.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/clockpicker/jquery-clockpicker.min.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/jquery-asColorPicker/css/asColorPicker.min.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
     <link rel="stylesheet" href="{{ asset('public/vendors/x-editable/bootstrap-editable.css') }}">



      <!-- Sumery plugin -->
      <link rel="stylesheet" href="{{ asset('public/vendors/summernote/dist/summernote-bs4.css') }}">
      <link rel="stylesheet" href="{{ asset('public/vendors/quill/quill.snow.css') }}">
      <link rel="stylesheet" href="{{ asset('public/vendors/simplemde/simplemde.min.css') }}">


      <!-- plugins:css -->
      <link rel="stylesheet" href="{{ asset('public/vendors/mdi/css/materialdesignicons.min.css') }}" >
      <link rel="stylesheet" href="{{ asset('public/vendors/simple-line-icons/css/simple-line-icons.css') }}">
      <link rel="stylesheet" href="{{ asset('public/vendors/flag-icon-css/css/flag-icon.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/vendors/css/vendor.bundle.base.css') }}">
      <!-- endinject -->
      <!-- plugin css for this page -->
      <link rel="stylesheet" href="{{ asset('public/vendors/lightgallery/css/lightgallery.min.css') }}">
      <!-- End plugin css for this page -->
      <!-- Datatable -->
      <link rel="stylesheet" href="{{ asset('public/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
      <!-- End Datatable -->
      <!-- Font Asomware -->
      <link rel="stylesheet" href="{{ asset('public/vendors/font-awesome/css/font-awesome.min.css') }}">
      <!-- End font Asomeware -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
      <link rel="stylesheet" href="{{ asset('public/css/tree.css') }}">
      <link rel="stylesheet" href="{{ asset('public/css/loading-style.css') }}">
      <!-- endinject -->
      <link rel="shortcut icon" href="{{ asset('public/images/favicon.ico') }}">

      <link rel="stylesheet" href="{{ asset('public/vendors/dragula/dragula.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">

      <style type="text/css">
        .image-tile:hover{
          box-shadow: 1px 1px 1px 3px #18cabe;
        }
      </style>




   </head>
