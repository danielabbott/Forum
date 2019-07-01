<?php
include 'connect.php';
include 'header.php';

/* Insert post into MySQL database */

$sql = 'INSERT INTO tblpost '.
       '(ThreadID,UserID,Text) '.
       'VALUES '.
       '(' . $_POST['threadid'] . ',' . $_SESSION['userid'] . ',"' . mysqli_real_escape_string($conn, $_POST['posttext']) . '")';

if(!$conn->query($sql))
	echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
else {
	echo '<p>Post created.</p>';
	echo '<a href="thread.php?id=' . $_POST['threadid'] . '">Click here to return to the thread</a>';
}

include 'footer.php';
include 'disconnect.php';
?>