<?php
error_reporting(0);

require 'vk.php';
require 'post.php';
####Добавить бд и загрузку по сессиям
$token = '34dabc59fee0033cdb3050537946402b1f8926ab26681440645b5838d4beaad5906a15b5213bda427e1b9';
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
