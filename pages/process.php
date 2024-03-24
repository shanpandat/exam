
<?php 
                            if(isset($_POST['submit']))
                            {
                                
                                //echo "Clicked";
                                //CHeck if the answer is clicked or not
                                
                                //Get the details from the form
                                $question_id=$_POST['question_id'];
                                
                                //Submitting Answers to the database
                                if(isset($_POST['answer']))
                                {
                                    $user_answer=$obj->sanitize($conn,$_POST['answer']);
                                }
                                else
                                {
                                    $user_answer=0;
                                }
                                $right_answer=$obj->sanitize($conn,$_POST['right_answer']);
                                $question_id=$obj->sanitize($conn,$_POST['question_id']);
                                $username=$_SESSION['student']; 
                                $marks=$_POST['marks'];
                                //Get User ID from username
                                $tbl_name="tbl_student";
                                $student_id=$obj->get_userid($tbl_name,$username,$conn);
                                $added_date=date('Y-m-d');
                                //Now Adding Data to Database
                                $tbl_name="tbl_result";
                                $data="
                                student_id='$student_id',
                                question_id='$question_id',
                                user_answer='$user_answer',
                                right_answer='$right_answer',
                                added_date='$added_date'
                                ";
                                //CHeck if the total score is set or not
                                if(isset($_SESSION['totalScore']))
                                {
                                    $totalScore=$_SESSION['totalScore'];
                                }
                                else
                                {
                                    $totalScore=0;
                                }
                                
                                //Check if the full marks is set or not
                                if(isset($_SESSION['full_marks']))
                                {
                                    $full_marks=$_SESSION['full_marks'];
                                }
                                else
                                {
                                    $full_marks=0;
                                }
                                
                                if($user_answer==$right_answer)
                                {
                                    $_SESSION['totalScore']=$totalScore+$marks;
                                    $_SESSION['full_marks']=$full_marks+$marks;
                                }
                                else
                                {
                                    $_SESSION['totalScore']=$totalScore+0;
                                    $_SESSION['full_marks']=$full_marks+$marks;
                                }
                                $query=$obj->insert_data($tbl_name,$data);
                                //$res=true;
                                $res=$obj->execute_query($conn,$query);
                                if($res===true)
                                {
                                    //Time Validation
                                    
                                    /*echo $current_time; 
                                    if($current_time==$current_time)
                                    {
                                        echo "Okey"; die();
                                    }*/
                                    /*$start=strtotime($current_time);
                                    $end=strtotime($_SESSION['end_time']);
                                    if($start>$end)
                                    {
                                        $_SESSION['time_complete']="<div class='error'>Your exam time has ended. Thank You.</div>";
                                        header('location:'.SITEURL.'index.php?page=endSession');
                                        echo "session end";die();
                                    }*/
                                    include('pages/timeCheck.php');
                                    /*
                                    if($current_time>$_SESSION['end_time'])
                                    {
                                        $_SESSION['time_complete']="<div class='error'>Your exam time has ended. Thank You.</div>";
                                        header('location:'.SITEURL.'index.php?page=endSession');
                                    }
                                    */
                                    //adding all the questions in session variable
                                    if(isset($_SESSION['all_qns']))
                                    {
                                        $_SESSION['all_qns']=$_SESSION['all_qns'].','.$question_id;
                                    }
                                    else
                                    {
                                        $_SESSION['all_qns']=0;
                                    }
                                    //Save the answer for result
                                    if(isset($_SESSION['sn']))
                                    {
                                        $_SESSION['sn']=$_SESSION['sn']+1;
                                    }
                                    else
                                    {
                                        $_SESSION['sn']=1;
                                    }
                                    
                                    $_SESSION['qns']=$question_id;
                                    //Redirect to the question page
                                    header('location:'.SITEURL.'index.php?page=question');
                                }
                                else
                                {
                                    echo "Error";
                                }
                                
                            }
                        ?>