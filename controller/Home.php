<?php

class Home extends Controller
{
    protected $user;



    function __construct()
    {
        $this->user = $this->model("userModel");

    }


    function listuser()
    {
        $user = $this->user->authenToken();
        if ($user == null)
        {
            //$status_user = false;
            header('Location: /Lession2/Home/login');
            die();
        }
        $view = $this->view("user", [
            "list" => $this->user->listUser(),
            "user"=> $user,
        ]);
    }

    function detail($id)
    {


        $user = $this->user->authenToken();
        if ($user == null)
        {
            //$status_user = false;
            header('Location: /Lession2/Home/login');
            die();
        }
        $view = $this->view("userdetail", [
            "user"=> $this->user->user($id),
        ]);
    }

    function login()
    {
        $message='';
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->user->Login($_POST['email'], md5($_POST['password']) )) {
                if(!empty($_POST['remember'])){
                    $token = md5($_POST['email']. time());
                    setcookie('token', $token, time() + 6*60*60, '/');
                    $this->user->updateRemember($_POST['email'],$token);
                }

                header('Location: ./listuser');
            }
        }else {
            $message = "* Tài khoản đăng nhập không đúng!!!";
        }

        $view = $this->view("login", [
            "title" => "Login",
            "message"=>'',
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

    function logout()
    {
        $token = $_COOKIE['token'];
        if(empty($token)){
            header('Location: /Lession2/Home/login');
            die();
        }
        setcookie('token','', time() -7 * 24 * 60 * 60, '/');
        header('Location: /Lession2/Home/login');
        die();
    }
}