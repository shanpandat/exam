<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<div class="main">
<?php
if($_SESSION['user']!='admin'){
    ?>
    
<div class="content">
                <div class="report">
                    <h2>Exam Type</h2>
                    <?php 
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                        ?>
                    <form method="post" action="" class="forms">
                    <span class="name">Exam Type</span>
                        <select name="Exam_Type">
                          <option value="No_Exam">No Exam</option>
                           <option value="Mock">Mock</option>
                           <option value="Semester">Semester</option>
                           <option value="Sessional">Sessional</option>
                          
                           
                        </select>
                        <input type="submit" name="submit" value="Update_Type" class="btn-add" style="margin-left: 15%;" />
                    </form>

                </div>
</div>

   <?php 
                        if(isset($_POST['submit']))
                        {
                            //echo "Clicked";
                            //Get Values froom the form
                            $type=$obj->sanitize($conn,$_POST['Exam_Type']);
                            $tbl_name='tbl_faculty';
                            $data="type='$type'";
                            $faculty_id=$_SESSION['user'];
                            $where="faculty_id='$faculty_id'";
                            $query=$obj->update_data($tbl_name,$data,$where);
                            $res=$obj->execute_query($conn,$query);
                            if($res===true)
                            {
                                $_SESSION['update']="<div class='success'>Type successfully updated.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=examination');
                            }
                            else
                            {
                                $_SESSION['update']="<div class='error'>Failed to update type. Please try again.</div>";
                                header('location:'.SITEURL.'admin/index.php?page=examination');
                            }
                        }

                            ?>

<?php

}
?>


            <div class="content">
                <div class="report">
                    
                    <h2>Active Students</h2>
                   
                    
                    <table>
                        <tr>
                            <th>S.N.</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Login Date/Time</th>
                            <th>Student Message</th>
                            <th>Actions</th>
                           
                        </tr>
                    <!--Displaying All Data From Database-->
                    <?php 
                    
            
                        $tbl_name="tbl_student";
                        $where="Logged_In='yes'";
                        $query=$obj->select_data($tbl_name,$where);
                        $sn=1;
                        $res=$obj->execute_query($conn,$query);
                        $count_rows=$obj->num_rows($res);
                        if($count_rows>0)
                        {
                            while($row=$obj->fetch_data($res))
                            {
                                
                                $student_id=$row['student_id'];
                                $first_name=$row['first_name'];
                                $last_name=$row['last_name'];
                                $Username=$row['username'];
                                $full_name=$first_name.' '.$last_name;
                                $date=$row['login_time'];
                                $message=$row['stu_msg'];
                                $_SESSION['student']=$Username;
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?> </td>
                                    <td><?php echo '<img src="images1/'.$row['image'].'" width="100px" height="100px" alt="Image">' ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <?php
                                    if($message==0){
                                        ?>
                                    <td><?php echo "No Message" ?></td>
                                    <?php

                                    }
                                    else{
                                        ?>
                                    <td><?php echo $message; ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td>
                                    <a href="<?php echo SITEURL;  ?>admin/index.php?page=logout1">
                                    <button type="button" class="btn-exit" onclick="return confirm('Are you sure?')">&nbsp; Log Out &nbsp;</button>
                            </a>
                                    <a href="<?php echo SITEURL;  ?>admin/index.php?page=images&id=<?php echo $student_id;?>">
                                    <button type="button" class="btn-update" >&nbsp; View &nbsp;</button>
                                    </td>
                                   
                                </tr>
                                <?php

                                
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='7'><div class='error'>No Students are logged in.</div></tr></td>";
                        }
                    ?>
                        
                 
                     </table>
                  
                </div>
            </div>
           
        </div>
        <!--Body Ends Here-->