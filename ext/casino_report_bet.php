<?php
	require_once "private/route/bootstart_popup.php";

	use app\casino\Controller\CasinoReportBetController;

	$request = $_REQUEST['request'] ?? $_POST['request'] ?? $_GET['request'] ?? NULL;

	if(!empty($request)){
			CasinoReportBetController::$request();
	}else{
    	$smarty->display('CasinoReportBet/CasinoReportBet.tpl'); // default template
	}
