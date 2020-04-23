<?php
  namespace app\core;

  class DbConfig{

    public static function SetServer($database){
    	
	    Controller::SetType('sqlsrv');
	    Controller::SetHostname($database->host);
	    Controller::SetPort('');
	    Controller::SetUsername($database->user);
	    Controller::SetPassword($database->pass);
	    Controller::SetDatabase($database->db);
    }

  }
