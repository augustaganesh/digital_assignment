<?php
if (!isset($_SESSION['admin-status']) || $_SESSION['admin-status'] != 'loggedin') {
   echo "<script> window.location.href='" . base_url() . "'</script>";
}

if (isset($_GET['action'])) {
   if ($_GET['action'] == 'd') {
      $obj->Delete("tbl_teacher", "tid", array($_GET['id']));

      echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
   } elseif ($_GET['action'] == 'inactive') {
      $status['status'] = 0;
      $obj->Update("tbl_teacher", $status, "tid", array($_GET['id']));
      echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
   } elseif ($_GET['action'] == 'active') {
      $status['status'] = 1;
      $obj->Update("tbl_teacher", $status, "tid", array($_GET['id']));
      echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
   }
}
// add teacher
if (isset($_POST['submit'])) {
   $old = $_POST;
   $temail = $_POST['temail'];
   $tname = $_POST['tname'];

   $chek_teacher = $obj->Query("SELECT * FROM tbl_teacher where tname='$tname'");

   $check_email = $obj->Query("SELECT * FROM tbl_teacher where temail='$temail'");


   if ($chek_teacher) { ?> <style>
         .collapse {
            display: block !important;
         }
      </style> <?php $_SESSION['nameError'] = "Teacher is already Registered!"; ?> <?php } else if ($check_email) { ?> <style>
         .collapse {
            display: block !important;
         }
      </style> <?php $_SESSION['emailError'] = "Email already exists!"; ?>
<?php } else {
                                                                                    if ($_POST['submit'] == 'add') {
                                                                                       unset($_POST['submit']);

                                                                                       $obj->Insert("tbl_teacher", $_POST);
                                                                                       echo '<script>alert("Teacher added successfully")</script>';
                                                                                       echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
                                                                                    }
                                                                                 }
                                                                              }
?>
<!-- // assign teacher -->
<?php
if (isset($_POST['assign'])) {

   $tsem = $_POST['tsemester'];
   $tsub = $_POST['tsubject'];
   $tname = $_POST['tname'];


   $check = $obj->Query("SELECT * FROM tbl_teacher where tid='$tname'");

   $check_subject_exixts = $obj->Query("SELECT * from tbl_teacher where tsemester = '$tsem' and tsubject = '$tsub'");

   if ($check_subject_exixts) {
      $_SESSION['subError'] ="This Subject is already assigned to another teacher.";
      $msgTname = $check_subject_exixts[0]->tname;

      $msg_sub = $check_subject_exixts[0]->tsubject;
      $msg_sub_query = $obj->Select("addsubject", "*", "sub_id", array($msg_sub));
      $msgTsub = $msg_sub_query[0]['subjectname'];


      $msg_sem = $check_subject_exixts[0]->tsemester;
      $msg_sem_query = $obj->Select("semesters", "*", "id", array($msg_sem));
      $msgTsem = $msg_sem_query[0]['name'];
   } else {

      if ($_POST['assign'] == 'Assign') {
         $_POST['tname'] = $check[0]->tname;
         $_POST['temail'] = $check[0]->temail;
         $_POST['taddress'] = $check[0]->taddress;
         $_POST['tphone'] = $check[0]->tphone;
         $_POST['status'] = 1;

         $del_unassigned_tname = $_POST['tname'] = $check[0]->tname;
         // print_r($del_unassigned_tname);
         // print_r($tsem);

         // print_r($_POST);
         unset($_POST['assign']);
         $obj->Insert("tbl_teacher", $_POST);


         $del_unassigned = $obj->Query("SELECT * from tbl_teacher where tname = '$del_unassigned_tname' and tsubject=0");

         if($del_unassigned){
            $del_unassigned_sub = $del_unassigned['0']->tsubject; 
            print_r($del_unassigned_sub);
   
               
            $del_unassigned = $obj->Query("DELETE from tbl_teacher where tname = '$del_unassigned_tname' and tsubject = '$del_unassigned_sub'");
   
            if($del_unassigned){
               echo '<script>alert("deleted!")</script>';
            }
            else {
            echo "";
            }
         }
        
         echo '<script>alert("Teacher assigned successfully")</script>';
         echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
      }
   }
}




//update Teacher 
if (isset($_POST['updateTeacher'])) {
   if ($_POST['updateTeacher'] == 'update') {
      unset($_POST['updateTeacher']);
      $tid = $_POST['tid'];
      // print_r($_POST);
      $obj->Update("tbl_teacher", $_POST, "tid", array($tid));
      echo '<script>alert("Data updated successfully")</script>';
      echo "<script> window.location.href='" . base_url('add_teacher.php') . "'</script>";
   }
}


