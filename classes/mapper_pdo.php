<?php namespace boxxy\classes;

use \PDO;

class mapper_pdo{

  protected $pdo;

  public function __construct(PDO $pdo){
    $this->pdo = $pdo;
  }
}