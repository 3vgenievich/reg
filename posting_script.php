<?php
require_once("includes/connection.php");
require_once ("twitteroauth/twitteroauth.php");
require 'vk.php';
require 'post.php';
$t=time()+(18000);
$tminus=time()+(17700);
$perm_time=( date('Y-m-d H:i:s', $t));
$permtimeminus=( date('Y-m-d H:i:s', $tminus));

#echo ($perm_time);
#echo "$permtimeminus<br>";  

$query ="SELECT * FROM posts WHERE DATETIME BETWEEN '$permtimeminus' AND '$perm_time'";
$result = mysqli_query($con, $query);

    $rows = mysqli_num_rows($result); // количество полученных строк
    echo($rows);
    for ($i = 0 ; $i < $rows ; ++$i)
    {
       while( $row = mysqli_fetch_assoc($result)){
                $login=$row['LOGIN'];
                $text =$row['TEXT'];
                $img=$row['IMG'];
                $tw=$row['VK'];
                $vk=$row['TW'];
                };
                $VKTOKEN=mysqli_query($con,"SELECT VK_TOKEN FROM users WHERE LOGIN ='$login'");
                $VKID=mysqli_query($con,"SELECT VK_ID FROM users WHERE LOGIN ='$login'");
                $TWITTERTOKEN=mysqli_query($con,"SELECT TW_TOKEN FROM users WHERE LOGIN ='$login'");
                $TWITTER_SECRET=mysqli_query($con,"SELECT TW_VERIFYER FROM users WHERE LOGIN ='$login'");
                $CONSUMERKEY='fKvwccSUHi7TVX6RvFZtUTNk8';
                $CONSUMERSECRET='jlH8AK22YuWP5rqmMlaGgqD9Hg7LonEAkHw0pTI1qcIqiIgVrA';
            
                if ($tw==1){
                    $connection = new TwitterOAuth($CONSUMERKEY,$CONSUMERSECRET , $TWITTERTOKEN, $TWITTER_SECRET);
                    $content = $connection->get('account/verify_credentials');
                    $connection->post('statuses/update', array('status' => '$text'));
                }
               
                    if ($vk==1){$token = '$VKTOKEN';
                    $user_id = $VKID;
                    $group_id = null;

                    $text = '$text';
                    $image = '$img';

                    try {
                        $vk = \vkApi\vk::create($token);
                        $post = new \vkApi\post($vk, $user_id, $group_id);
                        $post->post($text, $image);
                        echo 'Success!';
                    } catch(Exception $e){
                        echo 'Error: <b>' . $e->getMessage() . '</b><br />';
                        echo 'in file "' . $e->getFile() . '" on line ' . $e->getLine();
                                            }
                    }

            }
       
    
   
     
    // очищаем результат
    mysqli_free_result($result);

 
mysqli_close($con);
?>
</body>
</html>