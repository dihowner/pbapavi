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
                    <a href="student-management.php" class="block">
                        <div
                            class="text-2xl flex gap-4 items-center justify-center border-2 border-gray-300 bg-white rounded-lg dark:bg-gray-500 dark:border-gray-600 h-32">
                            <p class="font-bold bg-gray-900 text-white size-10 flex justify-center items-center rounded-full"><?php echo number_format($dashboardStats->total_students);?><br></p>
                            <p class="font-bold l">Total Students</p>
                        </div>
                    </a>
                    <a href="#" class="block">
                        <div
                            class="text-2xl flex gap-4 items-center justify-center border-2 rounded-lg border-gray-300 bg-white dark:bg-gray-500 dark:border-gray-600 h-32">
                            <p class="font-bold bg-gray-900 text-white size-10 flex justify-center items-center rounded-full"><?php echo number_format($dashboardStats->total_admin);?></p>
                            <p class="font-bold l">Total Admin</p>
                        </div>
                    </a>
                    <a href="course-management.php" class="block">
                        <div
                            class="text-2xl flex gap-4 items-center justify-center border-2 rounded-lg border-gray-300 bg-white dark:bg-gray-500 dark:border-gray-600 h-32">
                            <p class="font-bold bg-gray-900 text-white size-10 flex justify-center items-center rounded-full"><?php echo number_format($dashboardStats->total_course);?></p>
                            <p class="font-bold text-2xl"> Total Courses</p>
                        </div>
                    </a>
                    <a href="event-management.php" class="block">
                        <div
                            class="text-2xl flex gap-4 items-center justify-center border-2 rounded-lg border-gray-300 bg-white dark:bg-gray-500 dark:border-gray-600 h-32">
                            <p class="font-bold bg-gray-900 text-white size-10 flex justify-center items-center rounded-full"><?php echo number_format($dashboardStats->total_event);?></p>
                            <p class="font-bold l"> Total Events</p>
                        </div>
                    </a>
                    <a href="active-student.php" class="block lg:col-span-2">
                        <div
                            class="text-2xl flex gap-4  items-center justify-center border-2 rounded-lg border-gray-300 dark:bg-gray-500 bg-white dark:border-gray-600 h-32">
                            <p class="font-bold bg-gray-900 text-white size-10 flex justify-center items-center rounded-full"><?php echo number_format($dashboardStats->total_active_student);?></p>
                            <p class="font-bold l"> Active Students</p>
                        </div>
                    </a>
                    <a href="certified-student.php" class="block lg:col-span-2">
                        <div
                            class="text-2xl flex gap-4  items-center justify-center border-2 rounded-lg border-gray-300 dark:bg-gray-500 bg-white dark:border-gray-600 h-32">
                            <p class="font-bold bg-gray-900 text-white size-10 flex justify-center items-center rounded-full"><?php echo number_format($dashboardStats->total_certified_student);?></p>
                            <p class="font-bold l"> Certified Students</p>
                        </div>
                    </a>
                    <!-- <div class="lg:col-span-4 w-full border-2 rounded-lg border-gray-300 dark:bg-gray-500 bg-white dark:border-gray-600 overflow-hidden">
                        <div id="chart-area" class="w-full"></div>
                    </div> -->
                </div>
            </div>   
        </main>
    </div>


    <?php 
    include_once COMPONENT_DIR."admin-footer-script.php"; 
    // include_once COMPONENT_DIR."admin-charts-scripts.php";
    ?>
</body>

</html>