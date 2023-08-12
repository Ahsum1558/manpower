@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Bank</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Bank Account</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Account</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Bank Account of <strong>{{ $bankaccount_info->account_number }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.bank.updateAccount', ['id'=>$bankaccount_info->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Account Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="account_number" class="form-control d-inline-block inline_setup" value="{{ $bankaccount_info->account_number }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="bank_name" class="form-control d-inline-block inline_setup" value="{{ $bankaccount_info->bank_name }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Account Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="accountType" name="account_type" class="form-control d-inline-block inline_setup">
                                      <option>Select Account Type</option>
                            @if($bankaccount_info->account_type == 1)
                                      <option selected="selected" value="1">Current Account</option>
                                      <option value="2">Saving Account</option>
                              @elseif($bankaccount_info->account_type == 2)
                                      <option selected="selected" value="2">Saving Account</option>
                                      <option value="1">Current Account</option>
                              @endif
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="update" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.bank.show', ['id'=>$bankaccount_info->id]) }}">Back</a>
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