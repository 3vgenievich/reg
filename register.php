<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>


	<?php

if(isset($_POST["register"])){


if(/*!empty($_POST['full_name']) && !empty($_POST['email']) &&*/!empty($_POST['login']) && !empty($_POST['password'])) {
	/*$full_name=$_POST['full_name'];
	$email=$_POST['email'];*/
	$username=$_POST['login'];
	$password=$_POST['password'];
	

		
	$query=mysqli_query("SELECT * FROM users WHERE login='".$username."'");
	$numrows=mysqli_num_rows($query);
	
	if($numrows==0)
	{
	$sql="INSERT INTO users
			(/*full_name, email, */login,password) 
			VALUES(/*'$full_name','$email',*/ '$username', '$password')";

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
	<!--	<label for="user_login">Имя<br />
		<input type="text" name="full_name" id="full_name" class="input" size="32" value=""  /></label>
	</p>
	
	<label for="user_pass">Email<br />
		<input type="email" name="email" id="email" class="input" value="" size="32" /></label>
	</p>
	-->
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