<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include("login.php"); 
if($_SESSION['name']==''){
	header("location: signin.php");
}
// include("login.php"); 
$emailid= $_SESSION['email'];
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'demo');


if(isset($_POST['submit']))
{
    
    
    
    
    
    
   
    

    $category=$_POST['image-choice'];
    $quantity=mysqli_real_escape_string($connection, $_POST['quantity']);
    // $email=$_POST['email'];
    $phoneno=mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district=mysqli_real_escape_string($connection, $_POST['district']);
    $address=mysqli_real_escape_string($connection, $_POST['address']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
    
   
    
  
    $query="insert into cloth_storage(email,category,phoneno,location,address,name,quantity) values('$emailid','$category','$phoneno','$district','$address','$name','$quantity')";
    
    $query_run= mysqli_query($connection, $query);
  
      require 'PHPMailer/Exception.php';
      require 'PHPMailer/PHPMailer.php';
      require 'PHPMailer/SMTP.php';
      $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'obito.uchiha1184@gmail.com';                     //SMTP username
    $mail->Password   = 'mdgn iana dpuo bbns';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //sender
    $mail->setFrom('obito.uchiha1184@gmail.com', 'webProject'); //ae khane file ar directory
//receiver
    $mail->addAddress($emailid, 'amr website');     //Add a recipient
 

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Cloth Donation';
    $mail->Body    = 'Thanks for donation cloths';
   
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
     
       
        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:deliveryforcloth.php");
        
    }

    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donate</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body style="    background-color: #06C167;">
    <div class="container">
        <div class="regformf" >
    <form action="" method="post">
        <p class="logo">কাপড়  <b style="color: #06C167; ">দান</b></p>
        
       <!-- <div class="input">
        <label for="foodname"  > Food Name:</label>
        <input type="text" id="foodname" name="foodname" required/>
        </div> -->
      
      
        <!-- <div class="radio">
        <label for="meal" >Meal type :</label> 
        <br><br>

        <input type="radio" name="meal" id="veg" value="veg" required/>
        <label for="veg" style="padding-right: 40px;">Veg</label>
        <input type="radio" name="meal" id="Non-veg" value="Non-veg" >
        <label for="Non-veg">Non-veg</label>
    
        </div>
        <br> -->
        <div class="input">
        <label for="food">Select the Category:</label>
        <br><br>
        <div class="image-radio-group">
            <input type="radio" id="raw-food" name="image-choice" value="shirt">
            <label for="raw-food">
              <img src="img/form/7.png" alt="shirt" >
            </label>
            <input type="radio" id="cooked-food" name="image-choice" value="lungi"checked>
            <label for="cooked-food">
              <img src="img/form/8.png" alt="lungi" >
            </label>
            <input type="radio" id="packed-food" name="image-choice" value="Sharee">
            <label for="packed-food">
              <img src="img/form/9.png" alt="Sharee" >
            </label>
          </div>
          <br>
        <!-- <input type="text" id="food" name="food"> -->
        </div>
        <div class="input">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required/>
        
        </div>
       <b><p style="text-align: center;">Contact Details</p></b>
        
    
        <div class="input">
          <!-- <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email">
          </div> -->
      <div>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name"value="<?php echo"". $_SESSION['name'] ;?>" required/>
      </div>
      <div>
        <label for="phoneno" >PhoneNo:</label>
      <input type="text" id="phoneno" name="phoneno" maxlength="13"  required />
        
      </div>
      </div>
        <div class="input">
        <label for="location"></label>
        <label for="district">District:</label>
<select id="district" name="district" style="padding:10px;">
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

        <label for="address" style="padding-left: 10px;">Address:</label>
        <input type="text" id="address" name="address" required/><br>
        
      
       
       
        </div>
        <div class="btn">
            <button type="submit" name="submit"> submit</button>
     
        </div>
     </form>
     </div>
   </div>
     
    
</body>
</html>