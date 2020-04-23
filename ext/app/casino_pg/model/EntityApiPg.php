<?php
	namespace app\casino_pg\model;

	use app\core\Entity;

	class EntityApiPg extends Entity{
	public $operator_token;
	public $cur;
	public $public_domain;
	public $game_domain; 
    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

          settype( $this->operator_token  , "String" );
		  settype( $this->cur 		 	  , "String" );
		  settype( $this->public_domain   , "String" );
		  settype( $this->game_domain     , "String" );   
       } 
	}
