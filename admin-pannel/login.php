<?php  
 require_once ("config/config.php");
require_once ("config/db.php");
require_once root('layouts/header.php');

if(!empty($_POST) && $_POST['submit']=='submit'){
      
        $username=$_POST['username'];
        // $password=md5($_POST['password']);
        $password=$_POST['password'];

        $user_select=$obj->Query("SELECT * FROM tbl_admin WHERE email='$username' and password='$password'");
        
      if($user_select){
        $user_select= $user_select[0];
         session_start();
         
      $_SESSION['admin-status']="loggedin";
       $_SESSION['mainuser']=$user_select->username;
        $_SESSION['admin-login']='true';
       echo "<script>window.location.href='".base_url()."'</script>";

      }else {
        $_SESSION['error'] = "Invalid username or password!";
      }
      }

      $a = "Digital Assignment";


?>

<div style="height:10vh"></div>

<div class="container mt-2 bg-snow rounded" style="margin-top: 40px!important;font-family: roboto, sans-serif!important;">
    <div class="row justify-content-center">
        <div class="col-md-5 shadow-lg p-4 bg-white">
            <h4 class="pt-2"> <a href="<?= exit_url(); ?>" class="text-info"> <?= $a ?> </a> &#124; Admin Login </h4>
            <hr>
            <form class="form-group" method="post">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
                <label>Password</label>
                <input type="password" name="password" class="form-control" required id="Visible">

                
                <?php if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger my-2">
                                    <?php echo $_SESSION['error'];unset($_SESSION['error']);  ?>
                                </div>
                            <?php }  ?>

               
                <button class="btn btn-info btn-block mt-4" type="submit" name="submit" value="submit">Login </button><br>
                
            </form>
        </div>

    </div>
</div>



    <div class="container d-none">
              <div class="row justify-content-center">
                   <div class="col-md-6   shadow pb-4 pl-4 pr-4 pt-4">
                    <h3> Digital Assignment || Admin Login</h3><br>
                        <form method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                          
                            <button name="submit" value="submit" class="btn btn-sm btn-info mt-1">LOGIN
                                </button> 
                          <!--   <span><a href="forget_password.php">Forgot Password</span><br>
                                <br> -->
                                <br><br>

                        </form>
                   <!--  <span>Not have an account?</span>
                     <span class="ml-4" id="myBtn" style="cursor:pointer;"><a href="#">Sign Up</a></span>
 -->
                 </div>
             </div>
         </div>
           

 <!---------------Popup signup form-------------------->       

           <?php
        if(isset($_POST['submit']) && $_POST['submit'] == "Submit"){
                unset($_POST['submit']);
                $_POST['password'] = md5($_POST['password']);
                $obj->insert("tbl_admin",$_POST);
            }
            ?>      

        <style>
        .modal {
        display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
        }

        /* Modal Content */
        .modal-content {
            background: #fcfcfc;
            border: none!important;
          margin: auto;
          /*padding: 20px;*/
         }
        </style>
     <div class="container modal" id="myModal">
        <div style="height:13vh"></div>
        <div class="modal-content">
              <div class="row justify-content-center">
                <div class="col-md-3"></div>
                   <div class="col-md-6 shadow pb-4 pl-4 pr-4 pt-4">       
                         <h3 class="pb-4">Create a new account <span class="close"><i class="fas fa-close ml-4"></i></span></h3>
                        <form action="" method="post">
                        <div class="form-group">
                         <label>Username</label>
                         <input type="text" name="username" class="form-control" required>
        
                        </div>

                <div class="form-group">
                    <label>Email</label>
                     <input type="email" name="email" class="form-control " value="" required="required">
                </div>

                <div class="form-group">
                    <label>Password</label>
                        <input type="password" name="password" class="form-control " value="" required="required">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" name="submit" value="Submit">
                
                     </div>
                </form>
                 <span>Already have an account?</span>
                     <span class="ml-4" id="myBtn" style="cursor:pointer;"><a href="<?=base_url('admin-pannel');?>">Login</a></span>
             </div>
        </div>
    </div>
</div>
<!---------------Popup signup form End-------------------->



<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>