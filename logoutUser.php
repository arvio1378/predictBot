<?php

session_start();
unset($_SESSION['loginUser']);
header("Location: loginUser.php");
exit;

?>