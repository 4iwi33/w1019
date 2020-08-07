<?php

require "vendor/autoload.php";

use TexLab\MyDB\Runner;
use TexLab\MyDB\DB;
use Core\Config;

// class MyRunner extends Runner
// {
//     protected function errorHandler(array $error)
//     {
//         echo $error["error"] . "\n";
//         echo $error["sql"] . "\n";
//     }
// }

$runner = new Runner(
    DB::Link([
        'host' => Config::MYSQL_HOST,
        'username' => Config::MYSQL_USER_NAME,
        'password' => Config::MYSQL_PASSWORD
    ]));

    $runner->setErrorHandler(function($mysqli, $sql){
        echo "$mysqli->error\n";
    });
$runner->runScript(file_get_contents('install/guests_book.sql'));

// foreach (explode(";", file_get_contents('install/guests_book.sql')) as $value) {
//     try {
//         if (!empty($value)) {
//             $runner->runSQL($value);
//         }
//     } catch (Exception $e) {
//         echo $e->getMessage();
//     }
// }
