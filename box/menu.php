<?php 
    if(!isset($_SESSION['user']))
    {
        $_SESSION['xss']="<div class='error'>Please login to access control panel</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>
<!--Navigation Starts Here-->
        <nav class="menu">
            <div class="wrapper">
                
                <ul>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=home"><li>Home</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=students"><li>Students</li></a>
                   <?php
                      if($_SESSION['user']=="admin")
                      {
                    ?>

                    <a href="<?php echo SITEURL; ?>admin/index.php?page=faculties"><li>Faculties</li></a>
 
                    <?php
                      }
                    ?>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=questions"><li>Questions</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=results"><li>Results</li></a>
                    <?php
                    if($_SESSION['user']=="admin"){
                        ?>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=settings"><li>Settings</li></a>
                    <?php
                    }
                    else{
                        ?>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=fac_settings"><li>Settings</li></a>
                    <?php

                    }
                    ?>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=examination"><li>Examination</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=query"><li>Queries</li></a>
                    <a href="../box/about" target="_blank"><li>About Us</li></a>
                    <a href="<?php echo SITEURL; ?>admin/index.php?page=logout" onclick="return confirm('Are you sure?')"><li>Log Out</li></a>
                </ul>
            </div>
        </nav>
        <!--Navigation Ends Here-->