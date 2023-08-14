@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Bank</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Bank Account</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.bank.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Bank Account</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Bank Account Info</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Bank Account Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Serial</th>
                              <th>Account No.</th>
                              <th>Type</th>
                              <th>Bank</th>
                              <th>Holder</th>
                              <th>Branch</th>
                              <th>District</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_bankaccount as $bankaccount)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $bankaccount->accountsl }}</td>
                            <td>{{ $bankaccount->account_number }}</td>
                            <td>
                              @if($bankaccount->account_type == 1)
                                {{ __('Current Account') }}
                                @elseif($bankaccount->account_type == 2)
                                {{ __('Saving Account') }}
                              @endif
                            </td>
                            <td>{{ $bankaccount->bank_name }}</td>
                            <td>{{ $bankaccount->account_holder }}</td>
                            <td>{{ $bankaccount->branch }}</td>
                            <td>{{ $bankaccount->districtname }}</td>
                            <td>
                              @if($bankaccount->status == 1)
                                {{ __('Active') }}
                                @elseif($bankaccount->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.bank.show', ['id'=>$bankaccount->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($bankaccount->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $bankaccount->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($bankaccount->status == 0)
                              <a class="edit_option" href="#activeId{{ $bankaccount->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                            @if(Auth::check() && (Auth::user()->role == 'admin'))
                              <a class="delete_option" href="#delBank{{ $bankaccount->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                            @endif
                            </td>
            @include('admin.account.bank.bank_modal')
            @include('admin.account.bank.bank_active')
            @include('admin.account.bank.bank_inactive')
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