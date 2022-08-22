<?php 
if(!isset($_SESSION['isTeacher'] ) && $_SESSION['isTeacher']!='true'){
    header('location:teacher_login.php');

}
include('teacherheader.php') ;

if (isset($_GET['action'])) { ?>
<?php 
$a = $obj->Select("tbl_create_assignment","*","id",array($_GET['aid']));
// print_r($a);
$assi_id = $_GET['aid'];
// print_r($assi_id);
// echo "<br>";

$teacher_name = $a[0]['posted_by'];
// print_r($teacher_name);
$indi_assignment = $obj->Query("SELECT * from tbl_submit_assignment where assignment=$assi_id");
// print_r($indi_assignment);
?>



<style>
    .navbar{
        position: relative!important;
    }
         tr th{
        color:#fff!important;
        font-family: nunito, sans-serif;
        }
    
        #style th {
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            color:#fff!important;
            font-family: nunito;

          }
          #style td{
            font-family: nunito, sans-serif;
          }
      </style>

<?php if($indi_assignment) {  ?>   
<div class="container text-center pt-4" style="min-height: 100vh;">
       <h4 class="titlehead text-left">Students Assignment</h4>

    <div class="row">
        <div class="col-md-12">
        <table  id="style" class="table table-bordered table-responsive-lite table-hover">
        <tr style="position: sticky; top:0;background:darkslategrey;">
                <th>SN</th>
                <!-- <th>Subject</th> -->
                <th>Assignment Title</th>
                <th>Submitted By</th>
                <th>Submitted File</th>
                <th>Created Date</th>
                <th>Submitted Date</th>
              
                <th>Status</th>
         </tr>
        
            <?php foreach($indi_assignment as $key=>$value) : ?>
            <tr> 
                <td><?=++$key;?></td>
                <?php  
               
                 ?>
                <!-- <td><?=$value->subject;?></td> -->
                <td>
                    <?php
                   $tt = $obj->Select("tbl_create_assignment","*","id",array($value->assignment));
                   $assign_title = $tt['0']['title'];
                   $assign_cd = $tt['0']['created_date'];
                   ?>
                    <?=$assign_title?></td>
                <td><?=$value->submitted_by;?></td>
                <td>

                    <!-----------------------------Also review this.. Do not delete---->
                    <!-- <?php if($value->file != ''){ ?>
                    

                        <?php if(is_file($value->file) && file_exists($value->file)) { ?>
                        <a href="submit_assignment/<?=$value->file;?>">
                        <img src="submit_assignment/<?=$value->file;?>"
                            alt="Assignment" width="100px"></a>
                    <?php  }else{ ?>
                        <?=$value->file;?>

                   <?php  }


                }else{echo"No file attached";} ?> -->

                <!-------------------------------------------------------->


                <?php if($value->file != ''){ ?>
                    <a href="submit_assignment/<?=$value->file;?>"><img src="submit_assignment/<?=$value->file;?>"
                             width="100px"></a>
                    <?php  }else{echo"No file attached";} ?>
                </td>
                <td><?=$assign_cd;?></td>
                <td><?=$value->submitted_date;?></td>
                
                <td>
                    <?php if($value->status == 1){ ?>
                    <button class="btn btn-sm btn-success"><i class="far fa-check"></i> checked</button>
                    <hr>
                    <p>Remarks : <?=$value->suggestion?> </p>

                    <?php }  else{ ?>
                    <a class="btn btn-sm rounded-square btn-primary" href="<?=base_url('check_assignment.php?id='.$value->id.'&student='.$value->submitted_by);?>">&nbsp;&nbsp;&nbsp;Check&nbsp;&nbsp;&nbsp;</a>
                    
                    <?php }?>
                </td>

            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</div>
<?php }

    else { ?>
<div style="height:100vh">
<h5 style="color:red" class="ml-4 mt-4 text-center">Looks like no students have submitted any assignment !</h5>
</div>
<?php } ?>
        <?php } else { ?>
            <h5 class="text-danger text-center p-3">No students assignment found</h5>
            <div style="min-height:100vh"></div>
        <?php } ?>
