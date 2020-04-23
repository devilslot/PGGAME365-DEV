<?php
    namespace app\casino_live\Controller;
    // Classes
    use app\share\Classes\ErpController; 
    use app\casino_live\Classes\CasinoLiveConfigurationApi; 
    use app\casino_live\Classes\CasinoLiveMemberApi;

	// Data
    use app\casino_live\Data\CasinoLiveMemberData;
    use app\casino_live\Data\CasinoLiveTransferSaveData;
    use app\casino_live\Data\CasinoLiveCOnfigurationData;
    use app\casino_live\Data\CasinoLiveAuthenticationData;
    use app\casino_live\Data\CasinoLiveBalanceData;
    use app\casino_live\Data\CasinoLiveWalletReturnData;
    use app\casino_live\Data\CasinoLiveForwordData;
	//Model
    use app\casino_live\Model\CasinoLiveConfigurationRepository;
    use app\casino_live\Model\View_CasinoLiveMemberRepository;
    use app\casino_live\Model\CasinoLiveMemberRepository;
    use app\casino_live\Model\CasinoLiveGamesRepository;

    use app\share\Model\MemberRepository;


	class CasinoLiveController extends ErpController{
		// ######################################################################################################
		// public Route
        public static function GetGamesLists(){
            $CasinoLiveGamesQuery  = CasinoLiveGamesRepository::Find();
            $CasinoLiveGamesLists  = self::ToList($CasinoLiveGamesQuery);

            return $CasinoLiveGamesLists;
        }

        public static function GetURL(){// Check Login 
            // Check Account 
            $member_id  = self::CheckLogin();  
            $code       = self::GetRequestValue('code');
            $mobile     = self::GetRequestValue('mobile');
            // Get Authen          
            $que = MemberRepository::GetCasinoAuth($member_id);
            $CasinoAuthData = (Object) self::executeFetch($que);
            $CasinoLiveMemberData = self::CheckAccount($CasinoAuthData);
            $CasinoLiveConfigurationData = self::CasinoLiveConfigurationAuth();
            // Forword Games
            $CasinoLiveMemberData->code = $code;
            $CasinoLiveMemberData->platformtype = $mobile;
            $game = CasinoLiveMemberApi::Authentication($CasinoLiveMemberData,$CasinoLiveConfigurationData);
            if( empty($game->authtoken) ){
                echo 'Server under maintenance.';
            }else{
                $CasinoLiveForwordData = new CasinoLiveForwordData;
                $CasinoLiveForwordData->gameserver = $CasinoLiveConfigurationData->gameserver;
                $CasinoLiveForwordData->mobile = $game->authtoken;
                $CasinoLiveForwordData->desktop = $game->authtoken;

                $que = CasinoLiveMemberRepository::UpdateToken($CasinoAuthData->member_id,$CasinoLiveForwordData);
                self::UnitCommit($que);
                echo json_encode(array( 'url' => $CasinoLiveForwordData->gameserver.'/'.$code.'?token='.$game->authtoken ));
            }

        }

        public static function ForwordGames($CasinoAuthData){
            // Check Account 
            $CasinoLiveMemberData = self::CheckAccount($CasinoAuthData);
            // Get Authen
            $CasinoLiveConfigurationData = self::CasinoLiveConfigurationAuth();
            // Forword Games
            $CasinoLiveMemberData->platformtype = 0;
            $desktop = CasinoLiveMemberApi::Authentication($CasinoLiveMemberData,$CasinoLiveConfigurationData);

            $CasinoLiveMemberData->platformtype = 1;
            $mobile = CasinoLiveMemberApi::Authentication($CasinoLiveMemberData,$CasinoLiveConfigurationData);

            if( empty($desktop->authtoken) || empty($mobile->authtoken) ){
                return new CasinoLiveForwordData;
            }else{
                $CasinoLiveForwordData = new CasinoLiveForwordData;
                $CasinoLiveForwordData->gameserver = $CasinoLiveConfigurationData->gameserver;
                $CasinoLiveForwordData->desktop = $desktop->authtoken;
                $CasinoLiveForwordData->mobile = $mobile->authtoken;

                $que = CasinoLiveMemberRepository::UpdateToken($CasinoAuthData->member_id,$CasinoLiveForwordData);
                self::UnitCommit($que);

                return $CasinoLiveForwordData;
            }

        }
        
        // ######################################################################################################
        // private Route
        private static function CheckAccount($CasinoAuthData){
            if( $CasinoAuthData->casino_live_block != 0 ){
                echo 'Unable to connect to the system.';
                exit();
            }

            if( empty($CasinoAuthData->casino_live_account) ){
                $CasinoAuthData->casino_live_account = self::CreatedAccount($CasinoAuthData);
            }

            return $CasinoAuthData;
        }

        private static function CreatedAccount($CasinoAuthData){
            $sql = CasinoLiveMemberRepository::UpdateUsername($CasinoAuthData);
            self::UnitCommit($sql);
            return $rs;
        }

        private static function CasinoLiveConfigurationAuth(){
            $CasinoLiveConfigurationQuery  = CasinoLiveConfigurationRepository::Get(null);
            $CasinoLiveConfigurationData   = self::FirstOrDefault( $CasinoLiveConfigurationQuery , new CasinoLiveConfigurationData );

            if( empty($CasinoLiveConfigurationData->access_token) ){
                $CasinoLiveAuthenticationData = CasinoLiveConfigurationApi::Authentication($CasinoLiveConfigurationData,new CasinoLiveConfigurationData);

                $CasinoLiveConfigurationData->access_token    = $CasinoLiveAuthenticationData->access_token;
                $CasinoLiveConfigurationData->token_type      = $CasinoLiveAuthenticationData->token_type;
                $CasinoLiveConfigurationData->expires_in      = $CasinoLiveAuthenticationData->expires_in;
                $CasinoLiveConfigurationData->scope           = $CasinoLiveAuthenticationData->scope;

                $sql = CasinoLiveConfigurationRepository::UpdateAuthentication($CasinoLiveConfigurationData);
                self::UnitCommit($sql);
            }

            return $CasinoLiveConfigurationData;
        }


	}
