<?php
//入口文件
define('APATH', dirname(__FILE__));//文件绝对路径
define('CONFIG', '/Config');
define('CONTROLLER', '/Controller');
define('CORE', '/Core');
define('LIBS','/Libs');
define('CSS','/Front/css/');
require_once('Core.php');
Core::init();
?>