<div class="col-lg-6">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
            <dfn>To reset your password you will have to provide your registered email</dfn>
        </div>
        <form class="user" id="reset-form" method="post" >
            <div class="form-group">
                <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Enter Email" name="email" required="required" >
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox small" id="error-panel">
                    
                </div>
            </div>
            <button class="btn btn-primary btn-user btn-block">
                Reset
            </button>
            <hr>
        </form>
        
        <div class="text-center">
            <a href="index.php?view=validation&action=login">Return to Login</a>
        </div>
        
        <hr>
    </div>
</div>
<script>
    // $.validator.setDefaults({
    //     submitHandler: function() {
    //         alert("submitted!");
    //     }
    // });
    $().ready(function() {
        // validate the comment form when it is submitted
        // $("#login-form").validate();
        // validate signup form on keyup and submit
        $("#reset-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Please provide your email",
                    minlength: "Please enter a valid email address"
                }
            }
        });
       
    });
</script>