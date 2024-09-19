<?php require_once "../includes/config.php"; 
if (!isset($_SESSION['admin'])) {
    session_destroy();
    header("Location: " . BASE_URL . "admin/");
    exit;
}
$admin_instance = new Admins($db);
$adminDetail = $admin_instance->get_admin($_SESSION['admin']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-header {
            color: #fff;   
        }
    </style>
</head>