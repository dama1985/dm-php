<?php
class core
{
    public static function init()
    {
        self::load_core();//加载文件
        self::load_basic_controller();
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
                    include_once $require_file;
                }
            }
            closedir($handle);
        }
    }
    
    public static function load_basic_controller()//Base文件夹里的类可以按顺序继承
    {
        $files_arr = include_once CONFIG.'/controller.config.php';
        $dir = APATH.CONTROLLER.'/basic/';
        foreach($files_arr['basic'] as $file)
        {
            $file_name = $file.'Controller.class.php';
            if(file_exists($dir.$file_name))
                include_once $dir.$file_name;
            else
            {
               echo $dir.$file.'Controller.php文件不存在';
               die();
            }
        }
    }
}