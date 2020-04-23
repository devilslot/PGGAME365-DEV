<?php

	require_once "private/route/bootstart.php";

	use app\casino_sa\Controller\CasinoSaController;

	$request = $_REQUEST['request'] ?? $_POST['request'] ?? $_GET['request'] ?? NULL;

	if(!empty($request)){
			CasinoSaController::$request();
	}else{
		echo 'No Request';
		exit();
	}
