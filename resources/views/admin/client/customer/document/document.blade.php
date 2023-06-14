@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Documents</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Add Documents Info for <strong>{{ $customer_docs->cusFname .' '. $customer_docs->cusLname }}</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.storeDocuments', ['id'=>$customer_docs->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Police Clearance Certificate <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="pc" class="form-control d-inline-block inline_setup" placeholder="Enter Police Clearance Certificate Info">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">License <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="license" class="form-control d-inline-block inline_setup" placeholder="Enter Driving License">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Training Certificate <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="tc" name="tc" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Type</option>
                                  <option value="1">Done</option>
                                  <option value="2">Received</option>
                                  <option value="3">N/A</option>
                                  <option value="4">Return Back</option>
                                  <option value="5">Problem</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Certificate<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="certificate" name="certificate" class="form-control d-inline-block inline_setup">
                                    <option selected="selected">Select Certificate</option>
                                    <option value="1">Done</option>
                                    <option value="2">Received</option>
                                    <option value="3">N/A</option>
                                    <option value="4">Return Back</option>
                                    <option value="5">Problem</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Musaned<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="musaned" class="form-control d-inline-block inline_setup" placeholder="Enter Musaned Info">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Finger<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="finger" name="finger" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Finger</option>
                                  <option value="1">Done</option>
                                  <option value="2">Completed</option>
                                  <option value="3">N/A</option>
                                  <option value="4">Problem</option>
                            </select>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$customer_docs->id]) }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection