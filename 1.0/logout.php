<?php
    include_once("includes/config.php");
    session_start();
	session_unset();
	session_destroy();
	header("Location: $url");
?>
