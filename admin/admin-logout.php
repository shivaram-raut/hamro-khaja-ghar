<?php
include("../config/constants.php");
unset($_SESSION['user-admin']);
header("Location:" . SITEURL . "index.php");

?>