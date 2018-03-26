<?php include("includes/header.php"); 
error_reporting(E_ALL);
require_once("includes/connection.php");

session_start();
if(!isset($_SESSION["session_username"])) {
    header("location:main.php");
} else {}
?>




<div id="welcome">  
    
    <h2><span><?php echo $_SESSION['session_username'];?></span></h2>
    <input type="checkbox" name="postVK" id="postVK" /><a>опубликовать в VK</a>  
    <input type="checkbox" name="postVK" id="postVK" /><a>опубликовать в twitter</a><br>
    <textarea maxlength="140" cols="68" rows="4" placeholder="Введите текст вашего поста ..."></textarea>
    <form name="addpost" id="addpostform" action="" method="POST">
    
        <input type="text" name="img_src" id="img_src" class="input" value="" size="30" placeholder="Добавьте ссылку на картинку" /></label>

        <input type='text' class='datepicker-here' data-timepicker="true" placeholder="выберите дату поста"/>
        <script>
            $('#minMaxExample').datepicker({
    // Можно выбрать тольо даты, идущие за сегодняшним днем, включая сегодня
             minDate: new Date()
})</script>

    

        <p class="submit">
        <input type="submit" name="addpost" class="button" value="Опубликовать пост" /><br>
        <p class="submit">
        <input type="submit" name="addpost" class="button" value="Отложить пост" />
      
</form>

    <a href="logout.php">Выйти из аккаунта </a><br><a href="logout.php">     Удалить аккаунт</a>
</div>

<?php
include("includes/footer.php");
?>