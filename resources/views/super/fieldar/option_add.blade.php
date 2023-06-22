<div id="addNewArabicOption" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Arabic Option</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card_line">
                    <div class="card-header card_headline">
                        <h4 class="card-title headline">إضافة مكتب جديد باللغة العربية</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('super.fieldar.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                                 @csrf
                                <div class="profile-personal-info">

                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Title<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="title_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Title" value="{{ old('title_ar') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">License Number <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="license_ar" class="form-control d-inline-block inline_setup" placeholder="Enter License Number" value="{{ old('license_ar') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Description <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="description_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Description" value="{{ old('description_ar') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Office Address <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="address_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Office Address" value="{{ old('address_ar') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Proprietor Name <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="proprietor_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Name" value="{{ old('proprietor_ar') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Proprietor Title <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="proprietortitle_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Title" value="{{ old('proprietortitle_ar') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Telephone Number <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="telephone_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Telephone Number" value="{{ old('telephone_ar') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Cellphone Number <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="cellphone_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Cellphone Number" value="{{ old('cellphone_ar') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Helpline Number <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="helpline_ar" class="form-control d-inline-block inline_setup" placeholder="Enter Helpline Number" value="{{ old('helpline_ar') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Status <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9">
                                            <select id="select" name="status" class="form-control d-inline-block inline_setup">
                                              <option selected="selected">Select Type</option>
                                              <option value="1">Active</option>
                                              <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3"></div>
                                    <div class="modal-footer col-9 mybtn">
                                        <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addOption" class="form-control inline_setup btn submitbtn text-uppercase">Add</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>