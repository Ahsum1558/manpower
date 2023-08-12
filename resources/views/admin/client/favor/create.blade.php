@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Support Agent</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Support Agent Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Support Agent</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.favor.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                @php
                    $get_numbers = 1;
                @endphp

                @foreach($favor_data as $favor)
                    @php
                        $mreceipt = $favor['favorsl'];
                        $agentSerial = $mreceipt ? "FAV" . str_pad(++$get_numbers, 5, '0', STR_PAD_LEFT) : "FAV00001";
                    @endphp

                    <input type="hidden" name="favorsl" value="{{ $agentSerial }}">
                @endforeach

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent Book Ref.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="favorbook" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent Book Ref." value="{{ old('favorbook') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="favorname" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent Name" value="{{ old('favorname') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent Referance Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="father" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent Referance Name" value="{{ old('father') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent NID No.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="nid" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent NID No." value="{{ old('nid') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent Office Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="favor_office" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent Office Name" value="{{ old('favor_office') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent Office License<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="favor_license" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent Office License Number" value="{{ old('favor_license') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent Office Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="office_address" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent Office Address" value="{{ old('office_address') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent Phone No.<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="phone" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent Phone No." value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent E-Mail Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="email" class="form-control d-inline-block inline_setup" placeholder="Enter Support Agent E-Mail Address" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Support Agent Date Of Birth<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="dateOfBirth" class="form-control d-inline-block inline_setup" value="{{ old('dateOfBirth') }}" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="gender" name="gender" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Gender</option>
                                  <option selected="selected">Select Gender</option>
                                  <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Male</option>
                                  <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Female</option>
                                  <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>Other</option>
                            </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Account No. <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="accountNo" class="form-control d-inline-block inline_setup" placeholder="Enter Account No." value="{{ old('accountNo') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="bankname" class="form-control d-inline-block inline_setup" placeholder="Enter Bank Name" value="{{ old('bankname') }}">
                            </div>
                        </div>
                         <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Branch Location<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="bankbranch" class="form-control d-inline-block inline_setup" placeholder="Enter Bank Branch Location" value="{{ old('bankbranch') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="address" class="form-control d-inline-block inline_setup" placeholder="Enter Address" value="{{ old('address') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Country Name<span class="pull-right">:</span></h5>
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
                                <h5 class="f-w-500">Division <span class="pull-right">:</span></h5>
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
                                <h5 class="f-w-500">Police Station<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="upzilaselect" class="form-control d-inline-block inline_setup default-placeholder" name="policestationId">
                                    <option>Select Police Station</option>
                                </select>                        
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">City<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="cityselect" class="form-control d-inline-block inline_setup select2-width-50" name="cityId">
                                    <option>Select City</option>
                                </select>                        
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Zipcode<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="zipcode" class="form-control d-inline-block inline_setup" placeholder="Enter Zipcode" value="{{ old('zipcode') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="description" class="form-control d-inline-block inline_setup" placeholder="Enter Description" value="{{ old('description') }}">
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
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.favor') }}">Back</a>
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
                $.get("{{ route('admin.favor.get') }}", {country_id:countryId}, function(data){
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
                $.get("{{ route('admin.favor.getDistrict') }}", {division_id:divisionId, country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#id_label_single').empty().html(data);
                });
            }else{
                $('#id_label_single').empty().html('<option value="">Select District</option>');
            }
        });

        $('#id_label_single').change(function() {
            var districtId = $(this).val();
            var divisionId = $('#single-select').val();
            var countryId = $('#select').val();
            if(districtId && divisionId && countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.favor.getCity') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#cityselect').empty().html(data);
                });
            }else{
                $('#cityselect').empty().html('<option value="">Select City</option>');
            }
        });

        $('#id_label_single').change(function() {
            var districtId = $(this).val();
            var divisionId = $('#single-select').val();
            var countryId = $('#select').val();
            if(districtId && divisionId && countryId){
                $('#overlay .loader').show();
                $.get("{{ route('admin.favor.getUpzila') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
                    $('#overlay .loader').hide();
                    console.log(data);
                    $('#upzilaselect').empty().html(data);
                });
            }else{
                $('#upzilaselect').empty().html('<option value="">Select Police Station</option>');
            }
        });

    });
</script>
@endsection