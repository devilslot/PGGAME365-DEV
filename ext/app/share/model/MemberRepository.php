<?php
	namespace app\share\Model;
	// Classes
	use app\share\Classes\ErpModel;

	class MemberRepository extends ErpModel{
		// Get
		// #########################################################################
		public static function GetCasinoAuth($id){
			return 'EXEC sp_casino_authentication "'.$id.'" ';
		}

		// Value
		// #########################################################################
		public static function GetMemberCode($member_id){
			$sql = self::newSelect();
			$sql->cols(array(
					'Source.code' => 'member_code',
				));
			$sql->from('dbo.Member AS Source');
			$sql->where('Source.id = ?',$member_id);

			return $sql;
		}

	}
