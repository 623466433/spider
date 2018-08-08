<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 14:57
 */

/**
 * 方法重载函数，用于编辑器代码提醒
 * @method Database query($statement, $mode = PDO::ATTR_DEFAULT_FETCH_MODE, $arg3 = null, array $ctorargs = array())
 * @method Database fetchAll($fetch_style = null, $fetch_argument = null, array $ctor_args = array())
 */
use Yaf\Registry;

class Db
{
    // 类实例
    private static $instance = null;
    // 连接实例
    private static $link = null;

    // 配置文件
    private static $config = [];

    /**
     * 构造函数
     */
    private function __construct()
    {
        self::$config = Registry::get('config')->database->master;

        self::$link = new PDO("mysql:host=" . self::$config['host'] . ";dbname=" . self::$config['dbname'], self::$config['username'], self::$config['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'']);
    }

    /**
     * 获取实例
     * @return Database
     */
    public static function getInstance()
    {
        return self::$instance ?: (self::$instance = new self());
    }

    /**
     * 魔术方法，方法重载
     * @param $name
     * @param $arguments
     * @return mixed
     */
    function __call($name, $arguments)
    {
        return self::$link->$name($arguments[0]);
    }

    /**
     * 禁止克隆
     */
    private function __clone()
    {
    }

    /**
     * 反序列化魔术方法
     */
    public function __wakeup()
    {
        self::$instance = $this;
    }

    /**
     * 析构函数
     * @description 销毁实例
     */
    public function __destruct()
    {
        list(self::$instance, self::$config) = [null, []];
    }
}