<?php include('studentheader.php') ?>


<?php

$s = $_SESSION['student'];

$a = $obj->Query("SELECT * FROM tbl_student where sname ='$s'");
$sem   = $a[0]->semester;
// print_r($sem);

$data = $obj->Query("SELECT * FROM tbl_create_assignment where semester ='$sem'  order by created_date desc");
// print_r($data);


?>
<style>
  .navbar {
    position: relative !important;
  }

  tr th {
    color: #fff !important;
    /*font-weight:500;*/
    /* font-family: nunito, sans-serif; */
  }

  #style th {
    padding: 8px;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    color: #fff !important;
    font-family: nunito;

  }

  #style td {
    font-family: nunito, sans-serif;
  }

  #style tr:hover {
    background: #f1f1f1 !important;
  }

  .titlehead {
    color: #aa6708;
    border: 1px solid #e7e7e7;
    border-left: 4px solid #aa6708;
    border-radius: 4px;
    padding: 16px;
    padding-left: 10px;
    margin-bottom: 1rem;
    font-family: poppins, sans-serif;
    font-weight: 500;

  }
</style>
<?php if ($data) {  ?>
  <div class="container-fluid" style="min-height:100vh"><br>
    <div class="row justify-content-center ">
      <div class="card bg-white border-0 shadow-sm d-none">
        <div class="w-100 d-flex">
          <div class="" style="width:10%">
            <div class="d-flex float-left flex-column justify-content-center" style="min-height:30vh">
              <img src="images/wow.png" alt="" class="d-flex rounded-circle m-3" style="width: 60px;height:60px">
              <h5 class="text-center text-wrap flex-wrap"></h5>
            </div>
          </div>
          <div style="width:80%">
            <div class="card card-body my-3">
              <p class="mb-2">Assignment <span class="ml-3"> Date</span></p>
              <h4>What is Science Fiction?</h4>
              <!-- <img src="images/wow.png" alt="" class="img-fluid w-25 h-25"> -->
              <span class="position-absolute" style="right:55px">Due </span>
              <p class="qn"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum vitae, error nemo quam quidem nisi asperiores possimus, cumque expedita dignissimos reiciendis iure impedit est, culpa sint vero iusto autem reprehenderit.
              </p>

              <div class="ans">
                <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  Post Answer
                </button>

                <div class="collapse" id="collapseExample">
                  <div class="form-group">
                    <label style="font-family: nunito, sans-serif;font-weight:600">Write an answer</label><br>
                    <textarea rows="3" cols="50" name="description" id="assignment_desc" required="required" class="form-control"></textarea>

                    <a style="color:red" id="descError"></a>
                  </div>
                  <i class="fas fa-link"></i> Attach
                </div>



              </div>
            </div>


          </div>
        </div>

      </div>

      <div class="col-sm-12">
        <h4 class="bg-light p-3">Assignments</h4>

        <div class="table-responsive">
          <table id="style" class="table table-bordered text-center table-hover table-responsive-lite">

            <tr style="position:sticky;top:0;background:darkslategray!important;">
              <th>SN</th>
              <th>Assigned By</th>
              <th>Subject</th>
              <th>Assignment</th>
              <th>Issued Date</th>
              <th>Deadline</th>
              <th>File</th>
              <th>Submit ?</th>
            </tr>


            <?php foreach ($data as $key => $value) : ?>
              <tr class="bg-white">
                <td><?= ++$key; ?></td>

                <td>
                  <?php
                  $avatar_qr = $obj->select('tbl_teacher_login', '*', "username", array($value->posted_by));
                  $avatar = $avatar_qr[0]['avatar'];


                  ?>
                  <img src="images/<?= $avatar ?>" class="rounded-circle img-thumbnail" style="width:50px;height:50px">
                  <h6 class="font-weight-bold"><?= $value->posted_by; ?></h6>

                </td>
                <td>
                  <?php
                  $sub_qr = $obj->select('addsubject', '*', "sub_id", array($value->subject));
                  $sub = $sub_qr[0]['subjectname'];
                  ?>
                  <?= $sub ?>
                </td>
                <td >
                <h5><?= $value->title; ?></h4>
                <p >
                <?= $value->description; ?>
                </p>
                </td>
                <td><?= $value->created_date; ?></td>
                <td><?= $value->deadline; ?></td>
                <td>
                  <?php if ($value->file != '') { ?>
                    <a href="create_assignment/<?= $value->file; ?>"><img src="create_assignment/<?= $value->file; ?>" alt="Assignment" width="100px"></a>
                  <?php  } else {
                    echo "";
                  } ?>
                </td>
                <td><a href="<?= base_url('submit_assignment.php?id=' . $value->id); ?>">
                    <button class="btn btn-outline-info font-weight-bold">Submit <i class="fas fa-send"></i></button>

                  </a>

                  <!-- Button trigger modal -->
                  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop<?= $value->id ?>">
                    Submit
                  </button> -->

                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop<?= $value->id ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">

                      <div class="modal-content float-left">
                        <form action="" method="POST">
                          <div class="modal-header">
                            <h5 class="modal-titsle" id="staticBackdropLabel">
                              <?= $value->title; ?>
                            </h5>

                            <p class="p-1">
                              <?= $value->description; ?>
                            </p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body text-left">
                            <div class="uploadd-btn-wrapper">
                              <span class="btnn"><i class="fas fa-link"></i> Attach a file </span>
                              <input type="file" name="myfile" required />
                            </div>

                            <style>
                              .upload-btn-wrapper {
                                position: relative;
                                overflow: hidden;
                                display: inline-block;
                              }

                              .btnn {
                                color: gray;
                                background-color: white;
                                padding: 8px 20px;
                                border-radius: 8px;
                                font-size: 18px;
                                font-weight: bold;
                              }

                              .upload-btn-wrapper input[type=file] {
                                font-size: 100px;
                                position: absolute;
                                left: 0;
                                top: 0;
                                opacity: 0;
                              }
                            </style>

                          </div>
                          <div class="modal-footer text-left">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                          </div>
                        </form>
                      </div>

                    </div>
                  </div>

                </td>
              </tr>
            <?php endforeach; ?>
          </table>

        </div>

      </div>
        
      </div>
      

    </div>
  </div>
  </div>

<?php } else { ?>
  <div style="height:100vh">
    <h5 style="color:red" class="ml-4 mt-4 text-center">No teacher have created any assignment!</h5>
  </div>
<?php } ?>


<script>
  function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {
      type: "text/csv"
    });

    // Download link
    downloadLink = document.createElement("a");
    downloadLink.download = filename;

    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
  }


  function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 0; i < rows.length; i++) {
      var row = [],
        cols = rows[i].querySelectorAll("td, th");

      for (var j = 0; j < cols.length; j++)
        row.push(cols[j].innerText);

      csv.push(row.join(","));
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
  }
</script>