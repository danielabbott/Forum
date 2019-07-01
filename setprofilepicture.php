<?php
include "connect.php";
include "header.php";
include "removeprofpic.php";

/* Sets profile picture to picture with id specified in URL */

if(isset($_SESSION['userid'])) {
    if(isset($_GET['id'])) {
        $sql = 'SELECT ProfilePicture FROM tbluser WHERE UserID=' . $_SESSION['userid'];

        $result = $conn->query($sql);
        if(!$result || $result->num_rows <= 0) {
            echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
        }
        else {
            $record = $result->fetch_assoc();

            $sql = 	'UPDATE tbluser ' .
                'SET ProfilePicture=' .  mysqli_real_escape_string($conn, $_GET['id']) .
                ' WHERE userid=' . $_SESSION['userid'];

            if(!$conn->query($sql)) {
                echo '<p class="error">error: ' . mysqli_error($conn) . '</p>';
            }
            else {
                removeUnusedProfilePicture($conn, $record['ProfilePicture']);
            }
        }
    }
    else {
        echo '<p class="error">error: id not specified</p>';
    }
}
else {
    echo '<p class="error">error: not logged in</p>';
}

include "footer.php";
include 'disconnect.php';
?>
