<?php
	namespace app\casino_sa\Model;

  	use app\share\Classes\ErpModel;

	class CasinoSaConfigurationRepository extends ErpModel{

		// Find
		// #########################################################################

		// Get
		// #########################################################################
		public static function Get($id = null){
			$sql = self::newSelect();
			$sql
				->cols(array(
					'Source.SecretKey' 		=> 'SecretKey',
					'Source.MD5Key' 		=> 'MD5Key',
					'Source.EncryptKey' 	=> 'EncryptKey',

					'Source.apiserver' 		=> 'apiserver',
					'Source.gameserver'		=> 'gameserver',
				))
				->from('CasinoSaConfiguration AS Source')
				->orderBy(array('Source.created_date desc'));

			if( empty($id) ){
				$sql->Where('Source.isActive = ?',1);
			}else{
				$sql->Where('Source.id = ?',$id);
			}

			return $sql;
			
		}


	}
