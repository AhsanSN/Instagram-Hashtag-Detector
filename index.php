<!--database connection-->
<?php
    
$host='localhost';
$username='anomozco_chatuser1';
$user_pass='XhJ6a~U%C_Ws';
$database_in_use='anomozco_chat';

$con = mysqli_connect($host,$username,$user_pass,$database_in_use);
if (!$con)
{
    echo"not connected";
}
if (!mysqli_select_db($con,$database_in_use))
{
    echo"database not selected";
}
?>

<!DOCTYPE html>
<html>
<body>

<?
if ($_GET['code']){
    $code = $_GET['code'];
    //https://api.instagram.com/oauth/access_token
    //https://api.instagram.com/v1/users/self/media/recent/?access_token=7109981707.898d6c8.034c26cb207a468e8db1bdb4e14a1fe2
    $uri = 'https://api.instagram.com/oauth/access_token'; 
	$data = [
		'client_id' => '898d6c86cf63454eabd6d84d14f8c6bd', 
		'client_secret' => '6cabd0e37f87428abc5ac9fea43a9ff9', 
		'grant_type' => 'authorization_code', 
		'redirect_uri' => 'https://game.anomoz.com', 
		'code' => $code
	];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $uri); // uri
	curl_setopt($ch, CURLOPT_POST, true); // POST
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // POST DATA
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // RETURN RESULT true
	curl_setopt($ch, CURLOPT_HEADER, 0); // RETURN HEADER false
	curl_setopt($ch, CURLOPT_NOBODY, 0); // NO RETURN BODY false / we need the body to return
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // VERIFY SSL HOST false
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // VERIFY SSL PEER false
	$result = json_decode(curl_exec($ch)); // execute curl
	echo '<pre>'; // preformatted view
	
	// ecit directly the result
	echo"<a href='https://api.instagram.com/oauth/authorize/?client_id=898d6c86cf63454eabd6d84d14f8c6bd&redirect_uri=https://game.anomoz.com&response_type=code&scope=public_content'><button>Retry</button></a>";
	
	
	//print_r($result); 
	$data = json_encode((array)$result);
	$data = json_decode($data);

	$access_token = $data->access_token;
	echo $access_token;
	
	//access_token received
	
	//$url = "https://api.instagram.com/v1/users/self/media/recent/?access_token="+"strval($access_token);";
	$url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=7109981707.898d6c8.034c26cb207a468e8db1bdb4e14a1fe2";
	
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
    $json = curl_exec($ch);
    if(!$json) {
        echo curl_error($ch);
    }
    curl_close($ch);
    json_decode($json);
    $posts = $json->access_token;

}
else{
    
    echo"<a href='https://api.instagram.com/oauth/authorize/?client_id=898d6c86cf63454eabd6d84d14f8c6bd&redirect_uri=https://game.anomoz.com&response_type=code&scope=public_content'><button>Instagram Login</button></a>";
}
?>

</body>
</html>
