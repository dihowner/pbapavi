<?php 
$pageTitle = "Event Management - Pavi Admin";
include_once '../components/admin-head.php'; 
$event_instance = new Events($db);
$events = $event_instance->get_events();
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
                            <div
                                class="col-span-6 md:col-span-4 items-center mb-3 flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                                <h2 class="card-header"><strong>Event Management</strong></h2>
                            </div>
                            <div
                                class="col-span-6 md:col-span-2 flex items-center justify-center md:ml-auto space-x-2 sm:space-x-3">
                                <button type="button" data-modal-target="add-event-modal"
                                    data-modal-toggle="add-event-modal"
                                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Add Event
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                        <?php echo $utility->displayFormError();
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
                                                Event Title
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-bold text-center text-gray-500 uppercase dark:text-gray-400">
                                                Event Date
                                            </th>
                                            
                                            <th scope="col"
                                                class="p-4 text-xs font-bold text-center text-gray-500 uppercase dark:text-gray-400">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                        <?php if (count($events) > 0) {
                                            foreach ($events as $eventIndex => $event) {
                                                $eventId = $event['event_id'];
                                                $eventTitle = $event['event_title'];
                                                $eventDate = $event['event_date'];
                                            ?>
                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td
                                                        class=" max-w-sm p-4 overflow-hidden text-base text-center font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                                        <?php echo $eventIndex + 1; ?>
                                                    </td>
                                                    
                                                    <td class=" flex items-center justify-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                                <?php echo $eventTitle; ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td class="max-w-sm p-4 overflow-hidden text-base text-center font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                                <?php echo $utility->niceDateFormat($eventDate); ?>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="flex items-center justify-center p-4 space-x-3 whitespace-nowrap">

                                                        <button type="button" data-modal-target="edit-event-modal<?php echo $eventId;?>"
                                                            data-modal-toggle="edit-event-modal<?php echo $eventId;?>"
                                                            class="items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-400">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                                </path>
                                                                <path fill-rule="evenodd"
                                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                        
                                                        <button type="button" data-modal-target="delete-user-modal"
                                                            data-modal-toggle="delete-user-modal"
                                                            
                                                            data-id="<?php echo $eventId; ?>" data-name="<?php echo $eventTitle; ?>"
                                                            class="deleteEvent inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>

                                                        </button>
                                                    </td>
                                                </tr>

                                                <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
                                                    id="edit-event-modal<?php echo $eventId;?>">
                                                    <div class="relative w-full h-screen max-w-2xl px-4 md:h-auto">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                                            <!-- Modal header -->
                                                            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                                                                <h3 class="text-xl font-semibold dark:text-white">
                                                                    Edit Event (#<?php echo $eventTitle;?>)
                                                                </h3>
                                                                <button type="button"
                                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                                                                    data-modal-toggle="edit-event-modal<?php echo $eventId;?>">
                                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd"
                                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <form action="<?php echo CONTROLLER_PATH;?>events.php" method="POST" enctype="multipart/form-data">
                                                                <div class="p-6 space-y-6">

                                                                    <div class="grid grid-cols-6 gap-6">
                                                                        <div class="col-span-6 sm:col-span-3">
                                                                            <label for="event_title"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Title</label>
                                                                            <input type="text" name="event_title" id="event_title"
                                                                                value="<?php echo (isset($_SESSION['formInput']['event_title'])) ? $_SESSION['formInput']['event_title'] : $eventTitle; ?>"
                                                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                placeholder="UI/UX Design" required>
                                                                            <input type="hidden" name="event_id" id="event_id"
                                                                                value="<?php echo $eventId; ?>">
                                                                        </div>

                                                                        <div class="col-span-6 sm:col-span-3">
                                                                            <label for="datetime"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Date</label>
                                                                            <input type="datetime-local" id="datetime" name="datetime"
                                                                                value="<?php echo (isset($_SESSION['formInput']['datetime'])) ? $_SESSION['formInput']['datetime'] : $eventDate; ?>"
                                                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                required>
                                                                        </div>

                                                                        <div class="col-span-6">
                                                                            <label for="event_description"
                                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Description</label>
                                                                            <textarea id="event_description" name="event_description" rows="4" placeholder="Description about this event..."
                                                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                                ><?php echo (isset($_SESSION['formInput']['event_description'])) ? $_SESSION['formInput']['event_description'] : $event['event_description']; ?></textarea>
                                                                        </div>

                                                                        <div class="col-span-12 sm:col-span-6">
                                                                            <label for="datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Banner (Optional if you are not changing)</label>
                                                                            <input type="file" id="event_banner" name="event_banner"
                                                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            >
                                                                        </div>                                                                        

                                                                        <div class="col-span-6">
                                                                            <img src="/<?php echo UPLOADS_DIR . EVENT_DIR .$event['event_banner']; ?>" class="image image-rounded image-shadow" style="width: 100px; height: 100px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal footer -->
                                                                <div
                                                                    class="flex justify-end items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                                                                    <button
                                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                                        type="submit" name="edit_event">Edit Event</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } 
                                            } ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include_once COMPONENT_MODAL_DIR.'add-event.php';?>
                
            </div>
        </main>
    </div>
    <?php include_once COMPONENT_DIR."admin-footer-script.php"; ?>

    <script>
        $(".deleteEvent").on("click", function() {
            let eventId = $(this).attr('data-id');
            let eventName = $(this).attr('data-name');

            Swal.fire({
                title: 'Are you sure?',
                text: `Are you sure you want to delete (${eventName}) event. Action is irreversible`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'No, Cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action here
                    window.location.href = "<?php echo CONTROLLER_PATH;?>events.php?delete_event=" + eventId;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Cancelled', 'Action not processed', 'info');
                }
            });
        });
    </script>
</body>

</html>