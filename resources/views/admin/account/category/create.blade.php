@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Account Category</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Account Category</h4>
            </div>
            <div class="card-body">
@include('admin.includes.alert')
                <form action="{{ route('admin.category.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Category Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="category" class="form-control d-inline-block inline_setup" placeholder="Enter Category Name" value="{{ old('category') }}">
                            </div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Type<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="categoryType" name="type" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Type</option>
                                  <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income</option>
                                  <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Expense</option>
                                  <option value="assets" {{ old('type') == 'assets' ? 'selected' : '' }}>Assets</option>
                                  <option value="liabilities" {{ old('type') == 'liabilities' ? 'selected' : '' }}>Liabilities</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Value<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="officialValue" name="official" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Value</option>
                                  <option value="1" {{ old('official') == 1 ? 'selected' : '' }}>Official</option>
                                  <option value="2" {{ old('official') == 2 ? 'selected' : '' }}>Normal</option>
                            </select>
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
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.category') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection