<?php

session_start();

ini_set('display_errors', 0);

ini_set('display_startup_errors', 0);

error_reporting(0);

date_default_timezone_set("Asia/Bangkok");

require_once 'function.php';


/* SETTING */



// BANK

$bank['fullname'] = 'วันชัย เฟื่องเงิน';

$bank['number'] = '1712961378';



//WALLET
/*
$wallet[1]['fullname'] = 'พลรัตน์ เจนจุลพร';

$wallet[1]['number'] = '0886036076';

$wallet[2]['fullname'] = 'จิระศักดิ์ พันธ์นาม';

$wallet[2]['number'] = '0886982035';*/



//Game Config 

/*
Wallet Type: Seamless Wallet

1.operator_token
febbef7fac4d0b817fcdddd9c8ec54c8

2.secret_key
fedf32e5f5baff64efd7982f9ad07112

3.Api Domain (PgSoftAPIDomain)
https://api.int.pg-bo.net/external

4. PgSoftPublicDomain
https://public.pg-redirect.net/history/redirect.html?t={0}&psid={1}&sid={2}&gid={3}&type=operator

5.Launch URL (URL Scheme)
https://m.pg-redirect.net/{game_code}/index.html?language={0}&bet_type={1}&operator_token={2}&operator_player_session={3}

bet_type: 1=Real Money, 2=Trial

6.BackOffice URL
https://Allbet4X.int.pg-bo.net/
Username: Allbet4X
Password: d3@Dm3^L

7. Web Lobby (Game Demo)
https://public.pg-redirect.net/web-lobby/tournament/?operator_token=fu6fpagpekf7445m6sdeecr8xvkkfvy6&operator_player_session=abc123-abc123&language=en
*/

$gameconfig['operator_token'] = 'febbef7fac4d0b817fcdddd9c8ec54c8';
$gameconfig['secret_key'] = 'fedf32e5f5baff64efd7982f9ad07112';
$gameconfig['api_domain'] = 'https://api.int.pg-bo.net/external';
$gameconfig['public_domain'] = 'https://public.pg-redirect.net/history/redirect.html?t={0}&psid={1}&sid={2}&gid={3}&type=operator';
$gameconfig['game_domain'] = 'https://m.pg-redirect.net';
$gameconfig['lobby'] = 'https://public.pg-redirect.net/web-lobby/';
$gameconfig['mobile'] = 'https://m.pg-demo.com/lobby/';


//FRIEND



/* URL SETTING */

$Web['url'] = 'https://test.pggame999.com';

$Api['url'] = 'https://test.pggame999.com/api/new/';
$Api2['url'] = 'https://test.pggame999.com/api/';

$line['url'] = 'https://bit.ly/2MLJQfg';

/* DB SETTING */

$DB_Host = 'localhost';

$DB_Username = 'user_pggame999';

$DB_Password = '!QAZxdr5';

$DB_Name = 'pggame999_tst';

$DB_Charset = 'utf8';





$mysqli = new mysqli($DB_Host, $DB_Username, $DB_Password, $DB_Name);

mysqli_set_charset($mysqli, $DB_Charset);

mysqli_options($mysqli,MYSQLI_INIT_COMMAND,"SET time_zone = 'Asia/Bangkok'" );

if ($mysqli->connect_errno) {

    printf("Connect failed: %s\n", $mysqli->connect_error);

    exit();

}

?> 