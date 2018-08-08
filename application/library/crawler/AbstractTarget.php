<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 16:22
 */

namespace crawler;


abstract class AbstractTarget
{
    abstract public function crawl();
}