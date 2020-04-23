<?php
	namespace app\casino_awc\Classes;

	use app\share\Classes\ip_and_url;

	use app\casino_awc\Classes\DES;

	use GuzzleHttp\Client;

	class CasinoAwcApi{

		private static function des($request,$str){
			$crypt = new DES($request->EncryptKey);
			$mstr = $crypt->encrypt($str);
			$urlemstr = urlencode($mstr);
			return $urlemstr;
		}

		private static function md5($request,$str){
			$PreMD5Str = $str . $request->MD5Key . $request->Time . $request->SecretKey;
			$OutMD5 = md5($PreMD5Str);

			return $OutMD5;
		}


		// Public route User Account
		// #########################################################################
		public static function createMember($request,$code,$class = null){
			$client = new Client([
				'exceptions' 	=> false,
				'verify' 		=> false,
				'headers' 		=> [
							'Content-Type' 	=> 'application/x-www-form-urlencoded; charset=UTF-8 is valid',
				]
			]);
			$lang = 'th';

			$send = $client->request('POST',$request->apiserver.'/wallet/createMember',[
				    'form_params' => [
				    	'agentId' 	=> $request->clientId,
				    	'cert' 		=> $request->clientSecret,
				    	'userId' 	=> $request->username,
				    	'currency' 	=> 'THB',
				    	'betLimit' 	=> '{"SEXYBCRT":{"LIVE":{"limitId":['.$code.']}}}',
				    	'language' 	=> $lang,
				    ]
				]);

			$rs = json_decode($send->getBody()->getContents(),true);

			if( empty($class) ){
	          return $rs;
	        }else{
	          return new $class( $rs );
	        }

		}

		
		// Public route Login Access
		// #########################################################################
		public static function UpdateBetLimit($request,$code,$class = null){
			$client = new Client([
				'exceptions' 	=> false,
				'verify' 		=> false,
				'headers' 		=> [
							'Content-Type' 	=> 'application/x-www-form-urlencoded',
				]
			]);
			$lang = ( $_SESSION["lang"] == 'eng')?'en':'th';

			$send = $client->request('POST',$request->apiserver.'/wallet/updateBetLimit',[
				    'form_params' => [
				    	'agentId' 	=> $request->clientId,
				    	'cert' 		=> $request->clientSecret,
				    	'userId' 	=> $request->username,
				    	'betLimit' 	=> '{"SEXYBCRT":{"LIVE":{"limitId":['.$code.']}}}',
				    ]
				]);

			$rs = json_decode($send->getBody()->getContents(),true);
			
			if( empty($class) ){
	          return $rs;
	        }else{
	          return new $class( $rs );
	        }

		}

		// Public route Login Access
		// #########################################################################
		public static function LoginRequest($request,$mobile,$class = null){
			$client = new Client([
				'exceptions' 	=> false,
				'verify' 		=> false,
				'headers' 		=> [
							'Content-Type' 	=> 'application/x-www-form-urlencoded',
				]
			]);
			$lang = ( $_SESSION["lang"] == 'eng')?'en':'th';
			$mobile = ( $mobile == '1')?'true':'false';

			$send = $client->request('POST',$request->apiserver.'/wallet/doLoginAndLaunchGame',[
				    'form_params' => [
				    	'agentId' 	=> $request->clientId,
				    	'cert' 		=> $request->clientSecret,
				    	'userId' 	=> $request->username,
				    	'gameCode' 	=> '',
				    	'gameType' 	=> 'LIVE',
				    	'platform' 	=> 'SEXYBCRT',
				    	'isMobileLogin' => $mobile,
				    	'language' 		=> $lang,
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
