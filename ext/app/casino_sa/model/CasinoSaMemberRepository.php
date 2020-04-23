<?php
	namespace app\casino_sa\Model;

  	use app\share\Classes\ErpModel;

	class CasinoSaMemberRepository extends ErpModel{
		// Get
		// #########################################################################

		// Value
		// #########################################################################
		
		// Insert
		// #########################################################################
		
		// Update
		// #########################################################################
		public static function UpdateUsername($request){
			date_default_timezone_set("Asia/Bangkok");
			// new
			$sql = self::newUpdate();
			$sql->table("dbo.CasinoSaMember");
			$sql->cols(array(
					'loginname' 		=> trim($request->username),
				));
			$sql->where('member_id = ?',$request->userid);
			return $sql;
		}
		// Delete
		// #########################################################################

	}
