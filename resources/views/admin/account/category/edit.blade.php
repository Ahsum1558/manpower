@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Account Category</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Info of <strong>{{ $category_info->category }}</strong></h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.category.update', ['id'=>$category_info->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Category Name<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9"><input type="text" name="category" class="form-control d-inline-block inline_setup" value="{{ $category_info->category }}">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Type<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="categoryType" name="type" class="form-control d-inline-block inline_setup">
                                      <option>Select Type</option>
                            @if($category_info->type == 'income')
                                      <option selected="selected" value="income">Income</option>
                                      <option value="expense">Expense</option>
                                      <option value="assets">Assets</option>
                                      <option value="liabilities">Liabilities</option>
                            @elseif($category_info->type == 'expense')
                                      <option selected="selected" value="expense">Expense</option>
                                      <option value="income">Income</option>
                                      <option value="assets">Assets</option>
                                      <option value="liabilities">Liabilities</option>
                            @elseif($category_info->type == 'assets')
                                      <option selected="selected" value="assets">Assets</option>
                                      <option value="income">Income</option>
                                      <option value="expense">Expense</option>
                                      <option value="liabilities">Liabilities</option>
                            @elseif($category_info->type == 'liabilities')
                                      <option selected="selected" value="liabilities">Liabilities</option>
                                      <option value="income">Income</option>
                                      <option value="expense">Expense</option>
                                      <option value="assets">Assets</option>
                            @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Value<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="officialValue" name="official" class="form-control d-inline-block inline_setup">
                                      <option>Select Value</option>
                            @if($category_info->official == 1)
                                      <option selected="selected" value="1">Official</option>
                                      <option value="2">Normal</option>
                              @elseif($category_info->official == 2)
                                      <option selected="selected" value="2">Normal</option>
                                      <option value="1">Official</option>
                              @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="status" name="status" class="form-control d-inline-block inline_setup">
                                      <option>Select Status</option>
                            @if($category_info->status == 1)
                                      <option selected="selected" value="1">Active</option>
                                      <option value="0">Inactive</option>
                              @elseif($category_info->status == 0)
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
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.category.show', ['id'=>$category_info->id]) }}">Back</a>
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