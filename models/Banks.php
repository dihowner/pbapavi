<?php
require_once MODEL_DIR . 'Utility.php';
require_once MODEL_DIR . 'Students.php';

class Banks extends Utility
{
    public $table;
    protected $responseBody, $students;

    function __construct($db)
    {
        $this->db = $db;
        $this->table = new stdClass();
        $this->table->banks = 'banks';
    }
    
    public function get_banks() : array {
        $result = $this->db->getAllRecords($this->table->banks, "*", " ORDER BY bank_id DESC");
        return $result;
    }
}
?>