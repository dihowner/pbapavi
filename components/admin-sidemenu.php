<style>
      .custom-scrollbar {
    -ms-overflow-style: auto !important;  /* IE and Edge */
    scrollbar-width: none !important;  /* Firefox */
  }

  .custom-scrollbar::-webkit-scrollbar {
    width: 8px !important;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: #4A5568; /* Tailwind's gray-700 */
    border-radius: 4px !important;
  }

  .custom-scrollbar::-webkit-scrollbar-track {
    background-color: #E2E8F0 !important; /* Tailwind's gray-200 */
  }
</style>

<aside
            class="overflow-hidden custom-scrollbar overflow-y-auto fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidenav" id="drawer-navigation">
            <div class=" py-5 px-3 h-fit bg-white dark:bg-gray-800">

                <ul class="space-y-6 md:mt-10">
                    <li>
                        <a href="dashboard.php"
                            class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white dark:text-white">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="course-management.php"
                            class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">

                            <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                    clip-rule="evenodd" />
                            </svg>
                            
                            <span
                                class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white dark:text-white">
                                Course Management
                            </span>
                        </a>
                    </li>
                    
                    <li>
                        <button type="button"
                            class="flex items-center justify-between p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">


                            <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:group-hover:text-white dark:group-focus:text-white"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class=" text-gray-900 dark:text-white">Student
                                Management</span>
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-sales" class="hidden py-2 px-2 space-y-2 bg-gray-100 dark:bg-gray-900 rounded-md mt-3 mx-2">
                            <li>
                                <a href="add-student.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Add Student</span>
                                </a>
                            </li>

                            <!-- <li>
                                <a href="student-management.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Student
                                        Management</span>
                                </a>
                            </li> -->

                            <li>
                                <a href="pending-student.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Pending Student
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="active-student.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Active Student
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="active-student-summary.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Active Student Summary
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="certified-student.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Certified Students</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    
                    <li>
                        <button type="button"
                            class="flex items-center justify-between p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-admin" data-collapse-toggle="dropdown-admin">


                            <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:group-hover:text-white dark:group-focus:text-white"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class=" text-gray-900 dark:text-white">Admin
                                Management</span>
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-admin" class="hidden py-2 px-2 space-y-2 bg-gray-100 dark:bg-gray-900 rounded-md mt-3 mx-2">
                            <li>
                                <a href="add-admin.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Add Admin</span>
                                </a>
                            </li>

                            <li>
                                <a href="roles-management.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Roles
                                        Management</span>
                                </a>
                            </li>

                            <li>
                                <a href="admin-management.php"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Admin Management
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="event-management.php"
                            class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span
                                class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white dark:text-white">
                                Events Management
                            </span>
                        </a>
                    </li>
<!-- 
                    <li>
                        <button type="button"
                            class="flex items-center justify-between p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-certificate" data-collapse-toggle="dropdown-certificate">

                            <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:group-hover:text-white dark:group-focus:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z" />
                            </svg>

                            <span class=" text-gray-900 dark:text-white">Certificate</span>
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-certificate" class="hidden py-2 px-2 space-y-2 bg-gray-100 dark:bg-gray-900 rounded-md mt-3 mx-2">
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Upload Certificate</span>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center p-2 text-base font-medium  rounded-lg dark:text-white hover:bg-[#ff0000] focus:bg-[#ff0000] group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-white group-focus:text-white"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z" />
                                    </svg>
                                    <span
                                        class="ml-3 text-gray-900 group-hover:text-white group-focus:text-white text-sm dark:text-white">Our Certificate</span>
                                </a>
                            </li>

                        </ul>
                    </li> -->
                </ul>

            </div>
            <div
                class=" justify-center items-center p-4 space-x-4 w-full grid grid-cols-4 bg-white dark:bg-gray-800 z-20">
                <a href="logout.php"
                    class="flex col-span-3 items-center justify-center gap-3 py-2 px-4 mx-5 my-4 rounded text-center text-white font-bold text-sm bg-[#ff0000] cursor-pointer">
                    <svg aria-hidden="true"
                        class="w-7 h-7 text-white group-hover:text-gray-500 dark:text-gray-400 dark:group-hover:text-gray-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>Log out</span>
                </a>
                <a href="#" data-tooltip-target="tooltip-settings"
                    class="col-span-1 inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <div id="tooltip-settings" role="tooltip"
                    class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                    Settings page
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                <!-- Dropdown -->

            </div>
        </aside>