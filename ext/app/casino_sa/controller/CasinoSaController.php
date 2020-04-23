<?php
    namespace app\casino_sa\Controller;
    // Classes
    use app\share\Classes\ErpController;
    use app\casino_sa\Classes\CasinoSaApi;
    // Data
    use app\casino_sa\Data\CasinoSaConfigurationData;
    use app\casino_sa\Data\CasinoSaMemberData;
    
    // Model
    use app\casino_sa\Model\CasinoSaConfigurationRepository;
    use app\casino_sa\Model\View_CasinoSaMemberRepository;
    use app\casino_sa\Model\CasinoSaMemberRepository;
    use app\casino_sa\Model\CasinoSaGamesRepository;
    
    use app\share\Model\MemberRepository;


	class CasinoSaController extends ErpController{
		// ######################################################################################################
		// public Route
        public static function GetGamesLists($CasinoAuthData){
            $CasinoSaGamesQuery  = CasinoSaGamesRepository::Find($CasinoAuthData->member_id);
            $CasinoSaGamesLists  = self::ToList($CasinoSaGamesQuery);

            return $CasinoSaGamesLists;
        }

        public static function GetURL(){// Check Login 
            $member_id  = self::CheckLogin();
            $code       = self::GetRequestValue('code');
            $mobile     = self::GetRequestValue('mobile');
            // Register
            $CasinoSaMemberQuery  = View_CasinoSaMemberRepository::Get($member_id);
            $CasinoSaMemberData   = self::FirstOrDefault( $CasinoSaMemberQuery , new CasinoSaMemberData );

            if( $CasinoSaMemberData->line_block == 0 ){
                $CasinoSaMemberData = self::UpdateSaConfiguration($CasinoSaMemberData);
                if( empty($CasinoSaMemberData->username) ){
                    $CasinoSaMemberData = self::CreatedAccount($CasinoSaMemberData);
                }

                $res = CasinoSaApi::LoginRequest($CasinoSaMemberData,$code,$mobile);
                if($res->ErrorMsgId == 0){
                    echo json_encode($res);
                }else{
                    echo $res->ErrorMsg;
                }
            }

        }

        // ######################################################################################################
        // private Route
        private static function UpdateSaConfiguration($source){
            $CasinoSaConfigurationQuery = CasinoSaConfigurationRepository::Get();
            $CasinoSaConfigurationData  = self::FirstOrDefault( $CasinoSaConfigurationQuery , new CasinoSaConfigurationData );

            $source->UpdateConfiguration($CasinoSaConfigurationData);
            return $source;
        }

        private static function CreatedAccount($CasinoSaMemberData){
            $que       = MemberRepository::GetMemberCode($CasinoSaMemberData->userid);
            $CasinoSaMemberData->username  = self::ToValue($que);

            $tmp = CasinoSaApi::RegUserInfo($CasinoSaMemberData);
            if($tmp->ErrorMsgId!=0){
                $CasinoSaMemberData->line_block = 1;
            }else{
                $que = CasinoSaMemberRepository::UpdateUsername($CasinoSaMemberData);
                self::UnitCommit($que);
            }
            return $CasinoSaMemberData;
        }


	}
