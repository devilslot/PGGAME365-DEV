<?php
	namespace app\casino_live\Classes;

	use app\share\Classes\ip_and_url;

	use GuzzleHttp\Client;

	class CasinoLiveMemberApi{

		// Public route
		// #########################################################################
		public static function Authentication($request,$api, $class = null){
			switch ($request->code) {
				case 'GDLobby':
				case 'GDmLobby':
					$betlimitid = 1;
					break;
				
				default:
					$betlimitid = 3;
					break;
			}
			
			$client = new Client([
				'exceptions' 	=> false,
				'verify' 		=> false,
				'headers' 		=> [
							'Content-Type' 	=> 'application/x-www-form-urlencoded',
							'Accept' 		=> 'application/json',
							'Authorization' => $api->token_type.''.$api->access_token
				]
			]);

			$send = $client->request('POST',$api->apiserver.'/api/player/authorize',[
				    'form_params' => [
				    	"ipaddress" 	=> ip_and_url::GetIP(),
				    	"username" 		=> $request->member_code,
				    	"userid" 		=> $request->member_id,
				    	"lang" 			=> ( $_SESSION["lang"] == 'eng')?'en-US':'th-TH',
				    	"cur" 			=> 'THB',

				    	"betlimitid" 	=> $betlimitid,
				    	"platformtype" 	=> $request->platformtype,
				    	"istestplayer" 	=> 'false',

				    ]
				]);

			$rs = json_decode($send->getBody()->getContents(),true);

			if( empty($class) ){
	          return (object) $rs;
	        }else{
	          return new $class( $rs );
	        }

		}

	}
