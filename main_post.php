<?php
error_reporting(0);

/*require 'vk.php';
require 'post.php';
####Добавить бд и загрузку по сессиям
$token = '903104ac2c9faf89d65c8759e3264422695d36bb1bd21e452558ce126667da7a02850b2fefa3b35bf6878';
$user_id = 27576466;
$group_id = null;

$text = '12345';
$image = 'http://www.intermedia.ru/img/news/311875.jpg';

try {
    $vk = \vkApi\vk::create($token);
    $post = new \vkApi\post($vk, $user_id, $group_id);
    $post->post($text, $image);
    echo 'Success!';
} catch(Exception $e){
    echo 'Error: <b>' . $e->getMessage() . '</b><br />';
    echo 'in file "' . $e->getFile() . '" on line ' . $e->getLine();
}*/
?>
<!-- Подключение Open API -->
<script src="http://vk.com/js/api/openapi.js" type="text/javascript"></script>
 
<!-- Кнопка аутентификации в соц. сети -->
<div id="login_button" onclick="VK.Auth.login(RedBookCMSautoPosting);"></div>
<script language="javascript">
VK.init({
    apiId: 	6424647 /* сюда выписываем идентификатор приложения */
});
 
function RedBookCMSautoPosting(response) {
    var content = "VK Open API проверка автопостинга.";
    if (response.session) {
        VK.Api.call('wall.post', {message: content}, function(r) {}); 
    } else {
        alert('Не авторизован!');
    }
}
 
VK.Auth.getLoginStatus(RedBookCMSautoPosting);
VK.UI.button('login_button');
</script>
