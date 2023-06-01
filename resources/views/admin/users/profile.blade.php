@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4><strong>{{ Auth::user()->name }}</strong> welcome back!</h4>
        </div>

@include('admin.includes.alert')
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
                        <img class="img-fluid img_user rounded-circle" src="{{ (!empty($profile_data[0]->photo)) ? url('public/admin/uploads/user/'.$profile_data[0]->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">
                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="mb-0">{{ $profile_data[0]->name }}</h4>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted text-lowercase mb-0">{{ $profile_data[0]->email }}</h4>
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
               <h4 class="card-title headline">{{ Auth::user()->name }} Profile Information</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Personal Information</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-3 ">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img class="img-fluid img_user rounded-circle" src="{{ (!empty($profile_data[0]->photo)) ? url('public/admin/uploads/user/'.$profile_data[0]->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-sm-12">
                            <div class="profile-personal-info">
                            
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Full Name <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Username <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->username }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Designation <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->designation }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Level<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($profile_data[0]->role == 'admin')
                                            {{ __('Admin') }}
                                            @elseif($profile_data[0]->role == 'author')
                                            {{ __('Author') }}
                                            @elseif($profile_data[0]->role == 'editor')
                                            {{ __('Editor') }}
                                            @elseif($profile_data[0]->role == 'contributor')
                                            {{ __('Contributor') }}
                                            @elseif($profile_data[0]->role == 'user')
                                            {{ __('User') }}
                                          @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">E-Mail <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->email }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Phone <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($profile_data[0]->dateOfBirth)) }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($profile_data[0]->gender == 1)
                                        {{ __('Male') }}
                                        @elseif($profile_data[0]->gender == 2)
                                        {{ __('Female') }}
                                        @else
                                        {{ __('Other') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Address <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->address }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Upzila <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->policestationname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">District <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->districtname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">City <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->cityname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Division <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->divisionname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Country <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->countryname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Zipcode <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->zipcode }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $profile_data[0]->description }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($profile_data[0]->status == 'active')
                                            {{ __('Active') }}
                                            @elseif($profile_data[0]->status == 'inactive')
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                               
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($profile_data[0]->created_at)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.info') }}">Update Info</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.username') }}">Update Username</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.email') }}">Update E-Mail</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.image') }}">Update Image</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.profile.password') }}">Update Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection