<?php
class testController extends base
{
    function show()
    {
        $data = M('test')->get();
        $this->__View();
    }
}
?>
