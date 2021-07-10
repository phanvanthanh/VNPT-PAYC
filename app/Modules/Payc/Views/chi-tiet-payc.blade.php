@if(!Auth()->id() || Auth::user()->loai_tai_khoan=='KHACH_HANG')
  @php $layout='layouts.front-end'; @endphp
@else
  @php $layout='layouts.index'; @endphp
@endif
@extends($layout)
@section('title', 'Xem chi tiết PAKN')
@section('content')
<link rel="stylesheet" href="https://baocaotuan.vnpttravinh.vn/public/css/chi-tiet-payc.css">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
              <div class="row">
                  <div class="col-6">
                    <h4 class="text-danger"></h4>
                  </div>
                    <div class="col-6">
                       <div class="error-mode float-right"></div> 
                    </div>
              </div>
              <div class="row">
                <div class="col-12 noi-dung-payc-single"></div>
              </div>
              <div class="row">
                <div class="col-12 frm-danh-gia-single">
                  <form class="forms-sample frm-danh-gia" id="frm-danh-gia" name="frm-danh-gia">
                    {{ csrf_field() }}
                  </form>
                </div>
              </div>
              <div class="row">
                <div class="divider-gray"></div>
                <div class="col-12 frm-binh-luan-single"></div>
              </div>

                
          </div>
      </div>
    </div>


    <script type="text/javascript" src="https://baocaotuan.vnpttravinh.vn/public/js/jquery.min.js"></script>
  <script type="text/javascript">
  jQuery(document).ready(function() {
      @if($error)
        {{'errorLoader("error-mode","'.$error.'");'}}
      @else
        var _token=jQuery('form[name="frm-danh-gia"]').find("input[name='_token']").val();
        getById(_token, "{{$id}}", "{{ route('chi-tiet-payc-noi-dung-single') }}", ".noi-dung-payc-single");
        @if(!Auth()->id() || Auth::user()->loai_tai_khoan=='KHACH_HANG')
          getById(_token, "{{$id}}", "{{ route('chi-tiet-payc-frm-binh-luan-single') }}", ".frm-binh-luan-single");
        @else
          getById(_token, "{{$id}}", "{{ route('chi-tiet-payc-frm-can-bo-phan-hoi-binh-luan-single') }}", ".frm-binh-luan-single");
        @endif
      @endif
  });
  </script>
@endsection





