<?php namespace boxxy\interfaces;

use \boxxy\classes\response;

interface view{

  public function __construct($dir);

  public function render(response $response);
}