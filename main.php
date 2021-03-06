
<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
	header("location:index.php");
} else {
?>

<?php include("includes/header.php"); ?>
<div id="welcome">	
	<h3>Привет, <span><?php echo $_SESSION['session_username'];?> </span>!  Для создания отложенных постов необходимо авторизоваться с помощью социальных сетей.</h3>
    <h4>Из-за особенностей методов ВКонтакте, токен вконтакте придется получать вручную.</h4>
<?php

error_reporting(E_ALL);
require_once('./oauth/src/VK.php');
require_once('./oauth/src/VKException.php');
require_once('includes/connection.php');





####АВТОРИЗАЦИЯ ВКОНТАКТЕ
$vk_config = array(
    'app_id'        => '6424579',
    'api_secret'    => 'U8XC2uhFFQUOQO7ekXEz',
    'callback_url'  => 'blank.html',
    'api_settings'  => 'notify,friends,photos,wall,offline' // In this example use 'friends'.
    // If you need infinite token use key 'offline'.
);

try {
    $vk = new VK\VK($vk_config['app_id'], $vk_config['api_secret']);
    
    if (!isset($_REQUEST['code'])) {
        $authorize_url = $vk->getAuthorizeURL(
            $vk_config['api_settings'], $vk_config['callback_url']);

        echo '<a href="' . $authorize_url . '" target="_blank">Авторизуйтесь через ВК</a>';
    } else {
        $access_token = $vk->getAccessToken($_REQUEST['code'], $vk_config['callback_url']);
          $token=$access_token['access_token'];
        $idvk=$access_token['user_id'];
        $log=$_SESSION["session_username"];
     /*   echo 'access token: ' . $token
            . '<br />user id: ' . $idvk . '<br /><br />';*/
        mysqli_query($con,"UPDATE users SET VK_TOKEN='$token' WHERE LOGIN='$log';");
	   mysqli_query($con,"UPDATE users SET VK_ID='$idvk' WHERE LOGIN='$log';");
        $user_friends = $vk->api('friends.get', array(
            'uid'       => '12345',
            'fields'    => 'uid,first_name,last_name',
            'order'     => 'name'
        ));
        
        foreach ($user_friends['response'] as $key => $value) {
            echo $value['first_name'] . ' ' . $value['last_name'] . ' ('
                . $value['uid'] . ')<br />';
        }
    }
} catch (VK\VKException $error) {
    echo $error->getMessage();
}
?>

<form name="addtokenform" id="addtokenform" action="" method="post">
        <input type="text" name="token" id="token" class="input" value="" size="50" placeholder="Вставьте сюда токен вконтакте" />
        <input type="text" name="uid" id="uid" class="input" value="" size="50" placeholder="Вставьте сюда ID вконтакте" />
        <input type="submit" name="submit" id="register" class="button" value="ОК" onclick = "this.style.visibility='hidden'" />

</form>

<?php if (!empty($message)) {echo "<p class=\"error\">" . "Внимание: ". $message . "</p>";} ?>

<?php
if(isset($_POST["submit"])){

if(isset($_POST['token'])&& isset($_POST['uid'])){

    $token=$_POST['token'];
    $uid=$_POST['uid'];
    $LOGIN=$_SESSION['session_username'];
    $result=mysqli_query($con,"UPDATE users SET VK_TOKEN='$token' WHERE LOGIN='$LOGIN';");
    $result=mysqli_query($con,"UPDATE users SET VK_ID='$uid' WHERE LOGIN='$LOGIN';");
}
}
    ?>

<?php

// определяем изначальные конфигурационные данные

define('CONSUMER_KEY', 'fKvwccSUHi7TVX6RvFZtUTNk8');
define('CONSUMER_SECRET', 'jlH8AK22YuWP5rqmMlaGgqD9Hg7LonEAkHw0pTI1qcIqiIgVrA');

define('REQUEST_TOKEN_URL', 'https://api.twitter.com/oauth/request_token');
define('AUTHORIZE_URL', 'https://api.twitter.com/oauth/authorize');
define('ACCESS_TOKEN_URL', 'https://api.twitter.com/oauth/access_token');
define('ACCOUNT_DATA_URL', 'https://api.twitter.com/1.1/users/show.json');

define('CALLBACK_URL', '');


// формируем подпись для получения токена доступа
define('URL_SEPARATOR', '&');

$oauth_nonce = md5(uniqid(rand(), true));
$oauth_timestamp = time();

$params = array(
    'oauth_callback=' . urlencode(CALLBACK_URL) . URL_SEPARATOR,
    'oauth_consumer_key=' . CONSUMER_KEY . URL_SEPARATOR,
    'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
    'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
    'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
    'oauth_version=1.0'
);

$oauth_base_text = implode('', array_map('urlencode', $params));
$key = CONSUMER_SECRET . URL_SEPARATOR;
$oauth_base_text = 'GET' . URL_SEPARATOR . urlencode(REQUEST_TOKEN_URL) . URL_SEPARATOR . $oauth_base_text;
$oauth_signature = base64_encode(hash_hmac('sha1', $oauth_base_text, $key, true));


// получаем токен запроса
$params = array(
    URL_SEPARATOR . 'oauth_consumer_key=' . CONSUMER_KEY,
    'oauth_nonce=' . $oauth_nonce,
    'oauth_signature=' . urlencode($oauth_signature),
    'oauth_signature_method=HMAC-SHA1',
    'oauth_timestamp=' . $oauth_timestamp,
    'oauth_version=1.0'
);
$url = REQUEST_TOKEN_URL . '?oauth_callback=' . urlencode(CALLBACK_URL) . implode('&', $params);

$response = file_get_contents($url);
parse_str($response, $response);

$oauth_token = $response['oauth_token'];
$oauth_token_secret = $response['oauth_token_secret'];


// генерируем ссылку аутентификации

$link = AUTHORIZE_URL . '?oauth_token=' . $oauth_token;

echo '<br><a href="' . $link . '">Авторизоваться через Twitter</a>';


if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
    // готовим подпись для получения токена доступа

    $oauth_nonce = md5(uniqid(rand(), true));
    $oauth_timestamp = time();
    $oauth_token = $_GET['oauth_token'];
    $oauth_verifier = $_GET['oauth_verifier'];


    $oauth_base_text = "GET&";
    $oauth_base_text .= urlencode(ACCESS_TOKEN_URL)."&";

    $params = array(
        'oauth_consumer_key=' . CONSUMER_KEY . URL_SEPARATOR,
        'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
        'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
        'oauth_token=' . $oauth_token . URL_SEPARATOR,
        'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
        'oauth_verifier=' . $oauth_verifier . URL_SEPARATOR,
        'oauth_version=1.0'
    );

    $key = CONSUMER_SECRET . URL_SEPARATOR . $oauth_token_secret;
    $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode(ACCESS_TOKEN_URL) . URL_SEPARATOR . implode('', array_map('urlencode', $params));
    $oauth_signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

    // получаем токен доступа
    $params = array(
        'oauth_nonce=' . $oauth_nonce,
        'oauth_signature_method=HMAC-SHA1',
        'oauth_timestamp=' . $oauth_timestamp,
        'oauth_consumer_key=' . CONSUMER_KEY,
        'oauth_token=' . urlencode($oauth_token),
        'oauth_verifier=' . urlencode($oauth_verifier),
        'oauth_signature=' . urlencode($oauth_signature),
        'oauth_version=1.0'
    );
    $url = ACCESS_TOKEN_URL . '?' . implode('&', $params);

    $response = file_get_contents($url);
    parse_str($response, $response);


    // формируем подпись для следующего запроса
    $oauth_nonce = md5(uniqid(rand(), true));
    $oauth_timestamp = time();

    $oauth_token = $response['oauth_token'];
    $oauth_token_secret = $response['oauth_token_secret'];
    $screen_name = $response['screen_name'];

    $params = array(
        'oauth_consumer_key=' . CONSUMER_KEY . URL_SEPARATOR,
        'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
        'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
        'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
        'oauth_token=' . $oauth_token . URL_SEPARATOR,
        'oauth_version=1.0' . URL_SEPARATOR,
        'screen_name=' . $screen_name
    );
    $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode(ACCOUNT_DATA_URL) . URL_SEPARATOR . implode('', array_map('urlencode', $params));

    $key = CONSUMER_SECRET . '&' . $oauth_token_secret;
    $signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

	// получаем данные о пользователе
    $params = array(
        'oauth_consumer_key=' . CONSUMER_KEY,
        'oauth_nonce=' . $oauth_nonce,
        'oauth_signature=' . urlencode($signature),
        'oauth_signature_method=HMAC-SHA1',
        'oauth_timestamp=' . $oauth_timestamp,
        'oauth_token=' . urlencode($oauth_token),
        'oauth_version=1.0',
        'screen_name=' . $screen_name
    );

    $url = ACCOUNT_DATA_URL . '?' . implode(URL_SEPARATOR, $params);

    $response = file_get_contents($url);
    $user_data = json_decode($response, true);
   /* echo 'oauth token: ' . $oauth_token . '<br />verifier: ' . $oauth_verifier . '<br /><br />';
    echo 'oauth token: ' . $oauth_timestamp . '<br />verifier: ' . $oauth_token_secret . '<br /><br />';*/
    $log=$_SESSION["session_username"];
    mysqli_query($con,"UPDATE users SET TW_TOKEN='$oauth_token' WHERE LOGIN='$log';");
	mysqli_query($con,"UPDATE users SET TW_VERIFYER='$oauth_token_secret' WHERE LOGIN='$log';");
}
?>
<?php
$log=$_SESSION["session_username"];
$query = "SELECT * FROM `users` WHERE LOGIN ='$log' AND TW_TOKEN IS NOT NULL AND VK_TOKEN IS NOT NULL AND TW_VERIFYER IS NOT NULL AND VK_ID IS NOT NULL;";
$res = mysqli_query($con,$query) or die(mysql_error());
    if (mysqli_num_rows($res)!=0)

    {
    /* Redirect browser */
    header("Location: main_post.php");
    }
    else
    {

    }

 ?>
</div>


<?php include("includes/footer.php"); ?>

<div id="logout">
		<p><a href="logout.php">Выйти из аккаунта </a></p>
</div>


<?php
}
?>

<!--ВК авторизация-->
