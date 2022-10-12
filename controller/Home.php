<?php

class Home extends Controller
{
    protected $user;
    protected $message;


    function __construct()
    {
        $this->user = $this->model("userModel");

    }


    function user()
    {

        $view = $this->view("user", [
            "list" => $this->user->listUser(),
        ]);
    }
    function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->user->Login($_POST['email'], md5($_POST['password']) )) {
                header('Location: ./user');
            }
        }
        $view = $this->view("login", [
            "title" => "Login"
        ]);
    }
    function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $role= 'User';
            $password=md5($_POST['password']);
            $confirmpassword=md5($_POST['confirmpassword']);


            if ($this->user->isEmail($_POST['email'])) {
                if ($password == $confirmpassword) {
                    $this->user->Register($_POST['email'],$_POST['fullname'],$password, $role);
                    header('Location: ./login');
                } else {
                   $this->message= "* Xác nhận password không đúng! ";
                }
            } else {
                $this->message = "* Email này đã được đăng ký tài khoản!";
            }
        }
        $view = $this->view("register", [
            "title" => "Register",
            "message"=>$this->message
        ]);
    }

}