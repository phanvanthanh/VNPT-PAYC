@php
use Illuminate\Support\Facades\Auth;
$userId=Auth::id();
$binhLuanChuaXems=\Helper::layDanhSachBinhLuanChuaXemTheoTaiKhoan($userId);
$paknChuaXems=\Helper::layDanhSachPaknChuaXemTheoTaiKhoan($userId);
$soTinNhan=count($binhLuanChuaXems)+count($paknChuaXems);
@endphp
         <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row"><!-- thêm các class sau để đổi màu navbar-primary navbar-success navbar-warning navbar-danger navbar-pink navbar-info navbar-dark  -->
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
               <a class="navbar-brand brand-logo" href="/">VNPT - REPORT</a>
               <a class="navbar-brand brand-logo-mini" href="/">REPORT</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
               <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
               <span class="icon-menu"></span>
               </button>
               <ul class="navbar-nav">
                  <!-- <li class="nav-item dropdown d-none d-lg-flex">
                     <a class="nav-link dropdown-toggle nav-btn" href="#" data-toggle="modal" data-target="#exampleModal">
                     <span class="btn"><i class="icon-plus"></i> Đăng tin</span>
                     </a>
                  </li>
                  <li class="nav-item dropdown d-none d-lg-flex">
                     <a class="nav-link dropdown-toggle nav-btn" href="#" data-toggle="dropdown">
                     <span class="btn"><i class="fa fa-user-circle-o"></i> Đăng nhập/Đăng ký</span>
                     </a>
                     <div class="dropdown-menu navbar-dropdown dropdown-left" aria-labelledby="actionDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dangNhapModal">
                           <i class="icon-user-following text-primary"></i>
                           Đăng nhập
                           </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dangKyModal">
                           <i class="icon-user text-warning"></i>
                           Đăng ký
                        </a>
                     </div>
                  </li> -->
               </ul>
               <ul class="navbar-nav navbar-nav-right">

                  <li class="nav-item dropdown d-none d-lg-flex">
                     <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                     <i class="flag-icon flag-icon-vn"></i>
                     Việt Nam
                     </a>
                  </li>
                  <!-- <li class="nav-item dropdown">
                     <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                        <i class="icon-plus"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <a class="dropdown-item preview-item" data-toggle="modal" data-target="#exampleModal">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-warning">
                                 <i class="icon-basket-loaded mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Đăng tin bán</h6>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" data-toggle="modal" data-target="#modal-mua">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-success">
                                 <i class="icon-basket mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Đăng tin mua</h6>
                           </div>
                        </a>
                        
                     </div>
                  </li> -->
                  <li class="nav-item dropdown">
                     <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                     <i class="icon-bell mx-0"></i>
                     <span class="@if($soTinNhan<=0) count-success @else count @endif"></span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                        <a class="dropdown-item background-vnpt">
                           <p class="mb-0 font-weight-normal float-left">Danh sách thông báo
                           </p>
                           <span class="badge badge-pill badge-danger float-right">@php echo $soTinNhan; @endphp</span>
                        </a>
                        @foreach($binhLuanChuaXems as $binhLuan)
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item preview-item btn-danh-dau-da-xem-binh-luan" data="{{$binhLuan['id']}}" data2="{{$binhLuan['id_payc']}}">
                              <div class="preview-thumbnail">
                                 
                                 <div class="preview-icon bg-danger">
                                    <i class="icon-speech mx-0 btn-danh-dau-da-xem-binh-luan" data="{{$binhLuan['id']}}" data2="{{$binhLuan['id_payc']}}"></i>
                                 </div>
                              </div>
                              <div class="preview-item-content btn-danh-dau-da-xem-binh-luan" data="{{$binhLuan['id']}}" data2="{{$binhLuan['id_payc']}}">
                                 <h6 class="preview-subject font-weight-medium btn-danh-dau-da-xem-binh-luan" data="{{$binhLuan['id']}}" data2="{{$binhLuan['id_payc']}}">({{$binhLuan['so_phieu']}}) {{$binhLuan['tieu_de']}}</h6>
                                 <p class="font-weight-light small-text btn-danh-dau-da-xem-binh-luan" data="{{$binhLuan['id']}}" data2="{{$binhLuan['id_payc']}}">
                                    Tin mới từ <b class="font-weight-bold">{{$binhLuan['name']}}</b> <br>{{$binhLuan['ngay_binh_luan']}}
                                 </p>
                              </div>
                           </a>
                        @endforeach
                        @foreach($paknChuaXems as $paknChuaXem)
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item preview-item btn-danh-dau-da-xem-pakn" data="{{$paknChuaXem['id']}}" data2="{{$paknChuaXem['id_payc']}}">
                              <div class="preview-thumbnail">
                                 
                                 <div class="preview-icon bg-danger">
                                    <i class="icon-speech mx-0 btn-danh-dau-da-xem-pakn" data="{{$paknChuaXem['id']}}" data2="{{$paknChuaXem['id_payc']}}"></i>
                                 </div>
                              </div>
                              <div class="preview-item-content btn-danh-dau-da-xem-pakn" data="{{$paknChuaXem['id']}}" data2="{{$paknChuaXem['id_payc']}}">
                                 <h6 class="preview-subject font-weight-medium btn-danh-dau-da-xem-pakn" data="{{$paknChuaXem['id']}}" data2="{{$paknChuaXem['id_payc']}}">({{$paknChuaXem['so_phieu']}}) {{$paknChuaXem['tieu_de']}}</h6>
                                 <p class="font-weight-light small-text btn-danh-dau-da-xem-pakn" data="{{$paknChuaXem['id']}}" data2="{{$paknChuaXem['id_payc']}}">
                                    Tin mới từ <b class="font-weight-bold">{{$paknChuaXem['ten_user_xu_ly']}}</b> vào ngày {{$paknChuaXem['ngay_nhan']}}
                                 </p>
                              </div>
                           </a>
                        @endforeach
                        @if($soTinNhan==0)
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                 <i class="icon-envelope mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Hệ thống</h6>
                              <p class="font-weight-light small-text">
                                 Bạn chưa có thông báo hay bình luận nào
                              </p>
                           </div>
                        </a>
                        @endif
                        
                     </div>
                  </li>
                  
                  <li class="nav-item dropdown">
                     <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                     <i class="fa fa-user-circle-o"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                        <div class="dropdown-item background-vnpt">
                           <p class="mb-0 font-weight-normal float-left">Cấu hình thông tin tài khoản
                           </p>
                           <span class="badge badge-info badge-pill float-right"></span>
                        </div>
                        @if(!$userId)
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                 <i class="icon-user-following mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium "><div class="d-inline dang-nhap">Đăng nhập </div><div class="d-inline dang-ky">/ Đăng ký</div></h6>
                           </div>
                        </a>
                        @else
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="{{ route('thong-tin-ca-nhan') }}">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-info">
                                 <i class="icon-info mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Thông tin cá nhân</h6>
                           </div>
                        </a>
                        {{-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-danger">
                                 <i class="icon-key mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <h6 class="preview-subject font-weight-medium">Thay đổi mật khẩu</h6>
                           </div>
                        </a> --}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-danger">
                                 <i class="icon-lock-open mx-0"></i>
                              </div>
                           </div>
                           <div class="preview-item-content"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">                              
                              <h6 class="preview-subject font-weight-medium">Đăng xuất</h6>  
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 {{ csrf_field() }}
                              </form>
                           </div>
                        </a>
                        @endif
                     </div>
                  </li>
                  <li class="nav-item nav-settings d-none d-lg-block">
                     <a class="nav-link" href="#">
                     <i class="icon-grid"></i>
                     </a>
                  </li>
               </ul>
               <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
               <span class="icon-menu"></span>
               </button>
            </div>
         </nav>