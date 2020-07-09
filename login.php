<?php


session_start();

require('config.php');
$regnoError = "";
$passwordError = "";
$Error1 = "";

//validating inputs
if(!empty($_POST['login'])){

	
	//validating regnumber
	if (empty($_POST["regno"])) {
		$regnoError = "registration number is required";
	  } else {
		$regnum = test_input($_POST['regno']);
		
	  }

	  
 //validating password
 if (empty($_POST["psw"])) {
    $passwordError = "Password is required";
  }
  else{
   $loginpassword =test_input($_POST['psw']);
 
  }

  if($regnum!="" && $loginpassword!=""){
  $sq = "SELECT * FROM student WHERE regnumber='$regnum' ";
  $result = $conn->query($sq);

  if($result->num_rows > 0){
	  $fetch = $result->fetch_assoc();
	  $registrationpassword = $fetch["password"];

	
//verify if the password entered by the user is the same as password entered during the registration
if(password_verify($loginpassword,$registrationpassword))
{

$_SESSION['password'] = $loginpassword;
$_SESSION['regnumber'] = $regnum;

	header("Location:index.php"); 
}

else{

 $message = "invalid regnumber or password";

}
  }
}


 $conn ->close();
  
}

else{
	
	$Error1 = "failed to login";
}

//testing the inputs entered by the user

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
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 20%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
.error{
    color:red;
}
</style>
</head>
<body>

<h2>Modal Login Form</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate"  autocomplete = "on" onsubmit = "return validateForm()"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="avatar.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="regno"><b>Registration number</b></label>
      <input type="text" placeholder="Enter Registration number" name="regno">
      <span class = "error"><?php echo $regnoError ;?></span><br>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" >
      <span class = "error"><?php echo $passwordError;?></span><br>

        
      <!-- <button type="submit">Login</button> -->
      <input type ="submit" value="login" name="login"> 
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


function validateForm() {

var password = document.getElementById("password").value;


if(password == null || password == "" ){
    alert("pasword must be filled");
       return false;
}


if(password.length < 6){
   alert("atleast 6 characters required");
   return false;
}
else{
   return true;
}


}
</script>

</body>
</html>
