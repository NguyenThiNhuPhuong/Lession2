<?php

class Home extends Controller
{
    protected $user;

    function __construct()
    {
        $this->user = $this->model("userModel");
    }

    //Hiển thị giao diện trang chủ(danh sách user)
    function listuser()
    {
        $user = $this->user->authenToken();
        if ($user == null) {
            header('Location: /Lession2/Home/login');
            die();
        }
        $view = $this->view("listuser", [
            "list" => $this->user->listUser(),
            "user" => $user,
        ]);
    }

    //Hiển thị giao diện chi tiết user
    function detail($id)
    {
        $user = $this->user->authenToken();
        if ($user == null) {
            header('Location: /Lession2/Home/login');
            die();
        }
        if ($user['role'] == 'Admin') {
            if (empty($this->user->user($id))) {
                $view = $this->view("blank", [
                    'message' => '404 Not Found',
                ]);
            } else {
                $view = $this->view("userdetail", [
                    "user" => $this->user->user($id),
                ]);
            }

        } else {
            if ($user['id'] == $id) {
                $view = $this->view("userdetail", [
                    "user" => $this->user->user($id),
                ]);
            } else {
                $view = $this->view("blank", [
                    'message' => '403 Forbidden'
                ]);
            }
        }
    }

    //Hiển thị giao diện chỉnh sửa thông tin user
    function edit($id)
    {
        $user = $this->user->authenToken();
        if ($user == null) {
            header('Location: /Lession2/Home/login');
            die();
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->user->update($_POST['email'], $_POST['fullname'], $_POST['role']);
            header('Location: /Lession2');
        }

        if ($user['role'] == 'Admin') {
            if (empty($this->user->user($id))) {
                $view = $this->view("blank", [
                    'message' => '404 Not Found',
                ]);
            } else {
                $view = $this->view("edituser", [
                    "user" => $this->user->user($id),
                    "role" => $user['role']
                ]);
            }

        } else {
            if ($user['id'] == $id) {
                $view = $this->view("edituser", [
                    "user" => $this->user->user($id),
                    "role" => $user['role']
                ]);
            } else {
                $view = $this->view("blank", [
                    'message' => '403 Forbidden'
                ]);
            }
        }
    }

    //Hiển thị giao diện đăng ký tài khoản
    function register()
    {
        $user = $this->user->authenToken();
        if ($user != null) {
            header('Location: /Lession2');
            die();
        }
        $message = '';
        $email = '';
        $fullname = '';
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $role = 'User';
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $password = md5($_POST['password']);
            $confirmpassword = md5($_POST['confirmpassword']);
            if ($this->user->isEmail($_POST['email'])) {
                if ($password == $confirmpassword) {
                    $this->user->register($email, $fullname, $password, $role);
                    header('Location: ./login');
                } else {
                    $message = "* Confirm password does not match! ";
                }
            } else {
                $message = "* This email is already registered!";
            }
        }
        $view = $this->view("register", [
            "message" => $message,
            "old" => [
                'email' => $email,
                'fullname' => $fullname,
            ]
        ]);
    }

   //Hiển thị giao diện trang đăng nhập
    function login()
    {
        $user = $this->user->authenToken();
        if ($user != null) {
            header('Location: /Lession2');
            die();
        }
        $message = '';
        $email = '';
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = $_POST['email'];
            if ($this->user->login($email, md5($_POST['password']))) {
                if (!empty($_POST['remember'])) {
                    $token = md5($_POST['email'] . time());
                    setcookie('token', $token, time() + 6 * 60 * 60, '/');
                    $this->user->updateRemember($_POST['email'], $token);
                } else {
                    $token = md5($_POST['email'] . time());
                    setcookie('token', $token, time() + 30 * 60, '/');
                    $this->user->updateRemember($_POST['email'], $token);
                }

                header('Location: /Lession2');
            } else {
                $message = "* The login account is incorrect, please try again!";
            }
        }

        $view = $this->view("login", [
            "message" => $message,
            "old" => [
                "email" => $email,
            ]
        ]);
    }

    //Chức năng đăng xuất
    function logout()
    {
        $token = $_COOKIE['token'];
        if (empty($token)) {
            header('Location: /Lession2/Home/login');
            die();
        }
        setcookie('token', '', time() - 7 * 24 * 60 * 60, '/');
        header('Location: /Lession2/Home/login');
        die();
    }
}