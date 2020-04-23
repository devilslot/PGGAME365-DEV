<?php
	namespace app\casino_live\Model;

  	use app\share\Classes\ErpModel;

	class CasinoLiveTransferRepository extends ErpModel{

		public static function UpdateComplete($member_id){
			$sql = self::newUpdate();
			$sql->table("dbo.CasinoLiveTransfer");
			$sql->cols(array(
					'status' 		=> 2,
				));
			$sql->where('member_id = ?',$member_id);
			$sql->where('status = 1');
			
			return $sql;

		}


	}
