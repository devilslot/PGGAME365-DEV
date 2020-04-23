<?php
	namespace app\casino_awc\Data;

  	use app\casino_awc\Classes\AwcEntity;

	class CasinoAwcMemberData extends AwcEntity{

    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

      	settype( $this->userid 		 		, "Integer" );
      	settype( $this->username 		 	, "String" );

      	settype( $this->line_block 		 	, "Integer" );
      	settype( $this->access_token 		, "String" );
      	
    }

		public $userid;
		public $username;

		public $line_block;
		public $access_token;
		
	}
