<?php
class userModel extends Database
{
    function updateUser($username, $updated_at, $password, $email, $type_id)
    {
        $query = "UPDATE user SET username = '" . $username . "',updated_at='" . $updated_at . "',password='" . $password . "',type_id='" . $type_id . "'WHERE  email='" . $email . "'";
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

    function isEmail($email) //kiem tra xem email da dk tai khoan ch
    {
        $query = " SELECT email from user";
        $list = $this->executeResult($query);
        for ($i = 0; $i < count($list); $i++) {
            if ($email == $list[$i]['email']) {
                return false;
            }
        }
        return true;
    }

    function Register($email, $username, $password, $type_id, $nen, $avatar, $created_at, $updated_at)
    {
        $query = "INSERT INTO user (username,password,type_id,email,nen,avatar,created_at,updated_at) VALUES('" . $username . "','" . $password . "','" . $type_id . "','" . $email . "','" . $nen . "','" . $avatar . "','" . $created_at . "','" . $updated_at . "')";
        $this->execute($query);
    }

    function dsUser()
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
