      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-dang-tin">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModal">ĐĂNG THÔNG TIN MUA BÁN ĐẤT</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-12 col-form-label text-danger">Vui lòng nhập đầy đủ các thông tin màu đỏ</label>
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label text-danger">Tiêu đề</label>
                              <div class="col-sm-9">
                                 <input type="Text" class="form-control tieu-de" placeholder="Vui lòng nhập tiêu đề">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label text-danger">Giá</label>
                              <div class="col-sm-9">
                                 <input type="Number" class="form-control gia" placeholder="Vui lòng nhập giá">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="dia-chi" class="col-sm-3 col-form-label">Địa chỉ</label>
                              <div class="col-sm-9">
                                 <input type="Text" class="form-control dia-chi" name="dia-chi" placeholder="Vui lòng nhập địa chỉ đất">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="dai" class="col-sm-3 col-form-label">Diện tích</label>
                              <div class="col-sm-4">
                                 <input type="Number" class="form-control dai" name="dai" placeholder="Nhập chiều dài">
                              </div>
                              <div class="col-sm-5">
                                 <input type="Number" class="form-control rong" placeholder="Nhập chiều rộng">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="loai-dat" class="col-sm-3 col-form-label text-muted">Loại đất</label>
                              <div class="col-sm-9">
                                 <select class="form-control js-example-basic-single" name="loai-dat" style="width:100%">
                                    <option value="AL">Đất thổ cư</option>
                                    <option value="WY">Đất cây lâu năm</option>
                                    <option value="WY">Đất cây lâu năm khác</option>
                                    <option value="AM">Đất nông nghiệp</option>
                                    <option value="AM">Đất lúa</option>
                                    <option value="AM">Đất trồng màu</option>
                                    <option value="CA">Quy hoạch</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="so-thua" class="col-sm-3 col-form-label text-muted">Số thửa/Số tờ bản đồ </label>
                              <div class="col-sm-4">
                                 <input type="Number" class="form-control so-thua" name="so-thua" placeholder="Nhập số thửa">
                              </div>
                              <div class="col-sm-5">
                                 <input type="Number" class="form-control so-to-ban-do" placeholder="Nhập số tờ bản đồ">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="ghi-chu" class="col-sm-3 col-form-label text-muted">Thông tin khác</label>
                              <div class="col-sm-9">
                                 <input type="Text" class="form-control ghi-chu" name="ghi-chu" placeholder="VD: Giá này còn thương lượng">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="so-dien-thoai" class="col-sm-3 col-form-label text-primary">Liên hệ</label>
                              <div class="col-sm-9">
                                 <input type="Text" class="form-control" name="so-dien-thoai" placeholder="Nhập số điện thoại liên hệ. VD: 094.113.8484">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group row">
                              <label for="hinh-anh" class="col-sm-12 col-form-label text-primary text-danger">Tải hình ảnh lên
                                    </label>
                              <div class="col-sm-12">
                                 <input type="file" class="dropify hinh-anh" name="hinh-anh" multiple>
                              </div>
                              <div class="col-sm-12">
                                 <div id="myImg"></div>
                              </div>                                        
                           </div>           
                           
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-success"><i class="icon-check"></i>  Đăng tin</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Không đăng</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modal-mua" tabindex="-1" role="dialog" aria-labelledby="modal-mua" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-dang-tin">
               <div class="modal-header">
                  <h5 class="modal-title" id="modal-mua">ĐĂNG TIN TÌM MUA ĐẤT</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-12 col-form-label text-danger">Tôi muốn mua theo điều kiện sau</label>
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label text-danger">Tiêu đề</label>
                              <div class="col-sm-9">
                                 <input type="Text" class="form-control tieu-de" placeholder="Vui lòng nhập tiêu đề">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="exampleInputEmail2" class="col-sm-3 col-form-label text-danger">Giá</label>
                              <div class="col-sm-9">
                                 <input type="Number" class="form-control gia" placeholder="Vui lòng nhập giá">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="dia-chi" class="col-sm-3 col-form-label">Địa chỉ</label>
                              <div class="col-sm-9">
                                 <input type="Text" class="form-control dia-chi" placeholder="Vui lòng nhập địa chỉ đất">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="dai" class="col-sm-3 col-form-label">Diện tích</label>
                              <div class="col-sm-4">
                                 <input type="Number" class="form-control dai" placeholder="Nhập chiều dài">
                              </div>
                              <div class="col-sm-5">
                                 <input type="Number" class="form-control rong" placeholder="Nhập chiều rộng">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="loai-dat" class="col-sm-3 col-form-label text-muted">Loại đất</label>
                              <div class="col-sm-9">
                                 <select class="form-control js-example-basic-single loai-dat" name="loai-dat" style="width:100%">
                                    <option value="AL">Đất thổ cư</option>
                                    <option value="WY">Đất cây lâu năm</option>
                                    <option value="WY">Đất cây lâu năm khác</option>
                                    <option value="AM">Đất nông nghiệp</option>
                                    <option value="AM">Đất lúa</option>
                                    <option value="AM">Đất trồng màu</option>
                                    <option value="CA">Quy hoạch</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="so-thua" class="col-sm-3 col-form-label text-muted">Số thửa/Số tờ bản đồ </label>
                              <div class="col-sm-4">
                                 <input type="Number" class="form-control so-thua" placeholder="Nhập số thửa">
                              </div>
                              <div class="col-sm-5">
                                 <input type="Number" class="form-control so-to-ban-do" placeholder="Nhập số tờ bản đồ">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="ghi-chu" class="col-sm-3 col-form-label text-muted">Thông tin khác</label>
                              <div class="col-sm-9">
                                 <input type="Text" class="form-control ghi-chu" placeholder="VD: Giá này còn thương lượng">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="so-dien-thoai" class="col-sm-3 col-form-label text-primary">Liên hệ</label>
                              <div class="col-sm-9">
                                 <input type="Text" class="form-control" name="so-dien-thoai" placeholder="Nhập số điện thoại liên hệ. VD: 094.113.8484">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group row">
                              <label for="hinh-anh" class="col-sm-12 col-form-label text-primary text-danger">Tải hình ảnh lên
                                    </label>
                              <div class="col-sm-12">
                                 <input type="file" name="hinh-anh" class="dropify" multiple>
                              </div>
                              <div class="col-sm-12">
                                 <div id="myImg"></div>
                              </div>                                        
                           </div>           
                           
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-success"><i class="icon-check"></i>  Đăng tin</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Không đăng</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="modal-dang-ky" tabindex="-1" role="dialog" aria-labelledby="modal-dang-ky" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">ĐĂNG KÝ TÀI KHOẢN</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body card">
                  <form class="forms-sample">
                     <div class="form-group row">
                        <span class="text-danger">&nbsp;&nbsp;&nbsp;Vui lòng nhập đầy đủ các thông tin màu đỏ </span>
                     </div>
                     <div class="form-group row">
                        <label for="ho-ten" class="col-sm-4 col-form-label text-danger">Họ và tên</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control" id="ho-ten" placeholder="Vui lòng nhập họ tên">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="so-dien-thoai" class="col-sm-4 col-form-label text-danger">Số điện thoại</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control" id="so-dien-thoai" placeholder="Vui lòng nhập số điện thoại">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label text-danger">Mật khẩu</label>
                        <div class="col-sm-8">
                           <input type="Password" class="form-control password" placeholder="Nhập mật khẩu">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="confirm_password" class="col-sm-4 col-form-label text-danger">Nhập lại mật khẩu</label>
                        <div class="col-sm-8">
                           <input type="Password" class="form-control" id="confirm_password" placeholder="Nhập lại mật khẩu trên">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="dia-chi" class="col-sm-4 col-form-label">Địa chỉ</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control" id="dia-chi" placeholder="Vui lòng nhập địa chỉ">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="nam-sinh" class="col-sm-4 col-form-label">Năm sinh</label>
                        <div class="col-sm-8">
                           <input type="Text" class="form-control" id="nam-sinh" placeholder="Vui lòng nhập ngày tháng năm sinh. DD/MM/YYYY">
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-success"><i class="icon-check"></i> Tạo tài khoản với thông tin trên</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Không tạo</button>
               </div>
            </div>
         </div>
      </div>


      <div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-hidden="false">
          <div class="circle-loader" style="margin-top: 25%;"></div>
      </div>