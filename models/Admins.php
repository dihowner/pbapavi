<?php
require_once MODEL_DIR . 'Utility.php';
require_once MODEL_DIR . 'Students.php';
require_once MODEL_DIR . 'Courses.php';
require_once MODEL_DIR . 'Events.php';

class Admins extends Utility
{
    public $table;
    protected $responseBody;

    function __construct($db)
    {
        $this->db = $db;
        $this->table = new stdClass();
        $this->table->admins = 'admins';
    }

    public function get_admin($adminDetail) {
        $result = $this->db->getSingleRecord($this->table->admins, "*", " AND (username = '$adminDetail' OR email_address = '$adminDetail' OR id = '$adminDetail')");
        return $this->arrayToObject($result);
    }
    
    public function get_admins() : array|bool {
        $result = $this->db->getAllRecords($this->table->admins, "*", " ORDER BY id desc");
        return $result;
    }

    public function hashPassword($password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $this->responseBody = $hash;
        return $this->responseBody;
    }

    public function get_total_admin() : int {
        return count($this->get_admins());
    }

    public function get_dashboard_stats() {
        $student_instance = new Students($this->db);
        $course_instance = new Courses($this->db);
        $event_instance = new Events($this->db);
        $stats = [
            'total_students' => $student_instance->get_total_students("all"),
            'total_course' => $course_instance->get_total_course(),
            'total_admin' => $this->get_total_admin(),
            'total_active_student' => $student_instance->get_total_students("active"),
            'total_certified_student' => $student_instance->get_total_students("certified"),
            'total_event' => $event_instance->get_total_events(),
        ];
        // return $stats;
        return $this->arrayToObject($stats);
    }

}

?>