<?php
	namespace app\casino_sa\Model;

  	use app\share\Classes\ErpModel;

	class CasinoSaGamesRepository extends ErpModel{
		// Find
		// #########################################################################
		public static function Find($member_id){
			$sql = self::newSelect();
			$sql->from("dbo.CasinoSaGames");
			$sql->join(
				'LEFT',
				'CasinoSaBet',
				'CasinoSaBet.gamecode LIKE CasinoSaGames.code+\'%\' AND CasinoSaBet.txtype = 500 AND userid = '.$member_id
			);
			$sql->cols(array(
					'CasinoSaGames.id' 			=> 'id',
					'CasinoSaGames.code'		=> 'code',
					'CasinoSaGames.name'		=> 'name',
					'CasinoSaGames.images'		=> 'images',
					'CasinoSaGames.group_id'	=> 'group_id',

					'CasinoSaBet.id'			=> 'resume->id',

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
