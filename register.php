<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>


	<?php

if(isset($_POST["register"])){


if(!empty($_POST['login']) && !empty($_POST['password'])) {
	$username=$_POST['login'];
	$password=$_POST['password'];
	

		
	$query=mysqli_query("SELECT * FROM users WHERE login='".$username."'");
	$numrows=mysqli_num_rows($query);
	
	if($numrows==0)
	{
	$sql="INSERT INTO users
			(login,password) 
			VALUES('$username', '$password')";

	$result=mysqli_query($sql);


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



	
<div class="container mregister">
			<div id="login">
	<h1>РЕГИСТРАЦИЯ</h1>
<form name="registerform" id="registerform" action="register.php" method="post">
	<p>
		<label for="user_pass">Логин<br />
		<input type="text" name="username" id="username" class="input" value="" size="20" /></label>
	</p>
	
	<p>
		<label for="user_pass">Пароль<br />
		<input type="password" name="password" id="password" class="input" value="" size="32" /></label>
	</p>	
	

		<p class="submit">
		<input type="submit" name="register" id="register" class="button" value="Зарегистрироваться" />
	</p>
	
	<p class="regtext">Уже зарегистрированы? <a href="index.php" >Войти</a>!</p>
</form>
	
	</div>
	</div>
	
	
	<?php include("includes/footer.php"); ?>

	<?php if (!empty($message)) {echo "<p class=\"error\">" . "Внимание: ". $message . "</p>";} ?>
