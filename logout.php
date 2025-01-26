<?php
session_start();
session_unset();
session_destroy();
header("Location: Quick_home.php");
exit;
?>