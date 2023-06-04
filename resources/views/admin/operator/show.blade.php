@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">All Operator</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Operator Details</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Operator Info Details of <strong>{{ $single_user->name }}</strong></h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Operator Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-3 ">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img class="img-fluid img_user rounded-circle" src="{{ (!empty($single_user->photo)) ? url('public/admin/uploads/user/'.$single_user->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-sm-12">
                            <div class="profile-personal-info">
                            
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Full Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_user->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Username<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_user->username }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Contact Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_user->phone }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Designation<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_user->designation }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_user->email }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_user->address }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Date Of Birth <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_user->dateOfBirth)) }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_user->gender == 1)
                                        {{ __('Male') }}
                                        @elseif($single_user->gender == 2)
                                        {{ __('Female') }}
                                        @else
                                        {{ __('Other') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_user->description }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Level<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_user->role == 'admin')
                                            {{ __('Admin') }}
                                            @elseif($single_user->role == 'author')
                                            {{ __('Author') }}
                                            @elseif($single_user->role == 'editor')
                                            {{ __('Editor') }}
                                            @elseif($single_user->role == 'contributor')
                                            {{ __('Contributor') }}
                                            @elseif($single_user->role == 'user')
                                            {{ __('User') }}
                                          @endif
                                    </span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_user->status == 'active')
                                            {{ __('Active') }}
                                            @elseif($single_user->status == 'inactive')
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_user->created_at)) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                @if(Auth::user()->role == 'admin' && Auth::user()->id !== $single_user->id)
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.operator.edit', ['id'=>$single_user->id]) }}">Update Info</a>
                @endif
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.operator') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection