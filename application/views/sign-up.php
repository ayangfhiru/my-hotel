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
    <div class="font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto md:h-screen p-4">
        <div class="grid md:grid-cols-3 items-center shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-xl overflow-hidden">
            <div class="max-md:order-1 flex flex-col justify-center space-y-16 max-md:mt-16 min-h-full bg-gradient-to-r from-gray-900 to-gray-700 lg:px-8 px-4 py-4">
                <div>
                    <h4 class="text-white text-lg font-semibold">Create Your Account</h4>
                    <p class="text-[13px] text-gray-300 mt-3 leading-relaxed">Welcome to our registration page! Get started by creating your account.</p>
                </div>
                <div>
                    <h4 class="text-white text-lg font-semibold">Simple & Secure Registration</h4>
                    <p class="text-[13px] text-gray-300 mt-3 leading-relaxed">Our registration process is designed to be straightforward and secure. We prioritize your privacy and data security.</p>
                </div>
            </div>
            <?= form_open(site_url('user/register'), [
                'class' => 'md:col-span-2 w-full py-6 px-6 sm:px-16'
            ]); ?>
            <div class="mb-6">
                <h3 class="text-gray-800 text-2xl font-bold">Create an account</h3>
            </div>
            <div class="space-y-6">
                <div>
                    <?= form_label('Name', 'name', [
                        'class' => 'text-gray-800 text-sm mb-2 block'
                    ]); ?>
                    <div class="relative flex items-center">
                        <?= form_input('name', '', [
                            'id' => 'name',
                            'class' => 'text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500',
                            'required' => ''
                        ]); ?>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div>
                        <?= form_label('Email', 'email', [
                            'class' => 'text-gray-800 text-sm mb-2 block'
                        ]); ?>
                        <?= form_input([
                            'id' => 'email',
                            'name' => 'email',
                            'type' => 'email',
                            'class' => 'text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500',
                            'required' => ''
                        ]); ?>
                    </div>
                    <div>
                        <?= form_label('Phone Number', 'phone_number', [
                            'class' => 'text-gray-800 text-sm mb-2 block'
                        ]); ?>
                        <div class="relative flex items-center">
                            <?= form_input('phone_number', '', [
                                'id' => 'phone_number',
                                'class' => 'text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500',
                                'required' => ''
                            ]); ?>
                        </div>
                    </div>
                </div>
                <div>
                    <?= form_label('Password', 'password', [
                        'class' => 'text-gray-800 text-sm mb-2 block'
                    ]); ?>
                    <?= form_password('password', '', [
                        'id' => 'password',
                        'class' => 'text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500',
                        'required' => ''
                    ]); ?>
                </div>
                <div>
                    <?= form_label('Confirm Password', 'confirm_password', [
                        'class' => 'text-gray-800 text-sm mb-2 block'
                    ]); ?>
                    <div class="relative flex items-center">
                        <?= form_password('confirm_password', '', [
                            'id' => 'confirm_password',
                            'class' => 'text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500',
                            'required' => ''
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="mt-12">
                <button type="submit" class="w-full py-3 px-4 tracking-wider text-sm rounded-md text-white bg-gray-700 hover:bg-gray-800 focus:outline-none">
                    Create an account
                </button>
            </div>
            <p class="text-gray-800 text-sm mt-6 text-center">Already have an account? <a href="<?= site_url('user/login') ?>" class="text-blue-600 font-semibold hover:underline ml-1">Login</a></p>
            <?= form_close(); ?>
        </div>
    </div>
</body>

</html>
