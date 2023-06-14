@foreach ($embassy_single_data as $embassy)
<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Embassy Info Details of <strong>{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</strong></h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Embassy Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Mofa Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->mofa }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Religion<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->religion }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Age<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->age }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Type<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->visatype_name }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->visano_en }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Number Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->visano_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Sponsor Id<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->sponsorid_en }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Sponsor Id Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->sponsorid_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Sponsor Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->sponsorname_en }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Sponsor Name Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->sponsorname_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Date In Hijri<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->visa_date }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Location<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->visa_address }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Occupation<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->occupation_en }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Occupation Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->occupation_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Delegation/ Wakaalah No.<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->delegation_no }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Delegation Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($embassy->delegation_date)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Total Delegated Visa<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->delegated_visa }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Visa Duration<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->visa_duration }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->title }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->license }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->address }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Proprietor Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->proprietor }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Proprietor Title<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->proprietortitle }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Name Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->title_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">License Number Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->license_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Address Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->address_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Proprietor Name Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->proprietor_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Proprietor Title Arabic<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->proprietortitle_ar }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Name Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->title_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office License Number Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->license_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Address Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->address_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Proprietor Name Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->proprietor_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Proprietor Title Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->proprietortitle_bn }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Description Bengali<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $embassy->description_bn }}</span>
                                </div>
                            </div>
                           
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Embassy Submission Date<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($embassy->submissionDate)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($embassy->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
            
            @if($customer_single_data[0]->value == 3)
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.stampingVisa', ['id'=>$customer_single_data[0]->id]) }}">Add Visa Stamping Info</a>
            @else
                {{-- <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.edit', ['id'=>$customer_single_data[0]->id]) }}">Update</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editBook', ['id'=>$customer_single_data[0]->id]) }}">Update Book Referance</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editEmail', ['id'=>$customer_single_data[0]->id]) }}">Update E-Mail</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.editImage', ['id'=>$customer_single_data[0]->id]) }}">Update Image</a> --}}
             @endif
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.customer') }}">Back</a>
            </div>

        </div>
    </div>
</div>
@endforeach