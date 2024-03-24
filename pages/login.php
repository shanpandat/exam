<!--Body Starts Here-->
<?php
include('box/studentheader1.php');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<style>
    form i {
    margin-left: -30px;
    cursor: pointer;
}
</style>  
   <style>
        #reg{
            width:274px;
            height: 40px;
            margin-left:0px;
            margin-top:3px;
        }
    
    </style>
        <div class="main">
            <div class="login">
                <form method="post" action="">
                    <h2>Log In</h2>
                    <?php 
                        if(isset($_SESSION['invalid']))
                        {
                            echo $_SESSION['invalid'];
                            unset($_SESSION['invalid']);
                        }
                    ?>
                    <input type="text" name="Username" placeholder="Username" required="true" />
                    <input type="password" name="password" id="password" placeholder="Password" required="true" />
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                    <span id="my_camera" ></span>
                    <span>
                            <input type="hidden" name="image" class="image-tag" required="true">
                    </span>

                    <input type="submit" name="submit" value="Log In" class="btn-go" onClick="take_snapshot()" style="width: 274px;height: 37px;"/>
                    <a href="<?php echo SITEURL; ?>index.php?page=register"><button type="button" id="reg" class="btn-go" style="height: 37px;">Register</button></a>
                    <a href="pages\help\index.php"><button type="button" class="btn-exit" style="width:274px;height: 37px;margin-top:5px;margin-left:0px;">Help</button></a>
              
                </form>
                <script>
                            const togglePassword = document.querySelector("#togglePassword");
                            const password = document.querySelector("#password");

                             togglePassword.addEventListener("click", function () {
            
                            const type = password.getAttribute("type") === "password" ? "text" : "password";
                            password.setAttribute("type", type);
                            this.classList.toggle("bi-eye");
                            });
                        
                </script>
                  <script language="JavaScript">
                        Webcam.set({
                        width: 272,
                        height: 180,
                        image_format: 'jpeg',
                        jpeg_quality: 90
                    });
  
                    Webcam.attach( '#my_camera' );
  
                    function take_snapshot() {
                    Webcam.snap( function(data_uri) {
                     $(".image-tag").val(data_uri);
                     document.getElementById('my_camera').innerHTML = '<img src="'+data_uri+'"/>';
                    } );
                    }
                    </script>

               
                <?php 
                    if(isset($_POST['submit']))
                    {
                        //echo "CLicked";
                        //Get Values from forms
                        $Username=$obj->sanitize($conn,$_POST['Username']);
                        $password=$obj->sanitize($conn,$_POST['password']);
                        $logged_in='yes';
                        $img = $_POST['image'];
                        $folderPath = "admin/images1/";
  
                        $image_parts = explode(";base64,", $img);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                      
                        $image_base64 = base64_decode($image_parts[1]);
                        $fileName = uniqid() . '.png';
                        $file = $folderPath . $fileName;
                        file_put_contents($file, $image_base64);
  

                        //Check Login
                        $tbl_name="tbl_student";
                        $where="username='$Username' && password='$password' && is_active='yes' && Logged_In='no'";
                        $query=$obj->select_data($tbl_name,$where);
                        $res=$obj->execute_query($conn,$query);
                        $count_rows=$obj->num_rows($res);
                        if($count_rows>0)
                        {
                            $_SESSION['student']=$Username;
                            $currentDate=date('Y-m-d g:i:s');
                            mysqli_query($conn, "UPDATE tbl_student SET Login_time='$currentDate' WHERE username='$Username'");
                            mysqli_query($conn, "UPDATE tbl_student SET Logged_In='$logged_in' WHERE username='$Username'");
                            $_SESSION['login']="<div class='success'>Login Successful.</div>";
                            header('location:'.SITEURL.'index.php?page=welcome');
                        }
                        else
                        {
                            $_SESSION['invalid']="<div class='error'>Username or Password is invalid.</div>";
                            unlink($file);
                            header('location:'.SITEURL.'index.php?page=login');
                        }
                    }
                ?>
            </div>
        </div>
        <!--Body Ends Here-->