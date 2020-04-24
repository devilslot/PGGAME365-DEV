<?php

session_start();

ini_set('display_errors', 0);

ini_set('display_startup_errors', 0);

error_reporting(0);

date_default_timezone_set("Asia/Bangkok");

require_once 'function.php';


/* SETTING */



// BANK

//$bank['fullname'] = 'วันชัย เฟื่องเงิน';

//$bank['number'] = '1712961378';



//WALLET
/*
$wallet[1]['fullname'] = 'พลรัตน์ เจนจุลพร';

$wallet[1]['number'] = '0886036076';

$wallet[2]['fullname'] = 'จิระศักดิ์ พันธ์นาม';

$wallet[2]['number'] = '0886982035';*/



//FRIEND

/* DB SETTING */

$DB_Host = 'localhost';
$DB_Username = 'dev01_usr';
$DB_Password = '4i5yH7ZWMO1zY35k';
$DB_Name = 'dev01';
$DB_Charset = 'utf8';

$mysqli = new mysqli($DB_Host, $DB_Username, $DB_Password, $DB_Name);

mysqli_set_charset($mysqli, $DB_Charset);

mysqli_options($mysqli,MYSQLI_INIT_COMMAND,"SET time_zone = 'Asia/Bangkok'" );

if ($mysqli->connect_errno) {

    printf("Connect failed: %s\n", $mysqli->connect_error);

    exit();

}

?> 