<?php
	namespace app\casino_pg\Model;

  	use app\share\Classes\ErpModel;

	class CasinoPgMemberRepository extends ErpModel{
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
			$sql->table("dbo.CasinoPgMember");
			$sql->cols(array(
					'loginname' 		=> trim($request->member_code),
					'access_token' 		=> trim($request->casino_pg_access_token),
				));
			$sql->where('member_id = ?',$request->member_id);
			return $sql;
		}
		// Delete
		// #########################################################################

	}
