<?php
	namespace app\casino_pg\model;

	use app\core\Entity;

	class EntityCasinoPgMember extends Entity{
	public $userid;
	public $username;

	public $line_block;
	public $access_token;
	
    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

      	settype( $this->userid 		 		, "Integer" );
      	settype( $this->username 		 	, "String" );

      	settype( $this->line_block 		 	, "Integer" );
      	settype( $this->access_token 		, "String" );
      	
    } 
 }
