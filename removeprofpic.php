<?php

function removeUnusedProfilePicture($conn, $pictureid)
{
	$sql = 'SELECT COUNT(UserID) as total FROM tbluser GROUP BY ProfilePicture HAVING ProfilePicture=' . $pictureid;

    $result = $conn->query($sql);

    if ($result == null || $result->num_rows < 1 || $result->fetch_assoc()['total'] < 1) {

        /* The image should be deleted */

        $sql = 'DELETE FROM tblpicture WHERE Id = ' . $pictureid;
        $conn->query($sql);

        /* Delete file */
        unlink('profpics/' . $pictureid);
    }
}

?>