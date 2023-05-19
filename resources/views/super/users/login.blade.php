<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<?php  
    //  $getTitle = $rt->getPageTitle();
    // if ($getTitle) {
    //    while ($result = $getTitle->fetch_assoc()) {
?>
    <title><?php //echo $result['titleEn']; ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="admin/<?php //echo $result['logo']; ?>">
<?php //} } ?>
    <link href="{{ asset('public/admin/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/assets/css/main.css') }}" rel="stylesheet">
    
    <?php //include 'inc/scripts/css.php'; ?>

</head>

<body class="h-100">
    <style>
        body{
            background-image: url({{ asset('public/admin/assets/images/front_bg.jpg') }});
            background-size: cover;
            background-position: center;
            padding: 10px 0px;
        }
    </style>
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in your account<h4>

                                    @include('super.includes.alert')
    
                                    <form action="{{ url('/super/login') }}" method="POST" enctype="multipart/form-data">
                                         @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" name="username" class="form-control" placeholder="Enter Your Username">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="text-center mybtn">
                                            <input type="submit" name="submit" class="btn text-uppercase btn-block submitbtn" value="Log In">
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('public/admin/assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/deznav-init.js') }}"></script>

</body>

</html>