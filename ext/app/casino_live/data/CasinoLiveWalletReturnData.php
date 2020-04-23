<?php
	namespace app\casino_live\Data;

    use app\share\Classes\ErpEntity;

	class CasinoLiveWalletReturnData extends ErpEntity{

    public function __construct($arr = null){
			// construct
      parent::__construct($arr);
      settype( $this->err       , "String" );
      settype( $this->errdesc   , "String" );
      
      settype( $this->bal 			, "Float" );
      settype( $this->cur 			, "String" );
      settype( $this->txid      , "String" );
      settype( $this->ptxid     , "String" );
      settype( $this->dup       , "String" );

    }

    public $err;
    public $errdesc;

    public $bal;
    public $cur;
    public $txid;
    public $ptxid;
    public $dup;

	}
