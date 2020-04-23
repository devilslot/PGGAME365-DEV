<?php
  namespace app\core;

  class Entity{

    public function __construct($arr = array()){
      if( !empty($arr) ){
        
        foreach ($arr as $key => $value) {
          if( gettype($value) == 'array' || gettype($value) == 'Array'){

            if( method_exists( $this, 'Internal'.$key ) == 1 ){
              $rs   = $value[0] ?? null;
              $data = $this->{'Internal'.$key}($rs);
              if( property_exists($this, $key) == 1 ){
                $this->$key = (Object)$data;
              }
            }else if( method_exists( $this, 'External'.$key ) == 1 ){
              foreach ($value as $skey => $svalue) {
                $data = $this->{'External'.$key}($svalue);
                if( property_exists($this, $key) == 1 ){
                  $this->$key[] = $data;
                }
              }
            }

          }else{
            if( property_exists($this, $key) == 1 ){
              $this->$key = $value;
            }
          }
        }
      }
    }
  }
