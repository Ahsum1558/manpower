@extends('admin.master')
@section('main-content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content registration-form"> <!-- .login-form -->
        <div class="col-12 pl-0 pr-0">

             @include('admin.includes.alert')


            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">User Password Update Form</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('user-password-update') }}" enctype="multipart/form-data" autocomplete="off" class="form-inline">
                @csrf


                <div class="form-group col-12 mb-3">
                    <label for="password" class="col-sm-3 col-form-label text-right">{{ __('Old Password') }}</label>
                    <input id="password" type="password" class="col-sm-9 form-control @error('password') is-invalid @enderror" name="password" placeholder="Old Password" required>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group col-12 mb-3">
                    <label for="newPassword" class="col-sm-3 col-form-label text-right">{{ __('New Password') }}</label>
                    <input id="newPassword" type="password" class="col-sm-9 form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="New Password" required>

                     @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
<!--Content End-->
