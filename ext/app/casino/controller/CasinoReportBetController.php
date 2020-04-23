<?php
  namespace app\casino\Controller;
  // Classes
  use app\share\Classes\ErpController;
  // Data
  use app\casino\Data\CasinoReportBetSearchCriteria;
  // Model
  use app\casino\Model\View_CasinoWinloseRepository;

	class CasinoReportBetController extends ErpController{
		// ######################################################################################################
		// public Route
        public static function Find(){
            $request   = self::GetRequestData(new CasinoReportBetSearchCriteria);
            $request->member_id = self::CheckLogin();

            $query     = View_CasinoWinloseRepository::Find( $request );
            $result    = self::ToList($query);
          
            echo json_encode($result);
        }

        public static function GetGameLists(){
          // GameLists::SetDefault();
          // $result = GameLists::GetData();
          
          echo json_encode(array());
        }


	}
