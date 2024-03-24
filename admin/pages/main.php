
<?php 
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    else
    {
        $page='home';
    }
    
    switch($page)
    {
        case "home":
        {
            include('dashboard.php');
        }
        break;

        case "query":
        {
            include('query.php');
        }
        break;

        case "fac_settings":
        {
            include('fac_setting.php');
        }
        break;

        case "users":
        {
            include('users.php');
        }
        break;
        
        case "add_user":
        {
            include('add_user.php');
        }
        break;
        
        case "update_user":
        {
            include('add_user.php');
        }
        break;
        
        case "students":
        {
            include('students.php');
        }
        break;
        
        case "add_student":
        {
            include('add_student.php');
        }
        break;
        
        case "update_student":
        {
            include('update_student.php');
        }
        break;
        
        case "faculties":
        {
            include('faculties.php');
        }
        break;
        
        case "add_faculty":
        {
            include('add_faculty.php');
        }
        break;
        
        case "update_faculty":
        {
            include('update_faculty.php');
        }
        break;
        
        case "questions":
        {
            include('questions.php');
        }
        break;
        
        case "add_question":
        {
            include('add_question.php');
        }
        break;
        
        case "update_question":
        {
            include('update_question.php');
        }
        break;
        
        case "results":
        {
            include('results.php');
        }
        break;
        
        case "view_result":
        {
            include('view_result.php');
        }
        break;
        
        case "settings":
        {
            include('settings.php');
        }
        break;
        case "examination":
            {
                include('examination.php');
            }
            break;
        case "images":
            {
                include('images.php');
            }
        break;
       
        
        case "logout":
        {
            if(isset($_SESSION['user']))
            {
                unset($_SESSION['user']);
            header('location:'.SITEURL.'admin/login.php');
            }
            
        }
        break;

        case "logout1":
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
                    if($res3===true)
                    
                    {
                        
                            if(isset($_SESSION['student']))
                            {
                                 unset($_SESSION['student']);
                                 header('location:'.SITEURL.'admin/login.php');
                            }
                        header('location:'.SITEURL.'admin/index.php?page=examination');
                        
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
            include('dashboard.php');
        }
    }
?>