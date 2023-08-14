@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Account Category</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.category.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Category</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Account Category Info</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Account Category Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Category</th>
                              <th>Type</th>
                              <th>Value</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_category as $categories)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $categories->category }}</td>
                            <td>
                              @if($categories->type == 'income')
                                {{ __('Income') }}
                                @elseif($categories->type == 'expense')
                                {{ __('Expense') }}
                                @elseif($categories->type == 'assets')
                                {{ __('Assets') }}
                                @elseif($categories->type == 'liabilities')
                                {{ __('Liabilities') }}
                              @endif
                            </td>
                            <td>
                              @if($categories->official == 1)
                                {{ __('Official') }}
                                @elseif($categories->official == 2)
                                {{ __('Normal') }}
                              @endif
                            </td>
                            <td>
                              @if($categories->status == 1)
                                {{ __('Active') }}
                                @elseif($categories->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.category.show', ['id'=>$categories->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($categories->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $categories->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($categories->status == 0)
                              <a class="edit_option" href="#activeId{{ $categories->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                            @if(Auth::check() && (Auth::user()->role == 'admin'))
                              <a class="delete_option" href="#delCategory{{ $categories->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                            @endif
                            </td>
            @include('admin.account.category.category_modal')
            @include('admin.account.category.category_active')
            @include('admin.account.category.category_inactive')
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