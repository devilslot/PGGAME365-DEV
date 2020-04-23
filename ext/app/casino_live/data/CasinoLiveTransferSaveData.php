<?php
	namespace app\casino_live\Data;

    use app\share\Classes\ErpEntity;

	class CasinoLiveTransferSaveData extends ErpEntity{

    public function __construct($arr = null){
			// construct
      parent::__construct($arr);
      settype( $this->userid 			 , "String" );
      settype( $this->txid 			   , "Integer" );
      settype( $this->amt          , "Float" );
      settype( $this->timestamp    , "String" );
      settype( $this->transfertype , "String");

    }

    public $userid;
    public $txid;
    public $amt;
    public $timestamp;
    public $transfertype;

	}
