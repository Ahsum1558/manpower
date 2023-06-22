@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">All Operator</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Create New Operator</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.operator.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                     @csrf
                    <div class="profile-personal-info">
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Username<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="username" class="form-control d-inline-block inline_setup" placeholder="Enter Username" value="{{ old('username') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Full Name<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="name" class="form-control d-inline-block inline_setup" placeholder="Enter Full Name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Designation<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="designation" class="form-control d-inline-block inline_setup" placeholder="Enter Designation" value="{{ old('designation') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="email" class="form-control d-inline-block inline_setup" placeholder="Enter E-Mail Address" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Contact Number<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="phone" class="form-control d-inline-block inline_setup" placeholder="Enter Contact Number" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="gender" class="form-control d-inline-block inline_setup">
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
                                <h5 class="f-w-500">Password<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="password" class="form-control d-inline-block inline_setup" placeholder="Enter Password" value="{{ old('password') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Confirm Password<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9"><input type="text" name="password_confirmation" class="form-control d-inline-block inline_setup" placeholder="Enter Confirm Password" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">User Role<span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="role" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Role</option>
                                  <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                  <option value="author" {{ old('role') == 'author' ? 'selected' : '' }}>Author</option>
                                  <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                                  <option value="contributor" {{ old('role') == 'contributor' ? 'selected' : '' }}>Contributor</option>
                                  <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                            </div>
                            <div class="col-9">
                                <select id="select" name="status" class="form-control d-inline-block inline_setup">
                                  <option selected="selected">Select Type</option>
                                  <option value="active">Active</option>
                                  <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="row mb-2">
                        <div class="col-3"></div>
                        <div class="col-9 mybtn">
                            <button type="submit" name="addUser" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                            <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator') }}">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection