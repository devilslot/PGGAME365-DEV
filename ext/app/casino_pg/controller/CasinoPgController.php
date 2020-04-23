<?php
    namespace app\casino_pg\Controller;
    // Classes
    use app\share\Classes\ErpController;
    use app\share\Classes\guid;

    use app\casino_pg\Data\CasinoPgConfigurationData;

    use app\casino_pg\Model\CasinoPgGamesRepository;
    use app\casino_pg\Model\CasinoPgConfigurationRepository;
    use app\casino_pg\Model\CasinoPgMemberRepository;


	class CasinoPgController extends ErpController{
		// ######################################################################################################
		// public Route
        public static function GetGamesLists(){
            $CasinoPgGamesQuery  = CasinoPgGamesRepository::Find();
            $CasinoPgGamesLists  = self::ToList($CasinoPgGamesQuery);

            return $CasinoPgGamesLists;
        }

        public static function ForwordGames($CasinoAuthData){
            // Check Account 
            $CasinoAuthData = self::CheckAccount($CasinoAuthData);
            // Get Authen
            return $CasinoAuthData;
        }

        public static function GetCasinoPgConfigurationData(){
            $CasinoPgConfigurationQuery  = CasinoPgConfigurationRepository::Get(null);
            $CasinoPgConfigurationData   = self::FirstOrDefault( $CasinoPgConfigurationQuery , new CasinoPgConfigurationData );

            return $CasinoPgConfigurationData;
        }



        // ######################################################################################################
        // private Route
        private static function CheckAccount($CasinoAuthData){

            if( empty($CasinoAuthData->casino_pg_account) ){
                $CasinoAuthData = self::CreatedAccount($CasinoAuthData);
            }

            return $CasinoAuthData;
        }

        private static function CreatedAccount($CasinoAuthData){

            $CasinoAuthData->casino_pg_access_token = guid::get();
            
            $sql = CasinoPgMemberRepository::UpdateUsername($CasinoAuthData);
            self::UnitCommit($sql);
            return $CasinoAuthData;
        }

	}
