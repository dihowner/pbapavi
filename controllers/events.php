<?php
require_once '../includes/config.php';
require_once INCLUDES_DIR . 'Validator.php';

$event_instance = new Events($db);
$eventBannerPath = UPLOADS_PATH . EVENT_DIR ;
$allowedImageType = array("image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"); 
if (!file_exists($eventBannerPath))
    $valid = mkdir($eventBannerPath, 0777, true);

if (isset($_POST['create_event'])) {
	$myFilters = [
		'event_title' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'datetime' => [
			'sanitizations' => 'date',
			'validations' => 'required',
		],
		'event_description' => [
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
        $eventDateTime = $sanitizedInputData['datetime'];
        $eventBanner = $_FILES['event_banner'];
        
        if (!$utility->validateDate($eventDateTime)) {
            $_SESSION['formErrorMessage'][] = "Event date already elapse";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $fileSize = round($eventBanner["size"] / 1024);
        $response = [];

        if (!in_array($eventBanner['type'], $allowedImageType)) {
            $response['errors'][] = "".$eventBanner['type']." is not a JPG or PNG file";
        } else if ($fileSize > 5120) {
            $fileSize = $fileSize/1000;
            $response['errors'][] = "File size (".round($fileSize, 2)." mb) exceeds 5mb";
        } 
        
        if (!empty($response)) {
            $_SESSION['formErrorMessage'][] = $response['errors'][0];
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $pathInfo = pathinfo($eventBanner['name']);
        $filename = date("Ymd") . '_'.uniqid().'.' . strtolower($pathInfo['extension']);
        $eventFile = $eventBannerPath.$filename;
        
        $uploadEventBanner = move_uploaded_file($eventBanner['tmp_name'], $eventFile);
                
        if (!$uploadEventBanner) {
            $_SESSION['formErrorMessage'][] = "File could not be uploaded. Something went wrong. Please try again";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $eventData = [
            'event_title' => $sanitizedInputData['event_title'],
            'event_banner' => $filename,
            'event_date' => str_replace('WAT', ' ', $eventDateTime),
            'event_description' => $sanitizedInputData['event_description'],
        ];
        
        $create_event = $event_instance->create_event($eventData);
       
        if (!$create_event) {
            $_SESSION['formErrorMessage'] = "Event creation failed. Please try again.";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $_SESSION['formSuccessMessage'] = "Event created successfully";
        unset($_SESSION['formInput']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
    }
}

if (isset($_REQUEST['delete_event'])) {
    $eventId = (int) $_REQUEST['delete_event'];
    $getEvent = $event_instance->get_event($eventId);
    $eventBannerPath = UPLOADS_PATH . EVENT_DIR . $getEvent['event_banner'];
    
    if (file_exists($eventBannerPath)) {
        $delete_event = $event_instance->delete_event($eventId);
        if (!$delete_event) {
            $_SESSION['formErrorMessage'] = "Event deletion failed. Please try again.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        unlink($eventBannerPath);
        $_SESSION['formSuccessMessage'] = "Event deleted successfully";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
    }
    $_SESSION['formErrorMessage'] = "Event banner not found. Request failed";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if (isset($_POST['edit_event'])) {
    $myFilters = [
		'event_id' => [
			'sanitizations' => 'numeric',
			'validations' => 'required',
		],
		'event_title' => [
			'sanitizations' => 'string',
			'validations' => 'required',
		],
		'datetime' => [
			'sanitizations' => 'date',
			'validations' => 'required',
		],
		'event_description' => [
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
        $eventDateTime = $sanitizedInputData['datetime'];
        $eventBanner = $_FILES['event_banner'];
        $eventId = $sanitizedInputData['event_id'];

        if (!$utility->validateDate($eventDateTime)) {
            $_SESSION['formErrorMessage'][] = "Event date already elapse";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $getEvent = $event_instance->get_event($eventId);
        
        // Event Banner path in DB...
        $DBEventBannerPath = UPLOADS_PATH . EVENT_DIR . $getEvent['event_banner'];

        // empty event file name...
        $eventFile = $filename = "";
        $uploadEventBanner = false;

        if (!empty($eventBanner['name'])) {
            $fileSize = round($eventBanner["size"] / 1024);
            $response = [];
    
            if (!in_array($eventBanner['type'], $allowedImageType)) {
                $response['errors'][] = "".$eventBanner['type']." is not a JPG or PNG file";
            } else if ($fileSize > 5120) {
                $fileSize = $fileSize/1000;
                $response['errors'][] = "File size (".round($fileSize, 2)." mb) exceeds 5mb";
            } 
            
            if (!empty($response)) {
                $_SESSION['formErrorMessage'][] = $response['errors'][0];
                $_SESSION['formInput'] = $_POST;
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
    
            $pathInfo = pathinfo($eventBanner['name']);
            $filename = date("Ymd") . '_'.uniqid().'.' . strtolower($pathInfo['extension']);
            $eventFile = $eventBannerPath.$filename;
            
            $uploadEventBanner = move_uploaded_file($eventBanner['tmp_name'], $eventFile);

            if (!$uploadEventBanner) {
                $_SESSION['formErrorMessage'][] = "File could not be uploaded. Something went wrong. Please try again";
                $_SESSION['formInput'] = $_POST;
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
        
        if ($uploadEventBanner AND !empty($eventFile)) {
            unlink($DBEventBannerPath);
        }

        // Let's update...
        $filename = !empty($filename) ? $filename : $getEvent['event_banner'];

        $eventData = [
            'event_title' => $sanitizedInputData['event_title'],
            'event_banner' => $filename,
            'event_date' => str_replace('WAT', ' ', $eventDateTime),
            'event_description' => $sanitizedInputData['event_description'],
        ];

        $update_event = $event_instance->update_event($eventData, $eventId);
        if (!$update_event) {
            $_SESSION['formErrorMessage'] = "Event update failed. Please try again.";
            $_SESSION['formInput'] = $_POST;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        $_SESSION['formSuccessMessage'] = "Event updated successfully";
        unset($_SESSION['formInput']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die;
    }
}