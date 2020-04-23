<?php
	namespace app\casino_pg\Model;

  	use app\share\Classes\ErpModel;

	class CasinoPgConfiguration extends ErpModel{ 
		// Get
		// #########################################################################
		public static function Get($id = null){
			$sql = self::newSelect();
			$sql
				->cols(array(
					'Source.operator_token' 		=> 'operator_token',
					'Source.cur' 		=> 'cur',
					'Source.public_domain' 	=> 'public_domain', 
					'Source.game_domain' 		=> 'game_domain'
				))
				->from('CasinoPgConfiguration AS Source')
				->orderBy(array('Source.created_date desc'));

			if(empty($id) ){
				$sql->Where('Source.isActive = ?',1);
			}else{
				$sql->Where('Source.id = ?',$id);
			}

			return $sql;
			
		}


	}
