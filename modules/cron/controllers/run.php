<?php
namespace Modules\Cron\Controllers;

class Run extends \System\Basecontroller {
    function check() {
        // Check for mentions and add those to the database
        $lastlink = $this->loader['\Modules\Cron\Models\Lastcheck']->getLastMessageData();
        if (isset($lastlink['lastlink'])) {
            $lastlink = $lastlink['lastlink'];
        }
        else {
            $lastlink = '';
        }
        $rssdata = $this->loader['\Modules\Cron\Services\Site']->getJson();
        $users = $this->loader['\Modules\Cron\Services\Users']->getUsernames();
        $detections = $this->loader['\Modules\Cron\Services\Detector']->forListDetect($users, 
                    $this->loader['\Modules\Cron\Services\Site']->filterMessages($rssdata['responseData']['feed']['entries'], $lastlink));
        var_dump($detections);
        $this->loader['\Modules\Cron\Models\Lastcheck']->setLastMessageData($rssdata['responseData']['feed']['entries'][0]['link']);
        
        // Fire event systemwide, so listeners for specific devices can send out the actual notifications
        $this->loader['\System\Events']->fireEvent('userMentioned', $detections);
    }
}