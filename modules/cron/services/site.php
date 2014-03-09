<?php
namespace Modules\Cron\Services;

class Site extends \System\Baseservice {
    private $gmoturl = 'http://www.gmot.nl/index.php?type=rss;action=.xml';
    private $googlerssapiurl = 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=50&q={url}';
    
    function getRawXml() {
        return file_get_contents($gmoturl);
    }
    
    function getRawJson() {
        return file_get_contents(str_replace('{url}', $this->gmoturl, $this->googlerssapiurl));
    }
    
    function getJson() {
        return json_decode($this->getRawJson(), true);
    }
    
    function filterMessages($messages, $lastlink) {
        $return = array();
        foreach ($messages as $k=>$v) {
            if ($v['link'] != $lastlink) {
                $return[] = $v;
            }
            else {
                break;
            }
        }
        return $return;
    }
}