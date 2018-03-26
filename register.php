<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>


	<?php
if(isset($_POST["register"])){
if(!empty($_POST['LOGIN']) && !empty($_POST['PASSWORD'])) {
	$LOGIN=$_POST['LOGIN'];
	$PASSWORD=$_POST['PASSWORD'];
	
		
	$query=mysqli_query($con,"SELECT * FROM users WHERE LOGIN='".$LOGIN."'");
	$numrows=mysqli_num_rows($query);
	
	if($numrows==0)
	{
	$sql="INSERT INTO users
			(LOGIN,PASSWORD) 
			VALUES('$LOGIN', '$PASSWORD')";
	$result=mysqli_query($con,$sql);
	if($result){
	 $message = "Аккаунт успешно создан!";
	} else {
	 $message = "не удалось сохранить данные!";
	}
	} else {
	 $message = "Такой логин уже используется!";
	}
} else {
	 $message = "Заполните все поля!";
}
}
?>

<?php if (!empty($message)) {echo "<p class=\"error\">" . "Внимание: ". $message . "</p>";} ?>

	
<div class="container mregister">
			<div id="login">
	<h1>РЕГИСТРАЦИЯ</h1>
<form name="registerform" id="registerform" action="register.php" method="post">
	<p>
		<label for="user_pass">Логин<br />
		<input type="text" name="LOGIN" id="LOGIN" class="input" value="" size="20" /></label>
	</p>
	
	<p>
		<label for="user_pass">Пароль<br />
		<input type="PASSWORD" name="PASSWORD" id="PASSWORD" class="input" value="" size="32" /></label>
	</p>	
	

		<p class="submit">
		<input type="submit" name="register" id="register" class="button" value="Зарегистрироваться" />
	</p>
	
	<p class="regtext">Уже зарегистрированы? <a href="index.php" >Войти</a>!</p>
</form>
	
	</div>
	</div>
	
	
	<?php include("includes/footer.php"); ?>