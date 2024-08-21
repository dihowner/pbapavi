<?php
    require_once "../includes/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pavi Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet">
    <style>
        .checkbox {
            accent-color: #ff0000 !important;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex flex-col md:flex-row md:w-10/12 bg-white items-center overflow-hidden">
            <!-- Illustration Section -->
            <div class="illustration hidden md:block md:w-6/12">
                <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/authentication/illustration.svg"
                    class="w-full h-full" alt="">
            </div>
            <!-- Form Section -->
            <div class="p-8 w-full md:w-5/12 rounded-lg">
                <div class="flex justify-center mb-9">
                    <a href="https://pavi.ng" target="_blank">
                        <img src="https://pavi.ng/storage/app/public/company/2024-04-18-6621416d477fe.png" alt=""
                            class="logo w-40 h-14">
                    </a>
                </div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Login to your Account</h2>
                </div>
                
                <?php echo $utility->displayFormError(); ?>

                <form class="space-y-4" action="<?php echo CONTROLLER_PATH;?>login_admin.php" method="POST">
                    <div class="mt-4">
                        <label for="admin_detail" class="block text-sm font-medium text-gray-700">Email or Username</label>
                        <input type="text" id="admin_detail" name="admin_detail" placeholder="Email or Username" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#ff0000c0] focus:border-[#ff0000c0] sm:text-sm">
                    </div>
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" placeholder="********" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-[#ff0000c0] focus:border-[#ff0000c0] sm:text-sm">
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <div>
                            <input type="checkbox" id="remember" name="remember" class="checkbox mr-2 !accent-[#ff0000]">
                            <label for="remember" class="text-sm text-gray-600">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-[#ff0000]">Forgot your password?</a>
                    </div>
                    <button type="submit" class="w-full font-bold bg-[#ff0000] text-white py-2 rounded-md" name="admin_login">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>
