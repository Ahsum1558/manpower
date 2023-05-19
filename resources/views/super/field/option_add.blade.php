<div id="addNewOption" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Option</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card_line">
                    <div class="card-header card_headline">
                        <h4 class="card-title headline">Add New Option in English</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('super.field.store') }}" class="form-group" method="POST" enctype="multipart/form-data">
                                 @csrf
                                <div class="profile-personal-info">

                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Logo <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="file" name="logo" class="form-control d-inline-block inline_setup" placeholder="Enter Title">
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Title<span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="title" class="form-control d-inline-block inline_setup" placeholder="Enter Title">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Small Title <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="smalltitle" class="form-control d-inline-block inline_setup" placeholder="Enter Small Title">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">License Number <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="license" class="form-control d-inline-block inline_setup" placeholder="Enter License Number">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Description <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="description" class="form-control d-inline-block inline_setup" placeholder="Enter Description">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Office Address <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="address" class="form-control d-inline-block inline_setup" placeholder="Enter Office Address">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Proprietor Name <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="proprietor" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Name">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Proprietor Title <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="proprietortitle" class="form-control d-inline-block inline_setup" placeholder="Enter Proprietor Title">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Telephone Number <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="telephone" class="form-control d-inline-block inline_setup" placeholder="Enter Telephone Number">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Cellphone Number <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="cellphone" class="form-control d-inline-block inline_setup" placeholder="Enter Cellphone Number">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Helpline Number <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="helpline" class="form-control d-inline-block inline_setup" placeholder="Enter Helpline Number">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">Web Address <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="web" class="form-control d-inline-block inline_setup" placeholder="Enter Web Address">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="f-w-500">E-Mail Address <span class="pull-right">:</span></h5>
                                        </div>
                                        <div class="col-9"><input type="text" name="email" class="form-control d-inline-block inline_setup" placeholder="Enter E-Mail Address">
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