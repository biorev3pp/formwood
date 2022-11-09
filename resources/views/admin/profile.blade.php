@extends('layouts.admin')
@section('content')
<div class="content-header d-flex flex-wrap bg-white" style="padding: 0.8rem 2rem 0.4rem;">
    <div class="content-header-left p-0">
        <h3 class="content-header-title m-0 mr-1">Profile</h3>
        <div class="row breadcrumbs-top">
        </div>
    </div>
</div>
<div class="content-overlay"></div>
<div class="content-wrapper pb-0">
    <div class="content-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <form class="form" id="profileForm">
                    <div class="card m-0">
                        <div class="card-header border-bottom">
                            <h4 class="card-title text-uppercase">Edit Your Profile</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-2">
                                <div class="media mb-2">
                                    <img src="{{asset('backend/images/'.$admin->profile_image)}}" alt="users avatar" class="users-avatar-shadow rounded-circle mr-2" height="64" width="64">
                                    <div class="media-body">
                                        <h4 class="media-heading"></h4>
                                        <div class="col-12 px-0">
                                            <input type="file" id="profileImageInput" class="d-none" onchange="readUrl(this)">
                                            <label href="javascript:void(0)" for="profileImageInput" class="btn btn-sm btn-dark mr-25 waves-effect waves-light">Change</label>
                                            <br>
                                            <small class="font-weight-bold text-danger">(64 x 64px)</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="text-uppercase mb-1">Your Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Your Name" value="{{$admin->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="text-uppercase mb-1">Your Email</label>
                                    <input type="email" id="email" class="form-control" placeholder="Your Email" value="{{$admin->email}}" required>
                                </div>
                                <div class="form-group d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-dark glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-12">
                <form class="form" id="updatePasswordForm">
                    <input type="hidden" name="id" value={{$admin->id}}>
                    <div class="card m-0">
                        <div class="card-header border-bottom">
                            <h4 class="card-title text-uppercase">Change Your Password</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-2">
                                <div class="form-group">
                                    <label class="text-uppercase mb-1">Old Password</label>
                                    <input type="password" class="form-control" placeholder="Enter your old password" name="old_password" required>
                                </div>
                                <div class="form-group">
                                    <label class="text-uppercase mb-1">New Password</label>
                                    <input type="password" class="form-control" placeholder="Enter your password" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label class="text-uppercase mb-1">Confirm New Password</label>
                                    <input type="password" class="form-control" placeholder="Re-enter your password" name="confirm_password" required>
                                </div>
                                <div class="form-group d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-dark glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">Update Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
let profileImage = null;
const id = {{$admin->id}}, path = '{{asset("backend/images")}}';
$(document).ready(function () {
    $("#profileForm").submit(function( event ) {
        event.preventDefault();
        const name = $("#name").val();
        const email = $("#email").val();
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('profile_image', profileImage);

        $.ajax({
            type: 'POST',
            url: siteURL+'/api/edit-profile',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                toastr.clear();
                toastr.success("Your Profile has been updated successfully.");
                $('.avatar img').attr('src', `${path}/${response.profile_image}`);
            },
            error: function(error){
                toastr.error(error.responseJSON);
            }
        });
    });

    $("#updatePasswordForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: siteURL+'/api/update-password',
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                toastr.clear();
                toastr.success("Your Password has been updated successfully.");
                const form = document.getElementById('updatePasswordForm');
                form.reset();
            },
            error: function(error){
                toastr.error(error.responseJSON);
            }
        });
    });
});

function readUrl(input) {
    if (input.files && input.files[0]) 
    {  
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $(input).parents('.media').find('img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        profileImage = input.files[0];
    }
}
</script>
@endpush