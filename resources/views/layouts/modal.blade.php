<div class="modal fade" id="modal-tiep-nhan-va-chuyen-xu-ly" tabindex="-1" role="dialog" aria-labelledby="modal-tiep-nhan-va-chuyen-xu-ly" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-tiep-nhan-va-chuyen-xu-ly">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">TIẾP NHẬN VÀ CHUYỂN XỬ LÝ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body card">
            <form class="forms-sample" name="frm-tiep-nhan-va-chuyen-xu-ly" id="frm-tiep-nhan-va-chuyen-xu-ly">
               <input type="hidden" class="ds_id_payc_tiep_nhan_va_xu_ly" name="ds_id_payc_tiep_nhan_va_xu_ly">
               <input type="hidden" class="ds_id_user_tiep_nhan_va_xu_ly" name="ds_id_user_tiep_nhan_va_xu_ly">
                  {{ csrf_field() }}
               <div class="frm-tiep-nhan-va-chuyen-xu-ly">
                  
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-vnpt btn-tiep-nhan-va-chuyen-xu-ly-2"><i class="fa fa-mail-forward"></i>  Tiếp nhận & chuyển xử lý</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-chuyen-lanh-dao" tabindex="-1" role="dialog" aria-labelledby="modal-chuyen-lanh-dao" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-chuyen-lanh-dao">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">CHUYỂN LÃNH ĐẠO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body card">
            <form class="forms-sample" name="frm-chuyen-lanh-dao" id="frm-chuyen-lanh-dao">
               <input type="hidden" class="ds_id_payc_chuyen_lanh_dao" name="ds_id_payc_chuyen_lanh_dao">
               <input type="hidden" class="ds_id_user_chuyen_lanh_dao" name="ds_id_user_chuyen_lanh_dao">
                  {{ csrf_field() }}
               <div class="frm-chuyen-lanh-dao">
                  
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-vnpt btn-chuyen-lanh-dao-2"><i class="fa fa-group"></i>  Chuyển lãnh đạo</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>
      

<div class="modal fade" id="modal-hoan-tat-xu-ly" tabindex="-1" role="dialog" aria-labelledby="modal-hoan-tat-xu-ly" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-hoan-tat-xu-ly">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">HOÀN TẤT XỬ LÝ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body card">
            <form class="forms-sample" name="frm-hoan-tat" id="frm-hoan-tat">
               <input type="hidden" class="ds_id_payc_hoan_tat" name="ds_id_payc_hoan_tat">
                  {{ csrf_field() }}
               <div class="frm-hoan-tat">
                  
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-vnpt btn-hoan-tat-xu-ly-2"><i class="fa fa-check-circle"></i>  Hoàn tất xử lý</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="modal-tra-lai-khong-xu-ly" tabindex="-1" role="dialog" aria-labelledby="modal-tra-lai-khong-xu-ly" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-tra-lai-khong-xu-ly">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">HOÀN TRẢ KHÔNG XỬ LÝ YÊU CẦU</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body card">
            <form class="forms-sample" name="frm-tra-lai-khong-xu-ly" id="frm-tra-lai-khong-xu-ly">
               <input type="hidden" class="ds_id_payc_tra_lai_khong_xu_ly" name="ds_id_payc_tra_lai_khong_xu_ly">
                  {{ csrf_field() }}
               <div class="frm-tra-lai-khong-xu-ly">
                  
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-tra-lai-khong-xu-ly-2"><i class="fa fa-mail-reply"></i>  Hoàn trả</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="modal-huy" tabindex="-1" role="dialog" aria-labelledby="modal-huy" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-huy">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">HỦY YÊU CẦU</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body card">
            <form class="forms-sample" name="frm-huy" id="frm-huy">
               <input type="hidden" class="ds_id_payc_huy" name="ds_id_payc_huy">
                  {{ csrf_field() }}
               <div class="frm-huy">
                  
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-huy-2"><i class="fa fa-window-close-o"></i>  Hủy yêu cầu</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="modal-cap-nhat-payc" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat-payc" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-cap-nhat-payc">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">CẬP NHẬT PAYC</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body card">
            <form class="forms-sample" name="frm-cap-nhat-payc" id="frm-cap-nhat-payc">
               <input type="hidden" class="id_payc_cap_nhat" name="id_payc_cap_nhat">
                  {{ csrf_field() }}
               <div class="frm-cap-nhat-payc">
                  
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-vnpt btn-cap-nhat-payc-2"><i class="fa fa-pencil"></i>  Cập nhật</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="modal-qtxl" tabindex="-1" role="dialog" aria-labelledby="modal-qtxl" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-qtxl ">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">LỊCH SỬ QUÁ TRÌNH XỬ LÝ</h5>
            <b><button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></b>
            </button>
         </div>
         <div class="modal-body card">
            <form class="forms-sample frm-qtxl" name="frm-qtxl">
               {{ csrf_field() }}               
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
         </div>
      </div>
   </div>
</div>

      <div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-hidden="false">
          <div class="circle-loader" style="margin-top: 25%;"></div>
      </div>