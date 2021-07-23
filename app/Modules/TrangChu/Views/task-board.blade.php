@extends('layouts.task-board')
@section('title', 'Task board')
@section('content')

	<div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>TaskBoard</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">TaskBoard</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-3 col-md-12">
                    <div class="card open_task">
                        <div class="header">
                            <h2>Việc phát sinh</h2>
                            <ul class="header-dropdown">
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#addcontact"><i class="icon-plus"></i></a></li>
                                <li><a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right animated bounceIn">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body taskboard">
                            <div class="dd" data-plugin="nestable">
                                @if (isset($dsPakn['phat_sinh']))
                                	<ol class="dd-list">  
                                	@foreach ($dsPakn['phat_sinh'] as $pakn)
	                                    <li class="dd-item" data-id="{{$pakn['tbl_can_bo_nhan_id']}}" data="{{$pakn['id_payc']}}">
	                                        <div class="dd-handle">
	                                            <h5>{{$pakn['so_phieu']}} - {{$pakn['tieu_de']}}</h5>
	                                            <p>@php echo nl2br($pakn['noi_dung']); @endphp</p>
	                                            <ul class="list-unstyled team-info m-t-20 m-b-20">
	                                            	@php
	                                            		$dsUserDangLam=Helper::taskBoardLayDanhSachUserTheoIdPakn($pakn['id_payc']);
	                                            	@endphp
	                                            	@foreach ($dsUserDangLam as $user)
                                                        @if ($user['hinh_anh'])                                                        
	                                            		 <li><img src="{{ secure_asset('storage/app/public/file/payc/'.$user['hinh_anh']) }}" title="Avatar" alt="Avatar" width="30px" height="30px"></li>
                                                        @endif
	                                            	@endforeach
	                                                
	                                            </ul>
	                                            <ul class="list-unstyled clearfix action">
	                                                <li><a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> 0</a></li>
	                                                <li><a href="javascript:void(0);" class="bug"><i class="fa fa-dot-circle-o"></i> Bugs</a></li>
	                                            </ul>
	                                        </div>
	                                    </li> 
                                    @endforeach  
                                    </ol>
                                @else
                                	<div class="dd-empty"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">
                    <div class="card progress_task">
                        <div class="header">
                            <h2>Việc cần làm</h2>
                            <ul class="header-dropdown">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right animated bounceIn">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body taskboard">
                            <div class="dd" data-plugin="nestable">
                                @if (isset($dsPakn['can_lam']))
                                	<ol class="dd-list">  
                                	@foreach ($dsPakn['can_lam'] as $pakn)
	                                    <li class="dd-item" data-id="{{$pakn['tbl_can_bo_nhan_id']}}" data="{{$pakn['id_payc']}}">
	                                        <div class="dd-handle">
	                                            <h5>{{$pakn['so_phieu']}} - {{$pakn['tieu_de']}}</h5>
	                                            <p>@php echo nl2br($pakn['noi_dung']); @endphp</p>
	                                            <ul class="list-unstyled team-info m-t-20 m-b-20">
	                                                @php
	                                            		$dsUserDangLam=Helper::taskBoardLayDanhSachUserTheoIdPakn($pakn['id_payc']);
	                                            	@endphp
	                                            	@foreach ($dsUserDangLam as $user)
                                                        @if ($user['hinh_anh']) 
	                                            		 <li><img src="{{ secure_asset('storage/app/public/file/payc/'.$user['hinh_anh']) }}" title="Avatar" alt="Avatar" width="30px" height="30px"></li>
                                                        @endif
	                                            	@endforeach
	                                            </ul>
	                                            <ul class="list-unstyled clearfix action">
	                                                <li><a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> 0</a></li>
	                                                <li><a href="javascript:void(0);" class="bug"><i class="fa fa-dot-circle-o"></i> Bugs</a></li>
	                                            </ul>
	                                        </div>
	                                    </li> 
                                    @endforeach  
                                    </ol>
                                @else
                                	<div class="dd-empty"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">
                    <div class="card review_task">
                        <div class="header">
                            <h2>Việc đang làm</h2>
                            <ul class="header-dropdown">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right animated bounceIn">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body taskboard">
                            <div class="dd" data-plugin="nestable">                                                                 
                                @if (isset($dsPakn['dang_lam']))
                                	<ol class="dd-list">  
                                	@foreach ($dsPakn['dang_lam'] as $pakn)
	                                    <li class="dd-item" data-id="{{$pakn['tbl_can_bo_nhan_id']}}" data="{{$pakn['id_payc']}}">
	                                        <div class="dd-handle">
	                                            <h5>{{$pakn['so_phieu']}} - {{$pakn['tieu_de']}}</h5>
	                                            <p>@php echo nl2br($pakn['noi_dung']); @endphp</p>
	                                            <ul class="list-unstyled team-info m-t-20 m-b-20">
	                                                @php
	                                            		$dsUserDangLam=Helper::taskBoardLayDanhSachUserTheoIdPakn($pakn['id_payc']);
	                                            	@endphp
	                                            	@if (isset($dsUserDangLam) && count($dsPakn)>0)
		                                            	@foreach ($dsUserDangLam as $user)
                                                            @if ($user['hinh_anh']) 
		                                            		    <li><img src="{{ secure_asset('storage/app/public/file/payc/'.$user['hinh_anh']) }}" title="Avatar" alt="Avatar" width="30px" height="30px"></li>
                                                            @endif
		                                            	@endforeach
	                                            	@endif
	                                            </ul>
	                                            <ul class="list-unstyled clearfix action">
	                                                <li><a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> 0</a></li>
	                                                <li><a href="javascript:void(0);" class="bug"><i class="fa fa-dot-circle-o"></i> Bugs</a></li>
	                                            </ul>
	                                        </div>
	                                    </li> 
                                    @endforeach  
                                    </ol>
                                @else
                                	<div class="dd-empty"></div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-12">
                    <div class="card completed_task">
                        <div class="header">
                            <h2>Hoàn tất</h2>
                            <ul class="header-dropdown">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right animated bounceIn">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body taskboard">
                            <div class="dd" data-plugin="nestable">
                                @if (isset($dsPakn['hoan_tat']))
                                	<ol class="dd-list">  
                                	@foreach ($dsPakn['hoan_tat'] as $pakn)
	                                    <li class="dd-item" data-id="{{$pakn['tbl_can_bo_nhan_id']}}" data="{{$pakn['id_payc']}}">
	                                        <div class="dd-handle">
	                                            <h5>{{$pakn['so_phieu']}} - {{$pakn['tieu_de']}}</h5>
	                                            <p>@php echo nl2br($pakn['noi_dung']); @endphp</p>
	                                            <ul class="list-unstyled team-info m-t-20 m-b-20">
	                                                @php
	                                            		$dsUserDangLam=Helper::taskBoardLayDanhSachUserTheoIdPakn($pakn['id_payc']);
	                                            	@endphp
	                                            	@if (isset($dsUserDangLam) && count($dsPakn)>0)
		                                            	@foreach ($dsUserDangLam as $user)
                                                            @if ($user['hinh_anh']) 
		                                            		    <li><img src="{{ secure_asset('storage/app/public/file/payc/'.$user['hinh_anh']) }}" title="Avatar" alt="Avatar" width="30px" height="30px"></li>
                                                            @endif
		                                            	@endforeach
		                                            @endif
	                                            </ul>
	                                            <ul class="list-unstyled clearfix action">
	                                                <li><a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> 0</a></li>
	                                                <li><a href="javascript:void(0);" class="bug"><i class="fa fa-dot-circle-o"></i> Bugs</a></li>
	                                            </ul>
	                                        </div>
	                                    </li> 
                                    @endforeach  
                                    </ol>
                                @else
                                	<div class="dd-empty"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
										

   <script type="text/javascript" src="{{ secure_asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {

	    
	  
	});
	</script>
@endsection


