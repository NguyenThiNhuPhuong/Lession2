<?php
class Controller{
    function model($model){
        require_once ('C:/xampp/htdocs/De3/model/'.$model.'.php');
        return new $model;
    }
    function view($view,$data=[]){

        require_once ('C:/xampp/htdocs/De3/view/'.$view.'.php');
    }
}