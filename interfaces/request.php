<?php namespace boxxy\interfaces;

use \boxxy\classes\uploaded_file as file;

interface request{

  public function __construct();

  public function add_file(file $file);

  public function get_files();

  public function get_host();

  public function get_property($key);

  public function get_uri();

  public function set_host($host);

  public function set_property($key, $value);

  public function set_uri($uri);
}