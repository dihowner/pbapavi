<?php
    $pageTitle = "Register - Pavi Admin Dashboard";
    require_once "./components/front-head.php";
    
    $course_instance = new Courses($db);
    $courses = $course_instance->get_courses('course_name');
?>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex flex-col md:flex-row md:w-10/12 bg-white items-center overflow-hidden">
            <!-- Illustration Section -->
            <div class="illustration hidden md:block md:w-6/12">
                <img src="https://img.freepik.com/free-vector/work-progress-concept-illustration_114360-5241.jpg"
                    class="w-full h-full" alt="">
            </div>
            <!-- Form Section -->
            <div class="p-8 w-full md:w-5/12  rounded-lg">
                <div class="flex justify-center mb-9">
                    <a href="https://pba.pavi.ng" target="_blank">
                        <img src="https://pavi.ng/storage/app/public/company/2024-04-18-6621416d477fe.png" alt=""
                            class="logo w-40 h-14">
                    </a>
                </div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Register to our platform</h2>
                </div>

                <?php
                    echo $utility->displayFormError();
                ?>

                <form class="space-y-4" action="<?php echo CONTROLLER_PATH;?>students.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="firstName" name="firstName" placeholder="First Name: Johnathan" required 
                                value="<?php echo (isset($_SESSION['formInput']['firstName'])) ? $_SESSION['formInput']['firstName'] : ''; ?>"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#ff0000c0] focus:border-[#ff0000c0] sm:text-sm">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="lastName" name="lastName" placeholder="Last Name: Doe" required 
                                value="<?php echo (isset($_SESSION['formInput']['lastName'])) ? $_SESSION['formInput']['lastName'] : ''; ?>"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#ff0000c0] focus:border-[#ff0000c0] sm:text-sm">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Your email</label>
                        <input type="email" id="email" name="email" placeholder="Johndoe@example.com" required
                             value="<?php echo (isset($_SESSION['formInput']['email'])) ? $_SESSION['formInput']['email'] : ''; ?>"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#ff0000c0] focus:border-[#ff0000c0] sm:text-sm">
                    </div>
                   
                   <div class="mt-4">
                       <label for="phoneNo" class="block text-sm font-medium text-gray-700">Your Phone No</label>
                       <input type="tel" id="phoneNo" name="phoneNumber" placeholder="+234**********" required
                            value="<?php echo (isset($_SESSION['formInput']['phoneNumber'])) ? $_SESSION['formInput']['phoneNumber'] : ''; ?>"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#ff0000c0] focus:ring-opacity-5 focus:border-[#ff0000c0] sm:text-sm">
                   </div>
                   
                   <div class="mt-4">
                       <label for="course" class="block text-sm font-medium text-gray-700">Choose Course</label>
                       <select name="course" id="course" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#ff0000c0] focus:ring-opacity-5 focus:border-[#ff0000c0] sm:text-sm">
                           <option value=""> -- Select Course --</option>
                           <?php if(!empty($courses)){
                               foreach ($courses as $courseIndex => $courseInfo) { ?>
                                   <option value="<?php echo $courseInfo['course_id']; ?>"><?php echo $courseInfo['course_name']; ?></option>
                                <?php }
                           } ?>
                       </select>
                   </div>

                    <div class="mt-4">
                        <input type="checkbox" id="terms" name="terms" class="checkbox mr-2 !accent-[#ff0000]" required>
                        <label for="terms" class="text-sm text-gray-600">By Registering, and you agree to Pavi's <a href="#" class="text-[#ff0000]">Terms of Use</a> and <a href="#"
                                class="text-[#ff0000]">Privacy Policy</a>.</label>
                    </div>
                    <div class="mt-4">
                        <input type="checkbox" id="updates" name="updates" class="checkbox mr-2 accent-[#ff0000]">
                        <label for="updates" class="text-sm text-gray-600">Email me about updates and
                            resources.</label>
                    </div>
                    <button type="submit" class="w-full font-bold bg-[#ff0000] text-white py-2 rounded-md" name="student_register">
                        Register
                    </button>
                </form>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>