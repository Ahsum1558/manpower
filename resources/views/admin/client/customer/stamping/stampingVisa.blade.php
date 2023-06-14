@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Stamping Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Add Stamping Info for <strong>{{ $data_stamped_customer->cusFname .' '. $data_stamped_customer->cusLname }}</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.storeStampingVisa', ['id'=>$data_stamped_customer->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Stamped Visa Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="stamped_visano" class="form-control d-inline-block inline_setup" placeholder="Enter Stamped Visa Number">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Issue Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="visa_issue" class="form-control d-inline-block inline_setup">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Visa Expiry Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="visa_expiry" class="form-control d-inline-block inline_setup">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Stay Duration<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="stay_duration" class="form-control d-inline-block inline_setup" placeholder="Enter Stay Duration">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$data_stamped_customer->id]) }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection