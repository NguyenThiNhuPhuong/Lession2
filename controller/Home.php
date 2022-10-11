<?php

class Home extends Controller
{
    protected $user;


    function __construct()
    {
        $this->user = $this->model("userModel");

    }

    function default()
    {

        $view = $this->view("login", [
            "page" => "home",
            "title" => "Home"
        ]);
    }
}