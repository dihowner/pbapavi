<?php
require_once MODEL_DIR . 'Utility.php';
require_once MODEL_DIR . 'Students.php';
require_once MODEL_DIR . 'Courses.php';
require_once MODEL_DIR . 'Events.php';
require_once MODEL_DIR . 'Roles.php';

class Admins extends Utility
{
    public $table;
    protected $roles, $responseBody;

    function __construct($db)
    {
        $this->db = $db;
        $this->table = new stdClass();
        $this->table->admins = 'admins';
        
        $this->roles = new Roles($this->db);
    }

    public function create_admin(array $data) : bool {
        $adminData = array(
            'name' => trim($data['fullName']),
            'username' => trim($data['username']),
            'email_address' => trim($data['email']),
            'password' => $this->hashPassword(trim($data['password'])),
            'role_id' => trim($data['role'])
        );
        return $this->db->insert($this->table->admins, $adminData);
    }

    public function get_admin($adminDetail) {
        $result = $this->db->getSingleRecord($this->table->admins, "*", " AND (username = '$adminDetail' OR email_address = '$adminDetail' OR id = '$adminDetail')");
        if ($result !== false) {
            $adminRoleId = $result['role_id'];
            $roleData = $this->roles->get_role($adminRoleId);
            $result['role'] = $roleData;  
            $result['role']['role_permission'] = $this->roles->get_roles_permission($roleData['permission_id']); 
        }
        return $this->arrayToObject($result);
    }
    
    public function get_admins() : array|bool {
        $result = $this->db->getAllRecords($this->table->admins, "*", " ORDER BY id desc");
        if ($result !== false) {
            $result = array_map(function($admin) {
                $adminRoleId = $admin['role_id'];
                $roleData = $this->roles->get_role($adminRoleId);
                $admin['role'] = $roleData;
                $admin['role']['role_permission'] = $this->roles->get_roles_permission($roleData['permission_id']);
                return $admin;
            }, $result);        
        }
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

    public function update_admin(array $adminData, int $adminId) : bool {
        try {
            $this->db->update($this->table->admins, $adminData, array('id' => $adminId));
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }

}

?>