<?php
    // CREATES URL AND LOADES CONTROLLERS
    // URL FORMAT -/CONTROLLER/METHOD/PARAMS 

    class Core{
        protected $currentController ='Pages';
        protected $currentMethod = 'index';
        protected $params =[];

        public function __construct(){
            $url=$this->getUrl();
            // get the first value of the url and check if the method exists in the controller
            if(file_exists('../app/controller/'.$url[0].'.php')){
                // if it exists, set it as the current controller 
                $this->currentController=$url[0];
                unset($url[0]);
            }
            require_once '../app/controller/'. ucwords($this->currentController) . '.php';
            $this->currentController= new $this->currentController;
            if(isset($url[1])){
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod=$url[1];
                    unset($url[1]);
                }

                
            }
            $this->params=$url?array_values($url):[];
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
            

        }
        
        public function getUrl(){
            if(isset($_GET['url'])){
                $url=rtrim($_GET['url'],'/');
                $url=filter_var($url,FILTER_SANITIZE_URL);
                return explode('/',$url);
            }else{
                return [$this->currentController];
            }
        }
    }

