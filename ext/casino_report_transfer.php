<?php
	require_once "private/route/bootstart_popup.php";

	use app\casino\Controller\CasinoReportTransferController;

	$request = $_REQUEST['request'] ?? $_POST['request'] ?? $_GET['request'] ?? NULL;

	if(!empty($request)){
			CasinoReportTransferController::$request();
	}else{
    	$smarty->display('CasinoReportTransfer/CasinoReportTransfer.tpl'); // default template
	}
