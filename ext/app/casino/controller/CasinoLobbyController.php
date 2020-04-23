<?php
  namespace app\casino\Controller;
  // Controller
  use app\casino_live\Controller\CasinoLiveController;
  use app\casino_sa\Controller\CasinoSaController;
  use app\casino_pg\Controller\CasinoPgController;
  use app\casino_awc\Controller\CasinoAwcController;
  
  // Classes
  use app\share\Classes\ErpController;
  // Data
  use app\casino\Data\CasinoAuthData;
  use app\casino\Data\CasinoMemberBalanceData;
  use app\casino\Data\CasinoMemberWithdrawData;
  // Model
  use app\share\Model\MemberRepository;

  class CasinoLobbyController extends ErpController{
    // ######################################################################################################
    // public Route
    public static function Get(){
        $member_id = self::CheckLogin();

        $que = MemberRepository::GetCasinoAuth($member_id);
        $CasinoAuthData = (Object) self::executeFetch($que);
        $CasinoAuthData->game_lists = array();

        if($CasinoAuthData->casino_live_block == 0) {
          // get forword data
          // $CasinoLiveForwordData = (Object) CasinoLiveController::ForwordGames($CasinoAuthData);
          // get game list
          $CasinoLiveGame = CasinoLiveController::GetGamesLists();
          // loop
          foreach ($CasinoLiveGame as $index => $data) {
            $source = (Object)$data;
            array_push( $CasinoAuthData->game_lists , array(
                                                            'game_provider' => 'live',
                                                            'game_type' => $source->group_id,
                                                            'game_code' => '',
                                                            'game_name' => $source->name,
                                                            'game_img' => $source->images,
                                                            'game_resume' => array(),
                                                            'game_url' => $source->desktop,
                                                            'game_mobile' => $source->mobile,
                                                            'not_mobile' => $source->not_mobile,
                                                          ));
          }
        }

        if($CasinoAuthData->casino_pg_block==0) {
          // get game list
          $CasinoAuthData = CasinoPgController::ForwordGames($CasinoAuthData);
          $CasinoPgGame = CasinoPgController::GetGamesLists();
          $CasinoPgConfigurationData = CasinoPgController::GetCasinoPgConfigurationData();
          // loop
          foreach ($CasinoPgGame as $index => $data) {
            $source = (Object)$data;
            array_push( $CasinoAuthData->game_lists , array(
                                                            'game_provider' => 'pg',
                                                            'game_type' => $source->group_id,
                                                            'game_code' => $source->code,
                                                            'game_name' => $source->name,
                                                            'game_img' => $source->images,
                                                            'game_resume' => array(),
                                                            'game_url' => $CasinoPgConfigurationData->lobby.'?language='.(($_SESSION["lang"]=='th')?'th':(($_SESSION["langfix"]=='cn')?'zh':'en')).'&bet_type=1&operator_token='.$CasinoPgConfigurationData->operator_token.'&operator_player_session='.$CasinoAuthData->casino_pg_access_token,
                                                            'game_mobile' => $CasinoPgConfigurationData->mobile.'?language='.(($_SESSION["lang"]=='th')?'th':(($_SESSION["langfix"]=='cn')?'zh':'en')).'&bet_type=1&operator_token='.$CasinoPgConfigurationData->operator_token.'&operator_player_session='.$CasinoAuthData->casino_pg_access_token,
                                                            'not_mobile' => '',
                                                          ));
          }

          //http(s)://host/{game_code}/index.html?language={0}&bet_type=1&operator_token={2}&operator_player_session={3}&time_elapsed={4}&reminder_interval={5}&operator_param={6}&from={7}
        }

        if($CasinoAuthData->casino_sa_block==0) {
          // get game list
          $CasinoSaGame = CasinoSaController::GetGamesLists($CasinoAuthData);
          // loop
          foreach ($CasinoSaGame as $index => $data) {
            $source = (Object)$data;
            array_push( $CasinoAuthData->game_lists , array(
                                                            'game_provider' => 'sa',
                                                            'game_type' => $source->group_id,
                                                            'game_code' => $source->code,
                                                            'game_name' => $source->name,
                                                            'game_img' => $source->images,
                                                            'game_resume' => $source->resume,
                                                            'game_url' => '',
                                                            'game_mobile' => '',
                                                            'not_mobile' => '',
                                                          ));
          }
        }


        if($CasinoAuthData->casino_awc_block==0) {
          // get game list
          $CasinoAwcGame = CasinoAwcController::GetGamesLists($CasinoAuthData);
          // loop
          foreach ($CasinoAwcGame as $index => $data) {
            $source = (Object)$data;
            array_push( $CasinoAuthData->game_lists , array(
                                                            'game_provider' => 'awc',
                                                            'game_type' => $source->group_id,
                                                            'game_code' => $source->code,
                                                            'game_name' => $source->name,
                                                            'game_img' => $source->images,
                                                            'game_resume' => $source->resume,
                                                            'game_url' => '',
                                                            'game_mobile' => '',
                                                            'not_mobile' => '',
                                                          ));
          }
        }


        $slot = array();
        $casino = array();
        foreach ($CasinoAuthData->game_lists as $key => $value) {
          $source = (object) $value;
          if($source->game_type == 1){
            array_push($casino, $source);
          }else{
            array_push($slot, $source);
          }
        }
        $CasinoAuthData->game_lists = array();
        array_push($CasinoAuthData->game_lists, $casino);
        array_push($CasinoAuthData->game_lists, $slot);

        return $CasinoAuthData;

    }

  }
