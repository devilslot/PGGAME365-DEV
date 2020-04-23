<?php
	namespace app\casino_pg\Model;

  	use app\share\Classes\ErpModel;

	class CasinoPgConfigurationRepository extends ErpModel{

		// Find
		// #########################################################################

		// Get
		// #########################################################################
		public static function Get($id = null){
			$sql = self::newSelect();
			$sql
				->cols(array(
					'*'
				))
				->from('CasinoPgConfiguration AS Source')
				->orderBy(array('Source.created_date desc'));

			if( empty($id) ){
				$sql->Where('Source.isActive = ?',1);
			}else{
				$sql->Where('Source.id = ?',$id);
			}

			return $sql;
			
		}


	}
