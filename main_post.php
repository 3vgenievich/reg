<?php
error_reporting(0);

require 'vk.php';
require 'post.php';
####Добавить бд и загрузку по сессиям
$token = '1ec384f7eacb9422aed1237bd2c6e26b02c25f9f63818d05095fbe062701de6f2d61c577fbdeaa57d7c66';
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