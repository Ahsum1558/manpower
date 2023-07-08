@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Support Agent</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Support Agent Info</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.favor.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Support Agent</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All Support Agent Info</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Support Agent Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Serial</th>
                              <th>Book Ref</th>
                              <th>Name</th>
                              <th>Office</th>
                              <th>Office Loation</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_favor as $favor)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $favor->favorsl }}</td>
                            <td>{{ $favor->favorbook }}</td>
                            <td>{{ $favor->favorname }}</td>
                            <td>{{ $favor->favor_office .' - '. $favor->favor_license }}</td>
                            <td>{{ $favor->office_address }}</td>
                            <td>
                              @if($favor->status == 1)
                                {{ __('Active') }}
                                @elseif($favor->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('admin.favor.show', ['id'=>$favor->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                            @if($favor->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $favor->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inctive</span></a>
                            @elseif($favor->status == 0)
                              <a class="edit_option" href="#activeId{{ $favor->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                            @if(Auth::check() && (Auth::user()->role == 'admin'))
                              <a class="delete_option" href="#delFavor{{ $favor->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete</span></a>
                            @endif
                            </td>
                @include('admin.client.favor.favor_modal')
                @include('admin.client.favor.favor_active')
                @include('admin.client.favor.favor_inactive')
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