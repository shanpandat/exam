<?php
    $fac_id=$_SESSION['user'];


?>
<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    <h2>Question Manager</h2>
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=add_question">
                            <button type="button" class="btn-add">Add Question</button>
                        </a>
                        <?php 
                            if(isset($_SESSION['add']))
                            {
                                echo $_SESSION['add'];
                                unset($_SESSION['add']);
                            }
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                            if(isset($_SESSION['delete']))
                            {
                                echo $_SESSION['delete'];
                                unset($_SESSION['delete']);
                            }
                        ?>
                
                    <table>
                        <tr>
                            <th>S.N.</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <?php 
                            if($_SESSION['user']=="admin")
                            {
                            ?>
                            <th>Subject</th>
                            <?php
                            }
                            else{
                            ?>
                            <th>Subject</th>
                            <?php
                            }
                            ?>
                            <th>Is Active?</th>
                            <th>Actions</th>
                        </tr>
                        
                        <?php 
                         $tbl_name="tbl_question";
                            if($fac_id!='admin'){
                                $where="faculty=$fac_id";
                                $query=$obj->select_data($tbl_name,$where);

                            }
                            else{
                                $query=$obj->select_data($tbl_name);
                            }
                            //Getting Data From Database
                            $res=$obj->execute_query($conn,$query);
                            $count_rows=$obj->num_rows($res);
                            $sn=1;
                            if($count_rows>0)
                            {
                                while($row=$obj->fetch_data($res))
                                {
                                    $question_id=$row['question_id'];
                                    $question=$row['question'];
                                    $answer=$row['answer'];
                                    if($_SESSION['user']=="admin"){
                                    $ColVal=$row['category'];
                                    }
                                    else{
                                        $ColVal=$row['category'];
                                    }
                                    $is_active=$row['is_active'];
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td style="width: 650px;"><?php echo $question; ?></td>
                                        <td><?php echo $answer; ?></td>
                                        <td><?php echo $ColVal; ?></td></td>
                                        <td><?php echo $is_active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/index.php?page=update_question&id=<?php echo $question_id; ?>"><button type="button" class="btn-update">UPDATE</button></a> 
                                            <a href="<?php echo SITEURL; ?>admin/pages/delete.php?id=<?php echo $question_id; ?>&page=questions"><button type="button" class="btn-delete" onclick="return confirm('Are you sure?')">DELETE</button></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<tr><td colspan='6'><div class='error'></div></td></tr>";
                            }
                        ?>
                        
                    </table>
                </div>
            </div>
        </div>
        <!--Body Ends Here-->