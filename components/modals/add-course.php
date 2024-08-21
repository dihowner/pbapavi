<div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
    id="add-course-modal">
    <div class="relative w-full h-screen max-w-2xl px-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                <h3 class="text-xl font-semibold dark:text-white">
                    Create Course
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                    data-modal-toggle="add-course-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <form action="<?php echo CONTROLLER_PATH;?>courses.php" method="POST">
                <div class="p-6 space-y-6">

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="course_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Name</label>
                            <input type="text" name="course_name" id="course_name"
                                value="<?php echo (isset($_SESSION['formInput']['course_name'])) ? $_SESSION['formInput']['course_name'] : ''; ?>"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="UI/UX Design" required>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="course_fee"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Fee</label>
                            <input type="text" name="course_fee" id="course_fee"
                                value="<?php echo (isset($_SESSION['formInput']['course_fee'])) ? $_SESSION['formInput']['course_fee'] : ''; ?>"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="50000" required>
                        </div>

                        <div class="col-span-6">
                            <label for="course_description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Description</label>
                            <textarea id="course_description" name="course_description" rows="4" placeholder="Description about this course..."
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                ><?php echo (isset($_SESSION['formInput']['course_description'])) ? $_SESSION['formInput']['course_description'] : ''; ?></textarea>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex justify-end items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="submit" name="create_course">Create Course</button>
                </div>
            </form>
        </div>
    </div>
</div>