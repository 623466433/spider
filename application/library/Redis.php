<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 17:11
 */
namespace Spider;
use Predis\Client;
use Yaf\Registry;

class Redis
{
    protected static $instance;
    protected static $client;
    private function __construct()
    {
        $config = Registry::get('config')->redis->master;
        self::$client = new Client([
            'scheme' => "tcp",
            'host' => $config['host'],
            'port' => $config['port']
        ]);
    }
    /**
     * 获取实例
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
        return self::$client->$name(...$arguments);
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
        self::$instance = null;
    }
}