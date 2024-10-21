<?php
include 'connection.php';
// $connection=mysqli_connect("localhost","root","");
// $db=mysqli_select_db($connection,'demo');
if(isset($_POST['sign']))
{

    $username=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $gender=$_POST['gender'];

    $pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="select * from login where email='$email'" ;
    $result= mysqli_query($connection, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){

        echo "<h1><center>Account already exists</center></h1>";
    }
    else{
    
    $query="insert into login(name,email,password,gender) values('$username','$email','$pass','$gender')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {
      
       
        header("location:signin.php");
       
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
        
    }
}


   
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="regform">
            <form id="form" action=" " method="post">
                <p class="logo">Food <b style="color: #06C167;">Donate</b></p>
                
                <p id="heading">Create your account</p>
                
                <div class="input">
                    <label class="textlabel" for="name">User name</label><br>
                    <input type="text" id="name" name="name" required/>
                    <span class="error" id="nameError"></span>
                </div>
                <div class="input">
                    <label class="textlabel" for="email">Email</label>
                    <input type="email" id="email" name="email" required/>
                    <span class="error" id="emailError"></span>
                </div>
                <label class="textlabel" for="password">Password</label>
                <div class="password">
                    <input type="password" name="password" id="password" required/>
                     <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>                
                    <span class="error" id="passwordError"></span>
                </div>
                <div class="radio">
                    <input type="radio" name="gender" id="male" value="male" required/>
                    <label for="male" >Male</label>
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female" >Female</label>
                    <span class="error" id="genderError"></span>
                </div>
                <div class="btn">
                    <button type="submit" name="sign">Continue</button>
                </div>
                <div class="signin-up">
                    <p style="font-size: 20px; text-align: center;">Already have an account? <a href="signin.php"> Sign in</a></p>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById('form');
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const genderMale = document.getElementById('male');
            const genderFemale = document.getElementById('female');

            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const genderError = document.getElementById('genderError');

            name.addEventListener('input', validateName);
            email.addEventListener('input', validateEmail);
            password.addEventListener('input', validatePassword);
            genderMale.addEventListener('change', validateGender);
            genderFemale.addEventListener('change', validateGender);

            form.addEventListener('submit', (e) => {
                if (!validateName() || !validateEmail() || !validatePassword() || !validateGender()) {
                    e.preventDefault();
                }
            });

            function validateName() {
                const regex = /^[a-zA-Z0-9_]{3,20}$/;
                if (!regex.test(name.value)) {
                    nameError.textContent = "Username must be 3-20 characters and contain only letters, numbers, and underscores.";
                    return false;
                } else {
                    nameError.textContent = "";
                    return true;
                }
            }

            function validateEmail() {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!regex.test(email.value)) {
                    emailError.textContent = "Enter a valid email address.";
                    return false;
                } else {
                    emailError.textContent = "";
                    return true;
                }
            }

            function validatePassword() {
                const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
                if (!regex.test(password.value)) {
                    passwordError.textContent = "Password must be at least 8 characters long and contain at least one letter and one number.";
                    return false;
                } else {
                    passwordError.textContent = "";
                    return true;
                }
            }

            function validateGender() {
                if (genderMale.checked || genderFemale.checked) {
                    genderError.textContent = "";
                    return true;
                } else {
                    genderError.textContent = "Please select your gender.";
                    return false;
                }
            }
        });
    </script>
    <script src="admin/login.js"></script>
</body>
</html>
