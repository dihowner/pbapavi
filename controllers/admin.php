<?php
require_once '../includes/config.php';
require_once INCLUDES_DIR . 'Validator.php';

$admin_instance = new Admins($db);

if (isset($_POST['create_admin'])) {
	$myFilters = [
		'fullName' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'username' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'email' => [
			'sanitizations' => 'email',
			'validations' => 'required|email',
		],
		'role' => [
			'sanitizations' => 'numeric',
			'validations' => 'required',
		],
		'password' => [
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
		$email = $sanitizedInputData['email'];
		$username = $sanitizedInputData['username'];

        $getAdmin = $admin_instance->get_admin($email);

        if (isset($getAdmin->name)) {
            $_SESSION['formErrorMessage'] = "Email address already exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }

        $getAdmin = $admin_instance->get_admin($username);

        if (isset($getAdmin->name)) {
            $_SESSION['formErrorMessage'] = "Username address already exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }

        $create_admin = $admin_instance->create_admin($sanitizedInputData);

        if (!$create_admin) {
            $_SESSION['formErrorMessage'] = "Admin creation failed. Please try again.";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $_SESSION['formSuccessMessage'] = "Admin created successfully";
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

if (isset($_GET['delete_admin'])) {
	$adminId = (int) $_GET['delete_admin'];
	$loggedAdminId = (int) $_SESSION['admin'];
	$loggedAdmin = $admin_instance->get_admin($loggedAdminId);
	$admin = $admin_instance->get_admin($adminId);
	if ($adminId == $loggedAdminId) {
        $_SESSION['formErrorMessage'] = "You cannot delete yourself!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
	}

	if ($loggedAdmin->role_id != 1 AND $admin->role_id == 1) {
		$_SESSION['formErrorMessage'] = "You cannot delete an admin above your rank!";
		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit();
	}

	$delete_admin = $admin_instance->delete_admin($adminId);
	if (!$delete_admin) {
		$_SESSION['formErrorMessage'] = "Admin deletion failed. Please try again.";
		$_SESSION['formInput'] = $_POST;
		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit();
	}
	$_SESSION['formSuccessMessage'] = "Admin deleted successfully";
	header("Location: " . $_SERVER['HTTP_REFERER']);
	die;
}

if (isset($_POST['edit_admin'])) {
	$myFilters = [
		'fullName' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'username' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'email' => [
			'sanitizations' => 'email',
			'validations' => 'required|email',
		],
		'role' => [
			'sanitizations' => 'numeric',
			'validations' => 'required',
		],
		'admin_id' => [
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
		$email = $sanitizedInputData['email'];
		$username = $sanitizedInputData['username'];
		$adminId = (int) $sanitizedInputData['admin_id'];
		
		$loggedAdminId = (int) $_SESSION['admin'];
		$loggedAdmin = $admin_instance->get_admin($loggedAdminId);

        $getAdmin = $admin_instance->get_admin($email);

        if (isset($getAdmin->name) AND $getAdmin->id != $adminId) {
            $_SESSION['formErrorMessage'] = "Email address already exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }

        $getAdmin = $admin_instance->get_admin($username);

        if (isset($getAdmin->name) AND $getAdmin->id != $adminId) {
            $_SESSION['formErrorMessage'] = "Username address already exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }
		
		$getAdmin = $admin_instance->get_admin($adminId);

		if ($loggedAdmin->role_id != 1 AND $getAdmin->role_id == 1 AND $adminId != $getAdmin->role_id) {
            $_SESSION['formErrorMessage'] = "You cannot downgrade an admin of higher rank than yours";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();  
		}
		
		$adminData = [
			'name' => $sanitizedInputData['fullName'],
			'username' => $sanitizedInputData['username'],
			'email_address' => $sanitizedInputData['email'],
			'role_id' => $sanitizedInputData['role'],
		];

        $update_admin = $admin_instance->update_admin($adminData, $adminId);

        if (!$update_admin) {
            $_SESSION['formErrorMessage'] = "Admin update failed. Please try again.";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $_SESSION['formSuccessMessage'] = "Admin updated successfully";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
	}
}

if (isset($_GET['reset_password'])) {
	$adminId = (int) $_GET['reset_password'];
	$getAdmin = $admin_instance->get_admin($adminId);
	if (!isset($getAdmin->name)) {
		$_SESSION['formErrorMessage'] = "Admin record not found. Please try again";
		$_SESSION['formInput'] = $_POST; 
		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit();   
	}
	$adminName = $getAdmin->name;

	$systemPassword = $utility->randID('numeric', 8);
	$adminData = [
		'password' => $admin_instance->hashPassword(trim($systemPassword))
	];
	
	$update_admin = $admin_instance->update_admin($adminData, $adminId);

	if (!$update_admin) {
		$_SESSION['formErrorMessage'] = "Password reset failed for $adminName. Please try again.";
		$_SESSION['formInput'] = $_POST;
		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit();
	}
	$_SESSION['formSuccessMessage'] = "Password changed successfully for $adminName. New Password is ". $systemPassword;
	header("Location: " . $_SERVER['HTTP_REFERER']);
	die;
}
?>