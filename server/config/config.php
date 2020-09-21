<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "rest");

spl_autoload_register(function($className){
    require_once($_SERVER['DOCUMENT_ROOT'] ."/rest/server/classes/{$className}.php");
});