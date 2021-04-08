@extends('layouts.error')
@section('title', 'Lỗi 404 không tìm thấy tài nguyên')
@section('content')
  <div class="row align-items-center d-flex flex-row">
    <div class="col-lg-6 text-lg-right pr-lg-4">
      <h1 class="display-1 mb-0">500</h1>
    </div>
    <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
      <h2>XIN LỖI!</h2>
      <h3 class="font-weight-light">Không xác định.</h3>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-12 text-center mt-xl-2">
      <a class="text-white font-weight-medium" href="/">
        <p>Đã có lỗi xảy ra. Bạn sẽ <b>quay lại trang chủ</b>  sau <b><span id="counter">5</span> giây(s).</p></b>
        <script type="text/javascript">
          function countdown() {
            var i = document.getElementById("counter");
            if (parseInt(i.innerHTML)<=0) {
                location.href = "/";
            }
            if (parseInt(i.innerHTML)!=0) {
                i.innerHTML = parseInt(i.innerHTML)-1;
            }
          }
          setInterval(function(){ countdown(); },1000);
        </script>
      </a>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-12 mt-xl-2">
      <p class="text-white font-weight-medium text-center">Copyright &copy; 2020 <b>Phan Văn Thanh</b>  All rights reserved.</p>
    </div>
  </div>
@endsection