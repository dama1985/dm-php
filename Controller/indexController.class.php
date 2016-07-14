<?php
use Core\mvc;
use Core\base;
class indexController extends base
{
    function index()
    {
        $t = mvc::M('test');
        $DATA=$t->GetTest();
        $pagehtml = $this->__GetPages();
        $arr = array('test'=>$DATA,'pagehtml'=>$pagehtml);
        $this->__View($arr);
    }
}
?>
