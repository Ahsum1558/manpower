@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Ref</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">Customers For <strong>{{ Auth::user()->name }}</strong></h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">Customer Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Serial</th>
                              <th>Book Ref</th>
                              <th>Name</th>
                              <th>Passport No.</th>
                              <th>Delegate</th>
                              <th>Trade</th>
                              <th>Medical</th>
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($customer_ref as $customer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $customer->customersl }}</td>
                            <td>{{ $customer->bookRef }}</td>
                            <td>{{ $customer->cusFname .' '. $customer->cusLname }}</td>
                            <td>{{ $customer->passportNo }}</td>
                            <td>{{ $customer->agentname .' '. $customer->agentsl }}</td>
                            <td>{{ $customer->visatrade_name }}</td>
                            <td>
                              @if($customer->medical == 1)
                                {{ __('Done') }}
                                @elseif($customer->medical == 2)
                                {{ __('Fit') }}
                                @elseif($customer->medical == 3)
                                {{ __('Unfit') }}
                                @elseif($customer->medical == 4)
                                {{ __('N/A') }}
                                @elseif($customer->medical == 5)
                                {{ __('Problem') }}
                              @endif
                            </td>
                            <td>
                              @if($customer->status == 1)
                                {{ __('Active') }}
                                @elseif($customer->status == 0)
                                {{ __('Inactive') }}
                              @endif
                            </td>
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