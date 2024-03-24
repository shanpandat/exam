
<?php 

    include('check.php');
    include('box/studentheader1.php');
?>
<?php

$tbl_name4="tbl_student";
$username=$_SESSION['student'];
$where4="username='$username'";
$query4=$obj->select_data($tbl_name4,$where4);
$res4=$obj->execute_query($conn,$query4);
if($res4==true)
{
    $row4=$obj->fetch_data($res4);
    $student_id=$row4['student_id'];
    $first_name=$row4['first_name'];
    $last_name=$row4['last_name'];
    $faculty=$row4['faculty'];
    $full_name=$first_name.' '.$last_name;
}

$tbl_name_qns='tbl_faculty';
$where_qns="faculty_id='$faculty'";
$query_qns=$obj->select_data($tbl_name_qns,$where_qns);
$res_qns=$obj->execute_query($conn,$query_qns);
    if($res_qns==true)
    {
        $row_qns=$obj->fetch_data($res_qns);
        $type=$row_qns['type'];
       
        
        //echo $total_english;die();
    }

?>
<!--Body Starts Here-->


        <div class="main">
        
            <div class="content">
                <div class="welcome">
                    <?php 
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }
                        //Setting Time Limit Here
                        if(!isset($_SESSION['start_time']))
                        {
                            //$_SESSION['start_time']=
                        }
                    ?>
                    Hello <span class="heavy"><?php echo $full_name; ?></span>. Welcome to Exam Portal.<br />
                   
                    <div class="success">
                        <p style="text-align: left;">
                            Here are some of the rules and regulations of this app.<br />
                            1. This test is automated and you won't be able to return to previous question.<br />
                            2. Once you successfully login, you can't log back in unless the permission of system administrator.<br />
                            3. After you click on "Take a Test", the timer will start and it can't be paused or stopped.<br />
                            4. English questions will appear first and after you finish Englihs, you will be given Math question.
                        </p>
                    </div>

                    <?php
                    if($type=='Semester'){
                    ?>
                    
                    <a href="<?php echo SITEURL; ?>index.php?page=question">
                        <button type="button" class="btn-go">Semester</button></a>
                    </a>
                    <?php
                    }
                    elseif($type=='Sessional'){
                        ?>
                    <a href="<?php echo SITEURL; ?>index.php?page=question">
                        <button type="button" class="btn-go">Sessional</button></a>
                    </a>
                    <?php
                    }
                    elseif($type=='Mock'){
                        ?>
                    <a href="<?php echo SITEURL; ?>index.php?page=question">
                        <button type="button" class="btn-go">Mock</button></a>
                    </a>
                    <?php
                    }
                    else{
                        ?>
                         <button type="button" class="btn-exit">No Exam</button>

                        <?php
                    }
                    ?>
                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit" onclick="return confirm('Are you sure?')">&nbsp; Quit &nbsp;</button>
                    </a>
                    <a href="pages\help\index.php">
                        <button type="button" class="btn-exit">&nbsp; Help &nbsp;</button>
                    </a>
                </div>
            </div>
        </div>


       
        <!--Body Ends Here-->