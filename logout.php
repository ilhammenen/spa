<?php
session_start();
unset($_SESSION["userid"]);
header("Location: loginform.php?loggedout=true");
exit();
?>
