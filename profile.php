<?php
include "../back_inf/header.php";
?>

<div class="container-fluid">

<h2>Profiel Edit</h2>
<form action="../control/update.php" method="POST" enctype="multipart/form-data">
<div class="row">
  
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-4">
            <label for="profileImage">

            <img style="width: 200px; height:200px; border-radius  : 50%; "  src=" <?= isset($_SESSION['user']['profile']) ? "../uplodes/user/" . $_SESSION['user']['profile']  : "https://api.dicebear.com/7.x/initials/svg?seed=" . $_SESSION['user']['fname'] ?>"
                 
            alt="#" class="profile_image">

         </label>

                <input  type="file" name="profileImg" id="profileImage" class="select_profile_img">
            </div>
            <div class="col-lg-8">
                <input name="fname" value="<?= $_SESSION['user']['fname']?>"  class="form-control"  type="text" placeholder="Fast Name">
                <input name="lname" value="<?= $_SESSION['user']['lname']?>"  class="form-control"  type="text" placeholder="Last Name">
                <input name="email" value="<?= $_SESSION['user']['email']?>"  class="form-control"  type="text" placeholder="Email Address"><br>
                <button class="btn btn-primary">Update</button>
            </div>
        </div>

    </div>
    </form>
    
    <div class="col-lg-4">
    <div class="card shadow p-3 rounded">
        <form action="../control/updatepass.php" method="POST" >
            <input name="old_pass" type="text" class="form-control" placeholder="Old password">
            <span class="text-danger"><?= isset($_SESSION['update_error']['old_error']) ? $_SESSION['update_error']['old_error'] : '' ?></span>
            <input name="Password" type="text" class="form-control" placeholder="New password">
            <input name="confirm_pass"  type="text" class="form-control" placeholder="Confirm password"><br>
            <button class="btn btn-primary w-100">Update</button>

        </form>
    </div>
    </div>
</div>

</div>



<?php

  include_once "../back_inf/footer.php";
  unset( $_SESSION['update_error']);
?>


<script>

    let profileInput = document.querySelector('.select_profile_img');
    let profileImg = document.querySelector('.profile_image');
    function updateImg(event){

        let url = URL.createObjectURL(event.target.files[0])
        profileImg .src = url
        console.log(url);

    }
    profileInput.addEventListener('change', updateImg)

</script>