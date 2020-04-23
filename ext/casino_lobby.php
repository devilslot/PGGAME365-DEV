<?php

	require_once "private/route/bootstart.php";

	use app\casino\Controller\CasinoLobbyController;

	$request = $_REQUEST['request'] ?? $_POST['request'] ?? $_GET['request'] ?? NULL;

	if(!empty($request)){
			CasinoLobbyController::$request();
	}else{
		echo 'No Request';
		exit();
	}
