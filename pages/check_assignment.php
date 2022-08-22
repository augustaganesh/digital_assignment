<?php

if (!isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
    header('location:teacher_login.php');
}
$name = str_replace('%20', ' ', $_GET['student']);


$remarksData = $obj->Select("tbl_submit_assignment", "*", "id", array($_GET['id']));
$getAssiId = $obj->Select("tbl_submit_assignment", "*", "id", array($_GET['id']));
$assignment_id = $getAssiId['0']['assignment'];

// print_r($assignment_id);

// if (isset($_POST['submit']) && $_POST['submit'] == 'done') {
//     unset($_POST['submit']);
//     print_r($_POST);
//     $obj->Query("UPDATE tbl_submit_assignment set status = '1' where assignment = $assignment_id");
//     echo "<script> window.location.href='" . base_url('teacher_section.php') . "'</script>";
// }

if(isset($_POST['submit']) && $_POST['submit'] == 'done'){
    unset($_POST['submit']);
    $_POST['status'] = 1;
    $obj->update("tbl_submit_assignment",$_POST,"  submitted_by = '".$name."' AND assignment",array($assignment_id)) ;
		echo "<script> window.location.href='".base_url('teacher_section.php')."'</script>";
}


?>
<?php include('teacherheader.php'); ?>


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card-header">
                <h4>Question</h4>
                <?php if ($remarksData) { ?>
                    <?php foreach ($remarksData as $key => $value) : ?>
                        <?php
                        $assignment_str = $obj->Select("tbl_create_assignment", "*", "id", array($remarksData['0']['assignment']));
                        $assignment_title =  $assignment_str['0']['title'];
                        ?>


                        <?= $assignment_title //assignment name
                        ?>
                        <hr>
                        <span>Submitted by :</span>
                        <h4> <?= $value['submitted_by']; ?></h4>

                        <hr>
                        <span>Ans:</span>
                        <?php if ($value['file'] != '') { ?>
                            <a href="submit_assignment/<?= $value['file']; ?>"><img src="submit_assignment/<?= $value['file']; ?>" class="img-fluid"></a>
                        <?php  } else {
                            echo "No file attached";
                        } ?>

                    <?php endforeach ?>
                <?php } ?>

            </div>
        </div>
        <div class="col-md-8 shadow p-4">

            <form action="" method="post" class="form-group p-3">
                <div class="row mb-3">
                    <div class="col-7">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="5" style="width:5%" aria-valuemin="0" aria-valuemax="10"></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grade" id="exampleRadios1" value="Very bad ! Not accepted">
                            <label class="form-check-label" for="exampleRadios1">
                                Very bad ! Not accepted
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-7">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grade" id="exampleRadios2" value="Bad! Needs lot of improvization">
                            <label class="form-check-label" for="exampleRadios2">
                                Bad! Needs lot of improvization
                            </label>
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-7">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grade" id="exampleRadios3" value="Good ! But you can do it better.">
                            <label class="form-check-label" for="exampleRadios3">
                                Good ! But you can do it better.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-7">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grade" id="exampleRadios4" value="Very Good! Keep it up.">
                            <label class="form-check-label" for="exampleRadios4">
                                Very Good! Keep it up.
                            </label>
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-7">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="grade" id="exampleRadios5" value="Excellent !! So proud of you.">
                            <label class="form-check-label" for="exampleRadios5">
                                Excellent!! So proud of you.
                            </label>
                        </div>
                    </div>
                </div>


                <h5 class="text-left pb-1">Give a suggestion</h5>
                <textarea name="suggestion" id="" rows="5" class="form-control" required="required"></textarea>
                <br>
                <button class="btn btn-success" type="submit" name="submit" value="done">Done</button>
            </form>

        </div>
    </div>
</div>
<div style="height:40vh">
</div>