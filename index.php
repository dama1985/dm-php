<?php
//入口文件

define('APATH', dirname(__FILE__));
define('CONFIG', '/Config');
define('CORE', '/Core');
define('LIBS','/Libs');
define('CSS','/Front/css/');
require_once('Core.php');
Core::init();
?>
