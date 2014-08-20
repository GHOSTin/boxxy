<?php namespace boxxy\classes;

use \exception;

class app implements \boxxy\interfaces\app{

  public function execute_before_request_block(){}

  public function execute_before_resolver_block(){}

  public function execute_before_view_block(){}

  public function execute_before_controller_block(){}

  public function fail_request_block(exception $e){
    $this->fail_run_block($e);
  }

  public function fail_resolver_block(exception $e){
    $this->fail_run_block($e);
  }

  public function fail_controller_block(exception $e){
    $this->fail_run_block($e);
  }

  public function fail_view_block(exception $e){
    $this->fail_run_block($e);
  }

  public function fail_run_block(exception $e){
    if($this->get_status() === 'development')
      die($e);
    else
      exit();
  }

  public function get_request(){
    return new \boxxy\classes\request();
  }

  public function get_resolver(){
    return new \boxxy\classes\resolver(
                  new \app\errors\controllers\error404());
  }

  public function get_status(){
    return 'production';
  }

  public function get_view(){
    return new \boxxy\classes\view();
  }
}
