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

    public function update_course(array $courseData, int $courseId) : bool {
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
        $result = $this->db->getSingleRecord($this->table->course_registration, "*", " AND (id = '$id' OR student_reg_number = '$id')");
        if ($result !== false) {
            $students = new Students($this->db);
            $result['student'] = $students->get_student($result['student_id']);
            $result['course'] = $this->get_course($result['course_id']);
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

    public function get_pending_course_registration() {
        $result = $this->db->getAllRecords($this->table->course_registration, "*", " AND has_paid = '0' AND is_completed = '0'");
        
        if ($result !== false) {
            $students = new Students($this->db);
            $result = array_map(function($course) use ($students) {
                $course['student'] = $students->get_student($course['student_id']);
                $course['course'] = $this->get_course($course['course_id']);
                return $course;
            }, $result);        
        }
        return $result;
    }

    public function get_active_course_registration() {
        $result = $this->db->getAllRecords($this->table->course_registration, "*", " AND has_paid = '1' AND is_completed = '0'");
        
        if ($result !== false) {
            $students = new Students($this->db);
            $result = array_map(function($course) use ($students) {
                $course['student'] = $students->get_student($course['student_id']);
                $course['course'] = $this->get_course($course['course_id']);
                return $course;
            }, $result);        
        }
        return $result;
    }

    public function activate_student_course(int $courseRegId) : bool {
        $courseData = array(
            'has_paid' => '1',
            'student_reg_number' => $this->generateStudentRegNumber()
        );
        
        try {
            $this->db->update($this->table->course_registration, $courseData, array('id' => $courseRegId));
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }

    public function certify_student_course(int $courseRegId) : bool {
        $courseData = array(
            'is_completed' => '1'
        );
        
        try {
            $this->db->update($this->table->course_registration, $courseData, array('id' => $courseRegId));
            $this->responseBody =  true;
        } catch (\Throwable $e) {
            $this->responseBody =  false;
        }        
        return $this->responseBody;
    }

    // public function getRegCourse_Student($studentRegNumber) {
        
    //     $result = $this->db->getSingleRecord($this->table->course_registration, "*", " AND id = '$id'");
    // }

    public function generateStudentCertificate($courseRegId) {
        $certifyStudent = $this->certify_student_course($courseRegId);

        if (!$certifyStudent) {
            return $certifyStudent;
        }

        //designed certificate picture
		$certificatePath = TEMPLATE_PATH . 'certificate.jpg';

		$createimage = imagecreatefromjpeg($certificatePath);
        
		$getCourseReg = $this->get_course_registration($courseRegId);

		$studentFullName = $getCourseReg->student['full_name'];
		$courseName = $getCourseReg->course['course_name'];
		$output = $studentFullName. " ".$courseName." Certificate.jpeg";

		$texts = [
			$studentFullName,
			$getCourseReg->course['course_name'],
			$getCourseReg->student_reg_number,
		];

		// Font sizes
		$fontSizes = [
			48,
			48,
			24,
			// 24,
		];

		// Font colors (RGB)
		$fontColors = [
			imagecolorallocate($createimage, 0, 0, 0),
			imagecolorallocate($createimage, 0, 0, 0),
			imagecolorallocate($createimage, 0, 0, 0),
			// imagecolorallocate($createimage, 0, 0, 0),
		];

		// Font positions (x, y)
		$fontPositions = [
			[650, 780],
			[600, 1000],
			[200, 1140],
			// [100, 400],
		];

		// $fontFile = FONT_DIR . "TheBillion.ttf";

		$fontFiles = [
			"OkNoted.ttf",
			"Bosse.ttf",
			"MorningStarboy.otf",
			// "TheBillionMonoline.ttf",
		];

		// Loop through text, fonts, and positions
		for ($i = 0; $i < count($texts); $i++) {
			$text = $texts[$i];
			$fontSize = $fontSizes[$i];
			$fontColor = $fontColors[$i];
			$fontPosition = $fontPositions[$i];

			$fontPath = FONT_DIR . $fontFiles[$i];

			// Write the text to the image
			imagettftext($createimage, $fontSize, 0, $fontPosition[0], $fontPosition[1], $fontColor, $fontPath, $text);
		}
		// die;
		ob_clean();  // Clear the output buffer

		// Set headers for the file download
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="' . $output . '"');
		header('Content-Type: image/jpeg');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($certificatePath));

		// Output the image
		imagejpeg($createimage);

		// Free up memory
		imagedestroy($createimage);

		// Save the certificate image to a specified directory
        // $certificateDirectory = 'path/to/your/certificate/directory';
        // $certificateFilename = 'certificate_' . $courseRegId . '.jpg';
        // $certificatePath = $certificateDirectory . $certificateFilename;

        // // Create the directory if it doesn't exist
        // if (!is_dir($certificateDirectory)) {
        //     mkdir($certificateDirectory, 0777, true);
        // }

        // Save the image to the directory
        // imagejpeg($createimage, $certificatePath);

    }

}
?>