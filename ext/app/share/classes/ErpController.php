<?php
namespace app\share\Classes;

use app\core\Controller;

class ErpController extends Controller{

	public static function CheckLogin(){
	    $member_id = $_SESSION["member"]["id"];
	    if( empty($member_id) ){
	      echo "ท่านเข้าสู่ระบบนานเกินไป กรุณาเชื่อมต่อใหม่อีกครั้ง !!";
	      exit();
	    }else{
	      return $member_id;
	    }
	}
	
}
