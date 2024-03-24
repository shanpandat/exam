<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<style>
form i {
    margin-left: -30px;
    cursor: pointer;
}
</style>
<?php
include('box/studentheader1.php');
?>
<div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms" enctype="multipart/form-data">
                        <h2>Registration</h2>
                        <?php 
                            if(isset($_SESSION['validation']))
                            {
                                echo $_SESSION['validation'];
                                unset($_SESSION['validation']);
                            }
                            if(isset($_SESSION['add']))
                            {
                                echo $_SESSION['add'];
                                unset($_SESSION['add']);
                            }
                        ?>
                        <span class="name">First Name</span> 
                        <input type="text" name="first_name" placeholder="First Name" required="true" /> <br />
                        
                        <span class="name">Last Name</span>
                        <input type="text" name="last_name" placeholder="Last Name" required="true" /><br />
                        
                        <span class="name">Email</span>
                        <input type="email" name="email" placeholder="Email Address" required="true" /><br />
                        
                        <span class="name">Username</span>
                        <input type="text" name="Username" placeholder="Username" required="true" minlength="5" /><br />
                        
                        <span class="name">Password</span>
                        <input type="password" name="password" id="password" placeholder="Password" required="true" 
                         pattern="(?=.*\d(?=.*[a-z])(?=.*[A-Z]).{8,}" title="at least one number and one uppercase and one lowecase, and atleast 8 or more characters" />
                         <i class="bi bi-eye-slash" id="togglePassword"></i>
                         <br>
                         
                        <span class="name">Contact</span>
                        <input type="tel" name="contact" placeholder="Contact Number" minlength="10" maxlength="10"/><br />
                        
                        <span class="name">Gender</span>
                        <input type="radio" name="gender" value="male" /> Male 
                        <input type="radio" name="gender" value="female" /> Female 
                        <input type="radio" name="gender" value="other" /> Other
                        <br>
                       
                        <span style="display:flex;margin-left:5px;" id="my_camera"></span>
                        <br/>
                        <span>
                            <input class="btn-add" style="margin-left:10px;" type=button required="true" value="Take Snapshot"  onClick="take_snapshot()" style="margin-left: 1%;">
                            <input type="hidden" name="image" class="image-tag" required="true">
                        </span>
                        <br>
                        <span id="results" style="Display:flex;margin-top:40px;margin-left:15px" >Your captured image will appear here...</span>

                       <br>

                       <span><input type="submit" name="submit" value="REGISTER" class="btn-add" onclick="return confirm('Are you sure?')" style="margin-left: 1%;" />
                       <a href="index.php"><input type="button" value="LOG IN" class="btn-add" ></input></a>
                        </span>
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
                        width: 300,
                        height: 200,
                        image_format: 'jpeg',
                        jpeg_quality: 90
                    });
  
                    Webcam.attach( '#my_camera' );
  
                    function take_snapshot() {
                    Webcam.snap( function(data_uri) {
                     $(".image-tag").val(data_uri);
                     document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                    } );
                    }
                    </script>


                    <?php 
                        if(isset($_POST['submit']))
                        {
                            //Getting Values from the form
                            $first_name=$obj->sanitize($conn,$_POST['first_name']);
                            $last_name=$obj->sanitize($conn,$_POST['last_name']);
                            $email=$obj->sanitize($conn,$_POST['email']);
                            $Username=$obj->sanitize($conn,$_POST['Username']);
                            $password=$obj->sanitize($conn,$_POST['password']);
                            $contact=$obj->sanitize($conn,$_POST['contact']);
                            if(isset($_POST['gender']))
                            {
                                $gender=$obj->sanitize($conn,$_POST['gender']);
                            }
                            else
                            {
                                $gender='male';
                            }
                            $img = $_POST['image'];
                            $folderPath = "admin/images1/";
  
                            $image_parts = explode(";base64,", $img);
                            $image_type_aux = explode("image/", $image_parts[0]);
                            $image_type = $image_type_aux[1];
                          
                            $image_base64 = base64_decode($image_parts[1]);
                            $fileName = uniqid() . '.png';
                            $file = $folderPath . $fileName;
                            file_put_contents($file, $image_base64);
                            $filesize=filesize($file);

                            if($filesize==0){
                                $_SESSION['validation']="<div class='error'>Image is required.</div>";
                                unlink($file);
                                header('location:'.SITEURL.'index.php?page=register');


                            }
                            else{
                          
                           
                          
                       
                    
                            
                            $added_date=date('Y-m-d');
                            
                            //Backend Validation, Checking whether the input fields are empty or not
                            if(($first_name||$last_name||$email||$Username||$password)==null)
                            {
                                //SET SSESSION Message
                                $_SESSION['validation']="<div class='error'>First Name or Last Name, or Email or Username or Password is Empty.</div>";
                                unlink($file);
                                header('location:'.SITEURL.'index.php?page=register');
                            }
                           else{

                            $tbl_name="tbl_student";
                            $where="username='$Username'";
                            $where1="email='$email'";
                            $query=$obj->select_data($tbl_name,$where);
                            $query1=$obj->select_data($tbl_name,$where1);
                            $res=$obj->execute_query($conn,$query);
                            $res1=$obj->execute_query($conn,$query1);
                            $count_rows=$obj->num_rows($res);
                            $count_rows1=$obj->num_rows($res1);
                            if($count_rows>0)
                            {
                                $_SESSION['validation']="<div class='error'>Username already exist.</div>";
                                unlink($file);
                                header('location:'.SITEURL.'index.php?page=register');
                            }
                            else if($count_rows1>0)
                            {
                                $_SESSION['validation']="<div class='error'>Email already exist.</div>";
                                unlink($file);
                                header('location:'.SITEURL.'index.php?page=register');
                            }
                            else{
                            
                            //Addding to the database
                            $tbl_name='tbl_student';
                            $data="first_name='$first_name',
                                    last_name='$last_name',
                                    email='$email',
                                    username='$Username',
                                    password='$password',
                                    contact='$contact',
                                    gender='$gender',
                                    image='$fileName',
                                    added_date='$added_date',
                                    faculty=0,
                                    updated_date=''";
                            $query=$obj->insert_data($tbl_name,$data);
                            $res=$obj->execute_query($conn,$query);
                            $_SESSION['add']='';
                            if($res===true)
                            {
                                
                                $_SESSION['add']="<div class='success'>Successfully Registered.</div>";
                                header('location:'.SITEURL.'index.php?page=register');
                            }
                            else
                            {
                                
                                $_SESSION['add']="<div class='error'>Failed to Registered. Try again.</div>";
                                unlink($file);
                                header('location:'.SITEURL.'index.php?page=register');
                            }
                    
                     

                    }}}}
                    ?>
                </div>
            </div>
        </div>

        <!--Body Ends Here-->