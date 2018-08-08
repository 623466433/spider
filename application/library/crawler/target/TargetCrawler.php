<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 16:27
 */

namespace crawler\target;

use crawler\AbstractTarget;
use QL\QueryList;

class TargetCrawler extends AbstractTarget
{
    protected $crawl_rules = [];
    protected $target_url = '';
    protected $other_string = 'crawl by spider';
    public function init($target_url, $crawl_rules)
    {
        $this->target_url = $target_url;
        $this->crawl_rules = $crawl_rules;
    }
    public function crawl()
    {
        // TODO: Implement crawl() method.
        $ql = QueryList::get($this->target_url)->rules($this->crawl_rules);
        $data = $ql->query(function($item){
            $item['_copyright'] = $this->other_string;
            return $item;
        })->getData();
        return $data;
    }
}
