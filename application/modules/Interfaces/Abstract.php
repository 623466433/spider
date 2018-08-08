<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 14:09
 */

use Yaf\Controller_Abstract;
use Yaf\Dispatcher;

class AbstractController extends Controller_Abstract
{
    public function init()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            // 关闭模板渲染
            Dispatcher::getInstance()->disableView();
        }
    }

}