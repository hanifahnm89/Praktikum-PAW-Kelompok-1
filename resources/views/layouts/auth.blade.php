<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina - @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2D3E8B',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <div class="w-full lg:w-1/2 p-8 lg:p-20 flex flex-col justify-center bg-white">
            <div class="max-w-md mx-auto w-full">
                <div class="flex items-center gap-2 mb-12">
                    <img src="{{ asset('images/logo-lumina.png') }}" class="h-8" alt="Lumina Logo">
                </div>

                @yield('form_content')
            </div>
        </div>

        <div class="hidden lg:flex lg:w-1/2 bg-primary p-20 flex-col justify-center items-center text-white relative">
            <div class="text-center">
                <img src="@yield('side_image')" class="max-w-xs mx-auto mb-12 shadow-2xl rounded-2xl" alt="Illustration">
                
                <h2 class="text-4xl font-bold mb-4">@yield('side_title', 'Welcome to Lumina')</h2>
                <p class="text-blue-100 opacity-80 text-lg">@yield('side_desc', 'Organize your tasks easily.')</p>
                
                <div class="flex gap-2 mt-12 justify-center">
                    <div class="w-8 h-2 bg-white rounded-full"></div>
                    <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                    <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>