<?php namespace boxxy\classes;

abstract class controller{

  public final function __construct(){}

  abstract public function execute(\boxxy\interfaces\request $request);
}