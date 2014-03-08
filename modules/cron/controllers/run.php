<?php
namespace Modules\Cron\Controllers;

class Run extends \System\Basecontroller {
    function check() {
        $rssdata = $this->loader['\Modules\Cron\Services\Site']->getJson();
        $users = $this->loader['\Modules\Cron\Services\Users']->getUsernames();
        $detections = $this->loader['\Modules\Cron\Services\Detector']->forListDetect($users, $rssdata['responseData']['feed']['entries']);
    }
}