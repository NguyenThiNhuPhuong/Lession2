<?php
class Controller{
    function model($model){
        require_once ('C:/xampp/htdocs/Lession2/model/'.$model.'.php');
        return new $model;
    }
    function view($view,$data=[]){

        require_once ('C:/xampp/htdocs/Lession2/view/'.$view.'.php');
    }
}