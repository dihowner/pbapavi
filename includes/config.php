<?php
// ini settings
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

ini_set("memory_limit", "1024M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
ini_set('session.gc_maxlifetime', 24 * 60 * 40);

// session_set_cookie_params(3600);

ob_start();
session_start();
error_reporting(E_ALL);
// error_reporting(0);

// Sever constants
define('SERVER', $_SERVER['SERVER_NAME']);
define('PAGE', pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME));
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SCHEME', $_SERVER['REQUEST_SCHEME']);
define('PORT', $_SERVER['SERVER_PORT']);
define('REQUEST_URI', $_SERVER['REQUEST_URI']);
define('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);
define('REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');

// SQL database parameters
if (SERVER != 'localhost' and SERVER != '127.0.0.1') {
    define('BASE_PATH', '/');
    define('DB_NAME', 'pavi_certificate');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
} else {
    define('BASE_PATH', '/deviceXtra/');
    define('DB_NAME', 'deviceXtra');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
}

// Application constants
define('BASE_URL', SCHEME . '://' . SERVER . BASE_PATH);
define('MODEL_DIR', ROOT . BASE_PATH . 'models/');
define('CONTROLLER_DIR', ROOT . BASE_PATH . 'controllers/');
define('INCLUDES_DIR', ROOT . BASE_PATH . 'includes/');
define('COMPONENT_DIR', ROOT . BASE_PATH . 'components/');
define('FONT_DIR', ROOT . BASE_PATH . 'fonts/');
define('COMPONENT_MODAL_DIR', ROOT . BASE_PATH . 'components/modals/');

define('CONTROLLER_PATH', SCHEME . '://' . SERVER . BASE_PATH . 'controllers/');

define('TEMPLATE_DIR', 'templates/');
define('UPLOADS_DIR', 'uploads/');
define('EVENT_DIR', 'events/');
define('UPLOADS_PATH',  ROOT . BASE_PATH . UPLOADS_DIR);
define('TEMPLATE_PATH',  ROOT . BASE_PATH . TEMPLATE_DIR);


// Requirements
// require_once(VENDOR_DIR . 'autoload.php');
require_once('Database.php');
require_once("mysql.session.php");

// Database Coonection
$dsn = "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . "";
$pdo = "";
try {
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$db = new Database($pdo);

// Includes
include 'language.php';

// Initialize Models
include_once MODEL_DIR . 'Utility.php';
$utility = new Utility($db);

include_once MODEL_DIR . 'Courses.php';
include_once MODEL_DIR . 'Students.php';
include_once MODEL_DIR . 'Banks.php';
include_once MODEL_DIR . 'Admins.php';
include_once MODEL_DIR . 'Events.php';
include_once MODEL_DIR . 'Roles.php';

// Default Time zone
date_default_timezone_set("Africa/Lagos");
