<?php namespace boxxy\classes;

use \boxxy\classes\controller;

class resolver implements \boxxy\interfaces\resolver{

  private $default;
  private $uri;

  public function __construct(controller $controller){
    $this->default = $controller;
  }

  public function get_controller(\boxxy\interfaces\request $request){
    $router = new router($request, function(){
      return ['errors', 'error404'];
    });
    $router->add_route('/', function($request){
      return ['default_page', 'show_default_page'];
    });
    $router->add_route('/<name>/', function($request, $name){
      return [$name, 'show_default_page'];
    });
    $router->add_route('/<name>/<controller>/', function($request, $name, $controller){
      return [$name, $controller];
    });
    $route = $router->run();
    $class = '\app\\'.$route[0].'\\controllers\\public_'.$route[1];
    if(class_exists($class))
      return new $class;
    else
      return $this->default;
  }
}