<?php
 session_start();
 include_once "../database/db.php";

 $email = $_REQUEST['email'];
 $password = $_REQUEST['password'];
 $errors = [];


 if(empty($email)){
    $errors ['email_error'] = "Enter Your Email";
 }

 if(empty($password)){
    $errors ['password_error'] = "Enter Your password";
 }

if(count($errors) > 0){
    $_SESSION['login_errors'] = $errors ;
    header("location: ../backend/login.php");
}else{


    $query = "SELECT * FROM users WHERE email= '$email'";

   $result = mysqli_query($connected,$query);
   $user = mysqli_fetch_assoc($result);
  
 
   if(mysqli_num_rows($result) > 0){
    $password = $_REQUEST['password'];

   
   if($password){
    // login
    $_SESSION['user'] = $user;
    header("location: ../backend/index.php");
   }else{

    $errors ['password_error'] = "Wrong  password";
    $_SESSION['login_errors'] = $errors ;
    header("location: ../backend/login.php");

   }
   



}else{
    $errors ['email_error'] = "Wrong Email Address";
    $_SESSION['login_errors'] = $errors ;
    header("location: ../backend/login.php");
   }
}
?>