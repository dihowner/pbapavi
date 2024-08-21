<?php
require_once '../includes/config.php';
require_once INCLUDES_DIR . 'Validator.php';

$admin_instance = new Admins($db);

if (isset($_POST['admin_login'])) {
	$myFilters = [
		'admin_detail' => [
			'sanitizations' => 'string',
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

        $getAdmin = $admin_instance->get_admin($sanitizedInputData['admin_detail']);

        if (!$getAdmin) {
            $_SESSION['formErrorMessage'] = "Admin does not exist!";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $hashPassword = $getAdmin->password;
        unset($getAdmin->password);
        
        if($getAdmin) {
            if (password_verify($sanitizedInputData['password'], $hashPassword)) {
                $_SESSION['admin'] = $getAdmin->id;
                header("Location: " . BASE_URL . 'admin/dashboard.php');
                exit();
            } else {
                $_SESSION['formErrorMessage'] = $clientLang['invalid_credentials'];
                $_SESSION['formInput'] = $_POST;
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            $_SESSION['formErrorMessage'] = $clientLang['invalid_credentials'];
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>