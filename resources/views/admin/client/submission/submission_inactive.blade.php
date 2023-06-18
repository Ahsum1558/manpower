<!-- Inactive -->
<div id="inActiveId{{ $submission->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inactive Submission Date</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.submission.inactive', ['id'=>$submission->id]) }}" class="form-group" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h5 class="text-center">Are you sure you want to Inactive !</h5>
                    <h2 class="text-center">{{ $submission->title .' '. $submission->license }}</h2>
                    <h4 class="text-center">{{ date('d-M-Y', strtotime($submission->submissionDate)) }}</h4>
                    
                    <input type="hidden" name="status" value="0">
                </div>
                <div class="modal-footer mybtn">
                    <button type="button" class="form-control inline_setup btn submitbtn text-uppercase" data-dismiss="modal">Close</button>
                    <button type="submit" name="inactive" class="form-control inline_setup btn submitbtn text-uppercase">Inactive</button>
                </div>
            </form> 
        </div>
    </div>
</div>