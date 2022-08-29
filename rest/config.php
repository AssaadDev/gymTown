<?php

class Config {

  public static function DB_HOST(){
    return Config::get_env("DB_HOST", "sql.freedb.tech");
  }
  public static function DB_USERNAME(){
    return Config::get_env("DB_USERNAME", "freedb_ahmed");
  }
  public static function DB_PASSWORD(){
    return Config::get_env("DB_PASSWORD", "Xr7KDGUD@j*!bM#");
  }
  public static function DB_SCHEME(){
    return Config::get_env("DB_SCHEME", "freedb_gymBase");
  }
  public static function DB_PORT(){
    return Config::get_env("DB_PORT", "3306");
  }
  public static function JWT_SECRET(){
    return Config::get_env("JWT_SECRET", "w9OSiq1Lqa");
  }

  public static function get_env($name, $default){
   return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
  }
}

 ?>
