<table id="order-listing" class="table table-hover table-striped">
    <thead>
        <tr class="background-vnpt text-center">
            <th style="width: 10%;">STT #</th>
            <th style="width: 10%;">Tên tài khoản</th>
            <th style="width: 10%;">Email</th>
            <th style="width: 30%;">Send body</th>
            <th style="width: 30%;">Respone body</th>
            <th style="width: 10%;">Thời gian</th>
        </tr>
    </thead>
    <tbody>                       
                     
        <?php 
            $stt=0;
        ?>
        @foreach($logs as $log)
            <?php $stt++; ?>
            <tr class="tr-hover tr-small">
                <td class="text-center">{{$stt}}</td>
                <td class='text-primary btn-sua' data="{{$log['id']}}">
                    {{$log['name']}}
                </td>
                <td>                    
                    {{$log['email']}}
                </td>
                <td class="cusor send-body" data-toggle="modal" data-target="#modal-send-and-respone">
                    <code class="send-data" style="width: 50%;">
                        @php
                            \Helper::$stringJson='{ <br>';
                            $strSendBody=\Helper::decodeJson(json_decode($log['send_body'],TRUE));
                            echo $strSendBody;
                        @endphp 
                    </code>
                </td>
                <td class="cusor respone-body" data-toggle="modal" data-target="#modal-send-and-respone">
                    <code class="respone-data">
                        @php
                            \Helper::$stringJson='{ <br>';
                            $strResponeBody=\Helper::decodeJson(json_decode($log['respone_body'],TRUE));
                            $strResponeBody=str_replace('<br>', '',$strResponeBody);
                            echo $strResponeBody;
                        @endphp 
                    </code>
                </td>
                <td class="text-danger">
                    {{$log['created_at']}}
                </td>
            </tr>
        @endforeach    
    </tbody>
</table>             

<div class="modal fade" id="modal-send-and-respone" tabindex="-1" role="dialog" aria-labelledby="modal-send-and-respone" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content modal-send-and-respone">
         <div class="modal-header background-vnpt">
            <h5 class="modal-title">DATA SEND AND RESPONE BODY</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body card">
            <div class="font-weight-bold">Thông tin đã gửi:</div>
            <code id="data-send"></code>
            <div class="font-weight-bold">Thông tin đã nhận:</div>
            <code id="data-respone"></code>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-close-modal" data-dismiss="modal">Đóng</button>
         </div>
      </div>
   </div>
</div>





<script type="text/javascript">
    jQuery(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('.table').dataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: -1
        });
        var table = jQuery('#order-listing').DataTable({
            lengthChange: true
        });

        jQuery('.send-body').on('click',function(){
            var text=jQuery(this).text();
            jQuery('#data-send').text(text);

            var rp=jQuery(this).parents('tr').find('.respone-data').text();
            jQuery('#data-respone').text(rp);
        });

        jQuery('.respone-body').on('click',function(){
            var text=jQuery(this).text();
            jQuery('#data-respone').text(text);

            var send=jQuery(this).parents('tr').find('.send-data').text();
            jQuery('#data-send').text(send);
        });


        
    });
</script>


