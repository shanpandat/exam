<?php 
    if(isset($_SESSION['user']))
    {
        $faculty_id=$_SESSION['user'];
        $tbl_name="tbl_faculty";
        $where="faculty_id='$faculty_id'";
        $query=$obj->select_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        $count_rows=$obj->num_rows($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $faculty_name=$row['faculty_name'];
            $username=$row['username'];
            $password=$row['password'];
            $time_duration=$row['time_duration'];
            $qns_per_set=$row['qns_per_set'];
        }
        else
        {
            header('location:'.SITEURL.'admin/login.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=logout');
    }
?>
<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    <!--
                    <form method="post" action="" class="forms">
                        <h2>Update App Details</h2>
                        -->
                        <?php 
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                            if(isset($_SESSION['invalid']))
                            {
                                echo $_SESSION['invalid'];
                                unset($_SESSION['invalid']);
                            }
                            if(isset($_SESSION['password']))
                            {
                                echo $_SESSION['password'];
                                unset($_SESSION['password']);
                            }
                            if(isset($_SESSION['not_match']))
                            {
                                echo $_SESSION['not_match'];
                                unset($_SESSION['not_match']);
                            }
                        ?>
                        <!--
                        <span class="name">App Name</span>
                        <input type="text" name="app_name" value="<?php echo $faculty_name; ?>" required="true" /><br />
                        
                        
                        <span class="name">Username</span>
                        <input type="text" name="username" value="<?php echo $username; ?>" required="true" /><br />
                        
                       
                       <span class="note">Note: Please Enter Your Current Password To Make Changes.</span><br />
                       
                        <span class="name">Current Password</span>
                        <input type="password" name="current_password" placeholder="Current Password" required="true" /><br />
                        
                        
                        <input type="submit" name="submit" value="Update Settings" class="btn-update" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php"><button type="button" class="btn-delete">Cancel</button></a>
                    </form>
                    <hr />
                    -->
                    <?php 
                        if(isset($_POST['submit']))
                        {
                            //echo "Clicked";
                           $app_name=$obj->sanitize($conn,$_POST['app_name']);
                           $username=$obj->sanitize($conn,$_POST['username']);
                           $current_password=$obj->sanitize($conn,$_POST['current_password']);
                           
                           //Normal Validation
                           if(($app_name=="")or($username=="")or($current_password==""))
                           {
                                $_SESSION['validation']="<div class='error'>App Name or Email or Username or Contact or Password is Empty.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=fac_settings');
                           }
                           if($current_password==$password)
                           {
                                $tbl_name="tbl_faculty";
                            $data="
                                faculty_name='$faculty_name',
                                username='$username',
                            ";
                            $where="faculty_id=$faculty_id";
                            $query=$obj->update_data($tbl_name,$data,$where);
                            $res=$obj->execute_query($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['update']="<div class='success'>App details successfully updated.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=fac_settings');
                            }
                            else
                            {
                                $_SESSION['update']="<div class='error'>Failed to update app details.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=fac_settings');
                            }
                           }
                           else{
                            $_SESSION['invalid']="<div class='error'>Current Password did not match.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=fac_settings');
                           }
                        }
                    ?>
                </div>
                
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Change Password</h2>
                        
                        <span class="name">Current Password</span>
                        <input type="password" name="current_password" placeholder="Current Password" required="true" /><br />
                        
                        <span class="name">New Password</span>
                        <input type="password" name="new_password" placeholder="New Password" required="true" /><br />
                        
                        <span class="name">Confirm Password</span>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required="true" /><br />
                        
                        
                        <input type="submit" name="update" value="Update Password" class="btn-update" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php"><button type="button" class="btn-delete">Cancel</button></a>
                    </form>
                    
                    <?php 
                        if(isset($_POST['update']))
                        {
                            //echo "Clicked";
                            //Get Details from forms
                            $new_password=$obj->sanitize($conn,$_POST['new_password']);
                            $confirm_password=$obj->sanitize($conn,$_POST['confirm_password']);
                            $current_password=$obj->sanitize($conn,$_POST['current_password']);
                            if($current_password==$password)
                            {
                                if($new_password==$confirm_password)
                                {
                                    $tbl_name='tbl_faculty';
                                    $data="password='$new_password'";
                                    $where="faculty_id='$faculty_id'";
                                    $query=$obj->update_data($tbl_name,$data,$where);
                                    $res=$obj->execute_query($conn,$query);
                                    if($res==true)
                                    {
                                        $_SESSION['password']="<div class='success'>Password changed successfully.</div>";
                                        header('location:'.SITEURL.'admin/index.php?page=fac_settings');
                                    }
                                    else
                                    {
                                        $_SESSION['password']="<div class='error'>Failed to change password. Try again.</div>";
                                        header('location:'.SITEURL.'admin/index.php?page=fac_settings');
                                    }
                                }
                                else
                                {
                                    $_SESSION['not_match']="<div class='error'>New Password and Confirm Password did not match.</div>";
                                    header('location:'.SITEURL.'admin/index.php?page=fac_settings');
                                }
                            }
                            else
                            {
                                $_SESSION['not_match']="<div class='error'>Current Password did not match.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=fac_settings');
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->