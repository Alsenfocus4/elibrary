<?php

require('config.php');

$emailError = "";
$fnameError = "";
$lnameError = "";
$Error2 = "";
$Error1 = "";
$regnumError="";

if(!empty($_POST['register'])){

  //validating email
  if(empty($_POST['email'])){
    $emailError = "email required";
    }
    else{
    $email = test_input($_POST['email']);
    
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $emailError = "Invalid email format";
    }

}



//validating firstname
if (empty($_POST["Firstname"])) {
  $fnameError = "firstname is required";
} else {
  $firstname = test_input($_POST['Firstname']);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
    $fnameError = "Only letters and white space allowed";
  }
}


//validating lastname
if (empty($_POST["Lastname"])) {
  $lnameError = "lastname is required";
  
} else {
  $lastname = test_input($_POST['Lastname']);
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
    $lnameError = "Only letters and white space allowed";
  }
}

//validating regnumber
if (empty($_POST["Regnumber"])) {
  $regnumError = "reg number is required";
  
} else {
  $regnumber = test_input($_POST['Regnumber']);
 
}




 //validating password
 
 $pass =test_input($_POST['psw']);
 $password = password_hash($pass,PASSWORD_DEFAULT);


  //insert into the table student
  
  if($emailError =="" && $fnameError =="" && $lnameError =="" && $regnumError==""){
    $sql = "INSERT INTO student(firstname, lastname, regnumber,email, password)
    VALUES('$firstname', '$lastname','$regnumber', '$email', '$password')";
   
   $connect =   $conn->query($sql);

   if($connect===true){
    header("Location: login.php");
    }
    }
    else{
        $Error2 = "Signup failed";
    }
    $conn -> close();
    
    }
    
    else{
    
      $Error1 = "failed to Signup";
    }




// testing the  inputs entered by the user
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data,ENT_QUOTES);
return $data; 
}

?>




<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css" type="text/css">
<style>

.error{
        color:blue;
        
    }


</style>
</head>

<body>
  <h2></h2>

  <form   onsubmit=" return validateForm()" autocomplete = "on" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="container">
    <h1>Registration form</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label for="fname"><b>First name</b></label>
    <input type="text" placeholder="First name" name="Firstname" id="First name" >
    <span class = "error"><?php echo $fnameError;?></span><br>
   
  
    <label for="lname"><b>Last name</b></label>
    <input type="text" placeholder="Last name" name="Lastname" id="Last name" >
    <span class = "error"><?php echo $lnameError;?></span><br>
   
   
  
    <label for="regno"><b>Registration number</b></label>
     <input type="text" placeholder="Registration number" name="Regnumber" id="Registration number" >
     <span class = "error"><?php echo $regnumError;?></span><br>
   
     <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" >
    <span class = "error"><?php echo $emailError;?></span><br>
   
   
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" >
    <span class = "error"><?php echo $passError;?></span><br>

     
    
    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" >
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <!-- <button type="submit" class="registerbtn">Register</button> -->
    
    <input type ="submit" value="register" name="register"> 
  </div>
  
  
  <div class="container signin">
    <p>Already have an account?</p>
    <a href="login.php">Sign in</a>
  </div>
</form>

<script type="text/javascript" src="chaz.js"></script> 

</body>
</html>
