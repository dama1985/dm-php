<?php
class core
{
    public static function init()
    {
        self::load_core();//加载文件
        //self::load_files(CONFIG);
        if(isset($_REQUEST['c']))
        {
            $c = $_REQUEST['c']!=''? $_REQUEST['c']:'index';
        }
        else
        {
            $c = 'index';
        }
        if(isset($_REQUEST['m']))
        {
            $m = $_REQUEST['m']!=''? $_REQUEST['m']:'index';
        }
        else
        {
            $m = 'index';
        }
        Core\mvc::C($c,$m);
    }
    public static function load_core()
    {
        $dir = APATH.CORE;
        $handle = opendir( $dir );
        if ($handle)
        {
            while (false !== ($file = readdir($handle)))
            {
                if ($file[0] !== '.' && $file[0] !== '..' )
                {
                    $require_file = $dir.'/'.$file;
                    require_once $require_file;
                }
            }
            closedir($handle);
        }
    }
    public static function load_base_controller()//Base文件夹里的类可以按顺序继承
    {
        $files_arr = require_once CONFIG.'/controller.config.php';
        $dir = APATH.CONTROLLER.'/basic/';
        foreach($files_arr as $file)
        {
            $file_name = $file.'Controller.php';
            if(file_exists($dir.$file))
                require_once $dir.$file;
            else
               echo $dir.$file.'文件不存在';
        }
    }
}