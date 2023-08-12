@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Bank</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Bank Account</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Bank Account</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.bank.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                    @php
                        $get_numbers = 1;
                    @endphp
                    @foreach($bankaccount_data as $bankaccount)
                        @php
                            $banksl = $bankaccount['accountsl'];
                            $bankSerial = $banksl ? "BANK" . str_pad(++$get_numbers, 5, '0', STR_PAD_LEFT) : "BANK00001";
                        @endphp
                        <input type="hidden" name="accountsl" value="{{ $bankSerial }}">
                    @endforeach

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Account Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="account_number" class="form-control d-inline-block inline_setup" placeholder="Enter Account Number" value="{{ old('account_number') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="bank_name" class="form-control d-inline-block inline_setup" placeholder="Enter Bank Name" value="{{ old('bank_name') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Account Holder<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="account_holder" class="form-control d-inline-block inline_setup" placeholder="Enter Account Holder Name" value="{{ old('account_holder') }}">
                            </div>
                        </div>                        
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Account Type<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="accountType" name="account_type" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Account Type</option>
                                  <option value="1" {{ old('account_type') == 1 ? 'selected' : '' }}>Current Account</option>
                                  <option value="2" {{ old('account_type') == 2 ? 'selected' : '' }}>Saving Account</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Account Signatory<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="signatory" class="form-control d-inline-block inline_setup" placeholder="Enter Account Signatory" value="{{ old('signatory') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Nominee<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="nominee" class="form-control d-inline-block inline_setup" placeholder="Enter Nominee Name" value="{{ old('nominee') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Mobile Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="mobile" class="form-control d-inline-block inline_setup" placeholder="Enter Holder Mobile Number" value="{{ old('mobile') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="email" class="form-control d-inline-block inline_setup" placeholder="Enter Holder E-Mail Address" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Branch<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="branch" class="form-control d-inline-block inline_setup" placeholder="Enter Branch Location" value="{{ old('branch') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Country<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="countryId" class="form-control d-inline-block inline_setup disabling-options">
                                  <option selected="selected">Select Country</option>
                                @foreach($all_country as $country)
                                  <option value="{{ $country->id }}" {{ old('countryId') == $country->id ? 'selected' : '' }}>{{ $country->countryname }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Division<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="single-select" name="divisionId" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Division</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">District<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="id_label_single" name="districtId" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                  <option selected="selected">Select District</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Starting Balance<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="pre_balance" class="form-control d-inline-block inline_setup" placeholder="Enter Starting Balance" value="{{ old('pre_balance') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Status</option>
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
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.bank') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.includes.loader')
<style>#overlay .loader{display: none;} </style>
<script>
    $(document).ready(function(){
        $('#select').change(function() {
            var countryId = $(this).val();
            if(countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.bank.getDivision') }}", {country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#single-select').empty().html(data);
                });
            }else{
                $('#single-select').empty().html('<option value="">Select Division</option>');
            }
        });

        $('#single-select').change(function() {
            var divisionId = $(this).val();
            var countryId = $('#select').val();
            if(divisionId && countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.bank.getDistrict') }}", {division_id:divisionId, country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#id_label_single').empty().html(data);
                });
            }else{
                $('#id_label_single').empty().html('<option value="">Select District</option>');
            }
        });
    });
</script>
@endsection