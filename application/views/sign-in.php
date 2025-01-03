<!DOCTYPE html>
<html class="h-full bg-white" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <script src="<?= base_url('assets/js/tailwind-config.js') ?>"></script>
    <script src="<?= base_url('assets/js/tailwind-plugins-3.4.js') ?>"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="h-full">
    <div class="font-[sans-serif] bg-white max-w-xl flex items-center mx-auto md:h-screen p-4">
        <div class="w-full items-center shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-xl overflow-hidden">
            <form action="<?= site_url('user/login') ?>" method="POST" class="md:col-span-2 w-full py-6 px-6 sm:px-16">
                <div class="mb-6">
                    <h3 class="text-gray-800 text-2xl font-bold">Sign in your account</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="email" class="text-gray-800 text-sm mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input id="email" name="email" type="email" required class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500" placeholder="Enter email" />
                        </div>
                    </div>

                    <div>
                        <label for="password" class="text-gray-800 text-sm mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input id="password" name="password" type="password" required class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500" placeholder="Enter password" />
                        </div>
                    </div>
                </div>

                <div class="!mt-12">
                    <button type="submit" class="w-full py-3 px-4 tracking-wider text-sm rounded-md text-white bg-gray-700 hover:bg-gray-800 focus:outline-none">
                        Login
                    </button>
                </div>
                <p class="text-gray-800 text-sm mt-6 text-center">Don't have an account? <a href="<?= site_url('sign-up') ?>" class="text-blue-600 font-semibold hover:underline ml-1">Sign up</a></p>
            </form>
        </div>
    </div>
</body>

</html>