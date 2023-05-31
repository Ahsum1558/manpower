@extends('admin.master')

@section('main-content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0"></div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">District</a></li>
        </ol>
    </div>
</div>
@include('admin.includes.alert')
<div class="mybtn">
    <a href="{{ route('admin.district.create') }}" class="btn submitbtn mb-2 form-control inline_setup text-uppercase">Add New District</a>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card card_line">
            <div class="card-header card_headline">
               <h4 class="card-title headline">All District</h4>
            </div>
            <div class="card-body">
              <h4 class="mb-4 basic_headline">District Info</h4>
              <div class="table-responsive">
                  <table id="example" class="display" style="min-width: 700px">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>District Name</th>
                              <th>Division Name</th>
                              <th>Country Name</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                          $i=1;
                        @endphp
                      @foreach($all_district as $district)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $district->districtname }}</td>
                            <td>{{ $district->divisionname }}</td>
                            <td>{{ $district->countryname }}</td>
                            <td>
                              <a class="view_option" href="{{ route('admin.district.show', ['id'=>$district->id]) }}"><i class="fas fa-eye"></i><span>View Details</span></a>
                              <a class="delete_option" href="#delDistrict{{ $district->id }}" data-toggle="modal"><i class="fas fa-trash"></i><span>Delete District</span></a>
                            </td>
                @include('admin.location.district.district_modal')
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