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
                $VKTOKEN=$row['VK_TOKEN'];
                $VKID=$row['VK_ID'];
                };
            }

                echo $VKTOKEN;
                 $token = $VKTOKEN;
                $user_id = $VKID;
                 $group_id =$VKID;

                $text = '$texto';
                $image = '$img';

                    try {
                        $vk = \vkApi\vk::create('$token');
                        $post = new \vkApi\post($vk, $user_id, $group_id);
                        $post->post($text, $image);
                        echo 'Success!';
                    } catch(Exception $e){
                        echo 'Error: <b>' . $e->getMessage() . '</b><br />';
                        echo 'in file "' . $e->getFile() . '" on line ' . $e->getLine();
                                            }
                    } else{}
        if ($tw!=0){
                $TWITTERTOKEN=mysqli_query($con,"SELECT TW_TOKEN FROM users WHERE LOGIN ='".$login."'");
                $TWITTER_SECRET=mysqli_query($con,"SELECT TW_VERIFYER FROM users WHERE LOGIN ='".$login."'");

                $CONSUMERKEY='fKvwccSUHi7TVX6RvFZtUTNk8';
                $CONSUMERSECRET='jlH8AK22YuWP5rqmMlaGgqD9Hg7LonEAkHw0pTI1qcIqiIgVrA';
                $connection = new TwitterOAuth($CONSUMERKEY,$CONSUMERSECRET,$TWITTERTOKEN,$TWITTER_SECRET);
                $content = $connection->get('account/verify_credentials');
                $connection->post('statuses/update', array('status' => '$text'));
                } else{}
               
        
                }
            


    
       
    // очищаем результат

               ?>
</body>
</html>