$teachers = $obj->select('tbl_teacher', '*', '', array(), ' GROUP by tname ORDER BY status');

$v_teachers = $obj->select('tbl_teacher', '*', '', array(), 'ORDER BY tid desc ');

// $v_teachers = $obj->select('tbl_teacher', '*', '', array(),'GROUP by tname desc');



$subject = $obj->select('addsubject');
$semester = $obj->Query("SELECT * from semesters order by name asc");
?> <div class="container">
   <br>
   <div class="row">
      <div class="col-md-3 shadow-sm p-3">
         <div>
            <div class="card">
               <button class="btn btn-info bg-info text-light font-weight-bold" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus"></i> &nbsp;Add new teacher</button>
               </button>
            </div>
            <div class="collapse" id="collapseExample">
               <div class="card-body bg-white shadow-sm">
                  <form action="" method="post" class="form-group">
                     <div class="form-group">
                        <label>Teacher's Name</label>
                        <input type="text" name="tname" class="form-control">
                        <a class="text-primary"> <?php if (isset($_SESSION['nameError'])) {
                                                      echo $_SESSION['nameError'];
                                                      unset($_SESSION['nameError']);
                                                   } ?></a>
                     </div>
                     <div class="form-group">
                        <label>Teacher's Email</label>
                        <input type="text" name="temail" class="form-control">
                        <a class="text-primary"> <?php if (isset($_SESSION['emailError'])) {
                                                      echo $_SESSION['emailError'];
                                                      unset($_SESSION['emailError']);
                                                   } ?></a>
                     </div>
                     <div class="form-group">
                        <label>Teacher's Address</label>
                        <input type="text" name="taddress" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Teacher's Phone</label>
                        <input type="text" maxlength="10" id="phone" name="tphone" class="form-control" pattern="\d{10}" title="Please enter exactly 10 digits" />

                        <!-- <input type="number" id="phone" name="tphone" class="form-control" maxlength="10" pattern="[7-9]{1}[0-9]{9}"> -->
                     </div>
                     <!-- <script>
                        
                        function validation(){
                           let x = document.forms["check"]["tphone"].value;
                           if(x.length!=10){
                              alert ('Phone Number must be exactly 10 digits.');
                              return false;
                           }
                                                }
                     </script> -->

                     <div class="form-group mb-3">
                        <label class="font-weight-bold" for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                        </select>
                     </div>
                     <button class="btn btn-success" name="submit" value="add">Add</button>
                  </form>
               </div>
            </div>
         </div>




         <!-- //Assign subject teacher  -->
         <div class="card card-header bg-secondary font-weight-bold mt-4">
            <i class="fad fa-chalkboard-teacher fa-2x"></i> Assign Subject Teacher ? </button>
         </div>
         <div class="card-body bg-light shadow">
            <form action="" method="POST">
               <div class="form-group">
                  <label>Teacher</label>
                  <select class="form-control" name="tname" required>
                     <option selected disabled value="">Choose a teacher</option> <?php if ($teachers) { ?>
                        <?php foreach ($teachers as $key => $value) : ?> <option value="<?= $value['tid']; ?>">
                              <?= $value['tname']; ?> </option> <?php endforeach; ?> <?php  }  ?>
                  </select>
               </div>
               <div class="form-group">
                  <label>Semester</label>
                  <select class="form-control" name="tsemester" required onchange="studentAssignment(this.value)">
                     <option selected disabled value="">Choose a semester</option> <?php if ($semester) { ?>
                        <?php foreach ($semester as $key => $value) : ?>
                            <option value="<?= $value->id; ?>">
                              <?= $value->name; ?> </option> <?php endforeach; ?> <?php  }  ?>
                  </select>
               </div>
               <div class="form-group" id="studentAssignment">
                  
                   <?php if (isset($_SESSION['subError'])) { ?> <div class="alert alert-primary p-2 my-2">
                        <span> <?php
                                 echo $_SESSION['subError'];
                                 unset($_SESSION['subError']);
                                 ?> </span>
                        <span class="text-info small" href="#" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2" style="cursor: pointer;"><strong><i> More Info </i></strong></span>
                        <div class="collapse" id="collapseExample2">
                           <div class="bg-light p-2 text-dark small">
                              <strong><?= $msgTname ?></strong> teaches <strong><?= $msgTsub ?></strong> in <i><?= $msgTsem ?> semester.</i>
                           </div>
                        </div>
                     </div> <?php  } ?>
               </div>

               <button class="btn btn-success btn-block" type="submit" name="assign" value="Assign">Assign</button>
            </form>
         </div>
      </div>
      <div class="col-md-8 columnhead pt-3" style="min-height:85vh;"> <?php if ($v_teachers) { ?> <div class="col-md-12">
         <h5 class="font-weight-bold pb-3 text-left">Filter Teacher (Semester-wise)</h3>
                  <ul class="list-unstyled sem-nav d-flex">
                     <?php $semCounter = sizeof($semester);
                                                                              $semIdx = 0;
                     ?>

                     <li><a class="btn btn-light" href="<?= base_url('add_teacher.php') ?>">
                           All</a>
                     </li>

                     <?php foreach ($semester as $key => $value) : ?>

                        <li class="mx-2"> <button class="btn btn-light active" onClick="semFunction('<?= $value->id; ?>','<?= $semIdx; ?>')">
                              <?= $value->name; ?></button>
                        </li>
                     <?php endforeach; ?>
                  </ul>
               <span class="float-right text-light pb-4 position-absolute" style="top:0;right:18px"> <input type="text" class="form-control" name="search" id="mysearch" placeholder="&#128270; search teachers..">
               </span>
               <br>
               <div class="card-header bg-info ">
                     <h4 class="font-weight-bold text-white">
                        All Teachers
                     </h4>
               </div>
               <table class="table table-hover table-responsive-lite " id="teacherSem_wise">
                  <thead>
                     <tr style="background: #f9f9f9;">
                        <th>SN</th>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th colspan="1" class="text-center">Action</th>
                     </tr>
                  </thead>
                  <tbody> <?php foreach ($v_teachers as $key => $value) : ?>

                        <tr>
                           <td><?= ++$key ?></td>
                           <td><a href="teacher_view_more.php?tid=<?= $value['tid']; ?>" class="text-info font-weight-bold"><?= $value['tname']; ?></a></td>
                           <td class="text-nowrap"> <?php
                                                                                 $sem_query = $obj->Select("semesters", "*", "id", array($value['tsemester']));

                                                                                 if ($sem_query && $sem_query[0]['name'] !== null) {
                                                                                    echo $sem_query[0]['name'];
                                                                                 } else { ?> <span class="border-bottom border-danger">
                                    Not assigned </span> <?php } ?> </span>
                           </td>
                           <td class="text-nowrap"> <?php
                                                                                 $sub_query = $obj->Select("addsubject", "*", "sub_id", array($value['tsubject']));

                                                                                 if ($sub_query && $sub_query[0]['subjectname'] !== null) {
                                                                                    echo $sub_query[0]['subjectname'];
                                                                                 } else { ?> <span class="border-bottom border-danger"> Not assigned </span> <?php } ?>
                           </td>
                           <td><?php
                                                                                 if ($value['status'] == 1) { ?> <a href="add_teacher.php?action=inactive&id=<?= $value['tid']; ?>"> <i class="fas fa-check-circle " style="color:green"></i></a>
                              <?php  } elseif ($value['status'] == 0) { ?> <a href="add_teacher.php?action=active&id=<?= $value['tid']; ?>"> <i class="fas fa-times-circle " style="color:red"></i></a>
                              <?php   }
                              ?>
                           </td>
                          
                          
                           <td><a href="<?= base_url('add_teacher.php?action=d&id=' . $value['tid']) ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>
                        </tr> <?php endforeach; ?>
                  </tbody>
               </table>
            </div> <?php } else { ?> <p class="p-3 text-primary">No teacher have been added yet !</p> <?php } ?> </div>
   </div>
