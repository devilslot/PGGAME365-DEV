<?php
	namespace app\casino_pg\model;

	use app\core\Entity;

	class EntityGamePg extends Entity{
	public $gameid;
	public $gamecode;
	public $gamename;
	public $releasestatus;
	public $status;
	public $sort;
	public $images;
	public $group_id;  
    public function __construct($arr = null){
	  	// construct
        parent::__construct($arr);

          settype( $this->gameid 		    , "Integer" );
		  settype( $this->gamecode 		 	, "String" );
		  settype( $this->gamename 		 	, "String" );
		  settype( $this->releasestatus     , "Integer" );
		  settype( $this->status 		 	, "Integer" );
		  settype( $this->sort 		 	    , "Integer" );
		  settype( $this->images 		 	, "String" );
		  settype( $this->group_id 		 	, "Integer" );  
       } 
	}
