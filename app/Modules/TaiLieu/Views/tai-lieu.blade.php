@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')
<link rel="stylesheet" href="{{ secure_asset('public/css/chi-tiet-payc.css') }}">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h4 class="text-danger">DANH MỤC TÀI LIỆU HƯỚNG DẪN</h4>
                </div>
                  <div class="col-6">
                     <div class="error-mode float-right"></div> 
                  </div>
              </div>
             

              <div class="text-right table-responsive">
                  <div class="btn-group mr-2">
                      
                  </div>
              </div>
              <br>
             <div class="load-danh-sach">
              <div class="row pakn-detail">
                <div class="col-1">&nbsp;</div>
                <div class="col-11">
                  <div class="title" style="font-size: 20px; font-weight: 500; margin-bottom: 10px;">Tài liệu hướng dẫn cán bộ:</div>
                  <div class="file">
                      <span class="-ap icon-paper-clip icon"></span>
                      <div class="content">
                          <span class="text">File đính kèm:</span>
                          <a target="_blank" href="/api/download-file/huong_dan_can_bo.pdf" class="link">tai_lieu_huong_dan_can_bo.pdf</a>                
                      </div>
                  </div>
                </div>
              </div>  
             </div>
          </div>
      </div>
  </div>
@endsection


