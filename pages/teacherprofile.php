<?php
if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
	header('location:teacher_login.php');
} ?>
<?php
include('teacherheader.php');
if (isset($_SESSION['posted_by'])) {
	$teachers = $obj->select('tbl_teacher', '*', 'tid', array($_SESSION['teacher_id']));
	// print_r($teachers);
}

$edit = $obj->Select("tbl_teacher_login", "*", "username", array($_SESSION['posted_by']));

$edit_id = $edit[0]['tid'];
print_r($edit_id);
// die;


$t_email = $edit[0]['email'];
// print_r($t_email);


$teacher_details = $obj->Select("tbl_teacher", "*", "temail", array($t_email));
// echo "<pre>";
// print_r($teacher_details);

$tphone = $teacher_details[0]['tphone'];
$taddress = $teacher_details[0]['taddress'];
$tname = $teacher_details[0]['tname'];




$teacher_table_query = $obj->select('tbl_teacher_login', '*', 'username', array($_SESSION['posted_by']));

$teacher_table_email = $teacher_table_query[0]['email'];
$teacher_table_username = $teacher_table_query[0]['username'];

$teacher_table_teacher_name = $obj->Query("SELECT * from tbl_teacher where temail = '$teacher_table_email'");


if (isset($_POST['submit'])) {
	if ($_POST['submit'] == 'update') {

		$imgName = $_FILES['avatar']['name'];
		$tmp_name = $_FILES['avatar']['tmp_name'];
		$location = 'images' . '/' . $imgName;
		move_uploaded_file($tmp_name, $location); //upload file
		$_POST['avatar'] = $imgName;
		$avatar['avatar'] = $_POST['avatar'];
		unset($_POST['submit']);

		$update_avatar  =  $obj->Update("tbl_teacher_login", $_POST, "tid", array($edit_id));
		
		// $obj->Query("UPDATE tbl_teacher_login set avatar= $avvatar where email = '$teacher_table_email'");

		$tname_e =  $_POST['tname'];
		$taddress_e = $_POST['taddress'];
		$tphone_e = $_POST['tphone'];

		print_r($tname);
		print_r($taddress);
		print_r($tphone);
		// die;

		$update_details =  $obj->Query("UPDATE tbl_teacher SET tname = $tname_e,temail = $t_email_e, tphone = $tphone_e  where temail  =  $teacher_table_email");

		if ($update_details) {

			echo "<script>alert('Profile updated successfully');</script>";
			echo "<script> window.location.href='" . base_url('teacherprofile.php') . "'</script>";
		}
	}
}

//   print_r($_SESSION);



// if (!$edit) {
//     echo "<script> window.location.href='" . base_url('edit_student_profile.php') . "'</script>";
// }




?>




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
						$username = $_SESSION['posted_by'];

						$image_query = $obj->Query("SELECT * from tbl_teacher_login where username =  '$username'");
						$user_avatar = $image_query[0]->avatar;
						?>
						<img src="<?= base_url('images/' . $user_avatar) ?>" class="rounded-circle d-inline-flex img-thumbnail" style="width: 105px;height: 105px;border-radius: 50%;">
						<div class="p-2">
							<div class="form-group">
								<input type="file" name="avatar" required>
							</div>

							<div class="row d-block px-3 my-2">
								<div class="form-group">
									<label for="Name">Name</label>
									<input type="text" name="tname" class="form-control" id="Name" required value="<?= $tname ?>">

								</div>

								<div class="form-group">
									<label for="Address">Address</label>
									<input type="text" name="taddress" class="form-control" id="Address" required value="<?= $taddress ?>">

								</div>

								<div class="form-group">
									<label for="Phone">Phone</label>
									<input type="text" name="tphone" class="form-control" id="Phone" required value="<?= $tphone ?>">

								</div>
							</div>

							<button class="btn btn-success" name="submit" value="update">Update</button>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>


<style>
	label {
		font-weight: bold;
	}

	footer {
		display: none;
	}
</style>