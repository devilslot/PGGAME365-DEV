<?php
namespace app\share\Classes;

class ip_and_url {

  public static function GetPageURL() {
    $pageURL = 'http';
    if ((isset($_SERVER["HTTPS"]) ? $_SERVER["HTTPS"] : '') == "on") {
      $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
      $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
  }

  public static function GetIP() {
    if (getenv('HTTP_CLIENT_IP')) {
      $ip_counter = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
      $ip_counter = getenv('HTTP_X_FORWARDED_FOR');
      $ip_counter = array_values(array_filter(explode(',', $ip_counter)));
      $ip_counter = $ip_counter[0];
    } else {
      $ip_counter = getenv('REMOTE_ADDR');
    }
    return $ip_counter;
  }

  public static function GetUrlRewrite($input) {
    $input = eregi_replace("&lt;", "<", $input);
    $input = eregi_replace("&gt;", ">", $input);
    $input = eregi_replace("&quot;", '"', $input);
    $input = eregi_replace("'", "'", $input);
    $input = eregi_replace("&amp;", '&', $input);
    $input = eregi_replace("&", '-', $input);
    $input = eregi_replace(" ", '-', $input);
    $input = eregi_replace("/?", "", $input);
    $input = eregi_replace(">", '-', $input);
    $input = eregi_replace("<", '-', $input);
    $input = eregi_replace(",", '-', $input);
    $input = eregi_replace("/", 'ต่อ', $input);
    $input = eregi_replace("%", 'เปอร์เซ็น', $input);
    $input = eregi_replace('"', '-', $input);
    $input = eregi_replace('"', '-', $input);
    $input = eregi_replace("--", '-', $input);
    $input = eregi_replace("--", '-', $input);
    $input = eregi_replace("--", '-', $input);
    $input = eregi_replace("\.", '', $input);
    return $input;
  }

}