@extends('super.home')

@section('super-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Setup</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Travel Setup</a></li>
        </ol>
    </div>
</div>
@include('super.includes.alert')
<div class="mybtn">
  <a href="{{ route('super.travelset.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New Travel Setup</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Travel Header and Footer Setup Option</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Travel Setup Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Title</th>
                              <th>License</th>
                              <th>Address</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($header_footer_travel as $travel_setup)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $travel_setup->title }}</td>
                            <td>{{ $travel_setup->license }}</td>
                            <td>{{ $travel_setup->address }}</td>
                            <td>
                              @if($travel_setup->status == 1)
                                {{ __('Active') }}
                                @elseif($travel_setup->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
                            <td>
                              <a class="view_option" href="{{ route('super.travelset.show', ['id'=>$travel_setup->id]) }}"><i class="fas fa-eye"></i><span>View Travel Setup</span></a>
                            @if($travel_setup->status == 1)
                              <a class="edit_option bg-warning" href="#inActiveId{{ $travel_setup->id }}" data-toggle="modal"><i class="fas fa-caret-square-down"></i><span>Set Inactive</span></a>
                            @elseif($travel_setup->status == 0)
                              <a class="edit_option bg-success" href="#activeId{{ $travel_setup->id }}" data-toggle="modal"><i class="fas fa-caret-square-up"></i><span>Set Active</span></a>
                            @endif
                              <a class="delete_option" href="#delSetup{{ $travel_setup->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete Travel Setup</span></a>
                            </td>
                @include('super.travelset.setup_modal')
                @include('super.travelset.setup_inactive')
                @include('super.travelset.setup_active')
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