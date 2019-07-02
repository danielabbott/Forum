<?php

include 'connect.php';

unset($_SESSION['username']);
unset($_SESSION['userid']);
unset($_SESSION['privilege']);

include 'header.php';

?>

<p>You have logged out</p>

<?php
include 'footer.php';
include 'disconnect.php';
?>