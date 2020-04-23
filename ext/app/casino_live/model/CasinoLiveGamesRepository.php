<?php
	namespace app\casino_live\Model;

  	use app\share\Classes\ErpModel;

	class CasinoLiveGamesRepository extends ErpModel{
		// Find
		// #########################################################################
		public static function Find(){
			$sql = self::newSelect();
			$sql->from("dbo.CasinoLiveGames");
			$sql->cols(array(
					'CasinoLiveGames.id' 		=> 'id',
					'CasinoLiveGames.name'		=> 'name',
					'CasinoLiveGames.images'	=> 'images',
					'CasinoLiveGames.group_id'	=> 'group_id',
					'CasinoLiveGames.desktop'	=> 'desktop',
					'CasinoLiveGames.mobile'	=> 'mobile',
					'CasinoLiveGames.not_mobile'=> 'not_mobile',

				));
			$sql->where('isActive = 1');
			$sql->orderBy( array('group_id','sort','name') );

			return $sql;
		}

		// Get
		// #########################################################################

		// Value
		// #########################################################################
		
		// Insert
		// #########################################################################
		
		// Update
		// #########################################################################
		public static function UpdateUsername($request){
			date_default_timezone_set("Asia/Bangkok");
			// new
			$sql = self::newUpdate();
			$sql->table("dbo.CasinoSaMember");
			$sql->cols(array(
					'loginname' 		=> trim($request->username),
				));
			$sql->where('member_id = ?',$request->userid);
			return $sql;
		}
		// Delete
		// #########################################################################

	}
