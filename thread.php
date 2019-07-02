<?php
include "connect.php";
include "header.php";

/* Get information about thread */

$sql = "SELECT
            CreatorUserID,
            CategoryID,
            ThreadTitle
        FROM
            tblthread
        WHERE
            ThreadID = " . mysqli_real_escape_string($conn, $_GET['id']);

$result = $conn->query($sql);

if(!$result || $result->num_rows == 0) {
	echo '<p class="error">Error: Thread does not exist</p>';
} else {
	$record = $result->fetch_assoc();
	echo '<br/><div id="sectionHeader">';

    ?>
    
    <?php if(isset($_SESSION['privilege']) && $_SESSION['privilege'] > 0) { /* Form to delete the thread - uses POST instead of GET */ ?>
        <form action= "deletethread.php" method="post" style="margin: 0; padding: 0;">
    <?php } ?>

    <h3 style="display:inline;"> <?php echo $record['ThreadTitle']; ?> </h3>

    <?php if(isset($_SESSION['privilege']) && $_SESSION['privilege'] > 0) { ?>
        <input type="hidden" name="ThreadID" value=<?php echo '"' . $_GET['id'] . '"'; ?> />
        &nbsp;&nbsp;&nbsp;
        <input type="submit" value="Delete" style="display:inline;">
        </form>
    <?php } ?>

    <?php

	echo '</div><br/>';

	/* Get posts in thread */

	$sql = "SELECT
            PostID,
            UserID,
			Text,
			CreationDateTime,
            IsEdited
        FROM
            tblpost
        WHERE
            ThreadID = " . mysqli_real_escape_string($conn, $_GET['id']) .
        " ORDER BY PostID";

	$result = $conn->query($sql);

	if(!$result || $result->num_rows == 0) {
		echo '<p class="error">No posts to display</p>';
	}
    else {
    	while($record = $result->fetch_assoc()) {
    		$user = 'Unknown User';

    		/* Get username of poster */

    		$sql = "SELECT
                Name,
                ProfilePicture
            FROM
                tbluser
            WHERE
                UserID = " . $record['UserID'];

    		$result2 = $conn->query($sql);
    		if($result2 && $result2->num_rows > 0) {
    			$record2 = $result2->fetch_assoc();
    			if($record2)
    				$user = $record2['Name'];
    		}

            echo '<div id="post">';
            echo '<p style="text-decoration: underline; display:inline">' . $user . '</p>';
            echo '<p style="display:inline">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $record['CreationDateTime'] . ' &nbsp</p>';

            /* Display edit button if this post was posted by the user */
            if(isset($_SESSION['userid']) && $record['UserID'] == $_SESSION['userid']) {
                echo '<button onclick="location.href=\'editpost.php?postid=' . $record['PostID'] . '\'" type="button">Edit</button>';
            }

            /* If the post has been edited, display red text */
            if($record['IsEdited'] != 0) {
                echo '<p style="color:red;display:inline"> Edited</p>';
            }

            if($record2['ProfilePicture'] != 0) {
                echo '<br><img src="getimage.php?id=' . $record2['ProfilePicture'] . '" width="50" />';
            }

    		echo '<p>' . $record['Text'] . '</p>';
    		echo '</div>';
    	}
    }

	/* New post button */

	echo '<button onclick="location.href=\'newpost.php?threadid=' . $_GET['id'] . '\'" type="button">Reply to this thread</button></div>';
}

include "footer.php";
include 'disconnect.php';
?>
