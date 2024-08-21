<?php
require_once '../includes/config.php';
require_once INCLUDES_DIR . 'Validator.php';

$course_instance = new Courses($db);

if (isset($_POST['create_course'])) {
	$myFilters = [
		'course_name' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'course_fee' => [
			'sanitizations' => 'float',
			'validations' => 'required',
		],
		'course_description' => [
			'sanitizations' => 'string',
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
        
        $getCourse = $course_instance->get_course($sanitizedInputData['course_name']);

        if ($getCourse) {
            $_SESSION['formErrorMessage'] = "Course already exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }

        $create_course = $course_instance->create_course($sanitizedInputData);
       
        if (!$create_course) {
            $_SESSION['formErrorMessage'] = "Course creation failed. Please try again.";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $_SESSION['formSuccessMessage'] = "Course created successfully";
        unset($_SESSION['formInput']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
    }
}

if (isset($_POST['edit_course'])) {
	$myFilters = [
		'course_name' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'course_fee' => [
			'sanitizations' => 'float',
			'validations' => 'required',
		],
		'course_id' => [
			'sanitizations' => 'numeric',
			'validations' => 'required',
		],
		'course_description' => [
			'sanitizations' => 'string',
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
        $courseId = $sanitizedInputData['course_id'];

        $getCourse = $course_instance->get_course($courseId);

        if (!$getCourse) {
            $_SESSION['formErrorMessage'] = "Course does not exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }

        $getCourse = $course_instance->get_course($sanitizedInputData['course_name']);

        if ($getCourse && $getCourse['course_id'] != $courseId) {
            $_SESSION['formErrorMessage'] = "Course ({$sanitizedInputData['course_name']}) already exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }

        $update_course = $course_instance->update_course($sanitizedInputData, $courseId);

        if (!$update_course) {
            $_SESSION['formErrorMessage'] = "Course update failed. Please try again.";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $_SESSION['formSuccessMessage'] = "Course updated successfully";
        unset($_SESSION['formInput']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
    }
}

if (isset($_GET['delete_course'])) {
    $courseId = (int) $_GET['delete_course'];
    $delete_course = $course_instance->delete_course($courseId);
    if (!$delete_course) {
        $_SESSION['formErrorMessage'] = "Course deletion failed. Please try again.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    $_SESSION['formSuccessMessage'] = "Course deleted successfully";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    die;
}
?>