<?php
	namespace app\casino_sa\Data;

  use app\share\Classes\ErpEntity;

	class CasinoSaConfigurationData extends ErpEntity{

    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

      	settype( $this->apiserver 		 		, "String" );
      	settype( $this->gameserver 		 		, "String" );

      	settype( $this->SecretKey 		 		, "String" );
      	settype( $this->MD5Key 		 			, "String" );
      	settype( $this->EncryptKey 		 		, "String" );

    }

		public $apiserver;
		public $gameserver;

		public $SecretKey;
		public $MD5Key;
		public $EncryptKey;
			
	}
