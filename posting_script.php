<?php
error_reporting(0);
require_once("includes/connection.php");
require_once ("twitteroauth/twitteroauth.php");
require 'vk.php';
require 'post.php';

$t=time()+(18000);
$tminus=time()+(17700);
$perm_time=( date('Y-m-d H:i:s', $t));
$permtimeminus=( date('Y-m-d H:i:s', $tminus));


$query ="SELECT * FROM posts WHERE DATETIME BETWEEN '$permtimeminus' AND '$perm_time'";

$result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result); // количество полученных строк
    echo($rows);
    for ($i = 0 ; $i < $rows ; ++$i)
    {
       while( $row = mysqli_fetch_assoc($result))
       {
                 $login=$row['LOGIN'];
                 $texto=$row['TEXT'];
                 $img=$row['IMG'];
                 $tw=$row['VK'];
                 $vk=$row['TW'];
        }
        if ($vk!=0){
                $query =mysqli_query($con,"SELECT * FROM users WHERE LOGIN ='".$login."'");
                $numrows=mysqli_num_rows($query);
                if($numrows!=0)
                {
                while($row=mysqli_fetch_assoc($query))
                {
                $token=$row['VK_TOKEN'];
                $user_id=$row['VK_ID'];
                };
            }

               
                $token;
                $user_id;
                 $group_id =$user_id;

                $text = '$texto';
                $image = '$img';

                    try {
                        $vk = \vkApi\vk::create('$VKTOKEN');
                        $post = new \vkApi\post($vk, $user_id, $group_id);
                        $post->post($text, $image);
                        echo 'Success!';
                    } catch(Exception $e){
                        echo 'Error: <b>' . $e->getMessage() . '</b><br />';
                        echo 'in file "' . $e->getFile() . '" on line ' . $e->getLine();
                                            }
                    } else{}
        if ($tw!=0){
                 $query =mysqli_query($con,"SELECT * FROM users WHERE LOGIN ='".$login."'");
                $numrows=mysqli_num_rows($query);
                if($numrows!=0)
                {
                while($row=mysqli_fetch_assoc($query))
                {
                $TWITTERTOKEN=$row['TW_TOKEN'];
                $TWITTERSECRET=$row['TW_VERIFYER'];
                };
            }
                require_once('./twitter-api-php-master/TwitterAPIExchange.php');
    $settings = array(
    'oauth_access_token' => "$TWITTERTOKEN",
    'oauth_access_token_secret' => "$TWITTERSECRET",
    'consumer_key' => " e12piPQYzcVD8DVGE9AAr51y2",
    'consumer_secret' => "3wBVWwzQe8JFJ1zutDSc8XlGonbo7aCapnBnuWEzEGhmDKEO42"
);
$twitter = new TwitterAPIExchange($settings); // инициализируем класс с нашими параметрами
$url = 'https://api.twitter.com/1.1/statuses/update.json'; // стучим сюда
$requestMethod = 'POST'; // МЕТОД = POST, ибо ПОСТ делаем! (а не гет xD)
$postfields = array(
    'status' => '$texto'  ); // текст твита
$rtw = $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest(); //
                } else{}
               
        
                }
            


    
       
    // очищаем результат

               ?>
</body>
</html>