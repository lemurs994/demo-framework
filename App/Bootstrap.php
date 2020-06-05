<?php

require_once 'Config/Config.php';

session_start();

spl_autoload_register(function($classname){
    $classname = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
    if (file_exists(ROOT . $classname . '.php')) {
      require_once ROOT . $classname . '.php';
    } else {
      echo "Class file not found <br>";
      echo ROOT . $classname . '.php';
    }
});
