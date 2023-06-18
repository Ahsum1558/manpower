@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Customer</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                @php
                    $get_numbers = 1;
                @endphp

                @foreach($customer_data as $customer)
                    @php
                        $mreceipt = $customer['customersl'];
                        $customerSerial = $mreceipt ? "CUS" . str_pad(++$get_numbers, 5, '0', STR_PAD_LEFT) : "CUS00001";
                    @endphp

                    <input type="hidden" name="customersl" value="{{ $customerSerial }}">
                @endforeach
                
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Book Ref.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="bookRef" class="form-control d-inline-block inline_setup" placeholder="Enter Customer Book Ref.">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">First Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="cusFname" class="form-control d-inline-block inline_setup" placeholder="Enter First Name">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Last Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="cusLname" class="form-control d-inline-block inline_setup" placeholder="Enter Last Name">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="gender" name="gender" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Gender</option>
                                  <option value="1">Male</option>
                                  <option value="2">Female</option>
                                  <option value="3">Other</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="passportNo" class="form-control d-inline-block inline_setup" placeholder="Enter Passport Number">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Customer Phone No.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="phone" class="form-control d-inline-block inline_setup" placeholder="Enter Customer Phone No.">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Delegate<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="agentId" class="form-control d-inline-block inline_setup disabling-options">
                                  <option selected="selected">Select Delegate</option>
                                @foreach($all_delegate as $delegate)
                                  <option value="{{ $delegate->id }}">{{ $delegate->agentname .' - '. $delegate->agentsl }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Birth of Place<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="id_label_single" name="birthPlace" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                  <option selected="selected">Select Birth of Place</option>
                                  @foreach($all_district as $district)
                                  <option value="{{ $district->id }}">{{ $district->districtname }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Medical <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="medical" name="medical" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Medical</option>
                                  <option value="1">Done</option>
                                  <option value="2">Fit</option>
                                  <option value="3">Unfit</option>
                                  <option value="4">N/A</option>
                                  <option value="5">Problem</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Passport Receive Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="received" class="form-control d-inline-block inline_setup">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Trade <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="single-select" name="tradeId" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Trade</option>
                                  @foreach($all_visa_trade as $trade)
                                  <option value="{{ $trade->id }}">{{ $trade->visatrade_name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Type</option>
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="add" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection