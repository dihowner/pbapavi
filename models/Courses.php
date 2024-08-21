<?php
require_once MODEL_DIR . 'Utility.php';
require_once MODEL_DIR . 'Students.php';

class Courses extends Utility
{
    public $table;
    protected $responseBody, $students;

    function __construct($db)
    {
        $this->db = $db;
        $this->table = new stdClass();
        $this->table->courses = 'courses';
        $this->table->course_registration = 'course_registration';
    }

    public function create_course(array $courseData) : bool {
        $courseData = array(
            'course_name' => trim($courseData['course_name']),
            'course_fee' => (float) trim($courseData['course_fee']),
            'course_description' => trim($courseData['course_description'])
        );
        
        try {
            $this->db->insert($this->table->courses, $courseData);
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }

    public function update_course(array $courseData, int $courseId) : bool|array {
        $courseData = array(
            'course_name' => trim($courseData['course_name']),
            'course_fee' => (float) trim($courseData['course_fee']),
            'course_description' => trim($courseData['course_description'])
        );
        
        try {
            $this->db->update($this->table->courses, $courseData, array('course_id' => $courseId));
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }

    public function delete_course(int $courseId) : bool {
        return $this->db->delete($this->table->courses, ['course_id' => $courseId]);
    }

    public function create_course_registration(array $courseRegData) : bool {

        $data = [
            'has_paid' => isset($courseRegData['hasPaid']) ? $courseRegData['hasPaid'] : '0',
            'student_reg_number' => (isset($courseRegData['hasPaid']) AND (int) $courseRegData['hasPaid'] == 1) ? $this->generateStudentRegNumber() : NULL,
        ];

        $courseData = array(
            'course_id' => $courseRegData['course_id'],
            'student_id' => $courseRegData['student_id'],
            'course_data' => (isset($courseRegData['course_data']) AND is_array($courseRegData['course_data'])) ? json_encode($courseRegData['course_data']) : NULL
        );

        $courseData = array_merge($data, $courseData);
        
        try {
            $this->db->insert($this->table->course_registration, $courseData);
            
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }
    
    public function get_courses($columnOrdering = "id") : array {
        $orderCondition = $columnOrdering == "id" ? " ORDER BY course_id DESC" : "ORDER BY course_name ASC";
        $result = $this->db->getAllRecords($this->table->courses, "*", $orderCondition);
        return $result;
    }
    
    public function get_course($course_detail) : array|bool {
        $result = $this->db->getSingleRecord($this->table->courses, "*", " AND (course_id = '$course_detail' OR course_name = '$course_detail')");
        return $result;
    }
    
    public function get_course_registration($id) {
        $result = $this->db->getSingleRecord($this->table->course_registration, "*", " AND id = '$id'");
        if ($result !== false) {
            $result['student'] = (new Students($this->db))->get_student($result['student_id']);
            return $this->arrayToObject($result);
        }
        return $result;
    }

    public function get_total_course() : int {
        return count($this->get_courses());
    }

    public function count_student_course($studentId, $isCompleted = "all") {
        if ($isCompleted == "all") {
            return count($this->db->getAllRecords($this->table->course_registration, "*", " AND student_id = '$studentId'"));
        } else {
            return count($this->db->getAllRecords($this->table->course_registration, "*", " AND student_id = '$studentId' AND is_completed = '$isCompleted'"));
        }
    }
}

?>