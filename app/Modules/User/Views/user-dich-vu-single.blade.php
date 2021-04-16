@if($error=="")    
    <form action="javascript:void(0);" class="frm-user-dich-vu-single" name="frm-user-dich-vu-single">
        <div class="row">
            <div class="col-4">
                {{ csrf_field() }}
                <input type="hidden" name="id_user" class="id-user" value="{{$userId}}">
                <div class="form-group row">
                  <label for="id_dich_vu" class="col-sm-4 col-form-label">Chọn dịch vụ</label>
                  <div class="col-sm-8">
                     <select class="form-control id_dich_vu" name="id_dich_vu">
                      @foreach($dichVus as $dichVu)
                          <option value="{{$dichVu['id']}}">
                            {{$dichVu['ten_dich_vu']}}
                          </option>
                      @endforeach
                    </select>
                  </div>
               </div>
            </div>
            <div class="col-4">
                <div class="form-group row">
                  <label for="tu_ngay" class="col-sm-4 col-form-label ">Từ ngày</label>
                  <div class="col-sm-8">
                     <input type="date" class="form-control tu_ngay" name="tu_ngay" placeholder="Vui lòng nhập ngày bắt đầu">
                  </div>
               </div>
            </div>
            <div class="col-4">
                 <div class="form-group row">
                  <label for="den_ngay" class="col-sm-4 col-form-label ">Từ ngày</label>
                  <div class="col-sm-8">
                     <input type="date" class="form-control den_ngay" name="den_ngay" placeholder="Vui lòng nhập ngày kết thúc">
                  </div>
               </div>
            </div>
            <div class="col-12 text-right">
                <button type="button" class="btn btn-vnpt btn-them-user-dich-vu"><i class="icon-check"></i> Thêm</button>
            </div>
            <div class="col-12">
                <br>
                <div class="table-responsive load-danh-sach-dich-vu-theo-user">
                                  
               </div>
            </div>
        </div>
    </form>
    

@else
    
    <div class='text-danger'><b>Lỗi!</b> {{$error}}</div>
@endif
    <script type="text/javascript" src="{{ asset('public/js/t-tree.js') }}"></script>
    <script type="text/javascript">
        var _token=jQuery('form[name="frm-user-dich-vu-single"]').find("input[name='_token']").val();
        getById(_token, {{$userId}}, "{{ route('danh-sach-dich-vu-theo-tai-khoan') }}", '.load-danh-sach-dich-vu-theo-user');

        $('.btn-them-user-dich-vu').on('click',function(){
          themMoiVaRefreshDuLieuTheoId(_token, $("form.frm-user-dich-vu-single"), "{{ route('them-user-dich-vu') }}", {{$userId}}, "{{ route('danh-sach-dich-vu-theo-tai-khoan') }}", '.load-danh-sach-dich-vu-theo-user');
        });
        
    </script>