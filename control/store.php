<?php

session_start();
include_once "../database/db.php";

$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confirmpass = $_REQUEST['confirmpassword'];
$encPassword = password_hash($password, PASSWORD_BCRYPT);
$errors = [];

if(empty($fname)){
    $errors['fname_error'] = "Your fast name is missing";
}

if(empty($lname)){
    $errors['lname_error'] = "Your last name is missing";
}

if(empty($email)){
    $errors['email_error'] = "Enter Your email address";
}elseif( !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email_error'] = "Please Enter a valid email address";
}

if(empty($password)){
    $errors['password_error'] = "missing";
}elseif(strlen($password) < 8){
    $errors['password_error'] = "your password is to short";
}elseif($password != $confirmpass){

    $errors['password_error'] = "your password don't match";
}
if(count($errors) > 0){

  $_SESSION['register_error'] = $errors;
 header("Location: ../backend/register.php");
}else{

    $query = "INSERT INTO users(fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')";

   $result = mysqli_query($connected , $query);
   if($result){
    header("location: ../backend/login.php");
   }

}
?>