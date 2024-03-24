<?php
if(!empty($_POST["send"])) {
	$name = $_POST["userName"];
	$email = $_POST["userEmail"];
	$subject = $_POST["subject"];
	$content = $_POST["content"];

	$conn = $conn=mysqli_connect("localhost","root","") or die(mysqli_error());
	$db_select=mysqli_select_db($conn,"quizapp") or die(mysqli_error());
	mysqli_query($conn, "INSERT INTO tbl_contact (user_name, user_email,subjects,content) VALUES ('" . $name. "', '" . $email. "','" . $subject. "','" . $content. "')");
	$insert_id = mysqli_insert_id($conn);
	//if(!empty($insert_id)) {
	   $message = "Your contact information is saved and send successfully.";
	   $type = "success";
	//}
}
require_once "contact-view.php";
require_once "send_contact_mail.php";
?>