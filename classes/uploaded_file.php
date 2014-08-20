<?php namespace boxxy\classes;

class uploaded_file{

  private $type;
  private $temp_name;
  private $size;
  private $name;

  public function set_name($name){
    $this->name = $name;
  }

  public function set_temp_name($temp_name){
    $this->temp_name = $temp_name;
  }

  public function set_size($size){
    $this->size = $size;
  }

  public function set_type($type){
    $this->type = $type;
  }
}