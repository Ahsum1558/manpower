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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Profile</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Super Info Update</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Super Profile Information Update</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Update Personal Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <form action="{{ route('super.profile.infoUpdate') }}" class="form-group" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Full Name <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="text" name="fullname" class="form-control d-inline-block inline_setup" value="{{ $superData->fullname }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Designation <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="text" name="designation" class="form-control d-inline-block inline_setup" value="{{ $superData->designation }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Phone <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="text" name="phone" class="form-control d-inline-block inline_setup" value="{{ $superData->phone }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Super Level <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="text" name="type" class="form-control d-inline-block inline_setup" value="{{ $superData->type }}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Address <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="text" name="address" class="form-control d-inline-block inline_setup" value="{{ $superData->address }}">
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ $superData->dateOfBirth }}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                <select id="select" name="gender" class="form-control d-inline-block inline_setup">
                                  <option>Select Gender</option>
                        @if($superData->gender == 1)
                                  <option selected="selected" value="1">Male</option>
                                  <option value="2">Female</option>
                                  <option value="3">Other</option>
                          @elseif($superData->gender == 2)
                                  <option selected="selected" value="2">Female</option>
                                  <option value="1">Male</option>
                                  <option value="3">Other</option>
                           @else
                                  <option selected="selected" value="3">Other</option>
                                  <option value="1">Male</option>
                                  <option value="2">Female</option>
                          @endif
                                </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Description <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><input type="text" name="description" class="form-control d-inline-block inline_setup" value="{{ $superData->description }}">
                                {{-- <div class="col-9">
                                    <textarea class="summernote" name="description">{{ $superData->description }}</textarea>
                                    
                                </div> --}}
                            </div>
                        </div>
                    </div>
                        <div class="row mb-2">
                            <div class="col-3"></div>
                            <div class="col-9 mybtn">
                                <button type="submit" name="updateInfo" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.profile') }}">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection