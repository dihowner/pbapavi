<?php
require_once MODEL_DIR . 'Utility.php';
require_once MODEL_DIR . 'Courses.php';

class Students extends Utility
{
    public $table;
    protected $courses, $responseBody;

    function __construct($db)
    {
        $this->db = $db;
        $this->table = new stdClass();
        $this->table->students = 'students';

        $this->courses = new Courses($this->db);
    }

    public function create_student(array $data) : bool {

        $studentData = array(
            'first_name' => trim($data['firstName']),
            'last_name' => trim($data['lastName']),
            'email_address' => trim($data['email']),
            'mobile_number' => trim($data['phoneNumber'])
        );

        $this->db->beginTransaction();
        $courseId = (int) $data['course'];

        try {
            $this->db->insert($this->table->students, $studentData);
            $studentId = $this->db->lastInsertId();

            $getCourse = $this->courses->get_course($courseId);

            $courseData = [
                'course_id' => $data['course'],
                'student_id' => $studentId,
                'course_data' => ['name' => $getCourse['course_name'], 'amount' => $getCourse['course_fee']]
            ];
            $this->courses->create_course_registration($courseData);
            $courseRegId = $this->db->lastInsertId();
            $_SESSION['course_reg_id'] = $courseRegId;
            $this->responseBody =  true;
            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollback();
            $this->responseBody =  true;
            echo $e->getMessage();
            die;
        }

        return $this->responseBody;
    }

    public function get_student($userDetail) {
        $result = $this->db->getSingleRecord($this->table->students, "*", " AND (email_address = '$userDetail' OR student_id = '$userDetail')");
        if ($result !== false) {
            $result['full_name'] = $result['first_name'] . " " . $result['last_name'];
        }
        return $result;
    }
    
    public function get_students($studentType = "all") : array|bool {
        switch ($studentType) {
            case "all":
                $result = $this->db->getAllRecords($this->table->students, "*", " ORDER BY student_id desc");
                if ($result !== false) {
                    $result = array_map(function($student) {
                        $student['course_enrol'] = $this->courses->count_student_course($student['student_id']);
                        $student['course_completed'] = $this->courses->count_student_course($student['student_id'], 1);
                        $student['full_name'] = $student['first_name'] . " " . $student['last_name'];
                        return $student;
                    }, $result);        
                }
            break;

            case "pending":
                $result = $this->db->getRecFrmQry(
                    "SELECT 
                            {$this->table->students}.student_id, {$this->table->students}.first_name, {$this->table->students}.last_name, 
                            {$this->table->students}.email_address, {$this->table->students}.mobile_number,
                            COUNT({$this->courses->table->course_registration}.course_id) AS total_courses_enrol,
                            SUM(CASE WHEN {$this->courses->table->course_registration}.is_completed = '0' THEN 1 ELSE 0 END) AS active_course
                        FROM 
                            {$this->table->students}
                        INNER JOIN 
                            {$this->courses->table->course_registration} ON {$this->table->students}.student_id = {$this->courses->table->course_registration}.student_id
                        INNER JOIN 
                            {$this->courses->table->courses} ON {$this->courses->table->course_registration}.course_id = {$this->courses->table->courses}.course_id
                         WHERE course_registration.has_paid='0' AND course_registration.is_completed='0'
                        GROUP BY {$this->table->students}.student_id"
                );

                if ($result !== false) {
                    $result = array_map(function($student) {
                        $student['full_name'] = $student['first_name'] . " " . $student['last_name'];
                        return $student;
                    }, $result);        
                }
            break;

            case "active":
                $result = $this->db->getRecFrmQry(
                    "SELECT 
                            {$this->table->students}.student_id, {$this->table->students}.first_name, {$this->table->students}.last_name, 
                            {$this->table->students}.email_address, {$this->table->students}.mobile_number,
                            COUNT({$this->courses->table->course_registration}.course_id) AS total_courses_enrol,
                            SUM(CASE WHEN {$this->courses->table->course_registration}.is_completed = '0' THEN 1 ELSE 0 END) AS active_course
                        FROM 
                            {$this->table->students}
                        INNER JOIN 
                            {$this->courses->table->course_registration} ON {$this->table->students}.student_id = {$this->courses->table->course_registration}.student_id
                        INNER JOIN 
                            {$this->courses->table->courses} ON {$this->courses->table->course_registration}.course_id = {$this->courses->table->courses}.course_id
                         WHERE course_registration.has_paid='1' AND course_registration.is_completed='0'
                        GROUP BY {$this->table->students}.student_id"
                );

                if ($result !== false) {
                    $result = array_map(function($student) {
                        $student['full_name'] = $student['first_name'] . " " . $student['last_name'];
                        return $student;
                    }, $result);        
                }
            break;

            case "certified":
                $result = $this->db->getRecFrmQry(
                    "SELECT 
                            {$this->table->students}.student_id, {$this->table->students}.first_name, {$this->table->students}.last_name, 
                            {$this->table->students}.email_address, {$this->table->students}.mobile_number,
                            COUNT({$this->courses->table->course_registration}.course_id) AS total_courses_enrol,
                            SUM(CASE WHEN {$this->courses->table->course_registration}.is_completed = '1' THEN 1 ELSE 0 END) AS completed_course
                        FROM 
                            {$this->table->students}
                        INNER JOIN 
                            {$this->courses->table->course_registration} ON {$this->table->students}.student_id = {$this->courses->table->course_registration}.student_id
                        INNER JOIN 
                            {$this->courses->table->courses} ON {$this->courses->table->course_registration}.course_id = {$this->courses->table->courses}.course_id
                        WHERE course_registration.has_paid='1' AND course_registration.is_completed='1'
                        GROUP BY 
                            {$this->table->students}.student_id"
                );

                if ($result !== false) {
                    $result = array_map(function($student) {
                        $student['full_name'] = $student['first_name'] . " " . $student['last_name'];
                        return $student;
                    }, $result);        
                }
            break;
        }
        return $result;
    }
    
    public function get_active_students() : array|bool {
        $result = $this->db->getAllRecords($this->table->students, "*", " ORDER BY student_id desc");
        if ($result !== false) {
            $result = array_map(function($student) {
                $student['course_enrol'] = $this->courses->count_student_course($student['student_id']);
                $student['pending_course'] = $this->courses->count_student_course($student['student_id'], 0);
                $student['full_name'] = $student['first_name'] . " " . $student['last_name'];
                return $student;
            }, $result);        
        }
        return $result;
    }

    public function get_total_students($studentType = "all") {
        return count($this->get_students($studentType));
    }
}
?>