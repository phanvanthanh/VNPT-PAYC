@extends('layouts.index')
@section('title', 'Giới thiệu')
@section('content')
	<link rel="stylesheet" href="{{ secure_asset('public/vendors/codemirror/codemirror.css') }}">
  <link rel="stylesheet" href="{{ secure_asset('public/vendors/codemirror/ambiance.css') }}">
  <link rel="stylesheet" href="{{ secure_asset('public/vendors/pwstabs/jquery.pwstabs.min.css') }}">
  <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
  <style type="text/css">
    div.CodeMirror.cm-s-ambiance{
      background-color: rgba(0, 194, 146, 0.2);
      color: green;
      -webkit-box-shadow: none; */
      -moz-box-shadow: none;
      /* box-shadow: inset 0 0 10px black;
    }
      
  </style>
	<div class="documentation">
    <div class="row">
      <div class="col-12 grid-margin">
          <div class="card" style="padding-left: 20px;">
              <div class="card-body">
                  <h4 class="card-title text-primary text-center">
                    <div class="text-danger">PHẦN MỀM BÁO CÁO CÔNG TÁC <br></div>
                    (VNPT BUSINESS REPORTING SOFTWARE)

                  </h4>
                  <h4 class="card-title text-primary">Giới thiệu</h4>                  
                  <p>
                    Phần mềm báo cáo công tác (VNPT – Business Reporting Software) (VNPT – BRS ) được xây dựng nhằm mục đích tin học hóa công việc báo cáo (Gồm: Báo cáo tuần, báo cáo tháng, báo cáo quý, báo cáo năm), quản lý tích hợp dữ liệu, cho phép tổng hợp dữ liệu báo cáo từ các hệ thống khác như: Hệ thống Điều hành sản xuất kinh doanh, phần mềm Phản ánh kiến nghị, Chương trình quản lý công việc…
                  </p>
                  <p>
                    Phần mềm VNPT–BRS phục vụ cho việc quản lý và điều hành sản xuất kinh doanh bao gồm: Ban Giám đốc Viễn thông tỉnh, các Phòng chức năng, các Trung tâm trực thuộc Viễn thông tỉnh. Phần mềm lưu trữ lại các thông tin về lịch sử đăng nhập, thời gian báo cáo, thời gian tổng hợp báo cáo, thời gian chốt báo cáo. Ngoài ra, phần mềm cũng cung cấp các chức năng tra cứu, thống kê dữ liệu, xuất báo cáo theo các biểu mẫu quy định.
                  </p>
              </div>
          </div>
          <div class="row" style="margin-top:-30px;">
            <div class="col-12 grid-margin" id="doc-started">
                <div class="card" style="padding-left: 20px;">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Cấu trúc hệ thống</h4>
                          <textarea class="shell-mode">
VNPT – Business Reporting Software
├── Đăng nhập hệ thống qua cổng xác thực tập trung
├── Thông tin cá nhân
├── Chức năng Báo cáo Công tác các Phòng chức năng
├── Chức năng Báo cáo Công tác Trung tâm CNTT
├── Chức năng Báo cáo Công tác Trung tâm ĐHTT
├── Chức năng Báo cáo Công tác Trung tâm Viễn thông
├── Báo cáo Công tác Viễn thông tỉnh
├── Tiện ích
├── Tài liệu Hướng dẫn sử dụng
├── ...
├── ...
├── ...
├── ...</textarea>

                    </div>

                </div>
            </div>
          </div>

      </div>
     
      
    
  <script type="text/javascript" src="{{ secure_asset('public/vendors/codemirror/codemirror.js') }}"></script>
  <script type="text/javascript" src="{{ secure_asset('public/vendors/codemirror/javascript.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('public/vendors/codemirror/shell.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('public/vendors/pwstabs/jquery.pwstabs.min.js') }}"></script>
  <script type="text/javascript" src="{{ secure_asset('public/js/codeEditor.js') }}"></script>
  <script type="text/javascript" src="{{ secure_asset('public/js/tabs.js') }}"></script>
@endsection


