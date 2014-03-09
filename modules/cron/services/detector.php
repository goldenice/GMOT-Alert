<?php
namespace Modules\Cron\Services;

class Detector extends \System\Baseservice {
    function forListDetect($users, $messages) {
        $return = array();
        foreach ($users as $k=>$v) {
            $thesereturns = array();
            foreach ($messages as $k2=>$v2) {
                if (stripos($v2['content'], $v['username']) !== false) {
                    $thesereturns[] = $v2;
                    $this->insertMention($v['username'], $v2['title'], $v2['link'], $v2['content'], $v2['contentSnippet']);
                }
            }
            $return[] = $thesereturns;
        }
        return $return;
    }
    
    function insertMention($username, $title, $link, $content, $contentsnippet) {
        $data = array('u'=>$username, 't'=>$title, 'l'=>$link, 'c'=>$content, 'cs'=>$contentsnippet, 't'=>time());
        $this->db->safeQuery("INSERT INTO `gmotalert_mentions` (uid, title, link, content, contentsnippet, timestamp) VALUES (:u, :t, :l, :c, :cs, :t)", $data);
    }
}