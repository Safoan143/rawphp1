<?php
// print_r($_REQUEST);
session_start();
include "../database/db.php";
// print_r($_SESSION['user']);
// exit();
$id = $_SESSION['user']['id'];
$oldpassword = $_REQUEST['old_pass'];
$password = $_REQUEST['old_pass'];
$confirmpassword = $_REQUEST['old_pass'];
$errors =[];
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($connected,$query);
$user = mysqli_fetch_assoc($result);
// print_r($user);

$verifyd = password_verify($oldpassword, $user['password']);

// 
if($verifyd){
    // 
}else{
    $errors['old_error'] = "old password did not match";
    $_SESSION['update_error'] = $errors;
    header("Location: ../backend/profile.php");
}
?>