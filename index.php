<?php
$pageTitle = "PAVI Business MasterClass";
require_once "./components/front-head.php";

$event_instance = new events($db);
$events = $event_instance->get_events();
?>

<body
    class='scroll-smooth text-gray-950 dark:text-white bg-gradient-to-br lg:bg-gradient-to-r from-gray-100 via-red-500 to-red-500 bg-grad dark:from-gray-900  dark:via-gray-900 dark:to-gray-900 '>
    <header class="relative overflow-hidden w-full h-fit lg:h-dvh">
        <?php include_once './components/front-nav.php'; ?>
        <div
            class="w-0 h-0 lg:w-64 lg:h-dvh border-0 bg-white/50 lg:border-4  border-white animate__animated animate__fadeInLeft animate__delay-3s z-40 lg:absolute lg:right-[28rem] lg:top-0 grad-skew">
        </div>

        <!-- Form modal -->

        <section
            class="grid grid-cols-1 place-items-center mt-12 lg:mt-0 lg:grid-cols-2 z-30 relative w-full h-full lg:h-dvh lg:-top-[2.5rem]  overflow-hidden">
            <div class="pl-5 lg:pl-20 animate__animated animate__fadeInLeft animate__delay-1s">
                <h2 class="font-bold text-xl lg:text-4xl mb-5">Welcome</h2>
                <h1 class="font-bold text-4xl lg:text-7xl">
                    PAVI Business<br> Owners Academy
                </h1>
                <p class="font-medium text-lg mt-7">
                    Raise your skills and expertise in Business with PAVI
                    BUSINESS OWNER MASTERCLASS. This is a great
                    opportunity to transform your ideas and passion into
                    unparallel mastery that will help you achieve your dream in
                    record time
                </p>
                <a href="#"
                    class="rounded-full cursor-pointer inline-block font-bold italic border-none bg-[#ff0000] text-xl lg:text-3xl text-white py-4 px-8 mt-10">
                    Learn More
                </a>
            </div>

            <div
                class="relative h-0 w-0 lg:absolute  lg:-right-[9rem] lg:h-[62rem] lg:w-6/12 lg:-top-[4rem] overflow-hidden ">

                <img src="img/b-a-hero.png" alt="img/b-a-hero.png"
                    class="hidden lg:inline w-full h-full animate__animated animate__fadeInRight animate__delay-1s">
            </div>
        </section>
    </header>

    <div id="authentication-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[9999] justify-center items-center w-full lg:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 lg:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Register to our platform
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 lg:p-5">
                    <form class="space-y-4" action="#">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                            <div>
                                <label for="firstname"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                    firstname</label>
                                <input type="text" name="firstname" id="firstname"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#ff0000] focus:border-[#ff0000] block w-full p-2.5 "
                                    placeholder="name@company.com" required />
                            </div>
                            <div>
                                <label for="lastname"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                    lastname</label>
                                <input type="text" name="lastname" id="lastname"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#ff0000] focus:border-[#ff0000] block w-full p-2.5 "
                                    placeholder="name@company.com" required />
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#ff0000] focus:border-[#ff0000] block w-full p-2.5 "
                                placeholder="name@company.com" required />
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#ff0000] focus:border-[#ff0000] block w-full p-2.5 "
                                required />
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-[#ff0000] hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Register
                        </button>
                        <!-- <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                            Not registered? <a href="#" class="text-red-700 hover:underline dark:text-red-500">Create
                                account</a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <main class="px-5 lg:px-20 my-28 space-y-28" id="how-it-works">
        <section
            class="grid grid-cols-1 lg:grid-cols-2 lg:gap-10 bg-white dark:bg-gray-950 py-10 rounded-lg px-6 lg:px-20">
            <div class="flex justify-center items-center order-2 lg:order-1">
                <div class="border-2 border-[#ff0000] dark:border-gray-50 rounded-lg px-6 py-9 relative">
                    <div
                        class="flex justify-center items-center size-10 bg-[#ff0000] dark:bg-gray-950 border-4 border-white absolute -left-2 -top-2 rounded-full">
                        <svg class="w-9/12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="">
                        <h2 class="text-3xl lg:text-4xl font-bold mb-6">
                            Unlock Your Business's Full Potential with Experts’ Guidance and Actionable Strategies
                        </h2>
                        <p class="text-lg m-auto ">
                            PAVI Business Owners MasterClass helps
                            you navigate challenges, boost growth, and achieve lasting
                            success. It also enables you to gain invaluable insights, connect
                            with fellow entrepreneurs, and scale your business to new
                            heights. Join us and transform your entrepreneurial journey
                            today
                        </p>
                    </div>
                </div>
            </div>

            <!-- Carousel to see events -->
            <?php include_once COMPONENT_DIR . "event-carousel.php"; ?>

        </section>

        <section
            class="bg-white dark:bg-gray-950 grid grid-cols-1 gap-10 lg:gap-0 w-full  lg:grid-cols-2 place-items-center rounded-lg shadow-2xl mb-28 px-9 py-14 ">
            <div class="order-1 lg:order-2">

                <div class="border-2 border-[#ff0000] dark:border-gray-50 rounded-lg px-6 py-9 relative">
                    <div
                        class="flex justify-center items-center size-10 bg-[#ff0000] dark:bg-gray-950 border-4 border-white absolute -right-2 -top-2 rounded-full">
                        <svg class="w-9/12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z" />
                        </svg>
                    </div>
                    <h3 class="bg-[#ff0000] w-fit text-2xl lg:text-4xl font-extrabold text-white rounded-md p-3 mb-5">
                        What to Achieve:
                    </h3>
                    <p class="text-lg lg:text-xl font-light">
                        To educate people on relevant skills and knowledge towards
                        economic empowerment to give their lives a meaning through
                        the use of the tools on PAVI platform.
                    </p>
                </div>

            </div>
            <div class="w-full lg:w-6/12 h-80">
                <img src="img/target.jpg" alt="" class="w-full h-full rounded-2xl">
            </div>
        </section>
        <section
            class="bg-white dark:bg-gray-950 grid grid-cols-1 gap-10 lg:gap-0 w-full  lg:grid-cols-2 place-items-center rounded-lg shadow-2xl mb-28 px-9 py-14 ">
            <div class="order-2 lg:order-1">

                <div class="border-2 border-[#ff0000] dark:border-gray-50 rounded-lg px-6 py-9 relative">
                    <div
                        class="flex justify-center items-center size-10 bg-[#ff0000] dark:bg-gray-950 border-4 border-white absolute -left-2 -top-2 rounded-full">

                        <svg class="w-9/12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="bg-[#ff0000] w-fit text-2xl lg:text-4xl font-extrabold text-white rounded-md p-3 mb-5">
                        Why Pavi Business Owners MasterClass?
                    </h3>
                    <p class="text-lg lg:text-2xl font-light ">
                        It provides unparalleled strategic benefits to Business Owners
                        in the following ways;
                    </p>
                    <ul class="list-disc pl-5 my-10 text-sm lg:text-md font-light space-y-3">
                        <li>
                            Expert Guidance: Learn from industry leaders with proven
                            success
                        </li>
                        <li>
                            Actionable Strategies: Implement practical techniques to
                            drive growth.
                        </li>
                        <li>
                            Networking Opportunities: Connect with like-minded
                            entrepreneurs.
                        </li>
                        <li>
                            Problem-solving skills: Overcome challenges with
                            confidence.
                        </li>
                        <li>
                            Business Growth: Unlock your business’s full potential.
                        </li>
                        <li>
                            Lasting Success: Achieve sustainable and profitable results
                        </li>
                        <li>
                            Growth Acceleration: Opportunity to scale your business
                            quickly and sustainably.
                        </li>
                        <li>
                            Unlimited Access to Fund: Connect with a pool of financial
                            supporters
                        </li>
                    </ul>

                </div>
            </div>
            <div class="w-full lg:w-9/12 h-80 order-1 lg:order-2">
                <img src="img/question-symbl.jpg" alt="" class="w-full h-full rounded-2xl">
            </div>
        </section>
        <section
            class="bg-white dark:bg-gray-950 grid grid-cols-1 gap-10 lg:gap-0 w-full  lg:grid-cols-2 place-items-center rounded-lg shadow-2xl mb-28 px-9 py-14 ">
            <div class="order-1 lg:order-2">

                <div class="border-2 border-[#ff0000] dark:border-gray-50 rounded-lg px-6 py-9 relative">
                    <div
                        class="flex justify-center items-center size-10 bg-[#ff0000] dark:bg-gray-950 border-4 border-white absolute -right-2 -top-2 rounded-full">

                        <svg class="w-9/12 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <h3 class="bg-[#ff0000] w-fit text-2xl lg:text-4xl font-extrabold text-white rounded-md p-3 mb-5">
                        Who can join the Master Class?
                    </h3>

                    <ul class="list-disc pl-5 my-10 text-sm lg:text-md font-light space-y-3">
                        <li>
                            Young Men & Women Aspiring to Start Business
                        </li>
                        <li>
                            Men and Women in Business

                        </li>
                        <li>
                            Career Men & Women Aspiring to Start Business
                        </li>
                        <li>
                            Students of Higher Institutions and Corps Members

                        </li>
                        <li>
                            Retirees and those planning for retirement

                        </li>
                    </ul>

                </div>

            </div>
            <div class="w-full lg:w-9/12 h-80">
                <img src="https://img.freepik.com/premium-vector/speech-bubble-with-word-register-now-red-label-vector-stock-illustration_1072830-970.jpg"
                    alt="" class="w-full h-full rounded-2xl">

            </div>
        </section>
        <section>
            <a href="register.php"
                class="bg-[#ff0000] ml-auto w-fit inline-block text-3xl lg:text-5xl font-bold text-white rounded-lg px-5 py-3 mb-5">
                Register Now
            </a>
        </section>
    </main>

    <?php include_once COMPONENT_MODAL_DIR . 'verify-certificate.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script>
        //bg-white, text-text-text-black
        window.addEventListener('DOMContentLoaded', () => {

        })
        document.addEventListener('scroll', () => {
            const scrollPosition = window.scrollY || document.documentElement.scrollTop;
            const nav = document.querySelector('nav');
            const headerSec = document.querySelector('header section');
            console.log(scrollPosition)
            if (scrollPosition > 0) {
                headerSec.classList.remove('lg:-top-[2.5rem]');
                nav.classList.add('fixed', 'top-0', 'text-black', 'bg-white', 'dark:bg-gray-950', 'dark:text-white');
                nav.classList.remove('relative');
            } else {
                nav.classList.remove('fixed', 'top-0', 'text-black', 'bg-white', 'dark:bg-gray-950', 'dark:text-white');
                nav.classList.add('relative');
                headerSec.classList.add('lg:-top-[2.5rem]');
            }
        });
    </script>
</body>

</html>