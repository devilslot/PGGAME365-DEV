<?php
	namespace app\casino_pg\Data;

  use app\share\Classes\ErpEntity;

	class CasinoPgConfigurationData extends ErpEntity{

    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

      	settype( $this->operator_token 		, "String" );
      	settype( $this->lobby 		 		, "String" );

      	settype( $this->mobile 		 		, "String" );

    }

		public $operator_token;
		public $lobby;
		public $mobile;
			
	}




