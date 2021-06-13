(function($) {
  /*
  * _token là token của laravel
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  loadTable = function(_token, url, className, showMessage=false){
      loading('.error-mode');
      var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            $(className).empty();
            jQuery(className).html(data.html);
          },
      });
  }

  /*
  * _token là token của laravel
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  loadTableById = function(_token, id, url, className, showMessage=false){
      loading('.error-mode');
      var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              "id":id,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            $(className).empty();
            jQuery(className).html(data.html);
          },
      });
  }

    /*
  * _token là token của laravel
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  loadTableById2 = function(_token, id, url, className, showMessage=false){
      loading('.error-mode');
      var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              "id":id,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            $(className).empty();
            jQuery(className).html(data.html);
            if (data.error=="") {
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
            }else{
              errorLoader(".error-mode",data.error);
            }
              

          },
      });
  }


  /*
  * _token là token của laravel
  * frmName là tên form chứa các input
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */

  themMoi=function(_token, frmName, url, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    jQuery('.btn-them-moi').attr("disabled",true);
    var formData = new FormData(frmName[0]);
    var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        error:function(){   
          jQuery('.btn-them-moi').attr("disabled",false);
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            jQuery('.btn-them-moi').attr("disabled",false);
            if(urlRefreshData){
              loadTable(_token, urlRefreshData, classNameRefreshData);
            }
            
            
          }else{
            jQuery('.btn-them-moi').attr("disabled",false);
            errorLoader(".error-mode",data.error);
          }
            
        },
    });
  }

  /*
  * _token là token của laravel
  * id là id của dữ liệu cần get
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  getById=function(_token, id, url, className, showMessage=false){
    loading('.error-mode');
    var xhr1;
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){

            $(className).empty();
            if(data.error==""){
              if(className){
                jQuery(className).html(data.html);
              }
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
            }else{
              errorLoader(".error-mode",data.error);
              if(className){
                jQuery(className).html(data.html);
              }
            }
            
          },
      });
  }

  /*
  * _token là token của laravel
  * id là id của dữ liệu cần get
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  getById2=function(_token, id, url, className, showMessage=false){
    loading('.error-mode');
    var xhr1;
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){

            $(className).empty();
            if(data.error==""){
              if(className){
                jQuery(className).html(data.html);
              }
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
            }else{
              errorLoader(".error-mode",data.error);
              if(className){
                jQuery(className).html(data.html);
              }
            }
            
          },
      });
  }

  /*
  * _token là token của laravel
  * id là id của dữ liệu cần get
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  postId=function(_token, id, url, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    var xhr1;
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            if(data.error==""){
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
              if(urlRefreshData && classNameRefreshData){
                loadTable(_token, urlRefreshData, classNameRefreshData);
              }
            }else{
              errorLoader(".error-mode",data.error);
            }
            
          },
      });
  }

  /*
  * _token là token của laravel
  * id là id của dữ liệu cần get
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  postAndRefreshById=function(_token, id, url, idRefresh, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    var xhr1;
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            if(data.error==""){
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
              if(urlRefreshData && classNameRefreshData){
                loadTableById2(_token, idRefresh, urlRefreshData, classNameRefreshData, showMessage);
              }
            }else{
              errorLoader(".error-mode",data.error);
            }
            
          },
      });
  }

  /*
  * _token là token của laravel
  * id là id của dữ liệu cần get
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  postAndNotRefreshById=function(_token, id, url, showMessage=false){
    loading('.error-mode');
    var xhr1;
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            if(data.error==""){
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
            }else{
              errorLoader(".error-mode",data.error);
            }
            
          },
      });
  }

  /*
  * _token là token của laravel
  * frmName là tên form chứa các input
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */
  capNhat=function(_token, frmName, url, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    jQuery('.btn-cap-nhat').attr("disabled",true);
    var formData = new FormData(frmName[0]);
    var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        error:function(){   
          jQuery('.btn-cap-nhat').attr("disabled",false);
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){
          jQuery('.btn-cap-nhat').attr("disabled",false);          
          $(".error-mode").empty();
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            loadTable(_token, urlRefreshData, classNameRefreshData);
          }else{
            errorLoader(".error-mode",data.error);
          }
        },
    });
  }


  /*
  * _token là token của laravel
  * frmName là tên form chứa các input
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */
  capNhatVaRefreshDuLieuTheoId=function(_token, frmName, url, idRefresh, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    jQuery('.btn-cap-nhat').attr("disabled",true);
    var formData = new FormData(frmName[0]);
    var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        error:function(){   
          jQuery('.btn-cap-nhat').attr("disabled",false);
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){
          jQuery('.btn-cap-nhat').attr("disabled",false);          
          $(".error-mode").empty();
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            getById2(_token, idRefresh, urlRefreshData, classNameRefreshData, false);
          }else{
            errorLoader(".error-mode",data.error);
          }
        },
    });
  }


  /*
  * _token là token của laravel
  * id là id dòng dữ liệu cần xóa
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */
  xoa=function(_token, id, url, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    var xhr1;
    if(xhr1 && xhr1.readyState != 4){
        xhr1.abort(); //huy lenh ajax truoc do
    }
    xhr1 = $.ajax({
        url:url,
        type:'POST',
        dataType:'json',
        cache: false,
        data:{
            "_token":_token,
            'id':id,
        },
        error:function(){
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){          
          $(".error-mode").empty();
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            loadTable(_token, urlRefreshData, classNameRefreshData);
          }else{
            errorLoader(".error-mode",data.error);
          }
        },
    });
  }

   /*
  * _token là token của laravel
  * id là id dòng dữ liệu cần xóa
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */
  xoaKhongRefresh=function(_token, id, url, showMessage=false){
    loading('.error-mode');
    var xhr1;
    if(xhr1 && xhr1.readyState != 4){
        xhr1.abort(); //huy lenh ajax truoc do
    }
    xhr1 = $.ajax({
        url:url,
        type:'POST',
        dataType:'json',
        cache: false,
        data:{
            "_token":_token,
            'id':id,
        },
        error:function(){
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){          
          $(".error-mode").empty();
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
          }else{
            errorLoader(".error-mode",data.error);
          }
        },
    });
  }

   /*
  * _token là token của laravel
  * id là id dòng dữ liệu cần xóa
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */
  xoaVaRefreshDuLieuTheoId=function(_token, id, url, idRefresh, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    var xhr1;
    if(xhr1 && xhr1.readyState != 4){
        xhr1.abort(); //huy lenh ajax truoc do
    }
    xhr1 = $.ajax({
        url:url,
        type:'POST',
        dataType:'json',
        cache: false,
        data:{
            "_token":_token,
            'id':id,
        },
        error:function(){
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){          
          $(".error-mode").empty();
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            //errorLoader(".error-mode","");
            getById(_token, idRefresh, urlRefreshData, classNameRefreshData, false);  
          }else{
            errorLoader(".error-mode",data.error);
          }
        },
    });
  }

  /*
  * className là tên class body của modal chứa các input sửa dữ liệu
  * Nếu lỗi = rổng thì hiển thị LOADER
  * ngược lại hiển thị lỗi
  */

  errorLoader=function(className, error){
    $(className).empty();            
    if(error){
      showDangerToast(error);
      /*var strError='<div class="alert alert-danger alert-dismissible fade show" role="alert">'
            +'<strong>Thất bại!</strong> '+error
            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
              +'<span aria-hidden="true">&times;</span>'
            +'</button>'
          +'</div>';
      jQuery(className).html(strError);
      $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
          $(".alert-danger").slideUp(500);
      });*/
    }else{
      showSuccessToast("Hệ thống xử lý thành công");
      /*var strError='<div class="alert alert-success alert-dismissible fade show" role="alert">'
            +'<strong>Thành công!</strong> Hệ thống xử lý thành công.'
            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
              +'<span aria-hidden="true">&times;</span>'
            +'</button>'
          +'</div>';
      jQuery(className).html(strError);
      $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
          $(".alert-success").slideUp(500);
      });*/
    }    
  }

  loading=function(className){
    $(className).empty();
    jQuery(className).html('<div class="loading">Loading&#8230;</div>');
  }


  /*
  * _token là token của laravel
  * roleId là nhóm quyền id cần phân quyền
  * ruleId là id quyền được phân cho nhóm quyền
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  phanQuyen=function(_token, roleId, resourceId, url, className, showMessage=false){
    loading('.error-mode');
    var xhr1;
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'role_id':roleId,
              'resource_id':resourceId,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            if(data.error==""){
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
            }else{
              errorLoader(".error-mode",data.error);
            }
            
          },
      });
  }

  phanNhomQuyen=function(_token, roleId, userId, url, showMessage=false){
    loading('.error-mode');
    var xhr1;
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'role_id':roleId,
              'user_id':userId,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            if(data.error==""){
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
            }else{
              errorLoader(".error-mode",data.error);
            }
            
          },
      });
  }

  /*
  * _token là token của laravel
  * frmName là tên form chứa các input
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */

  themMoiKhongRefreshDuLieu=function(_token, frmName, url, showMessage=false){
    loading('.error-mode');
    jQuery('.btn-them-moi').attr("disabled",true);
    var formData = new FormData(frmName[0]);
    var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        error:function(){   
          jQuery('.btn-them-moi').attr("disabled",false);
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            jQuery('.btn-them-moi').attr("disabled",false);            
          }else{
            errorLoader(".error-mode",data.error);
          }
        },
    });
  }

  /*
  * _token là token của laravel
  * frmName là tên form chứa các input
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */

  themMoiVaRefreshDuLieuTheoId=function(_token, frmName, url, idRefresh, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    jQuery('.btn-them-moi').attr("disabled",true);
    var formData = new FormData(frmName[0]);
    var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        error:function(){   
          jQuery('.btn-them-moi').attr("disabled",false);
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            jQuery('.btn-them-moi').attr("disabled",false);
            getById(_token, idRefresh, urlRefreshData, classNameRefreshData);         
          }else{
            errorLoader(".error-mode",data.error);
          }
        },
    });
  }

   /*
  * _token là token của laravel
  * frmName là tên form chứa các input
  * url để load dữ liệu
  * urlRefreshData là url load dữ liệu là url load dữ liệu để làm mới dữ liệu vào bảng, sử dụng trong hàm loadTable
  * classNameRefreshData là tên class loadTable chứa dữ liệu của  để sau khi thực hiện thêm mới dữ liệu xong sẽ refresh lại dữ liệu và add vô bảng dữ liệu
  */

  themMoiVaRefreshDuLieuTheoId2=function(_token, frmName, url, idRefresh, urlRefreshData, classNameRefreshData, showMessage=false){
    loading('.error-mode');
    jQuery('.btn-them-moi').attr("disabled",true);
    var formData = new FormData(frmName[0]);
    var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        error:function(){   
          jQuery('.btn-them-moi').attr("disabled",false);
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
              
            jQuery('.btn-them-moi').attr("disabled",false);
            getById2(_token, idRefresh, urlRefreshData, classNameRefreshData, false);         
          }else{
            errorLoader(".error-mode",data.error);
          }
        },
    });
  }

  xuLy=function(frmName, url, urlRefreshData, showMessage=false){
    loading('.error-mode');
    jQuery('.btn-tiep-nhan-va-chuyen-xu-ly-2').attr("disabled",true);
    var formData = new FormData(frmName[0]);
    var xhr1;  
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        error:function(){   
          jQuery('.btn-tiep-nhan-va-chuyen-xu-ly-2').attr("disabled",false);
          errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
        },
        success:function(data){
          if(data.error==""){
            if (showMessage==true) {
              errorLoader(".error-mode","");
            }else{
              $(".error-mode").empty();
            }
            jQuery('.btn-tiep-nhan-va-chuyen-xu-ly-2').attr("disabled",false);
            if(urlRefreshData){
              window.location.href =urlRefreshData;
            }else{
              location.reload();
            }
          }else{
            errorLoader(".error-mode",data.error);
          }
            
        },
    });   
  }


  /*
  * _token là token của laravel
  * id là id của dữ liệu cần get
  * url để load dữ liệu
  * className là tên class chứa table dữ liệu sau khi load thành công
  */
  chuyenKHDanhGia=function(_token, id, url, showMessage=false){
    loading('.error-mode');
    var xhr1;
      if(xhr1 && xhr1.readyState != 4){
          xhr1.abort(); //huy lenh ajax truoc do
      }
      xhr1 = $.ajax({
          url:url,
          type:'POST',
          dataType:'json',
          cache: false,
          data:{
              "_token":_token,
              'id':id,
          },
          error:function(){
            errorLoader(".error-mode","Đã có lỗi xảy ra, vui lòng liên hệ quản trị để được hỗ trợ!");
          },
          success:function(data){
            if(data.error==""){
              if (showMessage==true) {
                errorLoader(".error-mode","");
              }else{
                $(".error-mode").empty();
              }
              location.reload();
            }else{
              errorLoader(".error-mode",data.error);
            }
            
          },
      });
  }
})(jQuery);
