@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Site Option</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Option in Arabic</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Site Option</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Arabic Site Option Info</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.fieldar.update', ['id'=>$fieldar_data->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="description_ar" class="form-control d-inline-block inline_setup" value="{{ $fieldar_data->description_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Office Location<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="address_ar" class="form-control d-inline-block inline_setup" value="{{ $fieldar_data->address_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="proprietor_ar" class="form-control d-inline-block inline_setup" value="{{ $fieldar_data->proprietor_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Proprietor Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="proprietortitle_ar" class="form-control d-inline-block inline_setup" value="{{ $fieldar_data->proprietortitle_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Telephone Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="telephone_ar" class="form-control d-inline-block inline_setup" value="{{ $fieldar_data->telephone_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Cellphone Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="cellphone_ar" class="form-control d-inline-block inline_setup" value="{{ $fieldar_data->cellphone_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Helpline Number<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="helpline_ar" class="form-control d-inline-block inline_setup" value="{{ $fieldar_data->helpline_ar }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="select" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($fieldar_data->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($fieldar_data->status == 0)
                                      <option selected="selected" value="0">Inactive</option>
                                      <option value="1">Active</option>
                              @endif
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="updateOption" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.fieldar.show', ['id'=>$fieldar_data->id]) }}">Back</a>
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