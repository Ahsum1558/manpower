@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Bank</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Bank Account</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Details</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Bank Account Details of <strong>{{ $single_bankaccount[0]->account_number }}</strong></h4>
            </div>
            <div class="card-body">
                <h4 class="mb-4 basic_headline">Bank Account Info</h4>
                <div class="profile-uoloaded-post border-bottom-1 pb-5">
                    <div class="row">
                        <div class="col-xl-3 ">
                        <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                    <img class="img-fluid img_user rounded-circle" src="{{ (!empty($single_bankaccount[0]->holder_img)) ? url('public/admin/uploads/bank/'.$single_bankaccount[0]->holder_img) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-sm-12">
                            <div class="profile-personal-info">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Account Serial<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->accountsl }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Account Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->account_number }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->bank_name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Account Holder<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->account_holder }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Account Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_bankaccount[0]->account_type == 1)
                                            {{ __('Current Account') }}
                                            @elseif($single_bankaccount[0]->account_type == 2)
                                            {{ __('Saving Account') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Account Signatory<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->signatory }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Nominee<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->nominee }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Mobile Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->mobile }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->email }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Branch Location<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->branch }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">District<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->districtname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Division<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->divisionname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Country<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->countryname }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Starting Balance<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ $single_bankaccount[0]->pre_balance }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>
                                        @if($single_bankaccount[0]->status == 1)
                                            {{ __('Active') }}
                                            @elseif($single_bankaccount[0]->status == 0)
                                            {{ __('Inactive') }}
                                        @endif
                                    </span>
                                    </div>
                                </div>
                               
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span>{{ date('d-M-Y', strtotime($single_bankaccount[0]->created_at)) }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mybtn">
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.bank.edit', ['id'=>$single_bankaccount[0]->id]) }}">Update</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.bank.editAccount', ['id'=>$single_bankaccount[0]->id]) }}">Update Account</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.bank.editImage', ['id'=>$single_bankaccount[0]->id]) }}">Update Holder Image</a>
                    <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.bank') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection