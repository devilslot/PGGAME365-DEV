<?php
  namespace app\core;

  use Aura\Sql\ExtendedPdo;

  class Controller {

    protected static $type;
    protected static $host;
    protected static $port;
    protected static $username;
    protected static $password;
    protected static $database;

    public function __construct(){  }

    public static function GetRequestData($returnClass = null){
      if(isset($_REQUEST)){
        if( empty($returnClass) ){
          return (Object) $_REQUEST;
        }else{
          return new $returnClass( $_REQUEST );
        }
      }else if(isset($_POST)){
        if( empty($returnClass) ){
          return (Object) $_POST;
        }else{
          return new $returnClass( $_POST );
        }
      }else if(isset($_GET)){
        if( empty($returnClass) ){
          return (Object) $_GET;
        }else{
          return new $returnClass( $_GET );
        }
      }else{
        return $returnClass;
      }
    }
    
    public static function GetRequestValue($returnId = null){
      if(isset($_REQUEST[$returnId])){
          return $_REQUEST[$returnId];
      }else if(isset($_POST[$returnId])){
          return $_POST[$returnId];
      }else if(isset($_GET[$returnId])){
          return $_GET[$returnId];
      }else{
        return array();
      }
    }

    private static function ArrayFromKeys($arr,$key){
      $newobj = array();
      foreach ($arr as $value) {
        if(isset($value[$key])){
          array_push($newobj,$value[$key]);
        }
      }
      return $newobj;
    }

    public static function isMatching( $param1 , $param2 , $param3 = null , $param4 = null ){
      if( gettype($param1) == 'array' && gettype($param2) == 'array' && empty($param3) && empty($param4) ){
        return array_intersect($param1,$param2);
      }else if( gettype($param1) == 'array' && gettype($param2) == 'string' && empty($param3) && empty($param4) ){
        return in_array($param2,$param1);
      }else if( gettype($param1) == 'string' && gettype($param2) == 'array' && empty($param3) && empty($param4) ){
        return in_array($param1,$param2);
      }else if( gettype($param1) == 'array' && gettype($param2) == 'string' && gettype($param3) == 'array' && empty($param4) ){
        $obj1 = self::ArrayFromKeys($param1,$param2);
        return array_intersect($obj1,$param3);
      }else if( gettype($param1) == 'array' && gettype($param2) == 'array' && gettype($param3) == 'string' && empty($param4) ){
        $obj1 = self::ArrayFromKeys($param2,$param3);
        return array_intersect($param1,$obj1);
      }else if( gettype($param1) == 'array' && gettype($param2) == 'string' && gettype($param3) == 'string' && empty($param4) ){
        $obj1 = self::ArrayFromKeys($param1,$param2);
        return in_array($param3,$obj1);
      }else if( gettype($param1) == 'array' && gettype($param2) == 'string' && gettype($param3) == 'array' && gettype($param4) == 'string' ){
        $obj1 = self::ArrayFromKeys($param1,$param2);
        $obj2 = self::ArrayFromKeys($param3,$param4);
        return array_intersect($obj1,$obj2);
      }

    }

    public static function GetType(){
      return self::$type;
    }

    public static function SetType($type){
      self::$type = $type;
    }

    public static function SetHostname($host){
      self::$host = $host;
    }

    public static function SetPort($port){
      self::$port = $port;
    }

    public static function SetUsername($user){
      self::$username = $user;
    }

    public static function SetPassword($pass){
      self::$password = $pass;
    }

    public static function SetDatabase($db){
      self::$database = $db;
    }

    // Pdo Connect
    // ########################################################################
    private static function connect(){
      switch (self::$type){
        case 'mysql' :
            $pdo = new ExtendedPdo( 'mysql:host='.self::$host.';dbname='.self::$database , self::$username, self::$password );
            $pdo->exec("set names utf8");

          break;
        case 'sqlsrv' :
            $pdo = new ExtendedPdo( 'sqlsrv:server='.self::$host.';database='.self::$database , self::$username, self::$password );

          break;
      }

      return $pdo;

    }

    // Controller Extention
    // ########################################################################
    public static function QueryAble($sql){
      return self::interpolateQuery( $sql->getStatement() , $sql->getBindValues() );
    }

    public static function FirstOrDefault($sql , $returnClass = null){
      $pdo = self::connect();

      $result = $pdo->fetchAll( $sql->getStatement() , $sql->getBindValues() );
      $rs = self::UpdateData($result);

      if( empty($rs[0]) ){
        return $returnClass;
      }else{
        if( empty($returnClass) ){
          return (Object)$rs[0];
        }else{
          return new $returnClass( $rs[0] );
        }
      }

    }

    public static function FetchRows($sql){
      $pdo = self::connect();

      $stmt = $pdo->prepare( $sql->getStatement() );
      $stmt->execute( $sql->getBindValues() );

      return $stmt->rowCount();
    }

    public static function ToValue($sql){
      $pdo = self::connect();

      $result = $pdo->fetchValue( $sql->getStatement() , $sql->getBindValues() );
      return $result;
    }

    public static function ToList($sql, $returnClass = null){
      $pdo = self::connect();

      $result = $pdo->fetchAll( $sql->getStatement() , $sql->getBindValues() );
      $rs     = self::UpdateData($result);


      if( empty($rs) ){
        return array();
      }else{
        if( empty($returnClass) ){
          return $rs;
        }else{
          $arr = array();
          foreach ($rs as $key => $value) {
            array_push($arr, new $returnClass($value) );
          }
          return $arr;
        }
      }

    }

    public static function UnitCommit( $sql , $id = null ){
      $pdo = self::connect();

      $sth = $pdo->prepare( $sql->getStatement() );
      $sth->execute( $sql->getBindValues() );
      if( !empty($id) ){
         $sql->getLastInsertIdName($id);
         return $pdo->lastInsertId();
      }
    }

    public static function execute($sql) {
      $pdo = self::connect();

      $sth = $pdo->prepare($sql);
      $sth->execute();
    }

    public static function executeFetch($sql) {
      $pdo = self::connect();

      $sth = $pdo->prepare($sql);
      $sth->execute();
      return $sth->fetch();
    }
    // private
    // Controller Function
    // ########################################################################
    private static function UpdateData($result) {
        $data = array();
        foreach ($result as $arr) {
            $newPrefix = array();
            foreach ($arr as $key => $value) {
                $prefix = explode('->', $key);
                while (count($prefix) > 0) {
                    $last[$prefix[count($prefix) - 1]] = $last ?? $value;
                    if (count($last) > 1) {
                        array_shift($last);
                    }
                    array_pop($prefix);
                }
                $newPrefix = array_merge_recursive($newPrefix, $last);
                unset($last);
            }
            $data[] = $newPrefix;
        }
        return self::ResultToClass($data);
    }
    private static function ResultToClass($result) {
        $obj = self::ResultToObj($result);
        $new = self::NewArrayFromObj($obj);

        return $new;
    }
    private static function ResultToObj($result, $tmp = array()) {
        foreach ($result as $arg) {
            $m = array();
            foreach ($arg as $k) {
                if (!is_array($k)) {
                    $m[] = $k;
                }
            }
            $offset = implode("_", $m);

            foreach ($arg as $key => $value) {
                if (is_array($value)) {
                    if (empty($tmp[$offset][$key])) {
                        $tmp[$offset][$key] = array();
                    }
                    $send = array();
                    $send[] = $value;
                    $tmp[$offset][$key] = self::ResultToObj($send, $tmp[$offset][$key]);
                } else {
                    $tmp[$offset][$key] = $value;
                }
            }
        }
        return $tmp;
    }
    private static function NewArrayFromObj($obj) {
        $new = array();
        $i = 0;
        foreach( $obj as $value ){
            foreach ($value as $fields => $data){
                if (is_array($data)) {
                    $relation = self::NewArrayFromObj($data);
                    $new[$i][$fields] = $relation;
                } else {
                    $new[$i][$fields] = $data;
                }
            }
            $i++;
        }
        if( count($new) === 1 ){
            $check = false;
            foreach ($new[0] as $val){
                if( !empty($val) ){
                    $check = true;
                }
            }
            if($check == true){
                return $new;
            }else{
                return array();
            }
        }else{
            return $new;
        }
    }

  }
