<header class="fixed md:relative w-full md:static top-0 z-50">
    <!-- Top Section -->
    <!-- <section class="bg-teal-500 relative overflow-hidden z-50 hidden md:block">
        <div class="container mx-auto md:flex flex-row justify-between py-3 text-white text-sm px-4">
            <div class="flex flex-row space-x-5 font-semibold">
                <p class="flex flex-row space-x-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"></path>
                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"></path>
                    </svg>
                    <span>Mon - Fri: 10:00 - 18:00</span>
                </p>
            </div>
            <div class="social flex flex-row space-x-3 items-center">
                <a href="https://www.linkedin.com/in/enigmait"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"></path>
                    </svg></a>
                <a href="https://www.facebook.com/enigmaitservice"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                    </svg></a>
            </div>
        </div>
    </section> -->

    <!-- Middle Section -->
    <section class="w-full bg-white text-black shadow-lg border-b">
        <div class="container mx-auto px-2 lg:px-4 py-2 flex justify-between items-center">
            <!-- Logo & Name -->
            <a href="./">
                <img src="../assets/logo.png" alt="<?php echo site_name ?>" class="w-28 md:w-32">
            </a>


            <div class="hidden md:grid grid-cols-2 gap-8 text-lg">
                <div class="flex gap-3 items-center">
                    <i class="bi bi-telephone-forward text-5xl text-[#86776f]"></i>
                    <div class="flex flex-col">
                        <span class="text-base">Contact Us</span>
                        <span class="font-bold">+9165159196516</span>
                    </div>

                </div>
                <div class="flex gap-3 items-center">
                    <i class="bi bi-envelope-at text-5xl text-[#86776f]"></i>
                    <div class="flex flex-col">
                        <span class="text-base">Send Email</span>
                        <span class="font-bold">info@paperdeals.in</span>
                    </div>

                </div>
            </div>

            <!-- Mobile Menu Toggler-->
            <a onclick="$('#mobileMenu').slideToggle(200)" class="md:hidden cursor-pointer text-2xl font-bold focus-within:bg-gray-200 hover:bg-gray-300 rounded p-2">
                <i class="bi bi-list"></i>
            </a>
        </div>
    </section>

    <!-- Mobilemenu Section -->
    <nav class="md:hidden">
        <div id="mobileMenu" class="hidden w-full fixed top-18 flex flex-col gap-3 divide-y divide-[#9d9e9e] bg-[#86776f] text-white text-xl px-4 py-2 min-h-80 font-bold">
            <a href="buyer" class="py-2 flex flex-row gap-4 items-center"><i class="bi bi-house-door-fill"></i> Home</a>
            <a href="buyer" class="py-2 flex flex-row gap-4 items-center"><i class="bi bi-cart-check-fill"></i> Buyers</a>
            <a href="seller" class="py-2 flex flex-row gap-4 items-center"><i class="bi bi-shop-window"></i> Sellers</a>
            <a href="buyer" class="py-2 flex flex-row gap-4 items-center"><i class="bi bi-headset"></i> Consultants</a>
            <a href="buyer" class="py-2 flex flex-row gap-4 items-center"><i class="bi bi-cash-coin"></i> Spot Price</a>
            <a href="buyer" class="py-2 flex flex-row gap-4 items-center"><i class="bi bi-play-circle-fill"></i> Videos</a>
            <div class="relative">
                <a onclick="$('#mobileloginMenu').slideToggle(200)" class="flex cursor-pointer flex-row items-center text-white gap-4 py-2 ">
                    <i class="bi bi-card-checklist"></i>
                    <div class="flex w-full justify-between items-center">
                        <span>Login</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </a>
                <div id="mobileloginMenu" class="hidden font-semibold flex flex-col divide-y divide-[#9d9e9e] px-4">
                    <a href='creategrn.php' class="flex flex-row items-center text-white gap-4 py-2 ">
                        <i class="bi bi-cart-check-fill"></i>
                        <span>Buyers</span>
                    </a>
                    <a href='returnofrentals.php' class="flex flex-row items-center text-white gap-4 py-2 ">
                        <i class="bi bi-shop-window"></i>
                        <span>Sellers</span>
                    </a>
                    <a href='grn.php' class="flex flex-row items-center text-white gap-4 py-2 ">
                        <i class="bi bi-person-fill-lock"></i>
                        <span>Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>


<!-- Bottom Section -->
<nav class="sticky z-40 shadow-lg top-0 border-b hidden md:flex gap-5 lg:gap-10 transition-all items-center text-lg font-semibold text-white bg-[#86776f] justify-center p-4">
    <a href="" class="flex items-center gap-2 drop-shadow-lg border-b border-transparent hover:border-white"><i class="bi bi-house-door-fill"></i> Home</a>
    <a href="" class="flex items-center gap-2 drop-shadow-lg border-b border-transparent hover:border-white"><i class="bi bi-cart-check-fill"></i> Buyers</a>
    <a href="" class="flex items-center gap-2 drop-shadow-lg border-b border-transparent hover:border-white"><i class="bi bi-shop-window"></i> Sellers</a>
    <a href="" class="flex items-center gap-2 drop-shadow-lg border-b border-transparent hover:border-white"><i class="bi bi-headset"></i> Consultants</a>
    <a href="" class="flex items-center gap-2 drop-shadow-lg border-b border-transparent hover:border-white"><i class="bi bi-cash-coin"></i> Spot Price</a>
    <a href="" class="flex items-center gap-2 drop-shadow-lg border-b border-transparent hover:border-white"><i class="bi bi-play-circle-fill"></i> Videos</a>
    <div class="flex gap-5 items-center relative">
        <a onclick="$('#loginMenu').slideToggle()" class="flex cursor-pointer items-center gap-2 drop-shadow-lg border-b border-transparent"><i class="bi bi-person-circle"></i> Login <i class="bi bi-chevron-down"></i></a>
        <div id="loginMenu" class="flex px-5 font-semibold flex text-[#86776f] text-base flex-col gap-3 top-10 absolute shadow border rounded bg-white hidden divide-y divide-gray-300">
            <a href="buyer" class="py-2 flex flex-row gap-2 items-center"><i class="bi bi-cart-check-fill"></i> Buyers</a>
            <a href="seller" class="py-2 flex flex-row gap-2 items-center"><i class="bi bi-shop-window"></i> Sellers</a>
            <a href="admin" class="py-2 flex flex-row gap-2 items-center"><i class="bi bi-person-fill-lock"></i> Admin</a>
        </div>
    </div>
</nav>