<?php
/*
*Base controller
*load the models and views
*/
class Controller{
    //Load model
    public function model($model){
        //Require model file
        require_once '../app/models/'.$model.'.php';
        //instatiate model
        return new $model;
    }

    //Load view
    public function view($view,$data=[]){
        //Chek for view file
        if(file_exists('../app/views/'.$view.'.php')){
            require_once '../app/views/'.$view.'.php';
        }else{
         die('view does not existe');
        }


    }
}