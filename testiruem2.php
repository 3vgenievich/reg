<?php

require_once "twitteroauth/twitteroauth.php";

define("CONSUMER_KEY", "<e12piPQYzcVD8DVGE9AAr51y2>");
define("CONSUMER_SECRET", "<3wBVWwzQe8JFJ1zutDSc8XlGonbo7aCapnBnuWEzEGhmDKEO42>");
define("OAUTH_TOKEN", "<965916412857454592-QO9BVzWnwpSbdoC1RgxMc2aPjBeZPh3>");
define("OAUTH_SECRET", "<KFRkxvRwkhKbwURcm5CUO75D3XgkFMGdwDu20aiNX7BUF>");

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_SECRET);
$content = $connection->get('account/verify_credentials');

$connection->post('statuses/update', array('status' => 'Сообщение в Twitter автоматом из PHP :) .'));
    
?>