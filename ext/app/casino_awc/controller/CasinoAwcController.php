<?php
    namespace app\casino_awc\Controller;
    // Classes
    use app\share\Classes\ErpController;
    use app\casino_awc\Classes\CasinoAwcApi;
    // Data
    use app\casino_awc\Data\CasinoAwcConfigurationData;
    use app\casino_awc\Data\CasinoAwcMemberData;
    
    // Model
    use app\casino_awc\Model\CasinoAwcConfigurationRepository;
    use app\casino_awc\Model\View_CasinoAwcMemberRepository;
    use app\casino_awc\Model\CasinoAwcMemberRepository;
    use app\casino_awc\Model\CasinoAwcGamesRepository;
    
    use app\share\Model\MemberRepository;


	class CasinoAwcController extends ErpController{
		// ######################################################################################################
		// public Route
        public static function GetGamesLists($CasinoAuthData){
            $CasinoAwcGamesQuery  = CasinoAwcGamesRepository::Find($CasinoAuthData->member_id);
            $CasinoAwcGamesLists  = self::ToList($CasinoAwcGamesQuery);

            return $CasinoAwcGamesLists;
        }

        public static function GetURL(){// Check Login 
            $member_id  = self::CheckLogin();
            $code       = self::GetRequestValue('code');
            $mobile     = self::GetRequestValue('mobile');
            // Register
            $CasinoAwcMemberQuery  = View_CasinoAwcMemberRepository::Get($member_id);
            $CasinoAwcMemberData   = self::FirstOrDefault( $CasinoAwcMemberQuery , new CasinoAwcMemberData );

            if( $CasinoAwcMemberData->line_block == 0 ){
                $CasinoAwcMemberData = self::UpdateSaConfiguration($CasinoAwcMemberData);
                if( empty($CasinoAwcMemberData->username) ){
                    $CasinoAwcMemberData = self::CreatedAccount($CasinoAwcMemberData,$code);
                }
                
                $res = CasinoAwcApi::UpdateBetLimit($CasinoAwcMemberData,$code,null);
                if($res['status'] == 0 || $res['status' == '0000']){
                    $res2 = CasinoAwcApi::LoginRequest($CasinoAwcMemberData,$mobile,null);
    
                    if($res2['status'] == 0 || $res2['status' == '0000']){
                        echo json_encode($res2);
                    }else{
                        echo $res2['desc'];
                    }
                }else{
                    echo $res['desc'];
                }
                
            }

        }

        // ######################################################################################################
        // private Route
        private static function UpdateSaConfiguration($source){
            $CasinoAwcConfigurationQuery = CasinoAwcConfigurationRepository::Get();
            $CasinoAwcConfigurationData  = self::FirstOrDefault( $CasinoAwcConfigurationQuery , new CasinoAwcConfigurationData );

            $source->UpdateConfiguration($CasinoAwcConfigurationData);
            return $source;
        }

        private static function CreatedAccount($CasinoAwcMemberData,$code){
            $que       = MemberRepository::GetMemberCode($CasinoAwcMemberData->userid);
            $CasinoAwcMemberData->username  = self::ToValue($que);

            $tmp = CasinoAwcApi::createMember($CasinoAwcMemberData,$code,null);

            if($tmp['status'] != '0000' && $tmp['status'] != 0 ){
                $CasinoAwcMemberData->line_block = 1;
            }else{
                $que = CasinoAwcMemberRepository::UpdateUsername($CasinoAwcMemberData);
                self::UnitCommit($que);
            }
            return $CasinoAwcMemberData;
        }


	}
