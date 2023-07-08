<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Support Agent Info Details of <strong>{{ $favor_single_data[0]->favor_office .' - '. $favor_single_data[0]->favor_license }}</strong></h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Support Agent Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-3 ">
                    <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                <img class="img-fluid img_user rounded-circle" src="{{ (!empty($favor_single_data[0]->photo)) ? url('public/admin/uploads/favor/'.$favor_single_data[0]->photo) : url('public/admin/assets/images/avatar.png') }}" alt="">  
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-9 col-sm-12">
                        <div class="profile-personal-info">
                        
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Serial Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->favorsl }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Ref Book No.<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->favorbook }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Support Agent Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->favorname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Care Of<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->father }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">NID Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->nid }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->favor_office }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office License Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->favor_license }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Office Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->office_address }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Phone Number<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->phone }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">E-Mail Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->email }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Date Of Birth<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($favor_single_data[0]->dateOfBirth)) }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Gender <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($favor_single_data[0]->gender == 1)
                                    {{ __('Male') }}
                                    @elseif($favor_single_data[0]->gender == 2)
                                    {{ __('Female') }}
                                    @else
                                    {{ __('Other') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Bank Account No.<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->accountNo }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Bank Name<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->bankname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Bank Branch<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->bankbranch }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Home Address<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->address }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Upzila <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->policestationname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">District <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->districtname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">City <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->cityname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Division <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->divisionname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Country <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->countryname }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Zipcode<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->zipcode }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Description<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $favor_single_data[0]->description }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Status<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($favor_single_data[0]->status == 1)
                                        {{ __('Active') }}
                                        @elseif($favor_single_data[0]->status == 0)
                                        {{ __('Inactive') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                           
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($favor_single_data[0]->created_at)) }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.favor.edit', ['id'=>$favor_single_data[0]->id]) }}">Update</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.favor.editBook', ['id'=>$favor_single_data[0]->id]) }}">Update Book Referance</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.favor.editOffice', ['id'=>$favor_single_data[0]->id]) }}">Update Office Name</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.favor.editLicense', ['id'=>$favor_single_data[0]->id]) }}">Update License</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.favor.editEmail', ['id'=>$favor_single_data[0]->id]) }}">Update E-Mail</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.favor.editImage', ['id'=>$favor_single_data[0]->id]) }}">Update Image</a>
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase pull-right" href="{{ route('admin.favor') }}">Back</a>
            </div>
        </div>
    </div>
</div>