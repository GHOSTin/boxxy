<?php namespace boxxy\interfaces;

use \boxxy\classes\controller;
use \boxxy\interfaces\request;

interface resolver{

  public function __construct(controller $controller);

  public function get_controller(request $request);
}