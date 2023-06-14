@foreach ($customer_single_docs as $documents)
<div class="col-xl-12 col-lg-12">
    <div class="card card_line">
        <div class="card-header card_headline">
           <h4 class="card-title headline">Documents Info Details of <strong>{{ $customer_single_data[0]->cusFname .' '. $customer_single_data[0]->cusLname }}</strong></h4>
        </div>
        <div class="card-body">
            <h4 class="mb-4 basic_headline">Documents Info</h4>
            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="profile-personal-info">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Police Clearance Certificate<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $documents->pc }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Driving License<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $documents->license }}</span>
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Training Certificate<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($documents->tc == 1)
                                    {{ __('Done') }}
                                    @elseif($documents->tc == 2)
                                    {{ __('Received') }}
                                    @elseif($documents->tc == 3)
                                    {{ __('N/A') }}
                                    @elseif($documents->tc == 4)
                                    {{ __('Return Back') }}
                                    @elseif($documents->tc == 5)
                                    {{ __('Problem') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Certificate<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($documents->certificate == 1)
                                    {{ __('Done') }}
                                    @elseif($documents->certificate == 2)
                                    {{ __('Received') }}
                                    @elseif($documents->certificate == 3)
                                    {{ __('N/A') }}
                                    @elseif($documents->certificate == 4)
                                    {{ __('Return Back') }}
                                    @elseif($documents->certificate == 5)
                                    {{ __('Problem') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Musaned<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $documents->musaned }}</span>
                                </div>
                            </div>
                            
                            
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Finger<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>
                                    @if($documents->finger == 1)
                                    {{ __('Done') }}
                                    @elseif($documents->finger == 2)
                                    {{ __('Completed') }}
                                    @elseif($documents->finger == 3)
                                    {{ __('N/A') }}
                                    @elseif($documents->finger == 4)
                                    {{ __('Problem') }}
                                    @endif
                                </span>
                                </div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Created At<span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ date('d-M-Y', strtotime($documents->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mybtn">
            
            @if($customer_single_data[0]->value == 1)
                <a class="btn submitbtn mb-2 form-control inline_setup text-uppercase" href="{{ route('admin.customer.passport', ['id'=>$customer_single_data[0]->id]) }}">Add Passport Info</a>
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