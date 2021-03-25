@INCLUDE('layouts.head')
      <div class="container-scroller">
         <!-- partial:../../partials/_navbar.html -->
         @INCLUDE('layouts.navbar')
         <!-- partial -->
         <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-left">
               @INCLUDE('layouts.setting')
               @INCLUDE('layouts.sidebar')
               <!-- partial -->
               <div class="content-wrapper">
                  <div class="row grid-margin" style="margin-top: -15px">  
                     @yield('content')
                  </div>
                  @INCLUDE('layouts.footer')
               </div>
               <!-- content-wrapper ends -->
            </div>
            <!-- row-offcanvas ends -->
         </div>
         <!-- page-body-wrapper ends -->
      </div>
      @INCLUDE('layouts.modal')
      @INCLUDE('layouts.js')
   </body>
</html>