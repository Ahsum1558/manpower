@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Visa Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Visa Info Details of {{ $single_visa->visano_en }}</h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Visa Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        
                        <div class="col-xl-12 col-sm-12">
                            <div class="profile-personal-info">
                            
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa No in English<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->visano_en }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa No in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->visano_ar }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Sponsor Id in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->sponsorid_en }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Sponsor Id in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->sponsorid_ar }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Sponsor Name in English<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->sponsorname_en }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Sponsor Name in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->sponsorname_ar }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa Date in Hijri<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->visa_date }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->visa_address }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Occupation in English<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->occupation_en }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Occupation in Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->occupation_ar }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa Delegation/ Wakaalah No.<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->delegation_no }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa Delegation/ Wakaalah Date<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_visa->delegation_date)) }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Total Delegated Visa<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->delegated_visa }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Visa Duration<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_visa->visa_duration }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_visa->status == 1)
                                            {{ __('Active') }}
                                            @elseif($single_visa->status == 0)
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                               
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_visa->created_at)) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.visa.edit', ['id'=>$single_visa->id]) }}">Update</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.visa.editVisa', ['id'=>$single_visa->id]) }}">Update Visa No.</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.visa.editDelegation', ['id'=>$single_visa->id]) }}">Update Visa Delegation No.</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.visa') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection