<!doctype html>
<html lang="en">

<head>
<title>VNPT BRS - @yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
<meta name="author" content="ThemeMakker, design by: ThemeMakker.com">

<link rel="shortcut icon" href="{{ secure_asset('public/images/favicon.ico') }}">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ secure_asset('public/templatelight/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('public/templatelight/assets/vendor/animate-css/animate.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('public/templatelight/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('public/templatelight/assets/vendor/nestable/jquery-nestable.css') }}">
<link rel="stylesheet" href="{{ secure_asset('public/templatelight/assets/vendor/sweetalert/sweetalert.css') }}">
<link rel="stylesheet" href="{{ secure_asset('public/templatelight/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ secure_asset('public/templatelight/light/assets/css/main.css') }}">
<link rel="stylesheet" href="{{ secure_asset('public/templatelight/light/assets/css/color_skins.css') }}">
</head>
<body class="theme-blue">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="{{ secure_asset('public/file/payc/logo.png') }}" width="48" height="48" alt="Mplify"></div>
            <p>Please wait...</p>        
        </div>
    </div>
    <!-- Overlay For Sidebars -->
    <div class="overlay" style="display: none;"></div>
    
    <div id="wrapper">
    
        <!-- <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
    
                <div class="navbar-brand">
                    <a href="index.html">
                        <img src="{{ secure_asset('public/templatelight/assets/images/logo-icon.svg') }}" alt="Mplify Logo" class="img-responsive logo">
                        <span class="name">mplify</span>
                    </a>
                </div>
                
                <div class="navbar-right">
                    <ul class="list-unstyled clearfix mb-0">
                        <li>
                            <div class="navbar-btn btn-toggle-show">
                                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                            </div>                        
                            <a href="javascript:void(0);" class="btn-toggle-fullwidth btn-toggle-hide"><i class="fa fa-bars"></i></a>
                        </li>
                        <li>
                            <form id="navbar-search" class="navbar-form search-form">
                                <input value="" class="form-control" placeholder="Search here..." type="text">
                                <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                            </form>
                        </li>
                        <li>
                            <div id="navbar-menu">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="javascript:void(0);" class="mega_menu icon-menu" title="Mega Menu">Mega</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="create_new icon-menu" title="Create New">Create New</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                            <i class="icon-bell"></i>
                                            <span class="notification-dot"></span>
                                        </a>
                                        <ul class="dropdown-menu animated bounceIn notifications">
                                            <li class="header"><strong>You have 4 new Notifications</strong></li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <i class="icon-info text-warning"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
                                                            <span class="timestamp">10:00 AM Today</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>                               
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <i class="icon-like text-success"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text">Your New Campaign <strong>Holiday Sale</strong> is approved.</p>
                                                            <span class="timestamp">11:30 AM Today</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <i class="icon-pie-chart text-info"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text">Website visits from Twitter is 27% higher than last week.</p>
                                                            <span class="timestamp">04:00 PM Today</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <i class="icon-info text-danger"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="text">Error on website analytics configurations</p>
                                                            <span class="timestamp">Yesterday</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="footer"><a href="javascript:void(0);" class="more">See all notifications</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-flag"></i><span class="notification-dot"></span></a>
                                        <ul class="dropdown-menu animated bounceIn task">
                                            <li class="header"><strong>Project</strong></li>
                                            <li class="body">
                                                <ul class="menu tasks list-unstyled">
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Clockwork Orange <span class="float-right">29%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-turquoise" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Blazing Saddles <span class="float-right">78%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-slategray" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Project Archimedes <span class="float-right">45%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Eisenhower X <span class="float-right">68%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-coral" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <span class="text-muted">Oreo Admin Templates <span class="float-right">21%</span></span>
                                                            <div class="progress">
                                                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100" style="width: 21%;"></div>
                                                            </div>
                                                        </a>
                                                    </li>                        
                                                </ul>
                                            </li>
                                            <li class="footer"><a href="javascript:void(0);">View All</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="fa fa-language"></i></a>
                                        <ul class="dropdown-menu animated flipInX choose_language">                                        
                                            <li><a href="javascript:void(0);">English</a></li>
                                            <li><a href="javascript:void(0);">French</a></li>
                                            <li><a href="javascript:void(0);">Spanish</a></li>
                                            <li><a href="javascript:void(0);">Portuguese</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                            <img class="rounded-circle" src="../assets/images/user-small.png" width="30" alt="">
                                        </a>
                                        <div class="dropdown-menu animated flipInY user-profile">
                                            <div class="d-flex p-3 align-items-center">
                                                <div class="drop-left m-r-10">
                                                    <img src="{{ secure_asset('public/templatelight/assets/images/user-small.png') }}" class="rounded" width="50" alt="">
                                                </div>
                                                <div class="drop-right">
                                                    <h4>Samuel Morriss</h4>
                                                    <p class="user-name">samuelmorris@info.com</p>
                                                </div>
                                            </div>
                                            <div class="m-t-10 p-3 drop-list">
                                                <ul class="list-unstyled">
                                                    <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                                                    <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                                                    <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="icon-menu js-right-sidebar"><i class="icon-settings"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->
    
        <!-- <div id="leftsidebar" class="sidebar">
            <div class="sidebar-scroll">
                <nav id="leftsidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu">
                        <li class="heading">Main</li>
                        <li><a href="index.html"><i class="icon-home"></i><span>Dashboard</span></a></li>
                        <li class="heading">App</li>
                        <li><a href="app-inbox.html"><i class="icon-envelope"></i><span>Inbox</span></a></li>
                        <li><a href="app-chat.html"><i class="icon-bubbles"></i><span>Chat</span></a></li>
                        <li><a href="app-calendar.html"><i class="icon-calendar"></i><span>Calendar</span></a></li>
                        <li class="active"><a href="app-taskboard.html"><i class="icon-notebook"></i><span>Taskboard</span></a></li>
                        <li class="heading">UI Elements</li>
                        <li class="middle">
                            <a href="#uiElements" class="has-arrow"><i class="icon-diamond"></i><span>Component</span></a>
                            <ul>
                                <li><a href="ui-card.html">Card Layout</a></li>
                                <li><a href="ui-typography.html">Typography</a></li>
                                <li><a href="ui-tabs.html">Tabs</a></li>
                                <li><a href="ui-buttons.html">Buttons</a></li>
                                <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                                <li><a href="ui-icons.html">Icons</a></li>
                                <li><a href="ui-notifications.html">Notifications</a></li>
                                <li><a href="ui-colors.html">Colors</a></li>
                                <li><a href="ui-dialogs.html">Dialogs</a></li>
                                <li><a href="ui-list-group.html">List Group</a></li>
                                <li><a href="ui-media-object.html">Media Object</a></li>
                                <li><a href="ui-modals.html">Modals</a></li>
                                <li><a href="ui-nestable.html">Nestable</a></li>
                                <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                <li><a href="ui-range-sliders.html">Range Sliders</a></li>
                                <li><a href="ui-treeview.html">Treeview</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#forms" class="has-arrow"><i class="icon-pencil"></i><span>Forms</span></a>
                            <ul>
                                <li><a href="forms-validation.html">Form Validation</a></li>
                                <li><a href="forms-advanced.html">Advanced Elements</a></li>
                                <li><a href="forms-basic.html">Basic Elements</a></li>
                                <li><a href="forms-wizard.html">Form Wizard</a></li>
                                <li><a href="forms-dragdropupload.html">Drag &amp; Drop Upload</a></li>
                                <li><a href="forms-cropping.html">Image Cropping</a></li>
                                <li><a href="forms-summernote.html">Summernote</a></li>
                                <li><a href="forms-editors.html">CKEditor</a></li>
                                <li><a href="forms-markdown.html">Markdown</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#Tables" class="has-arrow"><i class="icon-tag"></i><span>Tables</span></a>
                            <ul>
                                <li><a href="table-basic.html">Tables Example</a></li>
                                <li><a href="table-normal.html">Normal Tables</a></li>
                                <li><a href="table-jquery-datatable.html">Jquery Datatables</a></li>
                                <li><a href="table-editable.html">Editable Tables</a></li>
                                <li><a href="table-color.html">Tables Color</a></li>
                                <li><a href="table-filter.html">Table Filter</a></li>
                                <li><a href="table-dragger.html">Table dragger</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#charts" class="has-arrow"><i class="icon-bar-chart"></i><span>Charts</span></a>
                            <ul>
                                <li><a href="chart-morris.html">Morris</a> </li>
                                <li><a href="chart-flot.html">Flot</a> </li>
                                <li><a href="chart-chartjs.html">ChartJS</a> </li>
                                <li><a href="chart-jquery-knob.html">Jquery Knob</a> </li>
                                <li><a href="chart-sparkline.html">Sparkline Chart</a></li>
                                <li><a href="chart-peity.html">Peity</a></li>
                                <li><a href="chart-c3.html">C3 Charts</a></li>
                                <li><a href="chart-gauges.html">Gauges</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#Widgets" class="has-arrow"><i class="icon-puzzle"></i><span>Widgets</span></a>
                            <ul>                                    
                                <li><a href="widgets-statistics.html">Statistics</a></li>
                                <li><a href="widgets-data.html">Data</a></li>
                                <li><a href="widgets-chart.html">Chart</a></li>
                                <li><a href="widgets-weather.html">Weather</a></li>
                                <li><a href="widgets-social.html">Social</a></li>
                                <li><a href="widgets-blog.html">Blog</a></li>
                                <li><a href="widgets-ecommerce.html">eCommerce</a></li>
                            </ul>
                        </li>
                        <li class="heading">User</li>
                        <li>
                            <a href="#FileManager" class="has-arrow"><i class="icon-folder"></i><span>File Manager</span></a>
                            <ul>                                    
                                <li><a href="file-dashboard.html">Dashboard</a></li>
                                <li><a href="file-documents.html">Documents</a></li>
                                <li><a href="file-media.html">Media</a></li>
                                <li><a href="file-images.html">Images</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#Blog" class="has-arrow"><i class="icon-globe"></i><span>Blog</span></a>
                            <ul>
                                <li><a href="blog-dashboard.html">Dashboard</a></li>
                                <li><a href="blog-post.html">New Post</a></li>
                                <li><a href="blog-list.html">Blog List</a></li>
                                <li><a href="blog-details.html">Blog Detail</a></li>
                            </ul>
                        </li>
                        <li class="heading">Extra</li>
                        <li class="top">
                            <a href="#Authentication" class="has-arrow"><i class="icon-lock"></i><span>Authentication</span></a>
                            <ul>
                                <li><a href="page-login.html">Login</a></li>
                                <li><a href="page-register.html">Register</a></li>
                                <li><a href="page-lockscreen.html">Lockscreen</a></li>
                                <li><a href="page-forgot-password.html">Forgot Password</a></li>
                                <li><a href="page-404.html">Page 404</a></li>
                                <li><a href="page-403.html">Page 403</a></li>
                                <li><a href="page-500.html">Page 500</a></li>
                                <li><a href="page-503.html">Page 503</a></li>
                            </ul>
                        </li>
                        <li class="top">
                            <a href="#Pages" class="has-arrow"><i class="icon-docs"></i><span>Pages</span></a>
                            <ul>
                                <li><a href="page-blank.html">Blank Page</a></li>
                                <li><a href="app-contact.html">Contact list</a></li>
                                <li><a href="app-contact-grid.html">Contact Card</a></li>
                                <li><a href="page-profile.html">Profile</a></li>
                                <li><a href="page-gallery.html">Image Gallery</a></li>
                                <li><a href="page-gallery2.html">Image Gallery</a></li>
                                <li><a href="page-timeline.html">Timeline</a></li>
                                <li><a href="page-timeline-h.html">Horizontal Timeline</a></li>
                                <li><a href="page-pricing.html">Pricing</a></li>
                                <li><a href="page-invoices.html">Invoices</a></li>
                                <li><a href="page-search-results.html">Search Results</a></li>
                                <li><a href="page-helper-class.html">Helper Classes</a></li>
                                <li><a href="page-teams-board.html">Teams Board</a></li>
                                <li><a href="page-projects-list.html">Projects List</a></li>
                                <li><a href="page-maintenance.html">Maintenance</a></li>
                                <li><a href="page-testimonials.html">Testimonials</a></li>
                                <li><a href="page-faq.html">FAQ</a></li>
                            </ul>
                        </li>                        
                        <li class="top">
                            <a href="#Maps" class="has-arrow"><i class="icon-map"></i> <span>Maps</span></a>
                            <ul>
                                <li><a href="map-google.html">Google Map</a></li>
                                <li><a href="map-yandex.html">Yandex Map</a></li>
                                <li><a href="map-jvectormap.html">jVector Map</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div> -->
    
        <!-- <div id="mega_menubar" class="mega_menubar">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>Subscribe</h2>
                            </div>
                            <div class="body">
                                <form>
                                    <div class="form-group">
                                        <input type="text" value="" placeholder="Enter Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" value="" placeholder="Enter Email" class="form-control">
                                    </div>
                                    <button class="btn btn-primary">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>Accordion</h2>
                            </div>
                            <div class="body">
                                <ul class="accordion2">
                                    <li class="accordion-item is-active">
                                        <h3 class="accordion-thumb"><span>Lorem ipsum</span></h3>
                                        <p class="accordion-panel">
                                            Lorem ipsum dolor sit amet, elit. Placeat, quibusdam! Voluptate nobis
                                        </p>
                                    </li>
                                    
                                    <li class="accordion-item">
                                        <h3 class="accordion-thumb"><span>Dolor sit amet</span></h3>
                                        <p class="accordion-panel">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing  Voluptate nobis
                                        </p>
                                    </li>
                                </ul>
    
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>Company</h2>
                            </div>
                            <div class="body">
                                <ul class="list-unstyled links">
                                    <li><a href="javascript:void(0);" title="" >Our Facts</a></li>
                                    <li><a href="javascript:void(0);" title="" >Confidentiality</a></li>                                
                                    <li><a href="javascript:void(0);" title="" >About Us</a></li>
                                    <li><a href="javascript:void(0);" title="" >Testimonials</a></li>
                                    <li><a href="javascript:void(0);" title="" >Contact Us</a></li>                                
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>Image Gallery</h2>
                            </div>
                            <div class="body">
                                <div class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/image-gallery/1.jpg') }}" class="img-fluid" alt="img" />
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/image-gallery/2.jpg') }}" class="img-fluid" alt="img" />
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/image-gallery/3.jpg') }}" class="img-fluid" alt="img" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#skins" aria-expanded="true">Mplify</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact" aria-expanded="false">Contact</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Timeline" aria-expanded="false">Timeline </a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane animated fadeIn in active" id="skins" aria-expanded="true">
                    <div class="sidebar-scroll">
                        <div class="card">
                            <div class="header">
                                <h2>General Setting</h2>
                            </div>
                            <div class="body">
                                <ul class="setting-list list-unstyled">
                                    <li>
                                        <label for="checkbox1" class="fancy-checkbox">
                                            <input id="checkbox1" type="checkbox">
                                            <span>Report Panel Usage</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="checkbox2" class="fancy-checkbox">
                                            <input id="checkbox2" type="checkbox" checked>
                                            <span>Email Redirect</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="checkbox3" class="fancy-checkbox">
                                            <input id="checkbox3" type="checkbox" checked>
                                            <span>Notifications</span>
                                        </label>         
                                    </li>
                                    <li>
                                        <label for="checkbox4" class="fancy-checkbox">
                                            <input id="checkbox4" type="checkbox">
                                            <span>Auto Updates</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="checkbox5" class="fancy-checkbox">
                                            <input id="checkbox5" type="checkbox">
                                            <span>Offline</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="checkbox6" class="fancy-checkbox">
                                            <input id="checkbox6" type="checkbox">
                                            <span>Location Permission</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h2>Color Skins</h2>
                            </div>
                            <div class="body">
                                <ul class="choose-skin list-unstyled">
                                    <li data-theme="purple">
                                        <div class="purple"></div>
                                        <span>Purple</span>
                                    </li>                   
                                    <li data-theme="blue" class="active">
                                        <div class="blue"></div>
                                        <span>Blue</span>
                                    </li>
                                    <li data-theme="cyan">
                                        <div class="cyan"></div>
                                        <span>Cyan</span>
                                    </li>
                                    <li data-theme="green">
                                        <div class="green"></div>
                                        <span>Green</span>
                                    </li>
                                    <li data-theme="orange">
                                        <div class="orange"></div>
                                        <span>Orange</span>
                                    </li>
                                    <li data-theme="blush">
                                        <div class="blush"></div>
                                        <span>Blush</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h2>Storage</h2>
                            </div>
                            <div class="body">
                                <div class="progress progress-xs mb-0">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 89%;">
                                    </div>
                                </div>
                                <small>50MB of 10GB Used</small>
                                <button type="button" class="btn btn-primary btn-block mt-3">Upgrade Storage</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane animated fadeIn" id="contact" aria-expanded="false">
                    <div class="sidebar-scroll">
                        <div class="card">
                            <div class="header">
                                <h2>Recent Chat</h2>
                            </div>
                            <div class="body">
                                <ul class="right_chat list-unstyled">
                                    <li class="online">
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object " src="../assets/images/xs/avatar4.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Chris Fox</span>
                                                    <span class="message">Angular Champ</span>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </div>
                                        </a>                            
                                    </li>
                                    <li class="online">
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object " src="../assets/images/xs/avatar5.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Joge Lucky</span>
                                                    <span class="message">Sales Lead</span>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </div>
                                        </a>                            
                                    </li>
                                    <li class="offline">
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object " src="../assets/images/xs/avatar2.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Isabella</span>
                                                    <span class="message">CEO, Thememakker</span>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </div>
                                        </a>                            
                                    </li>
                                    <li class="offline">
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object " src="../assets/images/xs/avatar1.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Folisise Chosielie</span>
                                                    <span class="message">PHP Expert</span>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </div>
                                        </a>                            
                                    </li>
                                    <li class="online">
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object " src="../assets/images/xs/avatar3.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Alexander</span>
                                                    <span class="message">eCommerce Master</span>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </div>
                                        </a>                            
                                    </li>                        
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h2>Contact List</h2>
                            </div>
                            <div class="body">
                                <ul class="list-unstyled contact-list">
                                    <li class="d-flex align-items-center">
                                        <span class="contact-img">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar1.jpg') }}" class="rounded" alt="">
                                        </span>
                                        <h4 class="contact-name">Vincent Porter <span class="d-block">London UK</span></h4>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="contact-img">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar2.jpg') }}" class="rounded" alt="">
                                        </span>
                                        <h4 class="contact-name">Mike Thomas <span class="d-block">London UK</span></h4>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="contact-img">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar3.jpg') }}" class="rounded" alt="">
                                        </span>
                                        <h4 class="contact-name">Aiden Chavaz</h4>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="contact-img">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar4.jpg') }}" class="rounded" alt="">
                                        </span>
                                        <h4 class="contact-name">Vincent Porter <span class="d-block">London UK</span></h4>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="contact-img">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar5.jpg') }}" class="rounded" alt="">
                                        </span>
                                        <h4 class="contact-name">Mike Thomas <span class="d-block">London UK</span></h4>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <span class="contact-img">
                                            <img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar6.jpg') }}" class="rounded" alt="">
                                        </span>
                                        <h4 class="contact-name">Aiden Chavaz</h4>
                                    </li>                             
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane animated fadeIn" id="Timeline" aria-expanded="false">
                    <div class="sidebar-scroll">
                        <div class="card">
                            <div class="header">
                                <h2>My Stats</h2>
                            </div>
                            <div class="body">
                                <ul class="list-unstyled basic-list">
                                    <li><i class="icon-book-open m-r-5"></i> Active Projects <span class="badge badge-primary">21</span></li>
                                    <li><i class="icon-list m-r-5"></i> Task Pending <span class="badge-purple badge">50</span></li>
                                    <li><i class="fa fa-ticket m-r-5"></i> Support Tickets<span class="badge-success badge">9</span></li>
                                    <li><i class="icon-tag m-r-5"></i> New Projects<span class="badge-info badge">7</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="body">
                                <div class="new_timeline mt-3">
                                    <div class="header">
                                        <div class="color-overlay">
                                            <div class="day-number">8</div>
                                            <div class="date-right">
                                            <div class="day-name">Monday</div>
                                            <div class="month">July 2018</div>
                                            </div>
                                        </div>                                
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="bullet pink"></div>
                                            <div class="time">11am</div>
                                            <div class="desc">
                                                <h3>Attendance</h3>
                                                <h4>Computer Class</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet green"></div>
                                            <div class="time">12pm</div>
                                            <div class="desc">
                                                <h3>Developer Team</h3>
                                                <h4>Hangouts</h4>
                                                <ul class="list-unstyled team-info margin-0 p-t-5">                                            
                                                    <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar1.jpg') }}" alt="Avatar"></li>
                                                    <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar2.jpg') }}" alt="Avatar"></li>
                                                    <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar3.jpg') }}" alt="Avatar"></li>
                                                    <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar4.jpg') }}" alt="Avatar"></li>                                            
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet orange"></div>
                                            <div class="time">1:30pm</div>
                                            <div class="desc">
                                                <h3>Lunch Break</h3>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet green"></div>
                                            <div class="time">2pm</div>
                                            <div class="desc">
                                                <h3>Finish</h3>
                                                <h4>Go to Home</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    <div id="main-content" class="taskboard">
        @yield('content')
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>TaskBoard</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">TaskBoard</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-3 col-md-12">
                    <div class="card open_task">
                        <div class="header">
                            <h2>Open</h2>
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
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <h5>Job title</h5>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                            <ul class="list-unstyled team-info m-t-20 m-b-20">
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar1.jpg') }}" title="Avatar" alt="Avatar"></li>
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar2.jpg') }}" title="Avatar" alt="Avatar"></li>
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar5.jpg') }}" title="Avatar" alt="Avatar"></li>
                                            </ul>
                                            <ul class="list-unstyled clearfix action">
                                                <li><a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> 5</a></li>
                                                <li><a href="javascript:void(0);" class="bug"><i class="fa fa-dot-circle-o"></i> Bugs</a></li>
                                            </ul>
                                        </div>
                                    </li>                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">
                    <div class="card progress_task">
                        <div class="header">
                            <h2>In progress</h2>
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
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <h5>Create Blog</h5>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                            <ul class="list-unstyled clearfix action">
                                                <li><a href="javascript:void(0);"><i class="fa fa-paperclip"></i> 1</a></li>
                                                <li><a href="javascript:void(0);"><i class="fa fa-dot-circle-o"></i> UX</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <h5>Design UI</h5>
                                            <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero</p>
                                            <ul class="list-unstyled team-info m-t-20 m-b-20">
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar7.jpg') }}" title="Avatar" alt="Avatar"></li>
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar9.jpg') }}" title="Avatar" alt="Avatar"></li>
                                            </ul>
                                            <ul class="list-unstyled clearfix action">
                                                <li><a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> 5</a></li>
                                                <li><a href="javascript:void(0);"><i class="fa fa-paperclip"></i> 1</a></li>
                                                <li><a href="javascript:void(0);" class="bug"><i class="fa fa-dot-circle-o"></i> Bugs</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12">
                    <div class="card review_task">
                        <div class="header">
                            <h2>Review</h2>
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
                                <ol class="dd-list">                                   
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <h5>New Code update</h5>
                                            <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                                            <ul class="list-unstyled team-info m-t-20 m-b-20">
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar4.jpg') }}" title="Avatar" alt="Avatar"></li>
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar5.jpg') }}" title="Avatar" alt="Avatar"></li>
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar6.jpg') }}" title="Avatar" alt="Avatar"></li>
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar8.jpg') }}" title="Avatar" alt="Avatar"></li>
                                            </ul>
                                            <ul class="list-unstyled clearfix action">
                                                <li><a href="javascript:void(0);" class="comment"><i class="fa fa-comment"></i> 5</a></li>
                                                <li><a href="javascript:void(0);"><i class="fa fa-paperclip"></i> 1</a></li>
                                                <li><a href="javascript:void(0);" class="bug"><i class="fa fa-dot-circle-o"></i> Bugs</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-12">
                    <div class="card completed_task">
                        <div class="header">
                            <h2>Completed</h2>
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
                                <ol class="dd-list">                                   
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <h5>Event Done</h5>
                                            <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                                            <ul class="list-unstyled team-info m-t-20 m-b-20">
                                                <li><img src="{{ secure_asset('public/templatelight/assets/images/xs/avatar4.jpg') }}" title="Avatar" alt="Avatar"></li>
                                            </ul>
                                            <ul class="list-unstyled clearfix action">
                                                <li><a href="javascript:void(0);"><i class="fa fa-paperclip"></i> 1</a></li>
                                                <li><a href="javascript:void(0);" class="qa"><i class="fa fa-dot-circle-o"></i> QA</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</div>

<!-- Add New Task -->
<div class="modal fade" id="addcontact" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Add New Task</h6>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="form-group">                                    
                            <input type="text" class="form-control" placeholder="Task no.">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">                                   
                            <input type="text" class="form-control" placeholder="Job title">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">                                    
                            <textarea class="form-control" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <select class="form-control show-tick m-b-10">
                            <option>Select Team</option>
                            <option>John Smith</option>
                            <option>Hossein Shams</option>
                            <option>Maryam Amiri</option>
                            <option>Tim Hank</option>
                            <option>Gary Camara</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label>Range</label>
                        <div class="input-daterange input-group" data-provide="datepicker">
                            <input type="text" class="form-control" name="start">
                            <span class="input-group-addon"> to </span>
                            <input type="text" class="form-control" name="end">
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<!-- Javascript -->
<script type="text/javascript" src="{{ secure_asset('public/templatelight/light/assets/bundles/libscripts.bundle.js') }}"></script>    
<script type="text/javascript" src="{{ secure_asset('public/templatelight/light/assets/bundles/vendorscripts.bundle.js') }}"></script>

<script type="text/javascript" src="{{ secure_asset('public/templatelight/assets/vendor/nestable/jquery.nestable.js') }}"></script> <!-- Jquery Nestable -->
<script type="text/javascript" src="{{ secure_asset('public/templatelight/assets/vendor/sweetalert/sweetalert.min.js') }}"></script> <!-- SweetAlert Plugin Js --> 
<script type="text/javascript" src="{{ secure_asset('public/templatelight/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script><!-- bootstrap datepicker Plugin Js --> 

<script type="text/javascript" src="{{ secure_asset('public/templatelight/light/assets/bundles/mainscripts.bundle.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('public/templatelight/light/assets/bundles/morrisscripts.bundle.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('public/templatelight/light/assets/js/pages/ui/sortable-nestable.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('public/templatelight/light/assets/js/pages/ui/dialogs.js') }}"></script>
</body>
</html>
