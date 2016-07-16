<?php
namespace Core;
class mvc
{
    public static function C($name,$method)//控制器
    {
        if(file_exists(APATH.'/Controller/'.$name.'Controller.class.php'))
        {
            require_once(APATH.'/Controller/'.$name.'Controller.class.php');
            $class_name = $name.'Controller';
            if(!class_exists($class_name))
            {
                echo $name.'Controller.class.php不存在类'.$class_name;
                exit();
            }
            $obj = new $class_name;
            if(property_exists($obj,'Base_V_D'))
            {
                 $obj->Base_V_D = $name;
            }
            if(property_exists($obj,'Base_V_F'))
            {
                 $obj->Base_V_F = $method;
            }
            if(property_exists($obj,'post'))
            {
                $obj->post = array_map(array("Core\mvc","Filter"),$_POST);
            }
            if(property_exists($obj,'get'))
            {
                $obj->get =  array_map(array("Core\mvc","Filter"),$_GET);
            }
            if(property_exists($obj,'req'))
            {
                $obj->req = array_map(array("Core\mvc","Filter"),$_REQUEST);
            }            
            if(method_exists($obj,'__initialize'))
            {
                $obj->__initialize();
            }
            if(!method_exists($obj,$method))
            {
                echo '类'.$name.'Controller不存在方法'.$method;
                exit();
            }
            else
            {
                $obj->$method();
            }
        }
        else
        {
            echo '控制器目录下不存在文件'.$name.'Controller.class.php';
            exit();
        }
    }
    	
    public static function M($name)//加载模型
    {
        if(file_exists(APATH.'/Model/'.$name.'Model.class.php'))
        {
            require_once(APATH.'/Model/'.$name.'Model.class.php');
            $class_name = $name.'Model';
            if(!class_exists($class_name))
            {
                echo 'Model不存在类'.$class_name;
                exit();
            }
            $obj= new $class_name;
            return $obj;
        }
        else
        {
            echo '不存在model文件/Model/'.$name.'Model.class.php';
            exit;
        }
    }

    public static function V($D,$F,&$V=array())//加载视图
    {
        if(file_exists(APATH.'/View/'.$D.'/'.$F.'View.php'))
        {
            require_once(APATH.'/View/'.$D.'/'.$F.'View.php');
        }
        else
        {
            echo '不存在视图文件/View/'.$D.'/'.$F.'View.php';
            exit;
        }
        //eval('$obj = new '.$name.'View();');
        //return $obj;
    }
    
    public static function Filter($v)
    {
        if(is_array($v)) 
        {
            return array_map(array("Core\mvc","Filter"),$v);
        }
        else
        {
            return htmlspecialchars(addslashes($v));
        }
    }
}
?>
