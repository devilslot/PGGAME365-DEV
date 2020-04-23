<?php
	namespace app\casino_live\Data;

  	use app\share\Classes\ErpEntity;

	class CasinoLiveConfigurationData extends ErpEntity{

    public function __construct($arr = null){
		// construct
      	parent::__construct($arr);

		settype( $this->clientId 		, "String" );
		settype( $this->clientSecret 	, "String" );
		settype( $this->lobby 			, "String" );
		settype( $this->mobile 			, "String" );
		settype( $this->apiserver 		, "String" );
		settype( $this->gameserver 		, "String" );  

		settype( $this->access_token 	, "String"  );
		settype( $this->token_type 		, "String"  );
		settype( $this->expires_in		, "Integer" );
		settype( $this->scope 			, "String"  );

		settype( $this->isEnabled 		, "Boolean" );
		settype( $this->type 		 	, "Integer" );
      
    }

		
		public $clientId;
		public $clientSecret;
		public $lobby;
		public $mobile;
		public $apiserver;
		public $gameserver;
		
		public $access_token;
		public $token_type;
		public $expires_in;
		public $scope;

		public $isEnabled;
		public $type;

	}
