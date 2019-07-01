<?php
include "connect.php";

$sql = "SELECT Data FROM tblpicture WHERE id=" . mysqli_real_escape_string($conn, $_GET['id']);

$result = $conn->query($sql);

if($result && $result->num_rows > 0) {
    $record = $result->fetch_assoc();

    echo $record['Data'];
}

include 'disconnect.php';
?>
