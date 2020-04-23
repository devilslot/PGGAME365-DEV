<?php
	namespace app\casino\Model;
	// Classes
	use app\share\Classes\ErpModel;

	class View_CasinoWinloseRepository extends ErpModel{
		// Public route
		public static function Find($request){
			$sql = self::newSelect();

			$sql->from('view_casino_report_winlose');
			$sql->cols(array(
				'bet' 		=> 'bet',
				'profit' 	=> 'profit',
				'date' 		=> 'date',

				'game_id' 		=> 'game_id',
				'game_name'		=> 'game_name',
				'game_provider'	=> 'game_provider',

				'level_7_com' 			=> 'com',
				'level_7_com_amount' 	=> 'com_amount',

			));
			$sql->where('member_id = ?',$request->member_id);
			$sql->orderby(array('date desc'));

			if(!empty($request->startdate)){
				$sql->where( 'CONVERT(VARCHAR(10),date ) >= ?', $request->startdate) ;
			}

			if(!empty($request->enddate)){
				$sql->where( 'CONVERT(VARCHAR(10),date ) <= ?', $request->enddate) ;
			}

			return $sql;

		}

	}
