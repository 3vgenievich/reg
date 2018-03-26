<?php
error_reporting(0);

require 'vk.php';
require 'post.php';

$token = '0b1d9617d8010672dbdf19712641aefdb5b4c1f4408a635385826417007f01c3474bad786a746c8fdb98c';
$user_id = '27576466';
$group_id = '27576466';

$text = 'PREVED_MEDVED';
$image = 'YOUR IMAGE';

try {
    $vk = \vkApi\vk::create($token);
    $post = new \vkApi\post($vk, $user_id, $group_id);
    $post->post($text, $image);
    echo 'Success!';
} catch(Exception $e){
    echo 'Error: <b>' . $e->getMessage() . '</b><br />';
    echo 'in file "' . $e->getFile() . '" on line ' . $e->getLine();
}