<?php

namespace Core;

use Core\Config;
use Controller\TableController;
use Model\DbTable;
use mysqli;
use View\View;


class Dispatcher
{
    public function __construct()
    {
    }

    public function run()
    {
        // include __DIR__ . "/../../config/config.php";
        // ?action=show
        // ?action=add

        $view =  new View();
        $view->setLayout('mainLayout');

        $controller = new TableController(
            new DbTable(
                new mysqli(
                    Config::MYSQL_HOST,
                    Config::MYSQL_USER_NAME,
                    Config::MYSQL_PASSWORD,
                    Config::MYSQL_DATABASE,
                ),
                Config::MYSQL_TABLE
            ),
            $view
        );

        $action = "action" . $_GET["action"];
        // echo $_SERVER['REQUEST_URI'];
        $controllerData = ['post' => $_POST, 'get' => $_GET];

        if (method_exists($controller, $action)) {
            $controller->{$action}($controllerData);
        } else {
            $controller->actionDefault();
        }
        // $controller->actionShow();
        // $controller->{"actionShow"}();
    }
}
