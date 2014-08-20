<?php namespace boxxy\classes;

use \RuntimeException;

class view{

  public function render($root, request $request, array $response){
    \Twig_Autoloader::register();
    $templates = $root.'templates'.DIRECTORY_SEPARATOR;
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
    $template_name = $route[0].DIRECTORY_SEPARATOR.'public_'.$route[1].'.tpl';
    $loader = new \Twig_Loader_Filesystem($templates);
    $loader->prependPath($templates.$route[0], $route[0]);
    $twig = new \Twig_Environment($loader);
    return $twig->render($template_name, $response);
  }
}