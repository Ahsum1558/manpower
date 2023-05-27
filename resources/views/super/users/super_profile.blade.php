@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4><strong>{{ Auth::guard('super')->user()->fullname }}</strong> welcome back!</h4>
        </div>

@include('super.includes.alert')
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="profile-info">
                    <div class="profile-photo">
                        <img class="img-fluid img_user rounded-circle" src="{{ (!empty($superData->photo)) ? url('public/admin/uploads/super/'.$superData->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">
                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="mb-0">{{ $superData->fullname }}</h4>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted text-lowercase mb-0">{{ $superData->email }}</h4>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Super Profile Information</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Personal Information</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-3 ">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img class="img-fluid img_user rounded-circle" src="{{ (!empty($superData->photo)) ? url('public/admin/uploads/super/'.$superData->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-sm-12">
                            <div class="profile-personal-info">
                            
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Full Name <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $superData->fullname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Username <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $superData->username }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Designation <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $superData->designation }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">E-Mail <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $superData->email }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Phone <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $superData->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($superData->dateOfBirth)) }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($superData->gender == 1)
                                        {{ __('Male') }}
                                        @elseif($superData->gender == 2)
                                        {{ __('Female') }}
                                        @else
                                        {{ __('Other') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Super Level <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $superData->type }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Address <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $superData->address }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $superData->description }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.profile.info') }}">Update Info</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.profile.username') }}">Update Username</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.profile.email') }}">Update E-Mail</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.profile.image') }}">Update Image</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('super.profile.password') }}">Update Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection