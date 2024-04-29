<?php
session_start();
if (isset($_SESSION['username'])) {
    // Redirect to main page instead of the login page
    header("Location: mainp.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="log.css">
    

</head>
<body>
    
    <form method="post" id="form" class="form-container">

        <label for="username">Username</label>
        <input type="text" name="username" id="username" required><br><br>


        <label for="password">Password</label>
        <input type="password" name="password" id="password" required><br><br>

        <div class="g-recaptcha" data-sitekey="6Le_5skpAAAAAC6OYq8ct8MCRqfaipvasEz1aTuC"></div><br>

        <button type="submit">LogIn</button>
        <button type="button" class="register" id = "register">Register</button>
        
    </form>

   
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    

    
    <script src="jquery.js"></script>
    <script>
        $('#register').click(function() {
            window.location.href = 'register';
        });
        $('#form').submit(function(e){
            e.preventDefault();
            var data = new FormData(this);
            data.append('g-recaptcha-response', grecaptcha.getResponse());
            var username = $('#username').val();
            var password = $('#password').val();
            data.append('username', username);
            data.append('password', password);
            $.ajax({
                type: "POST",
                url: "loginprocess",
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Logged In Successfully',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = 'mainp.php'; // Redirect to mainp.php after successful login
                        });
                    } else if (response.status === 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Invalid username or password.',
                            allowOutsideClick: false
                        });
                    } else if (response.status === 'recaptcha_error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'reCAPTCHA Error',
                            text: 'reCAPTCHA verification failed, please try again.',
                            allowOutsideClick: false
                            
                        });
                        grecaptcha.reset();
                    }
                },


            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Log the error to the console for debugging
                grecaptcha.reset();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error processing your request. Please try again later.',
                    allowOutsideClick: false


                })
                }
            });
        });


    </script>

    
</body>
</html>