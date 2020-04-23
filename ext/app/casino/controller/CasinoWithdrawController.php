<?php
  namespace app\casino\Controller;
  // Classes
  use app\share\Classes\ErpController;
  // Controller
  use app\casino_live\Controller\CasinoLiveController;
  // Data
  use app\casino\Data\CasinoMemberBalanceData;
  use app\casino\Data\CasinoMemberWithdrawData;

	class CasinoWithdrawController extends ErpController{
		// ######################################################################################################
		// public Route
    public static function GetBalanceData(){
      $member_id          = self::CheckLogin();
      $MemberBalanceData  = new CasinoMemberBalanceData;
      // RNG Balance Data
      $MemberBalanceData->casino_balance  = 0;
      // Live Balance Data
      $MemberBalanceData->live_balance    = CasinoLiveController::GetBalance($member_id);
      // returned
      $MemberBalanceData->member_id = $member_id;
      echo json_encode($MemberBalanceData);
    }

    public static function Withdraw(){
      $WithdrawData            = self::GetRequestData(new CasinoMemberWithdrawData);
      $WithdrawData->member_id = self::CheckLogin();

      CasinoLiveController::Withdraw($WithdrawData);

      $MemberBalanceData  = new CasinoMemberBalanceData;
      echo json_encode($MemberBalanceData);
      
    }

	}
