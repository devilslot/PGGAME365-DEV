<?php
	namespace app\casino_sa\Classes;

	use app\share\Classes\ip_and_url;

	use app\casino_sa\Classes\DES;

	use GuzzleHttp\Client;

	class CasinoSaApi{

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
		public static function RegUserInfo($request,$class = null){
			$client = new Client([
				'exceptions' 	=> false,
				'verify' 		=> false,
				'headers' 		=> [
							'Content-Type' 	=> 'application/x-www-form-urlencoded',
				]
			]);
			// Request
			$str = 'method=RegUserInfo&Key='.$request->SecretKey.'&Time='.$request->Time.'&Username='.$request->username.'&CurrencyType=THB';
			$q = self::des($request,$str);
			$s = self::md5($request,$str);

			$send = $client->request('GET',$request->apiserver."?q=".$q."&s=".$s);
			$xml  = simplexml_load_string( $send->getBody()->getContents() );
			$json = json_encode($xml);
			$arr  = json_decode($json,true);

			if( empty($class) ){
	          return (object) $arr;
	        }else{
	          return new $class( $arr );
	        }

		}

		public static function VerifyUsername($request){

		}
		
		public static function GetUserStatusDV($request){

		}
		
		public static function QueryBetLimit($request){

		}
		
		public static function SetBetLimit($request){

		}
		
		public static function GetUserMaxBalance($request){

		}
		
		public static function SetUserMaxBalance($request){

		}
		// Public route Login Access
		// #########################################################################
		public static function LiveFame(){

		}

		public static function LoginRequest($request,$code,$mobile,$class = null){
			$client = new Client([
				'exceptions' 	=> false,
				'verify' 		=> false,
				'headers' 		=> [
							'Content-Type' 	=> 'application/x-www-form-urlencoded',
				]
			]);
			$lang = ( $_SESSION["lang"] == 'eng')?'en_US':'th';
			// Request
			$str = 'method=LoginRequest&Key='.$request->SecretKey.'&Time='.$request->Time.'&Username='.$request->username.'&CurrencyType=THB';
			if( substr($code, 0, 1 ) != 'A' ){
				$str.= '&GameCode='.$code;
				$str.= '&Lang='.$lang;
				$str.= '&Mobile='.$mobile;
			}else{
				$str.= '&Lang='.$lang;
				$str.= '&Mobile='.$mobile;
			}
			$q = self::des($request,$str);
			$s = self::md5($request,$str);

			$send = $client->request('GET',$request->apiserver."?q=".$q."&s=".$s);
			$xml  = simplexml_load_string( $send->getBody()->getContents() );
			$json = json_encode($xml);
			$arr  = json_decode($json,true);

			if( $arr['ErrorMsgId']==0 && empty($arr['GameURL']) ){
				$arr['GameURL'] = $request->gameserver."?username=".$request->username;
				$arr['GameURL'].= "&token=".$arr['Token'];
				$arr['GameURL'].= "&lang=".$lang;
				$arr['GameURL'].= "&lobby=".$code;
				if($mobile==1){
					$arr['GameURL'].= "&mobile=true";
				}
			}
			
			if( empty($class) ){
	          return (object) $arr;
	        }else{
	          return new $class( $arr );
	        }
		}

		public static function LoginRequestForFun($request){

		}
		
		public static function KickUser($request){

		}
		// Public route Bet Records Query
		// #########################################################################
		
		public static function GetAllBetDetailsDV($request){

		}

		public static function GetAllBetDetailsForTimeIntervalDV($request){

		}

		public static function GetAllBetDetailsFor30secondsDV($request){

		}

		public static function GetUserBetItemDV($request){

		}
		
		public static function GetUserBetAmountDV($request){

		}
		
		public static function GetUserWinLost($request){

		}
		
		public static function GetTransactionDetails($request){

		}
		
		public static function GetFishermenGoldBetDetails($request){

		}
		// Public route Miscellaneous Functions
		// #########################################################################
		public static function SlotJackpotQuery($request){

		}
		
		// Public route Transfer Wallet
		// #########################################################################
		public static function DebitBalanceDV($request){

		}
		
		public static function DebitAllBalanceDV($request){

		}
		
		public static function CreditBalanceDV($request){

		}
		
		public static function CheckOrderId($request){

		}
		
			
	}
