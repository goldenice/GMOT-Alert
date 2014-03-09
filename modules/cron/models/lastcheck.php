<?php
namespace Modules\Cron\Models;

class Lastcheck extends \System\Basemodel {
    function getLastMessageData() {
        $return = array();
        $raw = $this->db->toArray($this->db->safeQuery("SELECT * FROM `gmotalert_lastcheck`"));
        foreach ($raw as $k=>$v) {
            $return[$v['key']] = $v['value'];
        }
        return $return;
    }
    
    function setLastMessageData($lastlink) {
        $this->db->safeQuery("INSERT INTO `gmotalert_lastcheck` (`key`, `value`) VALUES (:key, :value) ON DUPLICATE KEY UPDATE `value`=:updvalue", array('key'=>'lastlink', 'value'=>$lastlink, 'updvalue'=>$lastlink));
    }
}