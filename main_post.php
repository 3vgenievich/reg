<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
    header("location:login.php");
} else {}
?>

<?php include("includes/header.php"); ?>
<div id="welcome">  
    <h2><span><?php echo $_SESSION['session_username'];?></span></h2>
    <input type="checkbox" name="postVK" id="postVK" /><a>опубликовать в VK</a>  
    <input type="checkbox" name="postVK" id="postVK" /><a>опубликовать в twitter</a><br>
    <textarea maxlength="140" cols="68" rows="4" placeholder="Введите текст вашего поста ..."></textarea>
    <form name="addpost" id="addpostform" action="" method="POST">
    <p>
        <label for="img_src">Ссылка на картинку<br>
        <input type="text" name="img_src" id="img_src" class="input" value="" size="20" placeholder="https://example.ru/img.jpg" /></label>
    </p>
   
        <p class="submit">
        <input type="submit" name="addpost" class="button" value="Отложить пост" />
</form>

    <a href="logout.php">Выйти из аккаунта </a><br><a href="logout.php">     Удалить аккаунт</a>
</div>

<?php
     require_once('includes/connection.php');
/*
$query ="SELECT 'TIME','DATE','TEXT','IMG' FROM posts";
 
$result = mysqli_query($con, $query) or die("Ошибка " . mysqli_error($con)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
     
    echo "<table><tr><th>Id</th><th>Время</th><th>Текст поста</th><th>Ссылка на картинку</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
     
    mysqli_free_result($result);
}
mysqli_close($con);*/
?>
</body>
</html>


<?php

error_reporting(E_ALL);
include("includes/header.php"); 
require_once("includes/connection.php");
include("includes/footer.php");

?>