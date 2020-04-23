<?php
	namespace app\casino\Data;
  // Classes
  use app\share\Classes\ErpEntity;

	class CasinoReportTransferSearchCriteria extends ErpEntity{

    public function __construct($arr = null){
			// construct
      parent::__construct($arr);
      settype( $this->startdate , "String" );
      settype( $this->enddate 	, "String" );

      settype( $this->provider   , "String" );

      settype( $this->member_id   , "Integer" );
    }

    public $startdate;
		public $enddate;
    public $provider;
    
    public $member_id;

	}
