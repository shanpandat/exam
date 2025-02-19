
<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    <h2><u>Dash Board</u></h2>
                    
                    <?php 
                        if(isset($_SESSION['success']))
                        {
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        }
                        if(isset($_SESSION['fail']))
                        {
                            echo $_SESSION['fail'];
                            unset($_SESSION['fail']);
                        }
                    ?>
                    
                    <div class="clearfix">
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=students">
                            <div class="dash-tile">
                            <?php
                                    if($_SESSION['user']=="admin"){
                                ?>
                                
                                <h1><?php echo $obj->get_total_rows('tbl_student',$conn); ?></h1>
                                <?php
                                    }
                                    else{
                                        $temp=$_SESSION['user'];
                                        $where="faculty=$temp";
                                        ?>
                                 <h1><?php echo $obj->get_total_rows('tbl_student',$conn,$where); ?></h1>
                                 <?php
                                    
                                    }
                                ?>
                                <span>Students</span>
                            </div>
                        </a>
                        <?php
                        if($_SESSION['user']=="admin")
                        {

                        ?>
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=faculties">
                            <div class="dash-tile">
                                <h1><?php echo $obj->get_total_rows('tbl_faculty',$conn); ?></h1>
                                <span>Faculties</span>
                            </div>
                        </a>

                        <?php
                        }
                        else{
                        ?>
                         <a href="<?php echo SITEURL; ?>admin/index.php?page=examination">
                            <div class="dash-tile">
                              
                                <h1><?php echo $obj->get_total_rows('examination',$conn); ?></h1>
                               
                                <span>Examination</span>
                            </div>
                        </a>

                        <?php
                        }
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=questions">
                            <div class="dash-tile">
                            <?php
                                    if($_SESSION['user']=="admin"){
                                ?>
                                <h1><?php echo $obj->get_total_rows('tbl_question',$conn); ?></h1>
                                <?php
                                    }
                                    else{
                                        $temp=$_SESSION['user'];
                                        $where="faculty=$temp";
                                        ?>
                                 <h1><?php echo $obj->get_total_rows('tbl_question',$conn,$where); ?></h1>
                                 <?php
                                    
                                    }
                                ?>
                                <span>Questions</span>
                            </div>
                        </a>
                        
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=results">
                            <div class="dash-tile">
                            <?php
                                    if($_SESSION['user']=="admin"){
                                ?>
                                <h1><?php echo $obj->get_total_rows('tbl_result_summary',$conn); ?></h1>
                                <?php
                                    }
                                    else{
                                        $temp=$_SESSION['user'];
                                        $where="faculty=$temp";
                                        ?>
                                 <h1><?php echo $obj->get_total_rows('tbl_result_summary',$conn,$where); ?></h1>
                                 <?php
                                    
                                    }
                                ?>
                                <span>Results</span>
                            </div>
                        </a>
                        
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <!--Body Ends Here-->