<?php
/*-----------------------------------------------------+
 *  *
 *  * @author dm
 *  +-----------------------------------------------------*/
namespace Core;
class base
{
    public $Base_V_D = '';//view文件夹里文件夹
    public $Base_V_F = '';//view文件夹里文件夹里面的静态文件
    public $post = '';//$_POST变量
    public $get = '';//$_GET变量
    public $req = '';//$_REQUEST变量
    protected function __View(&$V)
    {
        header("Content-type: text/html; charset=utf-8");
        \Core\mvc::V($this->Base_V_D,$this->Base_V_F,$V);
    }
    protected function __Model(&$M)
    {
        return  \Core\mvc::M($M);
    }
    /**
     * @return string
     */
    public function __GetPages()
    {
        require_once APATH.LIBS.'/page.class.php';
        global $TotalPages;
        if(isset($this->get['page']))$page = $this->get['page'];
        else $page = 1;
        return \Libs\page::getPageHtml($TotalPages,$page);
    }
}
?>
