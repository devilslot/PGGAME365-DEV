<?php
	namespace app\casino_live\Classes;

	use GuzzleHttp\Client;

	class CasinoLiveConfigurationApi{

		// Public route
		// #########################################################################
		public static function Authentication($request, $class = null){
			
			$client = new Client([
				'exceptions' 	=> false,
				'verify' 		=> false,
				'headers' 		=> [
							'Content-Type' 	=> 'application/x-www-form-urlencoded',
							'Accept' 		=> 'application/json'
				]
			]);
			$send = $client->request('POST',$request->apiserver.'/api/oauth/token',[
				    'form_params' => [
				    	'client_id' 	=> $request->clientId,
				    	'client_secret' => $request->clientSecret,
				    	'grant_type' 	=> 'client_credentials',
				    	'scope' 		=> 'playerapi'
				    ]
				]);
			$rs = json_decode($send->getBody()->getContents(),true);
			
			if( empty($class) ){
	          return $rs;
	        }else{
	          return new $class( $rs );
	        }

		}

	}
