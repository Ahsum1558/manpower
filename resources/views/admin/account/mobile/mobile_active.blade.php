<!-- active -->
<div id="activeId{{ $mobileaccount->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Active Mobile Account</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.mobile.active', ['id'=>$mobileaccount->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Are you sure you want to Active !</h5>
                    <h4 class="text-center">A/C No.: {{ $mobileaccount->account_number }}</h4>
                    <h4 class="text-center">Type: 
                        @if($mobileaccount->account_type == 1)
                          {{ __('BKash') }}
                        @elseif($mobileaccount->account_type == 2)
                          {{ __('Nagad') }}
                        @elseif($mobileaccount->account_type == 3)
                          {{ __('Rocket') }}
                        @endif
                    </h4>
                    <input type="hidden" name="status" value="1">
                </div>
                <div class="modal-footer mybtn">
                    <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                    <button type="submit" name="active" class="form-control inline_setup btn submitbtn text-uppercase">Active</button>
                </div>
            </form> 
        </div>
    </div>
</div>