<?php
require_once '../includes/config.php';
require_once INCLUDES_DIR . 'Validator.php';

$student_instance = new Students($db);
$course_instance = new Courses($db);

if (isset($_POST['student_register'])) {
	$myFilters = [
		'firstName' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'lastName' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'email' => [
			'sanitizations' => 'email',
			'validations' => 'required|email',
		],
		'phoneNumber' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'course' => [
			'sanitizations' => 'numeric',
			'validations' => 'required',
		]
	];

	$validator = new Validator($myFilters);
	$validationResults = $validator->run($_POST);

	if ($validationResults === FALSE) {
		$validationErrors = $validator->getValidationErrors();
		foreach ($validationErrors as $error) {
			$_SESSION['formErrorMessage'][] = $error;
		}
		$_SESSION['formInput'] = $_POST;
		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit();
	} else {
		$sanitizedInputData = $validationResults;

		if ($course_instance->get_course($sanitizedInputData['course']) === false) {
			$_SESSION['formErrorMessage'] = "Course does not exist!";
			$_SESSION['formInput'] = $_POST;
			header("Location: " . $_SERVER['HTTP_REFERER']);
			exit();
		}

		$create_student = $student_instance->create_student($sanitizedInputData);

		if (!$create_student) {
			$_SESSION['formErrorMessage'] = "Student registration failed. Please try again.";
			$_SESSION['formInput'] = $_POST;
			header("Location: " . $_SERVER['HTTP_REFERER']);
			exit();
		}
		header("Location: " . BASE_URL . 'registration-success.php?id=' . base64_encode($_SESSION['course_reg_id']));
		die;
	}
}

if (isset($_POST['email_exists_student'])) {
	$myFilters = [
		'email' => [
			'sanitizations' => 'email',
			'validations' => 'required|email',
		]
	];

	$validator = new Validator($myFilters);
	$validationResults = $validator->run($_POST);

	if ($validationResults === FALSE) {
		$validationErrors = $validator->getValidationErrors();
		echo json_encode(["message" => "Email is not valid", "status" => false]);
		die;
	} else {
		$sanitizedInputData = $validationResults;
		$getStudent = $student_instance->get_student($sanitizedInputData['email']);
		if ($getStudent === false) {
			echo json_encode(["message" => "No student is associated with this email address", "status" => false]);
			die;
		}
		echo json_encode(["message" => "Email already belongs to another student (" . $getStudent['full_name'] . ")", "status" => true]);
		die;
	}
}

if (isset($_POST['admin_create_student'])) {
	$myFilters = [
		'firstName' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'lastName' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'email' => [
			'sanitizations' => 'email',
			'validations' => 'required|email',
		],
		'phoneNumber' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'course' => [
			'sanitizations' => 'numeric',
			'validations' => 'required',
		]
	];

	$validator = new Validator($myFilters);
	$validationResults = $validator->run($_POST);

	if ($validationResults === FALSE) {
		$validationErrors = $validator->getValidationErrors();
		foreach ($validationErrors as $error) {
			$_SESSION['formErrorMessage'][] = $error;
		}
		$_SESSION['formInput'] = $_POST;
		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit();
	} else {
		$result = false;
		$sanitizedInputData = $validationResults;
		$getStudent = $student_instance->get_student($sanitizedInputData['email']);
		if (!$getStudent) {
			$result = $create_student = $student_instance->create_student($sanitizedInputData);
		} else {
			$courseId = (int) $sanitizedInputData['course'];
			$getCourse = $course_instance->get_course($courseId);
			$courseData = [
				'student_id' => $getStudent['student_id'],
				'course_id' => $courseId,
				'hasPaid' => $sanitizedInputData['hasPaid'],
				'course_data' => ['name' => $getCourse['course_name'], 'amount' => $getCourse['course_fee']]
			];
			$result = $course_instance->create_course_registration($courseData);
		}

		if (!$result) {
			$_SESSION['formInput'] = $_POST;
			$_SESSION['formErrorMessage'] = "Student registration failed. Please try again.";
			$_SESSION['formInput'] = $_POST;
			header("Location: " . $_SERVER['HTTP_REFERER']);
			exit();
		}
		$_SESSION['formSuccessMessage'] = "Student registered successfully.";
		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit();
	}
}

if (isset($_GET['verify-certificate'])) {
	$studentId = $_GET['studentid'];

	$studentCourseData = $course_instance->get_course_registration($studentId);
	if ($studentCourseData === false) { ?>
		<script>
			alert("Student not found. Please provide a valid registration number");
			window.location.href = "<?php echo BASE_URL; ?>";
		</script>
	<?php 
		die;
	}

	if ($studentCourseData->is_completed != '1') { ?>
		<script>
			alert("Student is yet to complete his/her training. Please check back later to verify student progress.");
			window.location.href = "<?php echo BASE_URL; ?>";
		</script>
	<?php 
		die;
	}

	$courseRegId = $studentCourseData->id;
	$course_instance->generateStudentCertificate($courseRegId);
}
