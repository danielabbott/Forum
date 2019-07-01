<?php
include "connect.php";
include "header.php";
include "removeprofpic.php";

if(isset($_SESSION['userid']) && isset($_POST['upload']) && $_FILES['imagefile']['size'] > 0 && $_FILES['imagefile']['size'] < 1024*1024)
{
    $rawData = file_get_contents($_FILES['imagefile']['tmp_name']);
    $image = mysqli_real_escape_string($conn, $rawData);

    /* Get current profile picture */

    $sql = 'SELECT ProfilePicture FROM tbluser WHERE UserID = ' . $_SESSION['userid'];
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $record = $result->fetch_assoc();
        $prevPicID = $record['ProfilePicture'];

        /* Insert image into image table */

        $sql = "INSERT INTO tblpicture () VALUES ()";

        if(!$conn->query($sql)) {
            echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
        }

        /* Edit user table to point to new image */

        $newImageID = $conn->insert_id;

        $sql = 	'UPDATE tbluser ' .
            'SET ProfilePicture=' . $threadid = $newImageID .
            ' WHERE userid=' . $_SESSION['userid'];

        if(!$conn->query($sql)) {
            echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
        }

        /* Save new image to file */

        file_put_contents('profpics/' . $newImageID, $rawData);

        /* Delete previous image */

        if($prevPicID != null) {
            /* A profile picture is already set, it may need to be deleted */

            removeUnusedProfilePicture($conn, $record['ProfilePicture']);
        }

    }

}

include "footer.php";
include 'disconnect.php';
?>
