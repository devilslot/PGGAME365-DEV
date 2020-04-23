<?php
  namespace app\casino_live\Data;

  use app\core\Entity;

  class CasinoLiveBalanceData extends Entity{

    public function __construct($arr = null){
      // construct
      parent::__construct($arr);
      settype( $this->err           , "Integer" );
      settype( $this->errdesc       , "String" );
      settype( $this->bal           , "Float" );
      settype( $this->cur           , "String" );

      settype( $this->credit_remain , "Float" );
      settype( $this->url           , "String" );
      settype( $this->urlmobile     , "String" );

    }

    public $err;
    public $errdesc;
    public $bal;
    public $cur;
    
    public $credit_remain;
    public $url;
    public $urlmobile;

  }
