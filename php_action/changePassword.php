<?php 

require_once 'core.php';
if($_POST) {
echo "HI ". $_SESSION['userId'];
	$valid['success'] = array('success' => false, 'messages' => array());
// md5
	$currentPassword = ($_POST['password']);
	$newPassword = ($_POST['npassword']);
	$conformPassword =($_POST['cpassword']);
	$userId = $_POST['user_id'];

	$sql ="SELECT * FROM users WHERE username = $_SESSION['userId']; ";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
  
	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

	$updateSql = "UPDATE users SET password = '$newPassword' ;";
			if($connect->query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Updated";		
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while updating the password";	
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "New password does not match with Confirm password";
		}

	// } else {
	// 	$valid['success'] = false;
	// 	$valid['messages'] = "Current password is incorrect";
	// }

	$connect->close();

	echo json_encode($valid);

}

?>