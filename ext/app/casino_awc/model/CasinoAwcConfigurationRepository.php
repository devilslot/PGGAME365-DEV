<?php
	namespace app\casino_awc\Model;

  	use app\share\Classes\ErpModel;

	class CasinoAwcConfigurationRepository extends ErpModel{

		// Find
		// #########################################################################

		// Get
		// #########################################################################
		public static function Get($id = null){
			$sql = self::newSelect();
			$sql
				->cols(array(
					'Source.clientId' 		=> 'clientId',
					'Source.clientSecret' 	=> 'clientSecret',
					'Source.apiserver' 		=> 'apiserver',
				))
				->from('CasinoAwcConfiguration AS Source')
				->orderBy(array('Source.created_date desc'));

			if( empty($id) ){
				$sql->Where('Source.isActive = ?',1);
			}else{
				$sql->Where('Source.id = ?',$id);
			}

			return $sql;
			
		}


	}
