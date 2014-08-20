<?php namespace boxxy\classes;

use \boxxy\interfaces\request;

abstract class controller{

  public final function __construct(){}

  abstract public function execute(request $request);
}