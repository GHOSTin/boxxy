<?php namespace boxxy\classes;

use \boxxy\classes\uploaded_file as file;

class request implements \boxxy\interfaces\request{

  private $properties;
  private $uri;
  private $host;
  private $files;

  public function __construct(){
    if(!empty($_GET))
        foreach($_GET as $key => $value)
          $this->set_property($key, $value);
    if(!empty($_POST))
        foreach($_POST as $key => $value)
          $this->set_property($key, $value);
    if(!empty($_FILES)){
      $factory = new factory_uploaded_file();
      foreach($_FILES as $file){
        if($file['error'] != 1)
          $this->files[] = $factory->build($file);
      }
    }
    $this->set_host($_SERVER['SERVER_NAME']);
    $this->set_uri($_SERVER['REQUEST_URI']);
  }

  public function add_file(file $file){
    $this->files[] = $file;
  }

  public function get_files(){
    return $this->files;
  }

  public function get_host(){
    return $this->host;;
  }

  public function get_property($key){
    if(isset($this->properties[$key]))
      return $this->properties[$key];
    else
      return null;
  }

  public function get_uri(){
    return $this->uri;
  }

  public function set_property($key, $value){
    $this->properties[$key] = $value;
  }

  public function set_host($host){
    $this->host = $host;
  }

  public function set_uri($uri){
    $this->uri = $uri;
  }
}