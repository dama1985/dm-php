<?php
namespace Core;
class db
{
    public $totalPages;//总共几页
    public $PerPageRecordsNum = 2;//每页记录数
    public static $mysqlobj;
    public static function mysql($tag=0)
    {
        static $Tag;
        //static $obj;
        if(!isset($Tag)||$Tag!=$tag)
        {
            require_once LIBS.'/mysql.class.php';
            $config = require_once CONFIG.'/mysql.config.php';
            $Tag = $tag;
            self::$mysqlobj = new \Libs\mysql($config[$Tag]);
            //return $obj;
        }
        else
        {
            //return $obj;
        }
    }
    public static function redis($tag=0)
    {
        
    }
    public static function memcache($tag=0)
    {
        
    }
    public function SeTotalPages($sql)
    {
        global $TotalPages;
        $TotalPages = ceil(self::$mysqlobj->getRowNum($sql)/$this->PerPageRecordsNum);//获取记录总页数
    }
    public  function MysqlpageSql($sql,$num=50)//
    {
        $page = isset($_GET['page'])?addslashes($_GET['page']):1;
        $b = ($page -1)*50;
        $sql = $sql.' limit '.$b.','.$num;
        return $sql;
    }
}
