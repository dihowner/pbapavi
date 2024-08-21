<?php 
$pageTitle = "Dashboard - Pavi Admin";
include_once '../components/admin-head.php'; 
$admin_instance = new Admins($db);
$dashboardStats = $admin_instance->get_dashboard_stats();
?>

<body>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <?php         
            include_once COMPONENT_DIR."admin-navbar.php";
            include_once COMPONENT_DIR."admin-sidemenu.php";
        ?>

        <main class="p-4 md:ml-64 min-h-screen pt-20 ">
            <!-- Main Dashboard -->
            <div class="text-gray-900 dark:text-white">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <div
                        class="flex items-center justify-center border-2 border-gray-300 bg-white rounded-lg dark:bg-gray-500 dark:border-gray-600 h-32">
                        <p class="font-bold text-xl"><?php echo number_format($dashboardStats->total_students);?><br></p> 
                        <p class="font-bold text-2xl">Total Students</p>
                    </div>
                    <div
                        class="flex items-center justify-center border-2 rounded-lg border-gray-300 bg-white dark:bg-gray-500 dark:border-gray-600 h-32">
                        <p class="font-bold text-2xl"><?php echo number_format($dashboardStats->total_admin);?> Total Admin</p>
                    </div>
                    <div
                        class="flex items-center justify-center border-2 rounded-lg border-gray-300 bg-white dark:bg-gray-500 dark:border-gray-600 h-32">
                        <p class="font-bold text-2xl"><?php echo number_format($dashboardStats->total_course);?> Total Courses</p>
                    </div>
                    <div
                        class="flex items-center justify-center border-2 rounded-lg border-gray-300 bg-white dark:bg-gray-500 dark:border-gray-600 h-32">
                        <p class="font-bold text-2xl"><?php echo number_format($dashboardStats->total_event);?> Total Events</p>
                    </div>
                    <div
                        class="flex lg:col-span-2 items-center justify-center border-2 rounded-lg border-gray-300 dark:bg-gray-500 bg-white dark:border-gray-600 h-32">
                        <p class="font-bold text-2xl"><?php echo number_format($dashboardStats->total_active_student);?> Active Students</p>
                    </div>
                    <div
                        class="flex lg:col-span-2 items-center justify-center border-2 rounded-lg border-gray-300 dark:bg-gray-500 bg-white dark:border-gray-600 h-32">
                        <p class="font-bold text-2xl"><?php echo number_format($dashboardStats->total_certified_student);?> Certified Students</p>
                    </div>
                </div>
            </div>   
        </main>
    </div>
    <?php include_once COMPONENT_DIR."admin-footer-script.php"; ?>
</body>

</html>