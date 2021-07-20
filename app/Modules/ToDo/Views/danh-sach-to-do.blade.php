@extends('layouts.script-layout')
<div class="col-12"> 
    <div class="row">
        <div class="col-12 text-right">
            <div class="badge badge-primary badge-fw">Chưa xử lý - Trong hạn</div>
            <div class="badge badge-danger badge-fw">Chưa xử lý - Quá hạn</div>
            <div class="badge badge-success badge-fw">Đã xử lý - Đúng hạn</div>
            <div class="badge badge-warning badge-fw">Đã xử lý - Quá hạn</div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card px-3">
                <div class="card-body" id='xu-ly-to-do' style="padding: 0px">
                    {{ csrf_field() }}
                </div>
                <div class="list-wrapper">
                    <ul id="items-list" class="moveable flex-column-reverse todo-list">
                        @foreach($toDos as $index => $toDo)
                            @php
                                $ngay_tao = date('d/m/Y H:i:s',strtotime($toDo['ngay_tao']));
                                $han_xu_ly = date('d/m/Y H:i:s',strtotime($toDo['han_xu_ly']));
                                $trangThai=Helper::kiemTraTrangThaiXuLy($toDo['han_xu_ly'], $toDo['ngay_hoan_thanh']);
                            @endphp           
                            <li draggable="true" @if($toDo['ngay_hoan_thanh']!='') class="draggable completed border-left-{{$trangThai}}" @else class="draggable border-left-{{$trangThai}}" @endif style="display: block !important;border-top: 2px solid #f2f2f2; padding: 5px 5px;">
                              <div class="form-check" style="display: flex; margin-top: 5px; margin-bottom: -10px; line-height:1px;">
                                <label class="form-check-label" style="padding-bottom:5px;">
                                  <input class="checkbox" type="checkbox" data-id="{{$toDo['id']}}" @if($toDo['ngay_hoan_thanh']!='') checked="checked" @endif>
                                  {{$toDo['noi_dung']}}
                                <i class="input-helper"></i></label>
                                <i class="remove"></i>
                                <p class="mb-0 font-weight-normal float-right text-primary btn-sua" data="{{$toDo['id']}}"><b style="padding-right: 5px"><i class="fa fa-wrench"></i></b>
                                </p>
                                <p class="mb-0 font-weight-normal float-right text-danger btn-xoa" data="{{$toDo['id']}}"><b><i class="fa fa-times-circle-o"></i></b>
                                </p>
                              </div>
                              <i class="text-muted" style="padding-left: 30px; font-size: 11px;">Hạn xử lý: {{$han_xu_ly}}</i>
                            </li>                      
                        @endforeach             
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-cap-nhat" tabindex="-1" role="dialog" aria-labelledby="modal-cap-nhat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header background-vnpt">
              <h5 class="modal-title">SỬA TO DO</h5>
              {{ csrf_field() }}
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
           </div>
           <div class="modal-body card">
                <form class="forms-sample frm-cap-nhat" id="frm-cap-nhat" name="frm-cap-nhat">
                    {{ csrf_field() }}
                </form>
           </div>
           <div class="modal-footer">
              <button type="button" class="btn btn-vnpt btn-cap-nhat"><i class="icon-check"></i> Cập nhật</button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
           </div>
        </div>
     </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var _token=jQuery('#modal-cap-nhat').find("input[name='_token']").val();

        /*Sự kiện bấm vào dòng cần sửa*/
        jQuery('.btn-sua').on('click',function(){            
            var id=jQuery(this).attr("data"); // lấy id
            getById(_token, id, "{{ route('to-do-single') }}", ".frm-cap-nhat"); // gọi sự kiện lấy dữ liệu theo id
            $('#modal-cap-nhat').modal('show'); // bật form sửa     
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-cap-nhat').on('click',function(){            
            capNhat(_token, $("form#frm-cap-nhat"), "{{ route('cap-nhat-to-do') }}", "{{ route('danh-sach-to-do') }}", '.load-danh-sach'); // bật form sửa     
            jQuery("#modal-cap-nhat").modal('hide'); // Tắt form sửa    
        });

        /*Sự kiện bấm nút cập nhật*/
        jQuery('.btn-xoa').on('click',function(){      
            var id=jQuery(this).attr("data"); // lấy id
            var result = confirm("Bạn thật sự muốn xóa thông tin này?  Nếu đồng ý xóa chúng tôi sẽ không phục hồi lại được.");
            if (result) {
                xoa(_token, id, "{{ route('xoa-to-do') }}", "{{ route('danh-sach-to-do') }}", '.load-danh-sach');  
            }
        });
        
        $('.checkbox').click(function() {
            jQuery(this).parents('li').toggleClass('completed');
            var _token=jQuery('#xu-ly-to-do').find("input[name='_token']").val();
            if ($(this).is(':checked')) {
                var id = $(this).attr("data-id");
                $.post("{{route('check-to-do')}}",
                {
                    "_token":_token,
                    id:id
                });
            }
            else{             
                var id = $(this).attr("data-id");
                $.post("{{route('uncheck-to-do')}}",
                {
                    "_token":_token,
                    id:id
                });
            }
        });
    });
    var dragSrcEl = null;

    function handleDragStart(e) {
      // Target (this) element is the source node.
      dragSrcEl = this;

      e.dataTransfer.effectAllowed = 'move';
      e.dataTransfer.setData('text/html', this.outerHTML);

      this.classList.add('dragElem');
    }
    function handleDragOver(e) {
      if (e.preventDefault) {
        e.preventDefault(); // Necessary. Allows us to drop.
      }
      this.classList.add('over');

      e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.


      return false;
    }

    function handleDragEnter(e) {
        e.preventDefault();

      // this / e.target is the current hover target.
    }

    function handleDragLeave(e) {
      this.classList.remove('over');  // this / e.target is previous target element.
    }

    function handleDrop(e) {
      // this/e.target is current target element.
      if (e.stopPropagation) {
        e.stopPropagation(); // Stops some browsers from redirecting.
      }

      // Don't do anything if dropping the same column we're dragging.
      if (dragSrcEl != this) {
        // Set the source column's HTML to the HTML of the column we dropped on.
        //alert(this.outerHTML);
        //dragSrcEl.innerHTML = this.innerHTML;
        //this.innerHTML = e.dataTransfer.getData('text/html');
        dragSrcEl.parentNode.removeChild(dragSrcEl);
        var dropHTML = e.dataTransfer.getData('text/html');
        this.insertAdjacentHTML('beforebegin',dropHTML);
        var dropElem = this.previousSibling;
        addDnDHandlers(dropElem);

      }
      this.classList.remove('over');
      return false;
    }

    function handleDragEnd(e) {
       // this/e.target is the source node.
        
        var dsId='';
        jQuery('.checkbox').each(function( index ) {
          dsId+=jQuery(this).attr('data-id')+';';
        });
        var _token=jQuery('#xu-ly-to-do').find("input[name='_token']").val();
        $.post('{{route('sort-to-do')}}',
        {
            "_token":_token,
            dsId:dsId
        },
        function(data){
          loadTable(_token, "{{ route('danh-sach-to-do') }}", '.load-danh-sach');
        });

        // Post danh sách id chỗ này xài hàm này, 2 trường cuối để rổng ''
        //postId(_token, id, url, urlRefreshData, classNameRefreshData);
       this.classList.remove('over');

      /*[].forEach.call(cols, function (col) {
        col.classList.remove('over');
      });*/
    }

    function addDnDHandlers(elem) {
      elem.addEventListener('dragstart', handleDragStart, false);
      elem.addEventListener('dragenter', handleDragEnter, false)
      elem.addEventListener('dragover', handleDragOver, false);
      elem.addEventListener('dragleave', handleDragLeave, false);
      elem.addEventListener('drop', handleDrop, false);
      elem.addEventListener('dragend', handleDragEnd, false);

    }

    var cols = document.querySelectorAll('#items-list .draggable');
    [].forEach.call(cols, addDnDHandlers);

</script>


