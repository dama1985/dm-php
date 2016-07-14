<?php
class core
{
    public static function init()
    {
        self::load_files(CORE);//加载文件
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
    public static function load_files($dir)
    {
        $dir = APATH.$dir;
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
}