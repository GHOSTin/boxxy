<?php namespace boxxy\interfaces;

interface container{

  public function __construct($root, $context);

  public function run();
}