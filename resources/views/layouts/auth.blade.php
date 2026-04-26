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
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    },
                    animation: {
                        float: 'float 3s ease-in-out infinite',
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
                    <img src="{{ asset('images/logo-lumina.png') }}" class="h-14" alt="Lumina Logo">
                </div>

                @yield('form_content')
            </div>
        </div>

        <div class="hidden lg:flex lg:w-1/2 bg-primary p-20 flex-col justify-center items-center text-white relative">
            <div class="text-center">
                <img id="side-img" src="@yield('side_image')" class="max-w-xs mx-auto mb-12 animate-float drop-shadow-2xl" alt="Illustration">

                <h2 id="side-title" class="text-4xl font-bold mb-4">@yield('side_title', 'Welcome to Lumina')</h2>
                <p id="side-desc" class="text-blue-100 opacity-80 text-lg">@yield('side_desc', 'Organize your tasks easily.')</p>

                <div class="flex gap-2 mt-12 justify-center">
                    <div id="dot-0" class="indicator w-8 h-2 bg-white rounded-full transition-all duration-300"></div>
                    <div id="dot-1" class="indicator w-2 h-2 bg-blue-400 rounded-full transition-all duration-300"></div>
                    <div id="dot-2" class="indicator w-2 h-2 bg-blue-400 rounded-full transition-all duration-300"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const data = [
            { 
                img: '{{ asset("images/note.png") }}', 
                title: 'Welcome to Lumina', 
                desc: 'Organize your tasks easily.' 
            },
            { 
                img: '{{ asset("images/stamp.png") }}',
                title: 'Stay On Track', 
                desc: 'Never miss a deadline again.' 
            },
            { 
                img: '{{ asset("images/clock.png") }}', 
                title: 'Reach Your Goals', 
                desc: 'Focus on what matters most.' 
            }
        ];

        let index = 0;

        function updateCarousel() {
            const sideImg = document.getElementById('side-img');
            const sideTitle = document.getElementById('side-title');
            const sideDesc = document.getElementById('side-desc');

            if(sideImg && sideTitle && sideDesc) {
                sideImg.style.opacity = 0;
                
                setTimeout(() => {
                    sideImg.src = data[index].img;
                    sideTitle.innerText = data[index].title;
                    sideDesc.innerText = data[index].desc;
                    sideImg.style.opacity = 1;

                    // Update Indikator Titik
                    document.querySelectorAll('.indicator').forEach((dot, i) => {
                        if(i === index) {
                            dot.classList.remove('w-2', 'bg-blue-400');
                            dot.classList.add('w-8', 'bg-white');
                        } else {
                            dot.classList.remove('w-8', 'bg-white');
                            dot.classList.add('w-2', 'bg-blue-400');
                        }
                    });
                }, 300);
            }
        }

        function nextSlide() {
            index = (index + 1) % data.length;
            updateCarousel();
        }

        setInterval(nextSlide, 3000);
    </script>
</body>
</html>