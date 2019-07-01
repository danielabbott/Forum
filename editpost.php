<?php
include "connect.php";
include "header.php";

if(isset($_SESSION['username'])) { /* User is logged in */

	if(isset($_GET['postid'])) {

        /* Create read-only text area to display original post contents */
		?>
        <p style="color:gray">Original Text</p>
        <div style="border:gray 1px dotted; width:600px"><?php

        /* Get current post text from database */

        $sql = "SELECT
    			Text
            FROM
                tblpost
            WHERE
                PostID = " . mysqli_real_escape_string($conn, $_GET['postid']);

    	$result = $conn->query($sql);

    	if(!$result || $result->num_rows == 0 || !($record = $result->fetch_assoc())) {
    		echo '<p class="error">Invalid post ID</p>';
    	} else {
            echo $record['Text'];

        ?></div><br/>

        <p style="color:gray">New Text</p>

		<form action= "editpost_.php" method="post">
			<textarea name="posttext" rows="25" cols="80"><?php

                echo $record['Text'];

            ?></textarea><br/>
			<input type="hidden" name="postid" value=<?php echo '"' . $_GET['postid'] . '"'; ?> />
			<input type="submit" value="Update">
		</form>

		<?php
        }

	} else {
		echo '<p class="error">Post not specified. Invalid URL?</p>';
	}

} else {
	echo '<p class="error">You must log in before editing a post</p>';
}

include "footer.php";
include 'disconnect.php';
?>
