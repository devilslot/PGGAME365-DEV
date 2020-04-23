<?php
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

return array(
	'site_id' => 'PG365',
    'host' => 'https://sexybet.pggame365.com',
	'app_dir' => 'C:\\xampp\\htdocs\\pggame365\\sexygaming_bet\\',
	'img_url' => '/public/images/',
	'line_at_url' => 'https://line.me/R/ti/p/@pggame365',
	'css_url' => '/public/css/',
	'js_url' => '/public/js/',
	'brand_name' => 'PGGAME365',
	'brand_name_url' => 'sexybet.pggame365.com',
	'title' => 'สมัครสล็อต epicwin slot เว็บสล็อต ออโต้ สล็อตเล่นฟรี เครดิตฟรี',
	'operator_token' => 'febbef7fac4d0b817fcdddd9c8ec54c8',
	'secret_key' => 'fedf32e5f5baff64efd7982f9ad07112',
	'PgSoftAPIDomain' => 'https://api.int.pg-bo.net/external',
	'PgSoftPublicDomain' => 'https://public.pg-redirect.net/history/redirect.html',
	'launch_url' => 'https://m.pg-redirect.net/',
	'bet_type' => '2',
	'web_lobby' => 'https://public.pg-redirect.net/web-lobby/games/?',
	'currency_code' => 'THB',
	'language' => 'th',
	'operator_player_session' => 'afd53be629a8800e6447030f2e0961f7',
	'first_deposit_bonus' => 50
);

?>