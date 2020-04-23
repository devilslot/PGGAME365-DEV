<?php
	namespace app\casino_pg\Model;

	use app\share\Classes\ip_and_url;

	class CasinoPgApi{ 
		public static function LoginRequest($request,$selectgame,$apipg,$gamecode,$mobile,$class = null){
			$lang = ( $_SESSION["lang"] == 'eng')?'en':'th';
			// Request 
			$Error=''; 
			 $game_code=$gamecode;
			
			 if($gamecode!='lobby' ||$gamecode!= 'joker-wild'){ //'lobby' joker-wild'
				 if(empty($selectgame)){
					$Error='closegame'; 
				 }else {
					 $game_code=$selectgame->gamecode; 
                     if($selectgame->status){

					 }
					 if($selectgame->releasestatus){

					} 
				 }  
			 }  

			$str = $apipg->game_domain.'/{game_code}/index.html?language={0}&bet_type={1}&operator_token={2}&operator_player_session={3}';
			$str .= '&from={7}'; //&time_elapsed={4}&reminder_interval={5}&operator_param={6}  

			$param=[$game_code,$lang,1,$apipg->operator_token,urlencode($request->username),ip_and_url::get_domain()."/pages/?lang=$lang"];
			$url_launcher= str_replace(['{game_code}', '{0}','{1}','{2}','{3}','{7}'], $param, $str); // '{4}','{5}','{6}',
			if(preg_match("/^tst0000(.*)/i",$request->username)) {// trial url
			  $str_trial =$str;
			  $str_trial.='&real_url={8}';
			  $param=[$game_code,$lang,2,$apipg->operator_token,urlencode($request->username),ip_and_url::get_domain()."/pages/?lang=$lang",$url_launcher];
			  $url_launcher= str_replace(['{game_code}', '{0}','{1}','{2}','{3}','{7}','{8}'], $param, $str_trial); // ,'{4}','{5}','{6}'
			}
			$arr['GameURL']=$url_launcher;  
			$arr['Error']=$Error;
			$arr['ErrorMsg']='';
			if( empty($class) ){
	          return (object) $arr;
	        }else{
	          return new $class( $arr );
	        }
		} 
	}
