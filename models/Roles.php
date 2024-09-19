<?php
require_once MODEL_DIR . 'Utility.php';

class Roles extends Utility
{
    public $table;
    protected $courses, $responseBody;

    function __construct($db)
    {
        $this->db = $db;
        $this->table = new stdClass();
        $this->table->role_permissions = 'role_permissions';
        $this->table->roles = 'roles';
    }
    
    public function get_roles_permissions() {
        $result = $this->db->getAllRecords($this->table->role_permissions, "*", " ORDER BY permission_title asc");
        return $result;
    }
    
    public function get_roles_permission($roleId) {
        $result = $this->db->getAllRecords($this->table->role_permissions, "*", " AND id IN ($roleId) ");
        return $result;
    }

    public function create_role($roleName, $permission_id) : bool {
        $roleData = array(
            'permission_id' => trim($permission_id),
            'role_name' => trim($roleName)
        );

        try {
            $this->db->insert($this->table->roles, $roleData);
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }
    
    public function update_role(array $roleData, int $roleId) : bool|array {
        $roleData = array(
            'permission_id' => trim(implode(',', $roleData['role_permissions'])),
            'role_name' => trim($roleData['role_name'])
        );
        
        try {
            $this->db->update($this->table->roles, $roleData, array('id' => $roleId));
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }
    
    public function get_roles() : array {
        $result = $this->db->getAllRecords($this->table->roles, "*", " ORDER BY id desc");
        return $result;
    }

    public function delete_role(int $roleId) : bool {
        return $this->db->delete($this->table->roles, ['id' => $roleId]);
    }
    
    public function get_role($role_detail) : array|bool {
        $result = $this->db->getSingleRecord($this->table->roles, "*", " AND (id = '$role_detail' OR role_name = '$role_detail')");
        return $result;
    }

}
?>