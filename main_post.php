<?php
error_reporting(0);

require 'vk.php';
require 'post.php';
####Добавить бд и загрузку по сессиям
$token = 'a07da5c9c6a72d76bcbc3a5bfbd8d88b0dc0e511db1ae657b61eb4235cfebb1a1bdd173f7ec577af6ab65';
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
}
