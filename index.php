<?php
require("templates/header.php");
require("templates/navbar.php");

// get viewed page from pages folder \\
if( isset($_GET["v"]) && searchFile("views","blade{$_GET["v"]}.php") ){
	require_once("templates/views/".searchFile("views","blade{$_GET["v"]}.php"));
}else{
	require_once("templates/views/bladeHome.php");
}

require("templates/modals.php");
require("templates/footer.php");
?>