</div>
<style>
   /* data-backdrop="false" */
   .modal-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 0;
   }

   .modal {
      z-index: 1;
   }

   .modal-backdrop {
      background-color: transparent;
   }

   .modal-content {
      box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
   }

   .modal-body {
      background-color: #fff;
   }
</style>
<script>
   function showFunction() {
      var div = document.getElementById("msg");
      div.classList.toggle('hidden');
   }
</script>
<script>
   function semFunction(data, i) {
      let counter = "<?= $semCounter; ?>";
      $.ajax({
         type: "POST",
         url: 'filtered-teacher.php',
         data: {
            tag: data

         },
         success: function(e) {
            $('#teacherSem_wise').html(e);

         }
      })
   }

   
  function studentAssignment(val) {
    // alert(val);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('studentAssignment').innerHTML = this.responseText;

        }
    }
    xhr.open('GET', 'ajax/getSubject.php?sem=' + val, true);
    xhr.send();
}



</script>
<script>
   //     $('#btn1').click(function() {
   //   // reset modal if it isn't visible
   //   if (!($('.modal.in').length)) {
   //     $('.modal-dialog').css({
   //       top: 0,
   //       left: 0
   //     });
   //   }
   //   $('#myModal').modal({
   //     backdrop: false,
   //     show: true
   //   });
   //   $('.modal-dialog').draggable({
   //     handle: ".modal-header"
   //   });
   // });
</script>