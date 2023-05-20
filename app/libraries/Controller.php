<!-- THIS CONTROLLER IS TO LOAD MODELS AND VIEWS -->

<?php
    class Controller{
        // load models 
        public function model($model){
            require_once '../app/model/'.$model.'.php';

            return new $model();
        }
        // load view 
        public function view($view, $data=[]){
            if (file_exists('../app/views/'.$view.'.php')){
                require_once '../app/views/'.$view.'.php';
            }else{
                die('view does not exist');

            }
        }
    }