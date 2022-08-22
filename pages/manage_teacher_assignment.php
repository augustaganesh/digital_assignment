<?php
if (!isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] != 'true') {
    header('location:teacher_login.php');
}

$t_sem = $_GET['sem'];
$t_sem_str = $obj->select('semesters', '*', 'name', array($t_sem));
$t_sem_id = $t_sem_str[0]['id'];

$t_sub = $_GET['sub'];

$tname = $_SESSION['posted_by'];

$data = $obj->Query("SELECT * from tbl_create_assignment where semester = '$t_sem_id' and subject = $t_sub and posted_by ='$tname' order by id desc");


$target = "manage_teacher_assignment.php?sem=$t_sem&sub=$t_sub";


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        // print_r($_GET['id']);
        $obj->Delete("tbl_create_assignment", "id", array($_GET['id']));

        echo "<script> window.location.href='" . base_url($target) . "'</script>";
    }
}
?>
<?php include('teacherheader.php') ?>

<style>
    .navbar {
        position: relative !important;
    }

    tr th {
        color: #fff !important;

        /*font-weight:500;*/
        /* font-size: 5px!important; */
        /*font-family: nunito, sans-serif;*/
    }

    a {
        cursor: pointer;
        text-decoration: none !important;
    }

    #style th {
        padding: 8px;
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        color: #fff !important;
        font-family: roboto, sans-serif;

    }

    #style td {
        text-align: center;
        font-family: nunito, sans-serif;
    }

    .detailview {
        border: 1px solid #e7e7e7;
        border-left: solid 4px orange;
        border-radius: 4px;
    }

    .detailview h6 {
        line-height: 1.6;
    }

    .sname {
        font-family: nunito, sans-serif;
    }
</style>

<!------------------ For modal (to display total student)----------->

<div class="modal fade bs-example-modal-lg" tabindex="10000" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white" style="font-size:30px!important;"><i class="fas fa-close"></i></span>
                </button>

                <div class="modal-content">
                    <h5 class="modal-title pl-2 pt-2" style="border-bottom: 2px solid #e7e7e7;padding:3px;font-family: nunito;padding-left: 3rem;">Student List</h5>


                    <div class="modal-body" style="margin-top:-15px!important;">
                        <?php if ($students) { ?>
                            <?php foreach ($students as $key => $value) : ?>
                                <li class="sname" type="1"><?= $value['sname']; ?></li>
                            <?php endforeach; ?>
                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!------------------------------End--------------------------->

<?php if ($data) {  ?>
    <br>
    <div class="container pt-2" style="min-height: 100vh;">
        <h4 style="font-family:nunito, sans-serif;font-weight: bold; color:darkslategrey;">Created Assignments</h4><br>
        <!-- <h6>Note* : Click <code>view</code> in the table below to see student's activity on relative assignment.</h6><br> -->

        <div class="contsainer detasilview" style="font-family:nunito, sans-serif;">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'check_total') {

                $total_count =  $obj->Query("SELECT COUNT(id) as total_nums FROM tbl_submit_assignment WHERE assignment = " . $_GET['aid']);

                $total_stu = $obj->Query("SELECT count(*) as total from tbl_student");
                $remaining = $total_stu[0]->total - $total_count[0]->total_nums;

            ?>

                <h6> Total Students :
                    <!-----------target in up------------------->
                    <a class="text-dark"> &nbsp;<?= $total_stu[0]->total; ?></a>
                    <a class="text-primary ml-2" style="background: snow;padding: .5rem;" data-toggle="modal" data-target=".bs-example-modal-lg">View </a>
                </h6>

                <h6>No of Student who have submitted : <a class="text-dark"><?= $total_count[0]->total_nums; ?></a><a class="text-primary ml-2" href="<?= base_url('view_students_assignment.php'); ?>">View </a>
                </h6>

                <h6>No of Student who haven't submitted : <a href="##" class="text-dark"><?= $remaining ?></a>
                </h6>
            <?php }
            ?>
        </div>
        <style>
            body {
                background: #f9f9f9 !important;
            }
        </style>

        <div class="row">
            <table id="style" class="table table-bordered table-hover table-responsive-lite">
                <tr style="position: sticky; top:0;background:darkslategrey!important;">
                    <th>SN</th>
                    <th> Assignment Title</th>
                    <th>Question</th>
                    <th>Posted Date</th>
                    <th>Deadline</th>

                    <!-- <th>Posted by</th>  -->
                    <th colspan="2">Action</th>
                </tr>
                <?php foreach ($data as $key => $value) : ?>

                    <tr>
                        <td><?= ++$key; ?></td>
                        <td><?= $value->title; ?></td>
                        <td>
                            <?php if ($value->file != '') { ?>
                                <a href="create_assignment/<?= $value->file; ?>"><img src="create_assignment/<?= $value->file; ?>" alt="Assignment" width="100px"></a>
                            <?php  } else {
                                echo "No file attached";
                            } ?>
                        </td>
                        <td><?= $value->created_date; ?></td>
                        <td><?= $value->deadline; ?></td>

                        <!-- <td><?= $value->posted_by; ?></td> -->
                        <td>
                            <a href="edit_assignment.php?action=e&id=<?= $value->id; ?>&sem=<?=$t_sem?>&sub=<?=$t_sub;?>" class="text-primary font-weight-bold"><i class="fas fa-edit"></i> </a>
                            
                        </td>

                        <td class="d-none">
                            <a  href="manage_teacher_assignment.php?id=<?=$value->id?>&action=d&sem=<?=$t_sem?>&sub=<?=$t_sub;?>&view_assignment" class="text-danger font-weight-bold" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i> </a>

                        </td>

                        <td>
                            <a href="<?= base_url('view_students_assignment.php?action=detail&aid=' . $value->id) ?>" class=" text-dark font-weight-bold"><i class="fas fa-eye"></i> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

<?php } else { ?>
    <div style="height:100vh">
        <h4 style="color:red" class="ml-4 mt-4 text-center">Looks like you've not created any assignment.</h4>
        <p class="text-center"><a href="create_assignment.php?sem=<?=$t_sem?>&sub=<?=$t_sub;?>&create_assignment"> <i class="fas fa-plus"></i> Create Assignment</a></p>
    </div>
<?php } ?>