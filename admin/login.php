<?php 
    include('config/apply.php');
    include('../box/header.php');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<style>
    form i {
    margin-left: -30px;
    cursor: pointer;
}
</style>  

<!--Body Starts Here-->
        <div class="main">
            <div class="login">
                <form method="post" action="">
                    <h2>Admin/Faculty | Log In</h2>
                    <?php 
                        if(isset($_SESSION['validation']))
                        {
                            echo $_SESSION['validation'];
                            unset($_SESSION['vaidation']);
                        }
                        if(isset($_SESSION['fail']))
                        {
                            echo $_SESSION['fail'];
                            unset($_SESSION['fail']);
                        }
                        if(isset($_SESSION['xss']))
                        {
                            echo $_SESSION['xss'];
                            unset($_SESSION['xss']);
                        }
                    ?>
                    <input type="text" name="username" placeholder="Username" required="true" />
                    <input type="password" id="password" name="password" placeholder="Password" required="true" />
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                    <input type="submit" name="submit" value="Log In" class="btn-go" />
                    <input type="reset" name="reset" value="Reset" class="btn-exit" />
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
                <?php 
                    if(isset($_POST['submit']))
                    {
                        //echo "Clicked";
                        $username=$obj->sanitize($conn,$_POST['username']);
                        $password_db=$obj->sanitize($conn,$_POST['password']);
                        
                        if(($username=="")or($password=""))
                        {
                            $_SESSION['validation']="<div class='error'>Username or Password is Empty</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                        $tbl_name="tbl_app";
                        $tbl_name2="tbl_faculty";
                        $where="username='$username' AND password='$password_db'  AND is_active='yes'";
                        $query=$obj->select_data($tbl_name,$where);
                        $query1=$obj->select_data($tbl_name2,$where);

                        $res=$obj->execute_query($conn,$query);
                        $res1=$obj->execute_query($conn,$query1);

                        $count_rows=$obj->num_rows($res);
                        $count_rows1=$obj->num_rows($res1);
                        if($count_rows==1 )
                        {
                            $_SESSION['user']=$username;
                            $_SESSION['success']="<div class='success'>Login Successful. Welcome ".$username." to dashboard.</div>";
                            header('location:'.SITEURL.'admin/index.php');
                        }
                        elseif($count_rows1==1){
                            $where4="username='$username'";
                            $query4=$obj->select_data($tbl_name2,$where4);
                            $res4=$obj->execute_query($conn,$query4);
                            if($res4==true)
                            {
                                $row4=$obj->fetch_data($res4);
                                $faculty_name=$row4['faculty_name'];
                                $faculty_id=$row4['faculty_id'];
                                
                            }
                            $_SESSION['message']="welci";
                            $_SESSION['user']=$faculty_id;
                            $_SESSION['success']="<div class='success'>Login Successful. Welcome ".$faculty_name." to dashboard.</div>";
                            header('location:'.SITEURL.'admin/index.php?page=index.php');

                        }
                        else
                        {
                            $_SESSION['fail']="<div class='error'>Username or Password is invalid. Please try again.</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                    }
                ?>
            </div>
        </div>
        <!--Body Ends Here-->

<?php
    include('../box/footer.php');
?>