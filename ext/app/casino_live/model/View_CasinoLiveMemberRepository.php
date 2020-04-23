<?php
	namespace app\casino_live\Model;

  	use app\share\Classes\ErpModel;

	class View_CasinoLiveMemberRepository extends ErpModel{

		// Find
		// #########################################################################

		// Get
		// #########################################################################
		public static function Get($id){
			$sql = self::newSelect();
			$sql
				->cols(array(
					'Source.level_7_id' 		=> 'userid',
					'Source.username'			=> 'username',

					'Source.line_block' 		=> 'line_block',
					'Source.access_token' 		=> 'access_token',

					'Source.credit_remain' 		=> 'credit_remain',

				))
				->from('view_casino_live_member_relation AS Source');

			$sql->Where('Source.level_7_id = ?',$id);

			return $sql;
			
		}
		
	}
