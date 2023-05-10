@php
    $id = Auth::guard('super')->user()->id;
    $superData = App\Models\Super::find($id);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<?php  
    //  $getTitle = $rt->getPageTitle();
    // if ($getTitle) {
    //    while ($result = $getTitle->fetch_assoc()) {
?>
    <title><?php //echo $result['titleEn']; ?>-<?php //echo TITLE; ?>Title</title>
    <link rel="icon" type="image/png" sizes="16x16" href="admin/<?php// echo $result['logo']; ?>">
<?php //} } ?>
    <?php// include 'scripts/meta.php'; ?>
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/select2/css/select2.min.css') }}">
    <link href="{{ asset('public/admin/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/vendor/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/chosen.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/LineIcons.css') }}" rel="stylesheet">
    @include('super.includes.css')
</head>
<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
        <div id="main-wrapper">
           <div class="nav-header" id="header_nav">
<?php  
    //  $getTitle = $rt->getPageTitle();
    // if ($getTitle) {
    //    while ($result = $getTitle->fetch_assoc()) {
?>
            <a href="{{ url('/super') }}" class="brand-logo">
                <img class="logo-abbr" src="admin/<?php //echo $result['logo']; ?>" alt="">
                <h3 class="logo-compact" id="header_logotitle"><?php //echo $result['smallTitle']; ?></h3>
                <h3 class="brand-title" id="header_logotitle"><?php //echo $result['smallTitle']; ?></h3>
            </a>
<?php //} } ?>
            <div class="nav-control" id="control_nav">
                <div class="hamburger">
                    <span class="line" id="line_nav"></span><span class="line" id="line_nav"></span><span class="line" id="line_nav"></span>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="header_bar w-100">

                                <span class="office_name"><?php //echo $result['titleEn']; ?></span>
                                <span class="licene_no">(<?php// echo $result['licenseEn']; ?>)</span>
                                <span class="current_time">
                                    <?php 
                                        date_default_timezone_set('Asia/Dhaka');
                                        echo date('F j, Y');
                                    ?>
                                </span>
                                <span class="doc_num"><?php //echo $result['address']; ?></span>

                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">

                                <a class="nav-link" href="javascript:;" role="button" data-toggle="dropdown">
                                    <div class="header-info">
                                        <span class="user_name">{{ Auth::guard('super')->user()->fullname }}</span>
                                        <span id="ourTime"></span>
                                    </div>
                   
                        <img class="header_img" src="{{ (!empty(Auth::guard('super')->user()->photo)) ? url('public/admin/uploads/super/'.Auth::guard('super')->user()->photo) : url('public/admin/assets/images/avatar.png') }}" alt="" width="20px">  
                    
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('super.profile') }}" class="dropdown-item ai-icon">
                                        <i class="fas fa-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                   
                                    <a href="{{ url('super/logout') }}" class="dropdown-item ai-icon logout_option"><i class='fas fa-sign-out-alt'></i>
                                        <span class="ml-2">{{ __('Log Out') }}</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
@include('super.includes.menu')