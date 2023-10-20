<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
</head>

<body class="antialiased min-h-screen flex w-full items-center justify-center">

    <div class="flex justify-center self-center">
        <div class=" bg-white mb-2 mx-auto rounded-2xl w-100">
            <div class="w-80">
                <img src="assets/Logo.png">
            </div>
            <form id="login" method="post">
                @csrf
                <div class="space-y-5">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 tracking-wide">Username</label>
                        <input class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none" type="" placeholder="Enter your username" name="username" id="username" required>
                    </div>

                    <!--ENTER PASSWORD-->
                    <div class="space-y-2">
                        <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                            Password
                        </label>
                        <input class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none" type="password" placeholder="Enter your password" name="password" id="password" required>
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center bg-teal-600 hover:bg-teal-500 text-gray-100 p-3  
                rounded-lg font-semibold  shadow-lg cursor-pointer transition ease-in duration-200 dark:bg-teal-500 ">
                            Sign in
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('login');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Serialize form data
                const formData = new FormData(form);

                fetch('/login-user', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add your CSRF token here
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Handle a successful response (e.g., show success message)
                            alert('Login successfully.');
                            // You can also reset the form or redirect to another page
                            location.reload();
                        } else {
                            // Handle errors (e.g., show error message)
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>

</body>


</html>