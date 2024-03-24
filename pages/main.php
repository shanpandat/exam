<?php 
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='mainlogin';
    }
    
    switch($page)
    {
        case "message":
            {
                include('message.php');

            }
            break;
        case "welcome":
        {
            include('welcome.php');
        }
        break;
        
        case "question":
        {
            include('question.php');
        }
        break;
        
        case "login":
        {
            include('login.php');

        }
        break;

        case "register":
        {
                include('register.php');
        }
        break;

        case "endSession":
        {
            include('endSession.php');
        }
        break;
        
        case "detail_result":
        {
            include('detail_result.php');
        }
        break;
        
        case "logout":
        {

            $tbl_name="tbl_student";
            $username=$_SESSION['student'];
            $student_id=$obj->get_userid($tbl_name,$username,$conn);
            
            $res=true;
            if($res==true)
            {
                //Setting Student Is_Active Mode to No
                $tbl_name3="tbl_student";
                $data3="is_active='no'";
                $logged_in='no';
                $where3="student_id='$student_id'";
                $query3=$obj->update_data($tbl_name3,$data3,$where3);
                $res3=$obj->execute_query($conn,$query3);
              
                mysqli_query($conn, "UPDATE tbl_student SET Logged_In='$logged_in',proc_msg=0,stu_msg=0 WHERE student_id='$student_id'");
               
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
                    $query3=$obj->delete_data($tbl_name3,$where3);
                    $res=$obj->execute_query($conn,$query3);
                
                }
               
                if($res3===true)

                {
                    session_destroy();
                    header('location:'.SITEURL.'index.php?page=login');
                }
                else
                {
                    echo "Error";
                }
                
            }
            else
            {
                echo "Error";
            }
            
        }
        break;
        
        default:
        {
            include('mainlogin.php');
        }
        break;
    }
?>