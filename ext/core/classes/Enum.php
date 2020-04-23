<?php
  namespace app\core;

  class Enum {

    protected static $enum;

    public static function SetData($arr){
      self::$enum = $arr;
    }

    public static function GetData(){
      return self::$enum;
    }

    public static function GetValue($item){
      $arr = self::$enum;
      return $arr[$item];
    }

  }
