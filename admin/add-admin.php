<?php 
$pageTitle = "Create Student - Pavi Admin";
include_once '../components/admin-head.php'; 
$role_instance = new Roles($db);
$roles = $role_instance->get_roles();
?>

<body>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <?php         
            include_once COMPONENT_DIR."admin-navbar.php";
            include_once COMPONENT_DIR."admin-sidemenu.php";
        ?>

        <main class="p-4 md:ml-64 min-h-screen pt-20">
            <div class="container mx-auto py-12">
                
                <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
                    <div class="w-full mb-1">
                        <div class="grid grid-cols-6">
                            <div class="col-span-6 md:col-span-4 items-center mb-3 flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                                <h2 class="card-header"><strong>Add Admin</strong></h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="relative w-full md:h-auto">
                                <!-- Form content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 p-6">
                                    
                                    <?php echo $utility->displayFormError();
                                        echo $utility->displayFormSuccess();
                                    ?>

                                    <div id="alert-1" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50" role="alert">
                                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                        </svg>
                                        <div class="ms-3 text-sm font-medium">
                                            <p>If you are registering an <strong>ADMIN</strong>, please ensure to fill all fields properly. Ensure to write down your <strong>PASSWORD!!!</strong></p>
                                        </div>
                                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-1" aria-label="Close">
                                            <span class="sr-only">Close</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <form action="<?php echo CONTROLLER_PATH;?>admin.php" method="POST">
                                        <div class="mb-4">
                                            <label for="fullName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Admin Full Name</label>
                                            <input type="text" id="fullName" name="fullName" placeholder="First Name: Johnathan Doe"
                                                value="<?php echo (isset($_SESSION['formInput']['fullName'])) ? $_SESSION['formInput']['fullName'] : ''; ?>"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User Name</label>
                                            <input type="text" id="username" name="username" placeholder="Username: marksmith"
                                                value="<?php echo (isset($_SESSION['formInput']['username'])) ? $_SESSION['formInput']['username'] : ''; ?>"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        </div>

                                        <div class="mb-4">
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email Address</label>
                                            <input type="email" id="email" name="email" placeholder="Email address: ohndoe@example.com"
                                                value="<?php echo (isset($_SESSION['formInput']['email'])) ? $_SESSION['formInput']['email'] : ''; ?>"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        </div>

                                        <div class="mb-4">
                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" onclick="reveal_password('password');">Password <strong>(Reveal Password)</strong> </label>
                                            <input type="password" id="password" name="password" placeholder="Enter password"
                                                value="<?php echo (isset($_SESSION['formInput']['password'])) ? $_SESSION['formInput']['password'] : $utility->randID('numeric', 8); ?>"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Select Role</label>
                                            <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="">-- Select Role --</option>
                                                <?php if (count($roles) > 0) {
                                                    foreach ($roles as $role) { ?>
                                                        <option value="<?= $role['id'] ?>" 
                                                            <?php echo (isset($_SESSION['formInput']['role']) AND $_SESSION['formInput']['role'] == $role['id']) ? "selected='selected'" : ''; ?>>
                                                            <?= $role['role_name'] ?>
                                                        </option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="flex items-center justify-end space-x-4">
                                            <button type="submit" name="create_admin" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Submit</button>
                                            <button type="reset" class="text-gray-500 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-300 text-sm px-5 py-2.5 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-600 dark:hover:border-gray-600 dark:focus:ring-gray-700">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include_once COMPONENT_MODAL_DIR.'add-course.php';?>
                
            </div>
        </main>
    </div>

    <?php include_once COMPONENT_DIR."admin-footer-script.php"; ?>

    <script>

        function reveal_password(element) {

            let x = document.getElementById(element);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            return false;
        }

        function isValidEmail(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }
        
        $("#email").keyup(function(e) {
            let email = $(this).val();
            let emailVerify = $(".email-verify");
            emailVerify.html("")
            if (isValidEmail(email)) {
                $.ajax({
                    url: "<?php echo CONTROLLER_PATH; ?>students.php",
                    type: "POST",
                    data: {
                        email: email,
                        email_exists_student: true
                    },
                    success: function(response) {
                        let decodeResponse = JSON.parse(response);
                        if (decodeResponse.status === false) {
                            emailVerify.html(decodeResponse.message).css({"color": "#fb7d8b"});
                        } else {
                            emailVerify.html(decodeResponse.message).css({"color": "#81f470"})
                        }
                    }
                });
            }
        });    
        
        $(".deleteCourse").on("click", function() {
            let courseId = $(this).attr('data-id');
            let courseName = $(this).attr('data-name');

            Swal.fire({
                title: 'Are you sure?',
                text: `Are you sure you want to delete (${courseName}) plan. Deleting this will affect all students that might want to or already enrolled in this course.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'No, Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action here
                    window.location.href = "<?php echo CONTROLLER_PATH;?>courses.php?delete_course=" + courseId;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Cancelled', 'Action not processed', 'info');
                }
            });
            

        });
    </script>
</body>

</html>