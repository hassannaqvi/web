<?php session_start(); include("includes/top.php");?>

<?php include("includes/topbar.php");?>

<?php
	if ( trim($page) !=='' and file_exists("pages/{$page}") )
	{
		include("pages/{$page}");
	}else
	{
		include("pages/404.php");
	}
?>

<?php include("includes/footer.php");?>