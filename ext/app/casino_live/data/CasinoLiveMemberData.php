<?php
	namespace app\casino_live\Data;

  	use app\share\Classes\ErpEntity;

	class CasinoLiveMemberData extends ErpEntity{

    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

      	settype( $this->userid 		 		, "Integer" );
      	settype( $this->username 		 	, "String" );

      	settype( $this->code 		 		, "String" );

      	settype( $this->line_block 		 	, "Integer" );
      	settype( $this->access_token 		, "String" );

      	settype( $this->platformtype 		, "Integer" );
      	settype( $this->credit_remain 		, "Float" );
      	
    }

		public $userid;
		public $username;

		public $code;

		public $line_block;
		public $access_token;

		public $platformtype;
		public $credit_remain;
		
	}
