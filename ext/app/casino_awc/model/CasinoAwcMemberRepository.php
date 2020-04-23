<?php
	namespace app\casino_awc\Model;

  	use app\share\Classes\ErpModel;

	class CasinoAwcMemberRepository extends ErpModel{
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
			$sql->table("dbo.CasinoAwcMember");
			$sql->cols(array(
					'loginname' 		=> trim($request->username),
				));
			$sql->where('member_id = ?',$request->userid);
			return $sql;
		}
		// Delete
		// #########################################################################

	}
