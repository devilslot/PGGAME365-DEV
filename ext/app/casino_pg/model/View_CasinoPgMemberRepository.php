<?php
	namespace app\casino_pg\Model;

  	use app\share\Classes\ErpModel;

	class View_CasinoPgMemberRepository extends ErpModel{ 
		public static function Get($id){
			$sql = self::newSelect();
			$sql
				->cols(array(
					'Source.level_7_id' 		=> 'userid',
					'Source.username'			=> 'username',

					'Source.line_block' 		=> 'line_block',
					'Source.access_token' 		=> 'access_token'

				))
				->from('view_casino_sa_member_relation AS Source'); 
			$sql->Where('Source.level_7_id = ?',$id); 
			return $sql; 
		}
		
	}
