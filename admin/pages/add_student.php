<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms" enctype="multipart/form-data" >
                        <h2>Add Student</h2>
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
                        <input type="text" name="password" placeholder="Password" required="true"
                        pattern="(?=.*\d(?=.*[a-z])(?=.*[A-Z]).{8,}" title="at least one number and one uppercase and one lowecase, and atleast 8 or more characters" /><br />
                        
                        <span class="name">Contact</span>
                        <input type="tel" name="contact" placeholder="Contact Number" minlength="10" maxlength="10"/><br />
                        
                        <span class="name">Gender</span>
                        <input type="radio" name="gender" value="male" /> Male 
                        <input type="radio" name="gender" value="female" /> Female 
                        <input type="radio" name="gender" value="other" /> Other
                        <br />
        
                        <?php
                          if($_SESSION['user']=="admin"){

                          ?>
                        <span class="name">Faculty</span>
                        <select name="faculty">
                        
                            <?php 
                                //Get Faculty from database
                                $tbl_name="tbl_faculty";
                                $where="is_active='yes'";
                                $query=$obj->select_data($tbl_name,$where);
                                $res=$obj->execute_query($conn,$query);
                                $count_rows=$obj->num_rows($res);
                                if($count_rows>0)
                                {
                                    while($row=$obj->fetch_data($res))
                                    {
                                        $faculty_id=$row['faculty_id'];
                                        $faculty_name=$row['faculty_name'];
                                        ?>
                                        <option value="<?php echo $faculty_id; ?>"><?php echo $faculty_name; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo("<option value='none'>NONE</option>");
                                }
                            ?>
                        </select>
                        <br />
                        <?php
                          }
                          ?>
                        <span class="name">Is Active?</span>
                        <input type="radio" name="is_active" value="yes" /> Yes 
                        <input type="radio" name="is_active" value="no" /> No
                        <br />
                        <span class="name">Image</span>
                        <input type="file" name="f1"  accept="images/*" >
                        </span>
                        <br />
                        
                        <input type="submit" name="submit" value="Add Student" class="btn-add" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=students"><button type="button" class="btn-delete">Cancel</button></a>
                    </form>
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
                            
                            if($_SESSION['user']=='admin'){
                                $faculty=$obj->sanitize($conn,$_POST['faculty']);
                            }
                            else{
                                $faculty=$_SESSION['user'];

                            }
                            if(isset($_POST['is_active']))
                            {
                                $is_active=$_POST['is_active'];
                            }
                            else
                            {
                                $is_active='yes';
                            }
                            $img=$_FILES["f1"]["name"];
                            $added_date=date('Y-m-d');
                            
                            //Backend Validation, Checking whether the input fields are empty or not
                            if(($first_name||$last_name||$email||$Username||$password)==null)
                            {
                                //SET SSESSION Message
                                $_SESSION['validation']="<div class='error'>First Name or Last Name, or Email or Username or Password is Empty.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=add_student');
                            }
                            $ext=end(explode('.',$_FILES['f1']['name']));
                            //Checking if the file type is valid or not
                            $valid_file=$obj->check_image_type($ext);
                            if($valid_file==false)
                            {
                                $_SESSION['add']="<div class='error'>Invalid Image type. Please use JPG or PNG or GIF file type.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=add_student');
                                die();
                            }
                        
                
                            
                            //Addding to the database
                            $tbl_name='tbl_student';
                            $data="first_name='$first_name',
                                    last_name='$last_name',
                                    email='$email',
                                    username='$Username',
                                    password='$password',
                                    contact='$contact',
                                    gender='$gender',
                                    faculty='$faculty',
                                    is_active='$is_active',
                                    image='$img',
                                    added_date='$added_date',
                                    updated_date=''";
                                    
                            $where="username='$Username'";
                            $query=$obj->select_data($tbl_name,$where);
                            $res=$obj->execute_query($conn,$query);
                            $count_rows=$obj->num_rows($res);
                            if($count_rows>0)
                                 {
                                        $_SESSION['validation']="<div class='error'>Username already exist.</div>";
                                        header('location:'.SITEURL.'admin/index.php?page=add_student');
                                }
                            else{
                            $query=$obj->insert_data($tbl_name,$data);
                            $res=$obj->execute_query($conn,$query);
                            if($res===true)
                            {
                                move_uploaded_file($_FILES["f1"]["tmp_name"], "images1/".$_FILES["f1"]["name"]);
                                $_SESSION['add']="<div class='success'>New student successfully added.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=students');
                            }
                            else
                            {
                                $_SESSION['add']="<div class='error'>Failed to add new student. Try again.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=add_student');
                            }
                        
                
                        }}
                
                    ?>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->