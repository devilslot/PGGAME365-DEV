<?php
namespace app\casino_awc\Classes;

use app\core\Entity;

class AwcEntity extends Entity{
    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

      	settype( $this->apiserver 		 		, "String" );

      	settype( $this->clientId 		 		, "String" );
      	settype( $this->clientSecret 		 	, "String" );
      	
    }

		public $apiserver;

		public $clientId;
		public $clientSecret;
		
		public function UpdateConfiguration($source){
			if(!empty($source->apiserver)){
				$this->apiserver = $source->apiserver;
			}
			if(!empty($source->clientId)){
				$this->clientId = $source->clientId;
			}
			if(!empty($source->clientSecret)){
				$this->clientSecret = $source->clientSecret;
			}
		}
}
