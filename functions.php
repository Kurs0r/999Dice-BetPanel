<?php
$key = '7ca45b1159344a2285afe69115ac24c9';
$numbets = null;
function CreateAccount() {
	$ch = curl_init();
	
	$data_to_post = [
	'a' => 'CreateAccount',
	'Key' => $GLOBALS['key'],
];

	curl_setopt($ch, CURLOPT_URL,"https://www.999dice.com/api/web.aspx");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_post);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	// In real life you should use something like:
	// curl_setopt($ch, CURLOPT_POSTFIELDS, 
	// http_build_query(array('postvar1' => 'value1')));
	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	// echo $server_output;					//$

	// Further processing ...
	#if ($server_output == "OK") { ... } else { ... }
	$decoded_output = json_decode($server_output, TRUE);
	//print_r($decoded_output);				//$decoded_output is now an array
											//store array as session variables
	$_SESSION['accountcookie'] = $decoded_output['AccountCookie'];
	$_SESSION['sessioncookie'] = $decoded_output['SessionCookie'];
	$_SESSION['accountid'] = $decoded_output['AccountId'];
	//echo "CreateAccount() Output: ", print_r($decoded_output), "<br><br>";		//check output
	//setcookie(SessionCookie, $decoded_output['SessionCookie'], time() + (86400 * 30), "/", 0);
	//print_r($_COOKIE);
	curl_close ( $ch );
	}
	
function Login() {
	$ch = curl_init();
	$data_to_post = [
	'a' => 'Login',
	'Key' => $GLOBALS['key'],
	'Username' => $_SESSION['name'],
	'Password' => $_SESSION['pwd'],
	];

	curl_setopt($ch, CURLOPT_URL,"https://www.999dice.com/api/web.aspx");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_post);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	// In real life you should use something like:
	// curl_setopt($ch, CURLOPT_POSTFIELDS, 
	// http_build_query(array('postvar1' => 'value1')));
	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	curl_close ( $ch );
	// echo $server_output;					//$

	// Further processing ...
	#if ($server_output == "OK") { ... } else { ... }
	$decoded_output = json_decode($server_output, TRUE);
	//print_r($decoded_output);				
	$_SESSION['sessioncookie'] = $decoded_output['SessionCookie'];
	$_SESSION['accountid'] = $decoded_output['AccountId'];
	$_SESSION['btcbalance'] = $decoded_output['Balance'];
	$_SESSION['btcdepositaddress'] = $decoded_output['DepositAddress'];
	$_SESSION['DOGE'] = array($decoded_output['Doge']);
	$_SESSION['LTC'] = array($decoded_output['LTC']);
	//$_SESSION['register'] = 0;
	//print_r($_SESSION['DOGE']);
	//print_r($_SESSION);
	
	//echo "Login() Output: ", print_r($decoded_output), "<br><br>";				//check output

}

function CreateUser() {
	$ch = curl_init();
	
	$data_to_post = [
	'a' => 'CreateUser',
	's' => $_SESSION['sessioncookie'],
	'Username' => $_SESSION['name'],
	'Password' => $_SESSION['pwd'],
	];

	curl_setopt($ch, CURLOPT_URL,"https://www.999dice.com/api/web.aspx");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_post);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	// In real life you should use something like:
	// curl_setopt($ch, CURLOPT_POSTFIELDS, 
	// http_build_query(array('postvar1' => 'value1')));
	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	// echo $server_output;					//$

	// Further processing ...
	#if ($server_output == "OK") { ... } else { ... }
	curl_close ($ch);
	$decoded_output = json_decode($server_output, TRUE);
	if (isset($decoded_output['success'])) {
	echo 'Account created successfully. Please log in to continue.';
	$_SESSION['register'] = 0;
	$page = '/index.php';
	header("Refresh: 15 url=$page");
	}
	else
		echo 'an unkown error has occurred.';
}




	
function PlaceBet() {
	if (isset($_POST['submit']) and isset($_POST['placebets'])) {
		$x = 0;
	if (isset($_POST['numbets'])) {
		$numbets = $_POST['numbets'];		
	}
	else {
		$numbets = "1";
	}
	set_time_limit(35000);
	$time_pre = microtime(true);
	$payin = $_POST['payin'] * 100000000;
	if (isset($_POST['5c'])) {
	$low = rand(0, 949499);
	$high = $low + 50000;
	}
	else {
	$low = $_POST['low'];
	$high = $_POST['high'];
	}
	do {
	$ch = curl_init();
	$data_to_post = [
	'a' => 'PlaceBet',
	's' => $_SESSION['sessioncookie'],
	'PayIn' => $payin,
	'Low' => $low,
	'High' => $high,
	'ClientSeed' => $_POST['clientseed'],
	'Currency' => $_POST['currency']
	];

	curl_setopt($ch, CURLOPT_URL,"https://www.999dice.com/api/web.aspx");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_post);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	// In real life you should use something like:
	// curl_setopt($ch, CURLOPT_POSTFIELDS, 
	// http_build_query(array('postvar1' => 'value1')));
	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	// echo $server_output;					//$

	// Further processing ...
	#if ($server_output == "OK") { ... } else { ... }
	$decoded_output = json_decode($server_output, TRUE);
	//print_r($decoded_output);				
	$_SESSION[1]['lastbet'] = $decoded_output;	
	//$_SESSION['register'] = 0;
	//print_r($_SESSION['DOGE']);
	//print_r($_SESSION[1]['lastbet']);
	//echo "PlaceBet Output: ", $decoded_output;
	//echo "<br><br>";				//check output
	if (isset($decoded_output['BetId']) == FALSE) {
		print_r($decoded_output);
		sleep(1);
		break;
	}
	if (isset($_SESSION[1]['lastbet']['PayOut'])) {
	if ($_SESSION[1]['lastbet']['PayOut'] == 0) {
		$_SESSION[1]['lastbet']['PayOut'] = $payin * -1;
		
		$x = $x + 1;
		if ($x % 27 and rand(0, 1000) > rand(0, 500) and isset($_POST['5c']) == FALSE) {
			$payin = $payin * 4;
			
		}
		elseif ($x % 4 and $x > 10 and isset($_POST['5c']) == FALSE) {
			$low = rand(0, 499499);
			$high = rand(499500, 979000);
			
			
		}
		else {
			$payin = $payin * 3;
			
		}
		
	}
	else {
		$_SESSION[1]['lastbet']['PayOut'] = $payin;
		$payin = $_POST['payin'] * 100000000;
		$x = $x + 1;
	}
	echo '<center>[', $x, '] Last bet result: <br>', $_SESSION[1]['lastbet']['PayOut'], '<br>Balance: ', ($_SESSION[1]['lastbet']['StartingBalance'] + $_SESSION[1]['lastbet']['PayOut']), '<br><br></center>' ;
	$numbets = $numbets - 1;
	}

	else {
		echo 'Error:';
		print_r($decoded_output);
		sleep(2);
		$numbets = $numbets - 1;
	}
	} while ($numbets > 0);
	
$time_post = microtime(true);
$exec_time = $time_post - $time_pre;
echo "Execution time: ", $exec_time, "<br>";
	curl_close ( $ch );
	#$page = '/panel.php';
	#header("Refresh: 0 url=$page");


}


}