<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
	header("location:login.php");
} else {
?>


<?php include("includes/header.php"); ?>
<div id="welcome">	
	<h2>рПривет, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
	<p><a href="logout.php">Для выхода </a> нажми сюда!</p>
</div>

<?php include("includes/footer.php"); ?>
	

<?php
}
?>
