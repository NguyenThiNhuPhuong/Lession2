<?php

class Database
{
    public $conn;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $database = "lession2";

    public function __construct()
    {
        // tạo kết nối
        $this->conn = new mysqli($this->servername,$this->username, $this->password,$this->database);
        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        //Tạo bảng user trong database
        $this->createTableUser();

    }


    function createTableUser()
    {
        $query = "CREATE TABLE IF NOT EXISTS user (
                    id INT(11) AUTO_INCREMENT PRIMARY KEY, 
                    fullname VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    remember VARCHAR(255) , 
                    role VARCHAR(50) DEFAULT 'User'
        )";
        //Kiểm tra tạo bảng có lỗi không
        if ( $this->execute($query)=== false) {
            die("Error creating table: " . $this->conn->error);
        }
    }

    function execute($query)
    {
        $this->conn->query($query);
    }

    function executeResult($query, $isSingle = false)
    {
        $result = $this->conn->query($query);
        $list = [];
        if ($isSingle) {
            $list = mysqli_fetch_array($result, 1);
        } else {
            while ($row = mysqli_fetch_array($result, 1)) {
                $list[] = $row;
            }
        }

        return $list;
    }
}