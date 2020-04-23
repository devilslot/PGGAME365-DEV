<?php
	namespace app\casino_awc\Data;

  use app\share\Classes\ErpEntity;

	class CasinoAwcConfigurationData extends ErpEntity{

    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

      	settype( $this->apiserver 		 		, "String" );

      	settype( $this->clientId 		 		, "String" );
      	settype( $this->clientSecret 		 	, "String" );

    }

		public $apiserver;

		public $clientId;
		public $clientSecret;
			
	}
