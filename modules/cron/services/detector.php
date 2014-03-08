<?php
namespace Modules\Cron\Services;

class Detector extends \System\Baseservice {
    function forListDetect($users, $messages) {
        $return = array();
        foreach ($users as $k=>$v) {
            $thesereturns = array();
            foreach ($messages as $k2=>$v2) {
                if (stripos($v2['content']) !== false) {
                    $thesereturns[] = $v2;
                }
            }
            $return[] = $thesereturns;
        }
        return $return;
    }
}