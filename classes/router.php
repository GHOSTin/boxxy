<?php namespace boxxy\classes;

class router{

  private $callbacks = [];
  private $default;
  private $status = false;
  private $path;
  private $patterns = ['/<([a-z]+)>/'];
  private $replacements = ['([a-zA-Z0-9_-]+)'];

  public function __construct(request $request, callable $function){
    $this->request = $request;
    $this->default = $function;
    $this->path = parse_url($this->request->get_uri(), PHP_URL_PATH);
  }

  public function add_route($string, callable $function){
    $regular = preg_replace($this->patterns, $this->replacements, $string);
    $this->callbacks[$regular] = $function;
  }

  public function run(){
    if(!empty($this->callbacks)){
      foreach($this->callbacks as $route => $call){
        if(preg_match('|^'.$route.'$|', $this->path, $match)){
          $match[0] = $this->request;
          return call_user_func_array($call, $match);
          $this->status = true;
          break;
        }
      }
    }
    if($this->status !== true)
      return call_user_func_array($this->default, [$this->request]);
  }
}