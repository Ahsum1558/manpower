@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Customer</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Submission Info</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Submission</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.submission.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
               
                       
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="fieldId" class="form-control d-inline-block inline_setup disabling-options">
                                  <option selected="selected">Select Office Name</option>
                                @foreach($all_field as $field)
                                  <option value="{{ $field->id }}">{{ $field->title.' - '.$field->license }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Office Name Arabic<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="id_label_single" name="fieldarId" class="form-control d-inline-block inline_setup select2-with-label-single js-states">
                                  <option selected="selected">Select Office Name Arabic</option>
                                  @foreach($all_fieldar as $fieldar)
                                  <option value="{{ $fieldar->id }}">{{ $fieldar->title_ar.' - '.$fieldar->license_ar }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Office Name Bengali<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="single-select" name="fieldbnId" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Office Name Bengali</option>
                                @foreach($all_fieldbn as $fieldbn)
                                  <option value="{{ $fieldbn->id }}">{{ $fieldbn->title_bn.' - '.$fieldbn->license_bn }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Submission Date<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="date" name="submissionDate" class="form-control d-inline-block inline_setup">
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
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.submission') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection