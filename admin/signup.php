<?php
// session_start();
// $connection=mysqli_connect("localhost","root","");
// $db=mysqli_select_db($connection,'demo');
include '../connection.php';
$msg=0;
if(isset($_POST['sign']))
{

    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $location=$_POST['district'];
    $address=$_POST['address'];

    $pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="select * from admin where email='$email'" ;
    $result= mysqli_query($connection, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        // echo "<h1> already account is created </h1>";
        // echo '<script type="text/javascript">alert("already Account is created")</script>';
        echo "<h1><center>Account already exists</center></h1>";
    }
    else{
        $query="insert into admin(name,email,password,location,address) values('$username','$email','$pass','$location','$address')";
        $query_run= mysqli_query($connection, $query);
        if($query_run)
        {
            // $_SESSION['email']=$email;
            // $_SESSION['name']=$row['name'];
            // $_SESSION['gender']=$row['gender'];
            header("location:signin.php");
            // echo "<h1><center>Account does not exists </center></h1>";
            //  echo '<script type="text/javascript">alert("Account created successfully")</script>';
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
    <link rel="stylesheet" href="formstyle.css">
    <script src="signin.js" defer></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Register</title>
    <style>
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post" id="form">
            <span class="title">Register</span>
            <br>
            <br>
            <div class="input-group">
                <label for="username">Name</label>
                <input type="text" id="username" name="username" required/>
                <span class="error" id="nameError"></span>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required/>
                <span class="error" id="emailError"></span>
            </div>
            <label class="textlabel" for="password">Password</label> 
            <div class="password">
                <input type="password" name="password" id="password" required/>
                <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>                
                <span class="error" id="passwordError"></span>
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" required></textarea>
                <span class="error" id="addressError"></span>
            </div>
            <div class="input-field">
                <select id="district" name="district" required>
                    <option value="dhaka">Dhaka</option>
                    <option value="chittagong">Chittagong</option>
                    <option value="sylhet">Sylhet</option>
                    <option value="rajshahi">Rajshahi</option>
                    <option value="khulna">Khulna</option>
                    <option value="barisal">Barisal</option>
                    <option value="rangpur">Rangpur</option>
                    <option value="mymensingh">Mymensingh</option>
                    <option value="comilla">Comilla</option>
                    <option value="narayanganj">Narayanganj</option>
                    <option value="gazipur">Gazipur</option>
                    <option value="savar">Savar</option>
                    <option value="tangail">Tangail</option>
                    <option value="kishoreganj">Kishoreganj</option>
                    <option value="manikganj">Manikganj</option>
                    <option value="munshiganj">Munshiganj</option>
                    <option value="faridpur">Faridpur</option>
                    <option value="pabna">Pabna</option>
                    <option value="bogra">Bogra</option>
                    <option value="rajbari">Rajbari</option>
                    <option value="natore">Natore</option>
                    <option value="naogaon">Naogaon</option>
                    <option value="joypurhat">Joypurhat</option>
                    <option value="sirajganj">Sirajganj</option>
                    <option value="dinajpur">Dinajpur</option>
                    <option value="kurigram">Kurigram</option>
                    <option value="lalmonirhat">Lalmonirhat</option>
                    <option value="nilphamari">Nilphamari</option>
                </select>
                <span class="error" id="districtError"></span>
            </div>
            <button type="submit" name="sign">Register</button>
            <div class="login-signup">
                <span class="text">Already a member?
                    <a href="signin.php" class="text login-link">Login Now</a>
                </span>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById('form');
            const username = document.getElementById('username');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const address = document.getElementById('address');
            const district = document.getElementById('district');

            const nameError = document.getElementById('nameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const addressError = document.getElementById('addressError');
            const districtError = document.getElementById('districtError');

            username.addEventListener('input', validateName);
            email.addEventListener('input', validateEmail);
            password.addEventListener('input', validatePassword);
            address.addEventListener('input', validateAddress);
            district.addEventListener('change', validateDistrict);

            form.addEventListener('submit', (e) => {
                if (!validateName() || !validateEmail() || !validatePassword() || !validateAddress() || !validateDistrict()) {
                    e.preventDefault();
                }
            });

            function validateName() {
                const regex = /^[a-zA-Z0-9_]{3,20}$/;
                if (!regex.test(username.value)) {
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

            function validateAddress() {
                if (address.value.trim() === "") {
                    addressError.textContent = "Address cannot be empty.";
                    return false;
                } else {
                    addressError.textContent = "";
                    return true;
                }
            }

            function validateDistrict() {
                if (district.value === "") {
                    districtError.textContent = "Please select a district.";
                    return false;
                } else {
                    districtError.textContent = "";
                    return true;
                }
            }
        });
    </script>
    <script src="login.js"></script>
    <!-- <script src="../login.js"></script> -->
</body>
</html>
