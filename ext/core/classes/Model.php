<?php
  namespace app\core;

  use Aura\SqlQuery\QueryFactory;

  class Model{
  	
  	public static function newSelect(){
  		$que = new QueryFactory( Controller::GetType() );
  		return $que->newSelect();
  	}

  	public static function newInsert(){
  		$que = new QueryFactory( Controller::GetType() );
  		return $que->newInsert();
  	}

  	public static function newUpdate(){
  		$que = new QueryFactory( Controller::GetType() );
  		return $que->newUpdate();
  	}

  	public static function newDelete(){
  		$que = new QueryFactory( Controller::GetType() );
  		return $que->newDelete();
  	}


    public static function debug($sql){
      return $sql->getStatement();
    }

    public static function ToQuery($sql){
      return self::interpolateQuery( $sql->getStatement() , $sql->getBindValues() );
    }


    private static function interpolateQuery($query, $params) {
        $keys = array();
        $values = $params;

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:'.$key.'/';
            } else {
                $keys[] = '/[?]/';
            }

            if (is_array($value))
                $values[$key] = implode(',', $value);

            if (is_null($value))
                $values[$key] = 'NULL';
        }
        // Walk the array to see if we can add single-quotes to strings
        array_walk($values, create_function('&$v, $k', 'if (!is_numeric($v) && $v!="NULL") $v = "\'".$v."\'";'));

        $query = preg_replace($keys, $values, $query, 1, $count);

        return $query;
    }

  }