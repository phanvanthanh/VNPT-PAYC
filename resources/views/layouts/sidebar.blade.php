@php
   use App\AdminResource;
   use App\AdminRule;
   use App\User;
   $resources=array();
   $userId=Auth::id();
   $user=array();
   if(!$userId){
      $userId=1;
   }
   // Lấy thông tin user ra để hiển thị lên giao diện
   $user=User::select('name')->where('id','=',$userId)->get()->toArray();
   // Lấy tất cả các quyền ra để đưa lên lưới
   $resources = AdminResource::where('status','=',1)->where('id','!=',1)->where('show_menu','=',1)->orderBy('order')->get()->toArray();
   $resources=\Helper::paycTreeResourceHasChild($resources, 1);
   $rules=\Helper::layDanhSachQuyenTheoUserId($userId);
@endphp         
               <div id="right-sidebar" class="settings-panel">
                  <i class="settings-close mdi mdi-close"></i>
                  <ul class="nav nav-tabs" id="setting-panel" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">THÔNG BÁO HỆ THỐNG</a>
                     </li>
                  </ul>
                  <div class="tab-content" id="setting-content">
                     <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                        <div class="list-wrapper px-3">
                           <ul class="d-flex flex-column-reverse todo-list">
                              <li class="logout">
                                 <div class="form-check">
                                    <i class="icon-lock-open"></i> &nbsp;&nbsp;&nbsp;&nbsp;
                                       ToDo
                                 </div>
                                 <i class="remove mdi mdi-close-circle-outline"></i>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <!-- To do section tab ends -->
                  </div>
               </div>
               <!-- partial -->
               <!-- partial:../../partials/_sidebar.html -->
               <nav class="sidebar sidebar-offcanvas" id="sidebar">
                  <ul class="nav">
                     <li class="nav-item nav-profile">
                        <div class="nav-link">
                           <div class="profile-image">
                              <a href="{{route('home')}}"><img src="{{ asset('public/images/logo.png') }}" alt="image"></a>
                              <!-- <span class="online-status online"></span> --> <!--change class online to offline or busy as needed-->
                           </div>
                           <div class="profile-name">
                              <p class="name">
                                 PHẢN ÁNH YÊU CẦU
                              </p>
                              <p class="designation">
                                 @if($user)
                                    {{$user[0]['name']}}
                                 @else
                                    Chế độ ẩn danh
                                 @endif
                              </p>
                           </div>
                        </div>
                     </li>

                     @foreach($resources as $resource)
                        @if(isset($rules[$resource['id']]))
                           @php $child=0; @endphp
                           @if($resource['has_child']>0)
                              @foreach($resources as $resourceChild)
                                 @if($resourceChild['parent_id']==$resource['id'] && isset($rules[$resourceChild['id']]))
                                    @php $child++; @endphp
                                 @endif
                              @endforeach
                           @endif
                           @if($resource['has_child']==0 && $resource['level']==0 && $child==0)
                           <li class="nav-item">
                              <a class="nav-link" href="{{$resource['uri']}}">
                                 <?php echo $resource['icon']; ?>
                                 <span class="menu-title">{{$resource['ten_hien_thi']}}</span>
                              </a>
                           </li>
                           @else
                              @if($resource['has_child']>0 && $resource['level']==0)
                              <li class="nav-item">
                                 <a class="nav-link" data-toggle="collapse" href="#icons{{$resource['id']}}" aria-expanded="false" aria-controls="icons{{$resource['id']}}">
                                 <?php echo $resource['icon']; ?>&nbsp;
                                 <span class="menu-title">{{$resource['ten_hien_thi']}}</span>
                                 <span class="badge badge-primary">{{$child}}</span>
                                 </a>
                                 <div class="collapse" id="icons{{$resource['id']}}">
                                    <ul class="nav flex-column sub-menu">
                                       <!-- Chạy lại dòng forearch để lấy ra những phần tử con -->
                                       @foreach($resources as $resourceChild)
                                          @if($resourceChild['parent_id']==$resource['id'] && isset($rules[$resourceChild['id']]))
                                          <li class="nav-item"> <a class="nav-link" href="{{$resourceChild['uri']}}"><?php echo $resource['icon']; ?>&nbsp;{{$resourceChild['ten_hien_thi']}}
                                          </a></li>
                                          @endif
                                       @endforeach                                 
                                    </ul>
                                 </div>
                              </li>
                              @endif
                           @endif
                        @endif
                     @endforeach                     
                  </ul>
               </nav>