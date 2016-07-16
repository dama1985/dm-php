<?php
namespace Libs;
use PDO;
class mysql{
    protected $pdo;
    protected $res = '';
    protected $Config;

    /*构造函数*/
    function __construct($config){
        $this->Config = $config;
        $this->connect();
    }

    /*数据库连接*/
    public function connect()
    {
        $this->pdo = new PDO($this->Config['dsn'], $this->Config['name'], $this->Config['password']);
        $this->pdo->query('set names utf8;');
        //把结果序列化成stdClass
        //$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        //自己写代码捕获Exception
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /*数据库关闭*/
    public function close(){
        $this->pdo = null;
    }
    //查询SQL
    public function query($sql){
        $this->res = $this->pdo->query($sql);
        return  $this->res;
    }
    //插入，更新，查询，返回数字
    public function exec($sql){
        return $this->pdo->exec($sql);
    }
    public function fetchColumn(){
        return $this->res->fetchColumn();
    }
    public function lastInsertId(){
       return  $this->pdo->lastInsertId();
    }
    public function getAll($sql)
    {
         $rs = $this->query($sql);
         if($rs)return $rs->fetchAll();
         else return false;
    }
    public function getOne($sql)
    {
         $rs = $this->query($sql);
         if($rs)return $rs->fetch();
         else return false;
    }
    public function getPdo()
    {
        return $this->pdo;
    }
    public function getAllRowNum()//通过getAll方法的获取查询记录行数
    {
        if($this->res!='')return $this->res->rowCount();
        else 
        {
            echo '还没执行查询sql';
            die();
        }
    }
    public function getRowNum($sql)//获取sql查询记录行数
    {
        $rs = $this->query($sql);
        return $rs->rowCount();
    }
    
    
}


?>

