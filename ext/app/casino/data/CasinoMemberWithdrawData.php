<?php
	namespace app\casino\Data;
  // Classes
  use app\share\Classes\ErpEntity;
  // Data 
	class CasinoMemberWithdrawData extends ErpEntity{

    public function __construct($arr = null){
			// construct
      parent::__construct($arr);
		  settype( $this->member_id 			  , "Integer" );

      settype( $this->casino_balance    , "Float" );
      settype( $this->live_balance      , "Float" );

    }

    public $member_id;

    public $casino_balance;
    public $live_balance;


	}
