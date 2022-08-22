<?php

include('studentheader.php');


if (!isset($_SESSION['student-status']) || $_SESSION['student-status'] != 'loggedin') {
    header('location:student_login.php');
    // echo "<script> window.location.href='" . base_url('student_login.php') . "'</script>";
}

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'update') {
        $imgName = $_FILES['avatar']['name'];
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $location = 'images' . '/' . $imgName;
        move_uploaded_file($tmp_name, $location); //upload file
        $_POST['avatar'] = $imgName;

        unset($_POST['submit']);

        $obj->Update("tbl_student_login", $_POST, "sid", array($_GET['id']));
        echo "<script>alert('profile updated successfully');</script>";
        echo "<script> window.location.href='" . base_url('edit_student_profile.php?id=' . $_GET['id']) . "'</script>";
    }
}

// if(!empty($_GET['id']))

$edit = $obj->Select("tbl_student_login", "*", "sid", array($_GET['id']));

if (!$edit) {
    echo "<script> window.location.href='" . base_url('edit_student_profile.php') . "'</script>";
}




?>

<style>
    nav .navbar {
        display: none !important;
    }
</style>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="my-4 mx-lg-5 p-2">Change Profile</h4>
        </div>
        <div class="col-md-6">
            <div class="px-5">
                <form action="" method="post" class="form-group" enctype="multipart/form-data">
                    <div class="d-flex">
                        <?php
                        $username = $_SESSION['student'];

                        $image_query = $obj->Query("SELECT * from tbl_student_login where username =  '$username'");
                        $user_avatar = $image_query[0]->avatar;
                        ?>
                        <img src="<?= base_url('images/' . $user_avatar) ?>" class="rounded-circle d-inline-flex img-thumbnail" style="width: 105px;height: 105px;border-radius: 50%;">
                        <div class="p-2">
                            <div class="form-group">
                                <input type="file" name="avatar" required>
                            </div>

                            <button class="btn btn-success" name="submit" value="update">Update</button>

                        </div>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
<style>
    footer{
        display: none;
    }
</style>