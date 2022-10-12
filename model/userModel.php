<?php

class userModel extends Database
{
    function updateUser($fullname, $password, $email, $role)
    {
        $query = "UPDATE user SET fullname = '" . $fullname . "',password='" . $password . "',role='" . $role . "'WHERE  email='" . $email . "'";
        $this->execute($query);
    }
    function updateRemember(  $email,$remember)
    {
        $query = "UPDATE user SET remember = '" . $remember . "'WHERE  email='" . $email . "'";
        $this->execute($query);
    }
    function Login($email, $password)
    {
        $query = "SELECT * From user WHERE email='" . $email . "' AND password='" . $password . "'";
        $list = $this->executeResult($query);
        if (count($list) == 1) {
            return true;
        } else {
            return false;
        }
    }

    function isEmail($email)
    {
        $query = "SELECT email from user";
        $list = $this->executeResult($query);
        for ($i = 0; $i < count($list); $i++) {
            if ($email == $list[$i]['email']) {
                return false;
            }
        }
        return true;
    }

    function authenToken()
    {
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            if (empty($token)) {
                return null;
            }
        } else {
            return null;
        }
        $query = "SELECT * From user WHERE remember='".$token."'";
        $list = $this->executeResult($query);
        if ($list != null && count($list) > 0) {
            return $list[0];
        }
        return null;

    }

    function Register($email, $fullname, $password, $role)
    {
        $query = "INSERT INTO user (fullname,password,role,email) VALUES('" . $fullname . "','" . $password . "','" . $role . "','" . $email . "')";
        $this->execute($query);
    }

    function listUser()
    {
        $query = "SELECT * FROM user";
        return $this->executeResult($query);
    }

    function user($email)
    {
        $query = "SELECT * FROM nguoidung WHERE email='$email'";
        return $this->executeResult($query, true);
    }

    function deleteUser($email)
    {
        $query = "DELETE FROM user WHERE email='" . $email . "'";
        $this->execute($query);
    }
}
