<?php
namespace app\casino_sa\Classes;

use app\core\Entity;

class SaEntity extends Entity{
    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

      	settype( $this->apiserver 		 		, "String" );
      	settype( $this->gameserver 		 		, "String" );

      	settype( $this->SecretKey 		 		, "String" );
      	settype( $this->MD5Key 		 			, "String" );
      	settype( $this->EncryptKey 		 		, "String" );

      	settype( $this->Time 		 			, "String" );
      	$this->Time = date('YmdHis',time());
      	
    }

		public $apiserver;
		public $gameserver;

		public $SecretKey;
		public $MD5Key;
		public $EncryptKey;
		
		public $Time;

		public function UpdateConfiguration($source){
			if(!empty($source->apiserver)){
				$this->apiserver = $source->apiserver;
			}
			if(!empty($source->gameserver)){
				$this->gameserver = $source->gameserver;
			}
			if(!empty($source->SecretKey)){
				$this->SecretKey = $source->SecretKey;
			}
			if(!empty($source->MD5Key)){
				$this->MD5Key = $source->MD5Key;
			}
			if(!empty($source->EncryptKey)){
				$this->EncryptKey = $source->EncryptKey;
			}
		}
}
