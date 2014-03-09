<?php
namespace Modules\Cron\Services;

class Users extends \System\Baseservice {
    function getUsernames() {
        return $this->db->toArray($this->db->query("SELECT username FROM `gmotalert_users` LIMIT 0, 100"));
    }
}