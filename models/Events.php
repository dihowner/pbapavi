<?php
require_once MODEL_DIR . 'Utility.php';

class Events extends Utility
{
    public $table;
    protected $responseBody, $students;

    function __construct($db)
    {
        $this->db = $db;
        $this->table = new stdClass();
        $this->table->events = 'events';
    }

    public function create_event(array $eventData) : bool {

        try {
            $this->db->insert($this->table->events, $eventData);
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }

    public function update_event(array $eventData, int $eventId) : bool|array {
        try {
            $this->db->update($this->table->events, $eventData, array('event_id' => $eventId));
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }

    public function delete_event(int $eventId) : bool {
        return $this->db->delete($this->table->events, ['event_id' => $eventId]);
    }
    
    public function get_events() : array {
        $result = $this->db->getAllRecords($this->table->events, "*", "ORDER BY event_id desc");
        return $result;
    }
    
    public function get_event($event_id) : array|bool {
        $result = $this->db->getSingleRecord($this->table->events, "*", " AND event_id = '$event_id'");
        return $result;
    }

    public function get_total_events() {
        return count($this->get_events());
    }
}
?>