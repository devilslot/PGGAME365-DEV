<?php
	namespace app\casino_live\Model;

  	use app\share\Classes\ErpModel;

	class SP_CasinoLiveTransferRepository extends ErpModel{

		public static function Update($Source){
			date_default_timezone_set("Asia/Bangkok");
			return 'EXEC sp_casino_live_update_transfer "'.$Source->userid.'",'.$Source->amt.',"'.$Source->transfertype.'","'.$Source->timestamp.'" ';
		}

		public static function Return($bill_id){
			return 'EXEC sp_casino_live_update_transfer_return "'.$bill_id.'" ';
		}

	}
