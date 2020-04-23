<?php
	namespace app\casino_live\Model;

  	use app\share\Classes\ErpModel;

	class CasinoLiveConfigurationRepository extends ErpModel{

		// Get
		// #########################################################################
		public static function Get($id = null){
			$sql = self::newSelect();
			$sql->cols(array(
					// Suncity
					'Source.clientId' 		=> 'clientId',
					'Source.clientSecret' 	=> 'clientSecret',
					'Source.lobby' 			=> 'lobby',
					'Source.mobile' 		=> 'mobile',
					
					'Source.isEnabled'		=> 'isEnabled',

					'Source.apiserver'		=> 'apiserver',
					'Source.gameserver'		=> 'gameserver',

					// Original
					'CASE WHEN DATEDIFF(minute, expires_in, \''.date("Y-m-d H:i:s", time() -60 * 50 ).'\' ) BETWEEN 0 AND 50
						THEN Source.access_token 
						ELSE NULL END'		=> 'access_token',
					'Source.token_type'		=> 'token_type',
					'Source.expires_in'		=> 'expires_in',
					'Source.scope'			=> 'scope',

				));

			$sql->from('CasinoLiveConfiguration AS Source');

			$sql->Where('Source.isActive = ?',1);

			return $sql;

		}


		// Update
		// #########################################################################
		public static function UpdateAuthentication($request){
			date_default_timezone_set("Asia/Bangkok");
			// new
			$sql = self::newUpdate();
			$sql->table("dbo.CasinoLiveConfiguration");
			$sql->cols(array(
					'access_token' 		=> trim($request->access_token),
					'token_type' 		=> trim($request->token_type),
					'expires_in'		=> date("Y-m-d H:i:s", time() + 60 * 60 ),
					'scope' 			=> $request->scope,
				));
			$sql->where('isActive = 1');
			
			return $sql;
		}
		
	}
