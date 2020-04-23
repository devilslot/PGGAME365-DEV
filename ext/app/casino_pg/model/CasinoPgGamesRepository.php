<?php
	namespace app\casino_pg\Model;

  	use app\share\Classes\ErpModel;

	class CasinoPgGamesRepository extends ErpModel{
		// Find
		// #########################################################################
		public static function Find(){
			$sql = self::newSelect();
			$sql->from("dbo.CasinoPgGames");
			$sql->cols(array(
					'CasinoPgGames.id' 		=> 'id',
					'CasinoPgGames.code'	=> 'code',
					'CasinoPgGames.name'		=> 'name',
					'CasinoPgGames.images'	=> 'images',
					'CasinoPgGames.group_id'	=> 'group_id',

				));
			$sql->where('isActive = 1');
			$sql->orderBy( array('group_id','name') );

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

		// Delete
		// #########################################################################

	}
