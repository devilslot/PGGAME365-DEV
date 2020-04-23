<?php
	namespace app\casino_live\Data;

    use app\share\Classes\ErpEntity;

	class CasinoLiveForwordData extends ErpEntity{

    public function __construct($arr = null){
			// construct
      parent::__construct($arr);
      settype( $this->gameserver    , "String" );
      settype( $this->mobile        , "String" );
      settype( $this->desktop       , "String" );

    }

    public $gameserver;
    public $mobile;
    public $desktop;

	}
