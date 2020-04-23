<?php
	namespace app\casino\Model;
	// Classes
	use app\share\Classes\ErpModel;

	class View_CasinoReportTransferRepository extends ErpModel{
		// Public route
		public static function Find($request){
			$sql = self::newSelect();

			$sql->from('view_casino_report_transfer');
			$sql->cols(array(
				'transfer_remain' 	=> 'transfer_remain',
				'transfer_provider' => 'transfer_provider',
				'transfer_type' 	=> 'transfer_type',
				'transfer_date' 	=> 'transfer_date',
			));
			$sql->where('member_id = ?',$request->member_id);
			$sql->where('status != 99');
			$sql->orderby(array('transfer_date'));

			if(!empty($request->provider)){
				$sql->where( 'transfer_provider = ?',$request->provider );
			}

			if(!empty($request->startdate)){
				$sql->where( 'CONVERT(VARCHAR(10),transfer_date ) >= ?', $request->startdate) ;
			}

			if(!empty($request->enddate)){
				$sql->where( 'CONVERT(VARCHAR(10),transfer_date ) <= ?', $request->enddate) ;
			}

			return $sql;

		}

	}
