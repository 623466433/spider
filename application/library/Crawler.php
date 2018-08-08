<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 16:20
 */
use crawler\target\TargetCrawler;

class Crawler
{
    protected $crawler;
    protected $config = ['url' => '', 'rules' => []];

    public function init($config)
    {
        $this->config = $config;
        return $this;
    }
    public function run()
    {
        $crawler = $this->crawler ?: $this->crawler = new TargetCrawler();

        $crawler->init($this->config['url'], $this->config['rules']);
        $data = $crawler->crawl();

        return $data->all();
    }
}