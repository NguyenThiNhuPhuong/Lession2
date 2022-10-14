<?php
class Controller{
    //hàm dùng để gọi model
    function model($model){
        require_once ('C:/xampp/htdocs/Lession2/model/'.$model.'.php');
        return new $model;
    }

    //hàm dùng để gọi view
    function view($view,$data=[]){
        require_once ('C:/xampp/htdocs/Lession2/view/'.$view.'.php');
    }
}