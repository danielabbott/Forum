<?php
include "connect.php";
include "header.php";

/* Get the 'about me' text */

$sql = "SELECT
            AboutMe
        FROM
            tbluser
        WHERE
            UserID = " . $_SESSION['userid'];

$result = $conn->query($sql);

if(!$result || $result->num_rows == 0) {
	echo '<p class="error">An error occurred</p>';
} else {
	$record = $result->fetch_assoc();

	/* Create a form for changing the 'about me' text */

	?>

	<h3>About Me</h3>

	<form action= "editprofile_.php" method="post">
		<textarea name="aboutme"><?php echo $record['AboutMe']; ?></textarea><br/><br/>
		<input type="submit" value="Update">
	</form>

	<br/>
    <button onclick="location.href='uploadprofilepicture.php'">Set profile Picture</button>

    <br/>
    <br/>
	<button onclick="deactivateAcount();">DEACTIVATE ACOUNT</button>

	<script>
	function deactivateAcount() {
		if(confirm("Are you sure you wish to deactivate your account? Your account can be reactivated later."))
		{
			window.location.href = "deactivateaccount.php";
		}
	}
	</script>


	<?php

}

include "footer.php";
include 'disconnect.php';
?>
