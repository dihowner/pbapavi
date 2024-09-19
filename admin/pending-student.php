<?php 
$pageTitle = "Pending Students - Pavi Admin";
include_once '../components/admin-head.php'; 
$course_instance = new Courses($db);
$pendingCourses = $course_instance->get_pending_course_registration();
?>

<body>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <?php         
            include_once COMPONENT_DIR."admin-navbar.php";
            include_once COMPONENT_DIR."admin-sidemenu.php";
        ?>

        <main class="p-4 md:ml-64 min-h-screen pt-20 ">
            <div class="container mx-auto py-12">
                
                <div
                    class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
                    <div class="w-full mb-1">

                        <div class="grid grid-cols-6">
                        <div class="col-span-6 md:col-span-4 mb-3 sm:mb-0 flex flex-col items-start sm:divide-x sm:divide-gray-100 dark:divide-gray-700">
                            <h2 class="card-header"><strong>Pending Student(s)</strong></h2>
                            <span class="dark:text-white">Student who only registered but yet to make a payment</span>
                        </div>

                            <div
                                class="col-span-6 md:col-span-2 flex items-center justify-center md:ml-auto space-x-2 sm:space-x-3">
                                <a href="add-student.php"
                                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Add Student
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle dark:text-white">

                            <?php 
                                echo $utility->displayFormError();
                                echo $utility->displayFormSuccess();
                            ?>
                            <div class="overflow-hidden shadow">
                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="p-4 text-xs font-bold text-center text-gray-500 uppercase dark:text-gray-400">
                                                S/No
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-bold text-center text-gray-500 uppercase dark:text-gray-400">
                                                Student Details
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-bold text-center text-gray-500 uppercase dark:text-gray-400">
                                                Course Details
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-bold text-center text-gray-500 uppercase dark:text-gray-400">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                        <?php 
                                        if (count($pendingCourses) > 0) {
                                            foreach ($pendingCourses as $courseIndex => $course) {
                                                $studentData = $course['student'];
                                                $courseData = $course['course'];
                                                $courseRegId = $course['id'];
                                                $courseId = $course['course_id'];
                                                $studentFullName = $studentData['full_name'];
                                                $courseName = $courseData['course_name'];
                                            ?>
                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td
                                                        class=" max-w-sm p-4 overflow-hidden text-base text-center font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                                        <?php echo $courseIndex + 1; ?>
                                                    </td>

                                                    <td class="flex items-center justify-center p-4 space-x-6 whitespace-nowrap">
                                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                                <?php echo $studentFullName; ?> <br>
                                                                <span class="d-flex" style="color: #fb7d8b">
                                                                    Email: <?php echo $studentData['email_address']; ?>
                                                                </span> <br>
                                                                <span class="d-flex" style="color: #d8bfb7">
                                                                    Mobile Number: <?php echo $studentData['mobile_number']; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td class="max-w-sm p-4 overflow-hidden text-base text-center font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                            <div class="text-base  dark:text-white">
                                                                <strong><?php echo $courseName; ?></strong>
                                                            </div>
                                                            <span class="d-flex" style="color: #fb7d8b">
                                                                Course Fee: <?php echo number_format($courseData['course_fee'], 2); ?>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    
                                                    <td class="max-w-sm p-4 overflow-hidden text-base text-center font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                            <div class="text-base  dark:text-white">
                                                                <button type="button" data-name="<?php echo $studentFullName; ?>" data-course-name="<?php echo $courseName; ?>" 
                                                                    data-id="<?php echo $courseRegId; ?>"
                                                                    class="approveStudent items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400">
                                                                    Approve
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <?php include_once COMPONENT_DIR."admin-footer-script.php"; ?>

    <script>
        $(".approveStudent").on("click", function() {
            let courseId = $(this).attr('data-id');
            let studentName = $(this).attr('data-name');
            let courseName = $(this).attr('data-course-name');

            Swal.fire({
                title: 'Are you sure?',
                text: `Are you sure you want to activate this course (${courseName}) for ${studentName}. Activating this student means the student has paid for this course.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve!',
                cancelButtonText: 'No, Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action here
                    window.location.href = "<?php echo CONTROLLER_PATH;?>courses.php?activate_student_course=" + courseId;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Cancelled', 'Action not processed', 'info');
                }
            });
        });
    </script>
</body>

</html>