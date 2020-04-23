<?php
	namespace app\casino_awc\Model;

  	use app\share\Classes\ErpModel;

	class CasinoAwcGamesRepository extends ErpModel{
		// Find
		// #########################################################################
		public static function Find($member_id){
			$sql = self::newSelect();
			$sql->from("dbo.CasinoAwcGames");
			$sql->cols(array(
					'CasinoAwcGames.id' 		=> 'id',
					'CasinoAwcGames.name'		=> 'name',
					'CasinoAwcGames.images'		=> 'images',
					'CasinoAwcGames.group_id'	=> 'group_id',
					'CasinoAwcGames.code'		=> 'code',

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
			$sql->table("dbo.CasinoAwcMember");
			$sql->cols(array(
					'loginname' 		=> trim($request->username),
				));
			$sql->where('member_id = ?',$request->userid);
			return $sql;
		}
		// Delete
		// #########################################################################

	}
