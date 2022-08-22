<?php

if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}
if (isset($_POST['submit'])) {

    $old = $_POST;
    $a = $_POST['roll_no'];
    $id = $_GET['id'];
    $users = $obj->Query("SELECT * from tbl_student where sid = $id");
    $userroll = $users[0]->roll_no;
    $usersem = $users[0]->semester;

    $entered_roll = $_POST['roll_no'];

    $check_if_roll_exists_in_same_semester = $obj->Query("SELECT * from tbl_student where roll_no = $entered_roll and semester =  $usersem");


    if ($userroll ==   $entered_roll) {
        if ($_POST['submit'] == 'add') {
            array_pop($_POST);

            $obj->Update("tbl_student", $_POST, "sid", array($_GET['id']));
            echo '<script>alert("Data updated successfully")</script>';
            echo "<script> window.location.href='" . base_url('add_student.php') . "'</script>";
        }
    } elseif ($check_if_roll_exists_in_same_semester) {
            $_SESSION['rollError'] = "Request denied. Roll no. cant't be similar .";
        
    }
    else{
        $_SESSION['rollError'] = "Request denied. Roll no. cant't be similar .";

    }

}

if (isset($_GET['action']) && $_GET['action'] == 'e') {
    $edit = $obj->Select("tbl_student", "*", "sid", array($_GET['id']));
    //print_r($edit);
    if (!$edit) {
        echo "<script> window.location.href='" . base_url('add_student.php') . "'</script>";
    }
}

$semester = $obj->select('semesters', '*', '', array(), ' Order by name asc');


?>



<div class="container pt-4">
    <h3 class="font-weight-bold">Edit students detail</h3>
    <div class="row">
        <div class="col-md-5 pt-4">
            <form action="" method="post" class="form-group">
                <div class="form-group">
                    <!-- <label for="college">College Name</label>   -->

                    <label>Student's Name</label>
                    <input type="text" name="sname" class="form-control" required value="<?= $edit[0]['sname']; ?>">

                    <label> Semester</label>
                    <?php $subject_e = $edit[0]['semester'];
                    $sem_Query = $obj->Select("semesters", "*", "id", array($subject_e));
                    $sem = $sem_Query[0]['name'];
                    $sem_id = $sem_Query[0]['id'];

                    ?>
                    <select name="semester" class="form-control">
                        <option value="" disabled selected>Choose a semester</option>

                        <?php foreach ($semester as $key => $value) : ?>
                            <option value="<?= $value['id'] ?>" <?php if ($value['id'] == $subject_e) { ?> selected<?php } ?>><?= $value['name'] ?> sem</option>
                        <?php endforeach ?>
                    </select>

                    <label>Roll No</label>
                    <input type="text" name="roll_no" class="form-control" required value="<?= $edit[0]['roll_no']; ?>">
                    <a style="color: red;">
                        <?php if (isset($_SESSION['rollError'])) {
                            echo $_SESSION['rollError'];
                            unset($_SESSION['rollError']);
                        } ?></a><br>


                    <label>Email</label>
                    <input type="text" name="email" class="form-control" required value="<?= $edit[0]['email']; ?>"><br>

                    <label>Address</label>
                    <input type="text" name="saddress" class="form-control" required value="<?= $edit[0]['saddress']; ?>"><br>


                    <label>Phone</label>
                    <input type="text" name="sphone" class="form-control" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" required value="<?= $edit[0]['sphone']; ?>"><br>



                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?php if ($edit[0]['status'] == 1) {
                                                echo "checked";
                                            } ?>>Active</option>
                        <option value="0" <?php if ($edit[0]['status'] == 0) {
                                                echo "checked";
                                            } ?>>Inactive</option>

                    </select>
                </div>


                <button class="btn btn-success" name="submit" value="add">Update</button>
            </form>
        </div>