@extends('admin.master')

@section('main-content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-md-8 offset-2 pl-0 pr-0">

            @include('admin.includes.alert')


            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">{{ $user->name }}'s Profile</h4>
                </div>
            </div>
            <form action="{{ route('update-user-photo') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="table-responsive p-1">
                <table id="" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <tr> 
                        <td> 
                            <img src="{{ asset('public/admin/assets/images/avatar.png') }}" id="profile_photo" alt="" style="max-width: 400px;"> 
                        </td> 
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="avatar" id="avatar" onchange="showImage(this, 'profile_photo')">
                                     <label class="custom-file-label" for="inputGroupFile02" id="fileLabel">Choose file</label>
                                 </div>
                            </div>
                        </td>
                    </tr>

                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <tr><td><button type="submit" class="btn btn-block my-btn-submit">Update Photo</button></td></tr>
                  
                </table>
            </div>
            </form>
        </div>
    </div>
</section>
<!--Content End-->

@endsection