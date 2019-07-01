<?php

include 'connect.php';

unset($_SESSION['username']);
unset($_SESSION['userid']);

include 'header.php';

?>

<p>You have logged out</p>

<?php
include 'footer.php';
include 'disconnect.php';
?>