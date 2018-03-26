<?php
error_reporting(0);

require 'vk.php';
require 'post.php';
####Добавить бд и загрузку по сессиям
$token = '1e0f79ef10817ce514bd0cb5ae7656a5126b087edc4b0d9658bab3f566897450916c864aae8c587f6a4e5';
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
