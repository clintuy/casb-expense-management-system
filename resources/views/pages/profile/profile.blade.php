@extends('layouts.app')

@section('main-content')
<div id="profile-page">

    <h1>User Profile</h1>
    <hr class="pb-5">
        <div class="container">
        
        <div class="row">
            <div class="col-md-6">
                <label for="name">Full Name</label>
                <label id="name" class="form-control">{{ $user->name }}</label>
            </div>
            <div class="col-md-6">
                <label for="email">E-Mail Address</label>
                <label id="email" class="form-control">{{ $user->email }}</label>
            </div>
        </div>
        <div class="mt-3">
            <button id="btnOpenModal" class="btn btn-dark" type="button"><i class="fas fa-unlock"></i> Change Password</a>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="modalPasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPasswordLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div id="errorMessage" class="alert alert-danger" style="display:none">
                    <ul id="errorList" class="pl-2">
                        <li>q</li>
                    </ul>
                </div>
                
                    <div class="form-group">
                        <label for="oldPassword"><b>Old Password <span style="color:red">*</span></b></label>
                        <input 
                            id="oldPassword" 
                            name="oldPassword" 
                            class="form-control" 
                            type="password"   
                            placeholder="Enter your Old Password"
                            autocomplete="oldPassword"
                        />
                    </div>
                    <div class="form-group">
                        <label for="newPassword"><b>New Password <span style="color:red">*</span></b></label>
                        <input 
                            id="newPassword" 
                            name="newPassword" 
                            class="form-control" 
                            type="password"   
                            placeholder="Enter your New Password"
                            autocomplete="newPassword"
                        />
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword"><b>Confirm Password <span style="color:red">*</span></b></label>
                        <input 
                            id="confirmPassword" 
                            name="confirmPassword" 
                            class="form-control " 
                            type="password"   
                            placeholder="Enter your Confirm Password"
                            autocomplete="confirmPassword"
                        />
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnChangePassword" type="button" class="btn btn-dark">Change Password</button>
            </div>
        </div>
    </div>
</div>

<script>

$(document).on('click', '#btnChangePassword', function () {
    
    const oldPassword = $("#oldPassword").val();
    const newPassword = $("#newPassword").val();
    const confirmPassword = $("#confirmPassword").val();
    const erroMessage = document.querySelector("#errorMessage");

    $.ajax({
        type: "POST",
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('change_password') }}",
        data: {
            oldPassword:oldPassword,
            newPassword:newPassword,
            confirmPassword:confirmPassword
        },
        success: function (data) {
            if(data.error != undefined) {
                erroMessage.style.display = "block";
                $("#errorList").empty();

                for(let i = 0; i < data.error.length; i++) {
                    $("#errorList").append(
                        '<li>' + data.error[i] + '</li>'
                    );
                }
            }
            else {
                window.location.reload();
            }
        },
        error: function(xhr, textStatus, errorThrow) {
            console.log(xhr.responseText);
        }
    });
});

$(document).ready(function(){
    $("#btnOpenModal").click(function(){
        $("#modalPassword").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
});
</script>
@endsection
