@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Setup</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Travel Meta</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Travel Meta</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.travelmeta.update', ['id'=>$travelmeta_data->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="title" class="form-control d-inline-block inline_setup" value="{{ $travelmeta_data->title }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Meta Title<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="meta_title" class="form-control d-inline-block inline_setup" value="{{ $travelmeta_data->meta_title }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="description" class="form-control d-inline-block inline_setup" value="{{ $travelmeta_data->description }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Meta Description<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="meta_description" class="form-control d-inline-block inline_setup" value="{{ $travelmeta_data->meta_description }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">URL<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="url" class="form-control d-inline-block inline_setup" value="{{ $travelmeta_data->url }}"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Meta Keywords<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><span><input type="text" name="meta_keywords" class="form-control d-inline-block inline_setup" value="{{ $travelmeta_data->meta_keywords }}"></span>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="select" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($travelmeta_data->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($travelmeta_data->status == 0)
                                      <option selected="selected" value="0">Inactive</option>
                                      <option value="1">Active</option>
                              @endif
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="updateMeta" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.travelmeta') }}">Back</a>
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