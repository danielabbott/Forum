<?php
include "connect.php";
include "header.php";

if(isset($_SESSION['username'])) { /* User is logged in */

	if(isset($_GET['threadid'])) {

		?>

		<form action= "newpost_.php" method="post">
			<textarea name="posttext" rows="25" cols="80"></textarea><br/>
			<input type="hidden" name="threadid" value=<?php echo '"' . $_GET['threadid'] . '"'; ?> />
			<input type="submit" value="Post">
		</form>

		<?php

	} else {
		echo '<p class="error">Thread not specified. Invalid URL?</p>';
	}

} else {
	echo '<p class="error">Only members may create posts</p>';
}

include "footer.php";
include 'disconnect.php';
?>