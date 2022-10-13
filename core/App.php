<?php
class App
{
    protected $controller = "Home";
    protected $action = "listuser";
    protected $params = [];

    function __construct()
    {
        $url = $this->UrlProcess();

        if (isset($url[0])) {
            if(file_exists("C:/xampp/htdocs/Lession2/controller/" . $url[0] . ".php")){
                $this->controller = $url[0];
                unset($url[0]);
            }

        }

        require_once("C:/xampp/htdocs/Lession2/controller/". $this->controller .".php");

        //xu ly action
        if (isset($url[1])) {
            if(method_exists($this->controller, $url[1])){
                $this->action = $url[1];
                unset($url[1]);
            }

        }

        // xu ly params
      $this->params = $url ? array_values($url) : [];
        $h = new $this->controller();
    call_user_func_array([$h, $this->action], $this->params);
    }
    function UrlProcess()
    {
        if (isset($_GET['url'])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
}
