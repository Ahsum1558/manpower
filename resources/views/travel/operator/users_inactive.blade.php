<!-- Inactive -->
<div id="inActiveId{{ $admin_user->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inactive Operator</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('travel.operator.inactive', ['id'=>$admin_user->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Are you sure you want to Inactive Operator !</h5>
                    <h2 class="text-center">{{ $admin_user->name }}</h2>
                    <h4 class="text-center">{{ $admin_user->username }}</h4>
                    
                    <input type="hidden" name="status" value="inactive">
                </div>
                <div class="modal-footer mybtn">
                    <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                    <button type="submit" name="inactive" class="form-control inline_setup btn submitbtn text-uppercase">Inactive</button>
                </div>
            </form> 
        </div>
    </div>
</div>