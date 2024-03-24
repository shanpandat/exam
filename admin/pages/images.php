<div style="height:420px">
<table>
<?php 
            if(isset($_GET['id']))
            {
                $student_id=$_GET['id'];
                ?>

               
                <?php
                $tbl_name='examination';
                $tbl_name2="tbl_student";
                $where="student_id=$student_id";
                $query=$obj->select_data($tbl_name,$where);
                $query2=$obj->select_data($tbl_name2,$where);
                $res4=$obj->execute_query($conn,$query2);
                if($res4==true)
                {
                    $row4=$obj->fetch_data($res4);
                    $stu_msg=$row4['stu_msg'];

                }
                $res=$obj->execute_query($conn,$query);
                $count_rows=$obj->num_rows($res);
                while($row=$obj->fetch_data($res))
                {
                    $student_id=$row['student_id'];
                ?>
                   
                    <tr><?php echo '<img src="images1/'.$row['image'].'" width="200px" height="200px" alt="Image">' ?></tr>
<?php

            }
        }
            
        ?>
    </table>
    </div>
   
    <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<body>


<button class="open-button" id="op" onclick="openForm()">Chat</button>

<div class="chat-popup" id="myForm">
  <form method="post" action="" enctype="multipart/form-data" class="form-container">
    <h4>Student Message: </h4>
    <h5><?php if($stu_msg=="0"){echo "No Message";}else{echo $stu_msg; }?></h5>
    <textarea placeholder="Type message.." name="msg" required></textarea>

    <button type="submit" name="publish" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
   
function openForm() {
  document.getElementById("myForm").style.display = "block";
}
<?php
if($stu_msg!="0"){
    ?>
   
    document.getElementById("op").style.backgroundColor = "Red";
  
   

    <?php
}
?>

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>
<?php
if(isset($_POST['publish']))
                        {
            $msg=$obj->sanitize($conn,$_POST['msg']);
            $tbl_name="tbl_student";
            $data="stu_msg='0',
            proc_msg='$msg'";
            $where="student_id=$student_id";
            $query=$obj->update_data($tbl_name,$data,$where);
            $res=$obj->execute_query($conn,$query);
    
                        }
                        ?>
