<?php
require_once '../includes/config.php';
require_once INCLUDES_DIR . 'Validator.php';

$role_instance = new Roles($db);

if (isset($_POST['create_role'])) {
	$myFilters = [
		'role_permissions' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'role_name' => [
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
        $permission_id = implode(',', $sanitizedInputData['role_permissions']);
        $roleName = trim($sanitizedInputData['role_name']);

        $create_role = $role_instance->create_role($roleName, $permission_id);
        if (!$create_role) {
            $_SESSION['formErrorMessage'] = "Role creation failed. Please try again.";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $_SESSION['formSuccessMessage'] = "Role created successfully";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
        var_export($sanitizedInputData['role_name']);
        var_export($permission_id);
        var_export($sanitizedInputData);
        
    }
}

var_export($_POST);

if (isset($_POST['edit_role'])) {
    $myFilters = [
		'role_permissions' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'role_id' => [
			'sanitizations' => 'numeric',
			'validations' => 'required',
		],
		'role_name' => [
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
        $roleId = $sanitizedInputData['role_id'];

        $getRole = $role_instance->get_role($roleId);

        if (!$getRole) {
            $_SESSION['formErrorMessage'] = "Role does not exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }

        $getRole = $role_instance->get_role($sanitizedInputData['role_name']);

        if ($getRole && $getRole['id'] != $roleId) {
            $_SESSION['formErrorMessage'] = "Role ({$sanitizedInputData['role_name']}) already exists!";
            $_SESSION['formInput'] = $_POST; 
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();   
        }

        $update_role = $role_instance->update_role($sanitizedInputData, $roleId);

        if (!$update_role) {
            $_SESSION['formErrorMessage'] = "Role update failed. Please try again.";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $_SESSION['formSuccessMessage'] = "Role updated successfully";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
    }
}

if (isset($_GET['delete_role'])) {
    $courseId = (int) $_GET['delete_role'];
    $delete_role = $role_instance->delete_role($courseId);
    if (!$delete_role) {
        $_SESSION['formErrorMessage'] = "Role deletion failed. Please try again.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    $_SESSION['formSuccessMessage'] = "Role deleted successfully";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    die;
}
?>