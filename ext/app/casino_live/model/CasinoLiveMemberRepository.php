<?php
	namespace app\casino_live\Model;

  	use app\share\Classes\ErpModel;

	class CasinoLiveMemberRepository extends ErpModel{
		// Get
		// #########################################################################
		public static function Get($member_id){
			$sql = self::newSelect();
			$sql->cols(array(
					'Source.member_id'				=> 'userid',
					'Source.loginname'				=> 'username',

					'Source.access_token' 			=> 'authtoken',
				));
			$sql->from('CasinoLiveMember AS Source');
			$sql->where('Source.member_id = ?',$member_id);

			return $sql;
		}
		// Value
		// #########################################################################
		
		// Insert
		// #########################################################################
		
		// Update
		// #########################################################################
		
		public static function UpdateToken($member_id,$source){
			$sql = self::newUpdate();
			$sql->table("dbo.CasinoLiveMember");
			$sql->cols(array(
					'desktop_token' 	=> trim($source->desktop),
					'mobile_token' 		=> trim($source->mobile),
				));
			$sql->where('member_id = ?',$member_id);
			return $sql;
		}

		public static function UpdateUsername($source){
			date_default_timezone_set("Asia/Bangkok");
			// new
			$sql = self::newUpdate();
			$sql->table("dbo.CasinoLiveMember");
			$sql->cols(array(
					'loginname' 		=> trim($source->member_code),
				));
			$sql->where('member_id = ?',$source->member_id);
			return $sql;
		}
		// Delete
		// #########################################################################

	}
