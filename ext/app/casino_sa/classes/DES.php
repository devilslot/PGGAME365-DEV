<?php
	namespace app\casino_sa\Classes;

	class DES{
		var $key;
		var $iv;

	    public function __construct( $key, $iv=0 ){
		  	// construct
	        $this->key = $key;
			if( $iv == 0 ) {
				$this->iv = $key;
			} else {
				$this->iv = $iv;
			}
	      	
	    }

		public function encrypt($str) {
			return base64_encode( openssl_encrypt($str, 'DES-CBC', $this->key,OPENSSL_RAW_DATA,$this->iv ) );
		}
	}