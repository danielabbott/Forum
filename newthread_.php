<?php
include 'connect.php';
include 'header.php';

/* Insert new record for the thread into the MySQL database */

$sql = 'INSERT INTO tblthread '.
       '(CreatorUserID,CategoryID,PostCount,ThreadTitle) '.
       'VALUES '.
       '(' . $_SESSION['userid'] . ',' . $_POST['categoryid'] . ',1,"' . mysqli_real_escape_string($conn, $_POST['title']) . '")';

if(!$conn->query($sql))
	echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
else {
	$threadid = $conn->insert_id;
	
	/* Insert initial post into MySQL database */

	$sql = 'INSERT INTO tblpost '.
       '(ThreadID,UserID,Text) '.
       'VALUES '.
       '(' . $threadid . ',' . $_SESSION['userid'] . ',"' . mysqli_real_escape_string($conn, $_POST['posttext']) . '")';

    if(!$conn->query($sql))
		echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
	else
		echo '<p>Thread created.</p>';
}

include 'footer.php';
include 'disconnect.php';
?>