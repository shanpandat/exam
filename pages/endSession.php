<?php
include('box/studentheader1.php');
?>
<?php 

    include('check.php');
    //Inserting Summary Result Here
            if(isset($_SESSION['totalScore']))
            {
                $totalScore=$_SESSION['totalScore'];
            }
            else
            {
                $totalScore=0;
            }
            //To get student id from student username
            $tbl_name="tbl_student";
            $username=$_SESSION['student'];
            $student_id=$obj->get_userid($tbl_name,$username,$conn);
            $active='no';
            $logeedin='no';
            $where="username='$username'";
            $data1="is_active='$active',
                    Logged_In='$logeedin'";
            $query1=$obj->update_data($tbl_name,$data1,$where);
            $res1=$obj->execute_query($conn,$query1);
            //to add sesult summary to the database
            $added_date=date('Y-m-d');
            $tbl_name2="tbl_result_summary";
            $tbl="tbl_student";
            $tbl2="tbl_faculty";
            $faculty=$obj->get_faculty($tbl,$student_id,$conn);
            $data="student_id='$student_id',
                    marks='$totalScore',
                    added_date='$added_date',
                    faculty='$faculty'
                    ";
            $query=$obj->insert_data($tbl_name2,$data);
            $res=$obj->execute_query($conn,$query);

            $tbl_name3="examination";
            $where3="student_id='$student_id'";
            $query2=$obj->select_data($tbl_name3,$where3);
            $res2=$obj->execute_query($conn,$query2);
            $count_rows=$obj->num_rows($res2);
          
            if($count_rows>0)
            {
                while($row=$obj->fetch_data($res2))
                {

                    $student_id=$row['student_id'];
                    $image=$row['image'];
                    $folderPath = "admin/images1/";
                    $file = $folderPath . $image;
                    unlink($file);

                }
            
            }
           
?>
<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="welcome">
                    <?php 
                        if(isset($_SESSION['time_complete']))
                        {
                            echo $_SESSION['time_complete'];
                        }
                    ?>
                     You have successfully completed the test. Thank You.<br />
                     <?php 
                        $tbl_name='tbl_student';
                        $username=$_SESSION['student'];
                        //Get Student ID from username
                        $userid=$obj->get_userid($tbl_name,$username,$conn);
                        //Getting Summary Result from the database
                        $tbl_name3="tbl_result_summary";
                        $where3="student_id=$userid ORDER BY summary_id DESC LIMIT 1";
                        $query=$obj->select_data($tbl_name3,$where3);
                        $res=$obj->execute_query($conn,$query);
                        $row=$obj->fetch_data($res);
                        $marks=$row['marks'];
                        $added_date=date('Y-m-d');

                        $tbl_name2="examination";
                        $where2="student_id='$userid'";
                        $query2=$obj->delete_data($tbl_name2,$where2);
                        $res2=$obj->execute_query($conn,$query2);
                        $full_marks=$_SESSION['full_marks'];
                      
                        //Calculate Marks for different faculties
                        $obtainedMarks=$_SESSION['totalScore'];
                       
                        $obtainedPercent=($obtainedMarks/$full_marks)*100;
                       
                        //Get Student ID
                        //Get Faculty ID from Student ID then Show full marks based on the faculty and obtained percentage
                      
                        $marksShown= $obtainedMarks;
                     
                        
                        $_SESSION['USERID']= $userid;
                        //Round Off Marks
                        $lastDigit=substr($marksShown,-1);
                        if($lastDigit<5)
                        {
                            $realMark=$marksShown-$lastDigit;
                        }
                        else
                        {
                            $digitToAdd=10-$lastDigit;
                            $realMark=$marksShown+$digitToAdd;
                        }
                     ?>
                     You got <h2><?php echo  $marksShown; ?>/<?php echo  $full_marks; ?></h2>
                     
                     <a href="<?php echo SITEURL; ?>index.php?page=detail_result">
                        <button type="button" class="btn-exit">
                            View Result
                        </button>
                    </a>
                    <a href="<?php echo SITEURL; ?>index.php?page=logout">
                        <button type="button" class="btn-exit">&nbsp; Log Out &nbsp;</button>
                    </a>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->