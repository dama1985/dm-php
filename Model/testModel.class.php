<?php
//SQL尽量写在model层
use Core\db as DB;
class testModel extends DB
{
    private $db;
    const Table = 'test';
    
    public function __construct()
    {
         DB::mysql();
    }
    public function GetTest()
    {
        //return "hello world";
        $sql = 'select * from '.self::Table;
        parent::SeTotalPages($sql);
        //$this->totalPages = ceil(parent::$mysqlobj->getRowNum($sql)/$this->PerPageRecordsNum);//获取记录总页数
        $rs = parent::$mysqlobj->getAll($this->MysqlpageSql($sql,$this->PerPageRecordsNum));
        return $rs;
    }
}
?>
