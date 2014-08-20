<?php namespace boxxy\classes;

class factory_uploaded_file extends factory{

  public function build(array $data){
    $file = new uploaded_file();
    $file->set_name($data['name']);
    $file->set_type($data['type']);
    $file->set_temp_name($data['tmp_name']);
    $file->set_size($data['size']);
    return $file;
  }
}