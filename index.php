<?php
session_start();
?>

<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>

<?php

if(isset($_SESSION["session_username"])){

header("Location: main.php");
}

if(isset($_POST["LOGIN"])){

if(!empty($_POST['LOGIN']) && !empty($_POST['PASSWORD'])) {
    $LOGIN=$_POST['LOGIN'];
    $PASSWORD=$_POST['PASSWORD'];

    $query =mysqli_query($con,"SELECT * FROM users WHERE LOGIN='".$LOGIN."' AND PASSWORD='".$PASSWORD."'");

    $numrows=mysqli_num_rows($query);
    if($numrows!=0)

    {
    while($row=mysqli_fetch_assoc($query))
    {
    $dbusername=$row['LOGIN'];
    $dbpassword=$row['PASSWORD'];
    }

    if($LOGIN == $dbusername && $PASSWORD == $dbpassword)

    {


    $_SESSION['session_username']=$LOGIN;

    /* Redirect browser */
    header("Location: main.php");
    }
    } else {

 $message =  "Не правильный логин или пароль!";
    }

} else {
    $message = "Заполните все поля!";
}
}
?>




    <div class="container mlogin">
            <div id="login">
    <h1>АВТОРИЗАЦИЯ</h1>
<form name="loginform" id="loginform" action="" method="POST">
    <p>
        <label for="user_login">Логин<br />
        <input type="text" name="LOGIN" id="LOGIN" class="input" value="" size="20" /></label>
    </p>
    <p>
        <label for="user_pass">Пароль<br />
        <input type="PASSWORD" name="PASSWORD" id="password" class="input" value="" size="20" /></label>
    </p>
        <p class="submit">
        <input type="submit" name="login" class="button" value="Войти" />
    </p>
        <p class="regtext">Не зарегистрированы? <a href="register.php" >Нажмите сюда</a>!</p>
</form>

    </div>

    </div>
	
	<?php include("includes/footer.php"); ?>
	
	<?php if (!empty($message)) {echo "<p class=\"error\">" . "Внимание: ". $message . "</p>";} ?>
	