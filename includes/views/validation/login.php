<div class="col-lg-6">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Login</h1>
        </div>
        <form class="user" id="login-form" method="post">
            
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Username" name="username" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" required>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox small" id="error-panel">
                    
                </div>
            </div>
            <button class="btn btn-primary btn-user btn-block">
                Login
            </button>
            <hr>
        </form>
        
        <div class="text-center">
            <a href="index.php?view=validation&action=password-reset">Forgot Password?</a>
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
        $("#login-form").validate({
            rules: {
                username: "required",
                password: "required"
            },
            messages: {
                username: "Please enter your username",
                password: "Please enter your password"
            }
        });
       
    });
</script>