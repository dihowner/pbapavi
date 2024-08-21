<?php
    $pageTitle = "Continue Registration - Pavi Admin Dashboard";
    require_once "./components/front-head.php";

    $courseRegId = (int) base64_decode($_REQUEST['id']);
    
    $course_instance = new Courses($db);
    $bank_instance = new Banks($db);
    $courseReg = $course_instance->get_course_registration($courseRegId);

    if (!isset($_REQUEST['id']) OR $courseRegId < 1 OR $courseReg === false) {
        $_SESSION['formErrorMessage'] = "You are not authorized to view this resource";
        header("Location: register.php");
        exit();
    }
    $courseData = json_decode($courseReg->course_data, true);

    $bankLists = $bank_instance->get_banks();
    $studentData = $courseReg->student;
?>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex flex-col md:flex-row md:w-10/12 bg-white items-center overflow-hidden">
            
            <div class="p-8 w-full md:w-5/12  rounded-lg">
                <div class="flex justify-center mb-9">
                    <a href="https://pavi.ng" target="_blank">
                        <img src="https://pavi.ng/storage/app/public/company/2024-04-18-6621416d477fe.png" alt=""
                            class="logo w-40 h-14">
                    </a>
                </div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">You're almost there!</h2>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600">
                        Dear <strong><?php echo $studentData['full_name'];?> (<em><?php echo $studentData['email_address'];?></em>)</strong> 
                        <br><br>

                        Thank you for registering for <em><strong><?php echo $courseData['name']; ?></strong></em>.<br>

                        Find below information about your registration <br><br>

                        <span class="text-800">
                            <strong>Course Fee:</strong> ₦<?php echo number_format($courseData['amount'], 2); ?>
                        </span> 
                        <br><br>

                        Kindly pay to any of the following bank account below <br>

                        <?php if (count($bankLists) > 0) {
                            echo '<div class="mb-4 mt-4"></div><hr>';
                            foreach ($bankLists as $bank) {
                                echo '<div class="mb-4 mt-4">';
                                    echo '<strong>Bank Name: </strong> '.$bank['bank_name'].
                                            '<br> <strong>Account Name:</strong> '.$bank['account_name'].
                                            '<br> <strong>Account Number:</strong> '.$bank['account_number'];
                                echo '</div>';
                                echo "<hr>";
                            }
                        } ?>
                        
                        <br><br>
                        After payment, kindly send your confirmation payment receipt to us on whatsapp <strong><em>+234806000000</em></strong> 

                        <br><br>
                        Thank you for your interest in Pavi Academy.<br>
                        <strong><em>See you in class soon</em></strong>
                        
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>