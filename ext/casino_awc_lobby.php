<?php

	require_once "private/route/bootstart.php";

	use app\casino_awc\Controller\CasinoAwcController;

	$request = $_REQUEST['request'] ?? $_POST['request'] ?? $_GET['request'] ?? NULL;

	if(!empty($request)){
			CasinoAwcController::$request();
	}else{
		echo 'No Request';
		exit();
	}
