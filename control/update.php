<?php
include "../database/db.php";
session_start();

$id = $_SESSION['user']['id'];
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$profileImg = $_FILES['profileImg'];
$erroes = [];
$acceptedTypes = ['jpg','png', 'svg'];
$extension = pathinfo($profileImg['name'])['extension'];

// print_r($profileImg );

// echo $extension;

if($profileImg['size'] == 0){
   $erroes['profile_img_error'] = "Image is empty";
}elseif(!in_array($extension, $acceptedTypes)){
   $erroes['profile_img_error'] = "Only jpg, png and Svg File are supported";
}elseif($profileImg['size'] > 2000000){
   $erroes['profile_img_error'] = "Total Image sixe is 2mb";
}


if(count($erroes)==0){
    //** move uploded file

    $fileName = "User-".uniqid().".$extension";
    // print_r($fileName );
    
    if(!is_dir("../uplodes/user")){
        mkdir("../uplodes/user");
    }
    $Uploded_file = move_uploaded_file($profileImg['tmp_name'],"../uplodes/user/$fileName");

    if($Uploded_file){
        $query = "UPDATE users SET fname='$fname',lname='$lname',email='$email',profile_img='$fileName' WHERE id = '$id'";
       
      $res = mysqli_query($connected,$query);
      
        // print_r($res);
       $_SESSION['user']['fname'] = $fname;
       $_SESSION['user']['lname'] = $lname;
       $_SESSION['user']['email'] = $email;
       $_SESSION['user']['profile'] = $fileName;
       
       header("location: ../backend/profile.php");
    }
}else{

    header("location: ../backend/profile.php");
}
?>