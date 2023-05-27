@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">All Operator</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Update Operator</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card_line">
            <div class="card-header card_headline">
                <h4 class="card-title headline">Update Operator Info</h4>
            </div>
            <div class="card-body">
@include('super.includes.alert')
                <form action="{{ route('super.operator.update', ['id'=>$user_info->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <!--Tab slider End-->
                    <div class="col">
                        <div class="product-detail-content">
                            <!--Product details-->
                            <div class="new-arrival-content pr">
                                <div class="row mb-2">
                                    <div class="col-3">
                                        <h5 class="f-w-500">User Level<span class="pull-right">:</span></h5>
                                    </div>
                                    <div class="col-9">
                                    <select id="select" name="role" class="form-control d-inline-block inline_setup">
                                      <option>Select Level</option>
                            @if($user_info->role == 'admin')
                                      <option selected="selected" value="admin">Admin</option>
                                      <option value="author">Author</option>
                                      <option value="editor">Editor</option>
                                      <option value="contributor">Contributor</option>
                                      <option value="user">User</option>
                            @elseif($user_info->role == 'author')
                                      <option selected="selected" value="author">Author</option>
                                      <option value="admin">Admin</option>
                                      <option value="editor">Editor</option>
                                      <option value="contributor">Contributor</option>
                                      <option value="user">User</option>
                            @elseif($user_info->role == 'editor')
                                      <option selected="selected" value="editor">Editor</option>
                                      <option value="admin">Admin</option>
                                      <option value="author">Author</option>
                                      <option value="contributor">Contributor</option>
                                      <option value="user">User</option>
                            @elseif($user_info->role == 'contributor')
                                      <option selected="selected" value="contributor">Contributor</option>
                                      <option value="admin">Admin</option>
                                      <option value="author">Author</option>
                                      <option value="editor">Editor</option>
                                      <option value="user">User</option>
                            @elseif($user_info->role == 'user')
                                      <option selected="selected" value="user">User</option>
                                      <option value="admin">Admin</option>
                                      <option value="author">Author</option>
                                      <option value="editor">Editor</option>
                                      <option value="contributor">Contributor</option>
                            @endif
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
                            @if($user_info->status == 'active')
                                      <option selected="selected" value="active">Active</option>
                                      <option value="inactive">Inactive</option>
                              @elseif($user_info->status == 'inactive')
                                      <option selected="selected" value="inactive">Inactive</option>
                                      <option value="active">Active</option>
                              @endif
                                    </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="col-9 mybtn">
                                        <button type="submit" name="updateOperator" class="form-control inline_setup btn submitbtn text-uppercase">Update</button>
                                        <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('super.operator.show', ['id'=>$user_info->id]) }}">Back</a>
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