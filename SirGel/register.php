<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="reg.css">



    
</head>
<body>
    
    <div class="form-container box">
        <form action="" method = "post" id="form">
            <div class="input-container">
                <label for="email">Email</label>
                <input type="email" name = "email" id = "email" required>
            </div>

            <div class="input-container">
                <label for = "Username">Username</label>
                <input type="text" name = "username" id = "Username" required>
            </div>

            <div class="input-container">
                <label for = "password">Password</label>
                <input type="password" name = "password" id = "password" required>
            </div>
            <button type="submit">Submit</button>

            <a href="login.php">Already have an account? Login here.</a>
        </form>
    </div>
     
    

    
   


    







     





    <script>
$(document).ready(function(){
    $('#form').submit(function(e){
        e.preventDefault(); // Prevent the form from submitting normally
        
        var isValid = validateForm(); // Check if the form is valid
        
        if(isValid) {
            var data = new FormData(this);
            var username = $('#Username').val();
            var password = $('#password').val();
            var email = $('#email').val();

            data.append('username', username);
            data.append('password', password);
            data.append('email', email);
            
            $.ajax({
                type: "POST",
                url: "regprocess.php",
                data: data,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log("Response from server:", response); // Log the response from the server
                    if(response.startsWith('Error:')) {
                        Swal.fire({
                            title: 'Registration Failed',
                            text: response, // Display the error message from PHP
                            icon: 'error',
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Success',
                            text: 'Registered Successfully',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then(() => {
                            window.location.href = 'login';
                        });
                    }
                },
                error: function(xhr, status, error){
                    console.log("Error:", error); // Log any errors to the console
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an error processing your request. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'Okay'
                    });
                }
            });
        }
    });
});

function validateForm() {
    var errors = [];

    // Validate Email
    var email = $('#email').val().trim();
    if (email === '') {
        errors.push("Email is required");
    } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        errors.push("Invalid email format");
    }

    // Validate Username
    var username = $('#Username').val().trim();
    if (username === '') {
        errors.push("username is required");
    } else if (username.length < 8) {
        errors.push("username must be at least 8 characters long");
    } else if (!/^[A-Za-z0-9]+$/.test(username)) {
        errors.push("username can only contain letters and numbers");
    }

    
    // Validate Password
    var password = $('#password').val().trim();
    if (password === '') {
        errors.push("Password is required");
    } else if (!/^[A-Z][a-zA-Z0-9]{7,15}$/.test(password) || password.indexOf(' ') != -1) {
        errors.push("Password must have a first letter uppercase, not contain whitespace and be 8-16 characters long");
    }


    // Display errors or submit form
    if (errors.length > 0) {
        Swal.fire({
            title: 'Validation Error',
            html: errors.join('<br>'),
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return false; 
    } else {
        return true;
    }
}


    </script>


</body>
</html>

