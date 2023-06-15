@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Info of <strong>{{ $customer_data_info[0]->cusFname .' '. $customer_data_info[0]->cusLname }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.customer.update', ['id'=>$customer_data_info[0]->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">First Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="cusFname" class="form-control d-inline-block inline_setup" value="{{ $customer_data_info[0]->cusFname }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Last Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="cusLname" class="form-control d-inline-block inline_setup" value="{{ $customer_data_info[0]->cusLname }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Gender<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="gender" name="gender" class="form-control d-inline-block inline_setup">
                                      <option>Select Gender</option>
                            @if($customer_data_info[0]->gender == 1)
                                      <option selected="selected" value="1">Male</option>
                                      <option value="2">Female</option>
                                      <option value="3">Other</option>
                              @elseif($customer_data_info[0]->gender == 2)
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
                                        <h5 class="f-w-500">Phone <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="phone" class="form-control d-inline-block inline_setup" value="{{ $customer_data_info[0]->phone }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Delegate Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="select" name="agentId" class="form-control d-inline-block inline_setup disabling-options">
                                      <option>Select Delegate</option>
                                    @foreach($all_delegate as $delegate)
                                      <option value="{{ $delegate->id }}" {{ $customer_data_info[0]->agentId == $delegate->id ? 'selected' : '' }}>{{ $delegate->agentname .' - '. $delegate->agentsl }}</option>
                                    @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Birth of Place<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="single-select" name="birthPlace" class="form-control d-inline-block inline_setup">
                                          <option selected="selected">Select Birth of Place</option>
                                    @foreach($all_district as $district)
                                      <option value="{{ $district->id }}" {{ $customer_data_info[0]->birthPlace == $district->id ? 'selected' : '' }}>{{ $district->districtname }}</option>
                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Trade<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="id_label_single" name="tradeId" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                          <option selected="selected">Select Trade</option>
                                    @foreach($all_visa_trade as $trade)
                                      <option value="{{ $trade->id }}" {{ $customer_data_info[0]->tradeId == $trade->id ? 'selected' : '' }}>{{ $trade->visatrade_name }}</option>
                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Medical<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="medical" name="medical" class="form-control d-inline-block inline_setup">
                                      <option>Select Medical</option>
                            @if($customer_data_info[0]->medical == 1)
                                      <option selected="selected" value="1">Done</option>
                                      <option value="2">Fit</option>
                                      <option value="3">Unfit</option>
                                      <option value="4">N/A</option>
                                      <option value="5">Problem</option>
                            @elseif($customer_data_info[0]->medical == 2)
                                      <option selected="selected" value="2">Fit</option>
                                      <option value="1">Done</option>
                                      <option value="3">Unfit</option>
                                      <option value="4">N/A</option>
                                      <option value="5">Problem</option>
                            @elseif($customer_data_info[0]->medical == 3)
                                      <option selected="selected" value="3">Unfit</option>
                                      <option value="1">Done</option>
                                      <option value="2">Fit</option>
                                      <option value="4">N/A</option>
                                      <option value="5">Problem</option>
                            @elseif($customer_data_info[0]->medical == 4)
                                      <option selected="selected" value="4">N/A</option>
                                      <option value="1">Done</option>
                                      <option value="2">Fit</option>
                                      <option value="3">Unfit</option>
                                      <option value="5">Problem</option>
                            @else
                                      <option selected="selected" value="5">Problem</option>
                                      <option value="1">Done</option>
                                      <option value="2">Fit</option>
                                      <option value="3">Unfit</option>
                                      <option value="4">N/A</option>
                            @endif
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($customer_data_info[0]->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($customer_data_info[0]->status == 0)
                                      <option selected="selected" value="0">Inactive</option>
                                      <option value="1">Active</option>
                              @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer.show', ['id'=>$customer_data_info[0]->id]) }}">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection