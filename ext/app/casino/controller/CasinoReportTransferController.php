<?php
  namespace app\casino\Controller;
  // Classes
  use app\share\Classes\ErpController;
  // Data
  use app\casino\Data\CasinoReportTransferSearchCriteria;
  // Model
  use app\casino\Model\View_CasinoReportTransferRepository;

	class CasinoReportTransferController extends ErpController{
		// ######################################################################################################
		// public Route
        public static function Find(){
            $request   = self::GetRequestData(new CasinoReportTransferSearchCriteria);
            $request->member_id = self::CheckLogin();

            $query     = View_CasinoReportTransferRepository::Find( $request );

            $result    = self::ToList($query);
          
            echo json_encode($result);
        }


	}
