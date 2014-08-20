<?php namespace boxxy\classes;

abstract class factory implements \boxxy\interfaces\factory{

  public abstract function build(array $data);
}