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

    <?php //include 'scripts/css.php'; ?>

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
            <a href="{{ url('/') }}" class="brand-logo">
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
<?php  
    //  $getTitle = $rt->getPageTitle();
    // if ($getTitle) {
    //    while ($result = $getTitle->fetch_assoc()) {
?>
                                <span class="office_name"><?php //echo $result['titleEn']; ?></span>
                                <span class="licene_no">(<?php// echo $result['licenseEn']; ?>)</span>
                                <span class="current_time">
                                    <?php 
                                        date_default_timezone_set('Asia/Dhaka');
                                        echo date('F j, Y');
                                    ?>
                                </span>
                                <span class="doc_num"><?php //echo $result['address']; ?></span>
<?php //} } ?>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
<?php  
    // $userid   = Session::get('adminId');
    // $getUser = $rec->getPersonalInfo($userid);
    // if ($getUser) {
    //    while ($result = $getUser->fetch_assoc()) {
?>
                                <a class="nav-link" href="javascript:;" role="button" data-toggle="dropdown">
                                    <div class="header-info">
                                        <span class="user_name"><?php// echo Session::get('adminUser'); ?></span>
                                        <span id="ourTime"></span>
                                    </div>
                    <?php //if (file_exists($result['image']) == TRUE) { ?>
                        {{-- <img class="header_img" src="<?php echo $result['image']; ?>" alt="" width="20px">     --}}
                    <?php //}else{ ?>
                        <img class="header_img" src="assets/images/avatar.png" alt="" width="20px">  
                    <?php// } ?>
                                </a>
<?php //} } ?>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="profile.php" class="dropdown-item ai-icon">
                                        <i class="fas fa-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                    <?php  
                        // if (isset($_GET['action']) && $_GET['action'] == "logout") {
                        //     Session::destroy();
                        // }
                    ?>
                                    <a href="?action=logout" class="dropdown-item ai-icon logout_option"><i class='fas fa-sign-out-alt'></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

@include('admin.includes.menu')