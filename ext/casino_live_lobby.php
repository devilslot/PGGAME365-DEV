<?php

	require_once "private/route/bootstart.php";

	use app\casino_live\Controller\CasinoLiveController;

	$request = $_REQUEST['request'] ?? $_POST['request'] ?? $_GET['request'] ?? NULL;

	if(!empty($request)){
			CasinoLiveController::$request();
	}else{
		echo 'No Request';
		exit();
	}
