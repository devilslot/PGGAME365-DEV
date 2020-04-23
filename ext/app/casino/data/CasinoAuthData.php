<?php
	namespace app\casino\Data;
  // Classes
  use app\share\Classes\ErpEntity;
  // Data 
	class CasinoAuthData extends ErpEntity{

    public function __construct($arr = null){
			// construct
      parent::__construct($arr);
		  settype( $this->member_id 			, "Integer" );
      settype( $this->member_code       , "String" );

      settype( $this->casino_live_block      , "Integer" );
      settype( $this->casino_sa_block   , "Integer" );

      settype( $this->credit_remain       , "Float" );
      settype( $this->casino_remain  , "Float" );

      settype( $this->gameserver         , "String" );
      settype( $this->authtoken  , "String" );

      settype( $this->mobile   , "String" );
      settype( $this->desktop  , "String" );

      settype( $this->sagames         , "String" );

    }

    public $member_id;
    public $member_code;

    public $casino_live_block;
    public $casino_sa_block;

    public $credit_remain;
    public $casino_remain;

    public $gameserver;
    public $authtoken;
    
    public $mobile;
    public $desktop;

    public $sagames;

	}
