@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All Operator</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
  <a href="{{ route('admin.operator.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Operator</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Operators For Users</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">All Operator</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>E-Mail</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_adminuser as $admin_user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $admin_user->name }}</td>
                            <td>{{ $admin_user->username }}</td>
                            <td>{{ $admin_user->email }}</td>
                            <td>
                              @if($admin_user->role == 'admin')
                                {{ __('Admin') }}
                                @elseif($admin_user->role == 'author')
                                {{ __('Author') }}
                                @elseif($admin_user->role == 'editor')
                                {{ __('Editor') }}
                                @elseif($admin_user->role == 'contributor')
                                {{ __('Contributor') }}
                                @elseif($admin_user->role == 'user')
                                {{ __('User') }}
                              @endif
                            </td>
                            <td>
                              @if($admin_user->status == 'active')
                                {{ __('Active') }}
                                @elseif($admin_user->status == 'inactive')
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.operator.show', ['id'=>$admin_user->id]) }}"><i class="fas fa-eye"></i><span>View Operator</span></a>
                          @if(Auth::user()->role == 'admin' && Auth::user()->id !== $admin_user->id)
                            @if($admin_user->status == 'active')
                              <a class="edit_option bg-warning" href="#inActiveId{{ $admin_user->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($admin_user->status == 'inactive')
                              <a class="edit_option bg-success" href="#activeId{{ $admin_user->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delOperator{{ $admin_user->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Operator</span></a>
                          @endif
                            </td>
                @include('admin.operator.users_modal')
                @include('admin.operator.users_inactive')
                @include('admin.operator.users_active')
                        </tr>
                @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection