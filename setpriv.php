<?php
include 'connect.php';
include 'header.php';

if(isset($_SESSION['privilege']) && $_SESSION['privilege'] >= 2) {

	$sql = 	'SELECT PrivilegeLevel FROM tbluser WHERE UserID = ' . mysqli_real_escape_string($conn, $_GET['id']);

	$result = $conn->query($sql);
	if(!$result || $result->num_rows == 0) {
		echo '<p class="error">Error: User does not exist</p>';
	}
	else {
		$CurrentPriv = $result->fetch_assoc()['PrivilegeLevel'];

		if($CurrentPriv != 0 && $CurrentPriv != 1) {
			echo '<p class="error">error: You don\'t have permission to do that.</p>';
		} else {
			if($CurrentPriv == 0) {
				$newPriv = 1;
			}
			else {
				$newPriv = 0;
			}

			$sql = 	'UPDATE tbluser ' .
			    'SET PrivilegeLevel=' . $newPriv .
			    ' WHERE UserID=' . mysqli_real_escape_string($conn, $_GET['id']);

			if(!$conn->query($sql)) {
				echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
			}
			else {
				if($newPriv == 1) {
					echo '<p>User is now an admin</p>';
				}
				else {
					echo '<p>User is no longer an admin</p>';
				}
			}
		}
	}

}
else {
	echo '<p class="error">error: You don\'t have permission to do that.</p>';
}

include 'footer.php';
include 'disconnect.php';
?>
