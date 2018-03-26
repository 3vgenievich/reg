<?php include("includes/header.php"); 
error_reporting(E_ALL);
require_once("includes/connection.php");

session_start();
if(!isset($_SESSION["session_username"])) {
    header("location:main.php");
} else {}
?>

<?php

if(isset($_POST["submit"])){
if(isset($_POST['checkVK']) or isset($_POST['checkTW']) && isset($_POST['textposta']) or isset($_POST['imgsrc'])&& isset($_POST['datetime'])){
    $checkVK=$_POST['checkVK'];
    $checkTW=$_POST['checkTW'];
    $textposta=$_POST['textposta'];
    $imgsrc=$_POST['imgsrc'];
    $datetime=$_POST['datetime'];
    $LOGIN=$_SESSION['session_username'];
   
    $query=mysqli_query($con,"SELECT * FROM posts");
    
    $sql="INSERT INTO posts
            (LOGIN,VK,TW,TEXT,DATETIME,IMG/*,VKGROUP_ID,RETWEET_URL*/) 
            VALUES('$LOGIN','$checkVK','$checkTW','textposta','imgsrc','datetime')";

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
?>

<?php if (!empty($message)) {echo "<p class=\"error\">" . "Внимание: ". $message . "</p>";} ?>


<div id="welcome">  
    
    <h2><span><?php echo $_SESSION['session_username'];?></span></h2>
    <form method="POST" action="">
    <input type="checkbox" name="checkVK" id="checkTW" class="input" /><a>опубликовать в VK</a>  
    <input type="checkbox" name="checkTW" id="checkTW " class="input" /><a>опубликовать в twitter</a><br>
    <textarea maxlength="140" cols="68" rows="4" name="textposta" placeholder="Введите текст вашего поста ..." class="input"></textarea>
    <input type="text" name="imgsrc" id="img_src" class="input" value="" size="30" placeholder="Добавьте ссылку на картинку" class="input" /></label>

    <input type='text' class='datepicker-here' data-timepicker="true" placeholder="выберите дату поста" name="datetime" class="input" />
    <script>
    $('#minMaxExample').datepicker({
    // Можно выбрать тольо даты, идущие за сегодняшним днем, включая сегодня
    minDate: new Date()
    })</script>

    

        <p class="submit">
        <input type="submit" name="submit" class="button" value="Опубликовать пост" /><br>
        <p class="submit">
        <input type="submit" name="submit" class="button" value="Отложить пост" />
      
    </form>

    <a href="logout.php">Выйти из аккаунта </a><br><a href="logout.php">     Удалить аккаунт</a>
</div>


<?php
include("includes/footer.php");
?>