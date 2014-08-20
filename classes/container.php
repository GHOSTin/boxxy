<?php namespace boxxy\classes;

use \exception;

class container implements \boxxy\interfaces\container{

  private $root;
  private $context;
  private $request;
  private $resolver;
  private $controller;
  private $response = [];

  public function __construct($root, $context){
    $this->root = $root;
    $this->context = $context;
  }

  public function run(){
    try{
      $this->execute_request_block();
      $this->execute_resolver_block();
      $this->execute_controller_block();
      $this->execute_view_block();
    }catch(exception $e){
      $this->fail_run_block($e);
    }
  }

  public function execute_request_block(){
    try{
      $this->context->execute_before_request_block();
      $this->request = $this->context->get_request();
    }catch(exception $e){
      $this->context->fail_request_block($e);
    }
  }

  public function execute_resolver_block(){
    try{
      $this->context->execute_before_resolver_block();
      $this->resolver = $this->context->get_resolver();
    }catch(exception $e){
      $this->context->fail_resolver_block();
    }
  }

  public function execute_controller_block(){
    try{
      $this->context->execute_before_controller_block();
      $this->controller = $this->resolver->get_controller($this->request);
      $this->response['response'] = $this->controller->execute($this->request);
      $this->response['request'] = $this->request;
    }catch(exception $e){
      $this->context->fail_controller_block($e);
    }
  }

  public function execute_view_block(){
    try{
      $this->context->execute_before_view_block();
      $this->view = $this->context->get_view();
      print $this->view->render($this->root, $this->request, $this->response);
    }catch(exception $e){
      $this->context->fail_view_block($e);
    }
  }
}