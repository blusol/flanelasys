<?php
	session_start();
	include_once('includes/config.php');
	if ($_SESSION["NOM_USUARIO"] == false ) {
        $url = $url . "index.php";
        header("Location:$url");
		exit;
	}
?>
