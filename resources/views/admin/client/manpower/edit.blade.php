@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manpower Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Info</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Info of <strong>{{ date('d-M-Y', strtotime($manpower_info->manpowerDate)) }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.manpower.update', ['id'=>$manpower_info->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="id_label_single" name="fieldId" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                          <option selected="selected">Select Office Name</option>
                                        @foreach($all_field as $field)
                                            <option value="{{ $field->id }}" {{ $manpower_info->fieldId == $field->id ? 'selected' : '' }}>{{ $field->title.' - '.$field->license }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Name Arabic<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="fieldar" class="form-control d-inline-block inline_setup default-placeholder" name="fieldarId">
                                            <option>Select Office Name Arabic</option>
                                        @foreach($all_fieldar as $fieldar)
                                            <option value="{{ $fieldar->id }}" {{ $manpower_info->fieldarId == $fieldar->id ? 'selected' : '' }}>{{ $fieldar->title_ar.' - '.$fieldar->license_ar }}</option>
                                        @endforeach
                                        </select>                        
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Name Bengali<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                        <select id="fieldbn" class="form-control d-inline-block inline_setup dropdown-groups" name="fieldbnId">
                                            <option>Select Office Name Bengali</option>
                                        @foreach($all_fieldbn as $fieldbn)
                                            <option value="{{ $fieldbn->id }}" {{ $manpower_info->fieldbnId == $fieldbn->id ? 'selected' : '' }}>{{ $fieldbn->title_bn.' - '.$fieldbn->license_bn }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="select" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($manpower_info->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($manpower_info->status == 0)
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
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.manpower.show', ['id'=>$manpower_info->id]) }}">Back</a>
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