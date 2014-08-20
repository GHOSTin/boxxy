<?php namespace boxxy;
class autoload{

  private static $paths = [];
  private static $register = false;

  public static function path($path){
    if(!file_exists($path))
      throw new exception('Путь не представлен в файловой системе.');
    self::$paths[] = $path;
    if(!self::$register){
      spl_autoload_register(['\boxxy\autoload', 'call']);
      self::$register = true;
    }
  }

  public static function call($class){
    $name = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    foreach(self::$paths as $path){
      $file = $path.$name;
      if(file_exists($file))
        require_once $file;
    }
  }
}