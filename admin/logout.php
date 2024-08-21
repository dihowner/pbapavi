<?php
include '../includes/config.php';
session_destroy();
header('Location: ' . BASE_URL . 'admin/');
exit;
?>