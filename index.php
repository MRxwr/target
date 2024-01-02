<?php
session_start();
require("templates/header.php");
require("templates/navbar.php");

// get viewed page from pages folder \\
if( isset($_GET["v"]) && searchFile("views","blade{$_GET["v"]}.php") ){
	if( isset($_GET["academyURL"]) && !empty($_GET["academyURL"]) && $mainAcademy = selectDB("academies","`status` = '0' AND `hidden` = '0' AND `url` = '".strtolower($_GET["academyURL"])."'") ){
		require_once("views/".searchFile("views","blade{$_GET["v"]}.php"));
	}else{
		require_once("views/bladeHome.php");
	}
}else{
	require_once("views/bladeHome.php");
}

require("templates/modals.php");
require("templates/footer.php");
?>