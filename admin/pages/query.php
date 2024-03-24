<!--Body Starts Here-->
        <div class="main">
            <div class="content">
                <div class="report">
                    <h2>Query Manager</h2>
                        <?php 
                            if(isset($_SESSION['delete']))
                            {
                                echo $_SESSION['delete'];
                                unset($_SESSION['delete']);
                            }
                        ?>
                
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                        
                        <?php 
                         $tbl_name="tbl_contact ORDER BY user_id DESC";
                         $query=$obj->select_data($tbl_name);
                         $res=$obj->execute_query($conn,$query);
                         $count_rows=$obj->num_rows($res);
                         $sn=1;
                            if($count_rows>0)
                            {
                                while($row=$obj->fetch_data($res))
                                {
                                    $Sender_Id=$row['user_id'];
                                    $Sender_Name=$row['user_name'];
                                    $Sender_Email=$row['user_email'];
                                    $Content=$row['content'];
                                    $Date_And_Time=$row['Time']
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?>.  </td>
                                        <td><?php echo $Sender_Name; ?></td>
                                        <td><?php echo $Sender_Email; ?></td>
                                        <td style="width:400px;"><?php echo $Content; ?></td>
                                        <td><?php echo $Date_And_Time; ?></td>
                                        
                                        <td>
                                           <a href="<?php echo SITEURL; ?>admin/pages/delete.php?id=<?php echo $Sender_Id; ?>&page=query"><button type="button" class="btn-delete" onclick="return confirm('Are you sure?')">DELETE</button></a>
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