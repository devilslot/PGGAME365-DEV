<?php
	namespace app\casino_awc\Model;

  	use app\share\Classes\ErpModel;

	class View_CasinoAwcMemberRepository extends ErpModel{

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

				))
				->from('view_casino_awc_member_relation AS Source');

			$sql->Where('Source.level_7_id = ?',$id);

			return $sql;
			
		}
		
	}
