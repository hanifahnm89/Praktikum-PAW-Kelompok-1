<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lumina Landing Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', inter;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #f7f7fb;
        }

        .glass {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(18px);
        }

        .hero-shadow {
            box-shadow: 0 20px 60px rgba(103, 90, 255, 0.18);
        }

        .card-shadow {
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.06);
        }

        .gradient-btn {
            background: linear-gradient(90deg, #4F2CCB, #6D3DFF);
        }

        .section-title {
            color: #4c1d95;
            font-weight: 700;
            font-size: 15px;
        }

        .main-gradient {
            background: linear-gradient(90deg, #3c4dc7, #9d8df5);
        }
    </style>
</head>

<body class="text-slate-900">

    <!-- NAVBAR -->
    <header class="px-8 lg:px-16 py-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-lumina.png') }}" class="h-22" alt="logo">
        </div>

        <nav class="hidden lg:flex items-center gap-10 font-semibold text-[14px]">
            <a href="#features">Features</a>
            <a href="#HowItWorks">How it Works</a>
            <a href="#testimonials">Testimonials</a>
            <a href="#faq">FAQ</a>
        </nav>

        <div class="flex items-center gap-6">
            <a href="{{ route('login') }}" class="font-semibold text-[14px]">Log in</a>
            <a href="{{ route('register') }}" class="gradient-btn text-white px-7 py-3 rounded-xl text-[14px] font-bold">
                Get Started
            </a>
        </div>
    </header>

    <!-- HERO -->
    <section class="px-8 lg:px-16 pt-10 pb-20 relative overflow-hidden">
        <img src="{{ asset('images/decor-lumina.png') }}"
            class="absolute top-9 right-[16%] w-[700px] opacity-100 z-0">

        <img src="{{ asset('images/decor-home.png') }}"
            class="absolute top-32 right-[14%] w-[650px] opacity-100 z-0">

        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <!-- LEFT -->
            <div>
                <p class="section-title mb-8">Student Productivity App</p>

                <h1 class="text-[80px] leading-[1.05] font-extrabold tracking-tight">
                    Organize Tasks.<br>
                    Track Deadlines.<br>
                    <span class="bg-gradient-to-r from-violet-500 to-indigo-500 bg-clip-text text-transparent">
                        Stay Productive.
                    </span>
                </h1>

                <p class="mt-8 text-[22px] text-slate-600 leading-relaxed max-w-xl">
                    Lumina helps students manage assignments, track deadlines,
                    and stay on top of every task so you can focus on what really matters.
                </p>

                <div class="flex gap-5 mt-10">
                    <a href="{{ route('register') }}" class="gradient-btn text-white px-9 py-4 rounded-2xl font-bold text-[16px]">
                        Get Started
                    </a>

                    <a href="#" class="border border-violet-300 text-violet-700 px-9 py-4 rounded-2xl font-semibold text-[16px]">
                        Watch Demo
                    </a>
                </div>

                <div class="flex items-center gap-5 mt-10">
                    <div class="flex items-center gap-5 mt-10">
                        <div class="flex -space-x-3">
                            <img src="{{ asset('images/student1.jpg') }}"
                                class="w-12 h-12 rounded-full border-3 border-white object-cover">

                            <img src="{{ asset('images/student2.jpg') }}"
                                class="w-12 h-12 rounded-full border-3 border-white object-cover">

                            <img src="{{ asset('images/student3.jpg') }}"
                                class="w-12 h-12 rounded-full border-3 border-white object-cover">

                            <img src="{{ asset('images/student4.jpg') }}"
                                class="w-12 h-12 rounded-full border-3 border-white object-cover">
                        </div>

                        <p class="text-[15px] text-slate-600 font-medium">
                            Trusted by 1000+ students
                        </p>

                        <!-- RIGHT 
        <div class="relative">
            <div class="absolute w-[340px] h-[340px] bg-indigo-200 rounded-full opacity-60 right-20 top-10"></div>

            <!--<div class="relative bg-white rounded-[34px] border border-slate-200 hero-shadow p-5 z-10">-->
                        <!--<img src="{{ asset('dashboard-preview.png') }}" class="rounded-[28px] w-full" alt="">-->
                    </div>
                </div>
            </div>
    </section>

    <!-- UNIVERSITIES -->
    <section class="bg-[#ede7ff] py-8">
        <div class="max-w-7xl mx-auto px-8 text-center">
            <h3 class="font-bold text-violet-700 text-[18px] mb-8">Trusted by students from</h3>

            <div class="flex justify-center items-center">
                <img src="{{ asset('images/logo-univ.png') }}" class="h-24 opacity-100 hover:grayscale-0 hover:opacity-100 transition">
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    @php
    $features = [
    [
    'title' => 'Task Management',
    'desc' => 'Create, organize, and prioritize your tasks with ease.',
    'icon' => 'images/feature1.png',
    'border' => 'border-violet-300',
    ],
    [
    'title' => 'Deadline Tracking',
    'desc' => 'Get reminders and never miss important deadlines.',
    'icon' => 'images/feature2.png',
    'border' => 'border-yellow-300',
    ],
    [
    'title' => 'Calendar View',
    'desc' => 'Visualize your schedule and plan your time effectively.',
    'icon' => 'images/feature3.png',
    'border' => 'border-green-300',
    ],
    [
    'title' => 'Productivity Dashboard',
    'desc' => 'Track your progress and stay motivated every day.',
    'icon' => 'images/feature4.png',
    'border' => 'border-pink-300',
    ],
    ];
    @endphp

    <section id="features" class="py-24 px-8 lg:px-16 text-center">
        <p class="text-violet-700 font-semibold text-lg">Features</p>

        <h2 class="text-[48px] md:text-[56px] font-extrabold mt-3 text-slate-900">
            Everything You Need to Stay Organized
        </h2>

        <p class="text-slate-500 mt-4 text-[18px] md:text-[20px] max-w-4xl mx-auto">
            Powerful tools designed for students to manage tasks, deadlines, and productivity.
        </p>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-16">

            @foreach($features as $item)
            <div class="bg-white rounded-[32px] border {{ $item['border'] }} p-8 text-left shadow-md hover:shadow-xl transition duration-300">

                <img src="{{ asset($item['icon']) }}"
                    class="h-[230px] w-auto -ml-14 -mt-16 -mb-12 object-contain object-left"
                    alt="{{ $item['title'] }}">

                <h3 class="font-bold text-[22px] text-slate-900 mb-2 leading-tight">
                    {{ $item['title'] }}
                </h3>

                <p class="text-slate-600 text-[16px] leading-relaxed">
                    {{ $item['desc'] }}
                </p>
            </div>
            @endforeach

        </div>
    </section>

    <!-- HOW IT WORKS -->
    @php
    $steps = [
    [
    'no' => '1',
    'title' => 'Create Your Tasks',
    'desc' => 'Add assignments, projects, and daily tasks.',
    'color' => 'bg-violet-400',
    'icon' => 'step1.png'
    ],
    [
    'no' => '2',
    'title' => 'Set Deadlines',
    'desc' => 'Get reminders and stay on track.',
    'color' => 'bg-amber-400',
    'icon' => 'step2.png'
    ],
    [
    'no' => '3',
    'title' => 'Stay Productive',
    'desc' => 'Track progress and achieve your goals.',
    'color' => 'bg-emerald-500',
    'icon' => 'step3.png'
    ],
    ];
    @endphp

    <section id="how-it-works" class="py-24 px-8 lg:px-16 text-center">
        <p class="text-violet-700 font-semibold text-lg uppercase tracking-wider">How it Works</p>
        <h2 class="text-[40px] md:text-[52px] font-extrabold mt-3 text-slate-900">Get Started in 3 Simple Steps</h2>
        <p class="text-slate-500 mt-4 text-[18px] max-w-2xl mx-auto">
            Lumina makes productivity simple and effective.
        </p>

        <div class="relative mt-20">
            <div class="hidden md:block absolute top-24 left-0 w-full border-t-2 border-dashed border-slate-300 z-0"></div>

            <div class="grid md:grid-cols-3 gap-12 relative z-10">
                @foreach($steps as $step)
                <div class="flex flex-col items-center">
                    <div class="w-48 h-48 {{ $step['color'] }} rounded-full flex items-center justify-center shadow-lg mb-8 border-8 border-white">
                        <img src="{{ asset('images/' . $step['icon']) }}" class="h-24 w-auto object-contain" alt="icon">
                    </div>

                    <div class="bg-violet-400 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mb-6 shadow-md">
                        {{ $step['no'] }}
                    </div>

                    <h3 class="text-2xl font-bold text-slate-900 mb-3">{{ $step['title'] }}</h3>
                    <p class="text-slate-500 max-w-[250px] leading-relaxed">
                        {{ $step['desc'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- BIG CTA VISUAL -->
    <section class="px-8 lg:px-16 pb-24">
        <div class="main-gradient rounded-[36px] px-14 py-16 text-white">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <p class="uppercase text-sm font-semibold tracking-wider">See Lumina in Action</p>
                    <h2 class="text-[54px] font-extrabold mt-5 leading-tight">
                        Your All-in-One<br>Study Companion
                    </h2>
                    <p class="mt-6 text-indigo-100 text-[19px] leading-relaxed">
                        Explore how Lumina helps you manage tasks, deadlines, and your study schedule seamlessly.
                    </p>
                    <p class="text-slate-200 mt-6 text-[18px] max-w-xl">
                        Explore how Lumina helps you manage tasks, deadlines, and your study schedule seamlessly.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-10">
                        <a href="#features" class="bg-white text-violet-700 px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-100 transition shadow-lg">
                            Explore Features
                        </a>

                        <a href="#" class="flex items-center gap-2 border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-violet-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                            </svg>
                            Watch Demo
                        </a>
                    </div>
                </div>

                <div>
                    <img src="{{ asset('images/showcase.png') }}" class="w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL -->
    @php
    $testimonials = [
    [
    'name' => 'Ni Putu',
    'univ' => 'Universitas Brawijaya',
    'text' => 'Lumina bener-bener ngebantu aku buat track deadline tugas kuliah yang numpuk banget setiap minggu. Gak ada lagi drama lupa tugas!',
    'image' => 'images/student3.jpg'
    ],
    [
    'name' => 'Sarah Wijaya',
    'univ' => 'Telkom University',
    'text' => 'Fitur Calendar View-nya juara banget! Aku bisa lihat jadwal belajar dan nugas secara visual, jadi lebih teratur waktunya.',
    'image' => 'images/student2.jpg'
    ],
    [
    'name' => 'Hanifah Nur',
    'univ' => 'Universitas Indonesia',
    'text' => 'Aplikasi produktivitas paling simpel tapi dapet banget fungsinya. Tampilannya bersih, bikin semangat buat nyelesein task.',
    'image' => 'images/student1.jpg'
    ],
    ];
    @endphp

    <section id="testimonials" class="py-24 px-8 lg:px-16 text-center">
        <p class="text-violet-700 font-semibold text-lg uppercase tracking-wider">Testimonials</p>
        <h2 class="text-[40px] md:text-[50px] font-extrabold mt-3 text-slate-900">Loved by Students</h2>

        <div class="grid md:grid-cols-3 gap-8 mt-16">
            @foreach($testimonials as $testi)
            <div class="bg-white rounded-[28px] p-8 border border-slate-200 shadow-sm hover:shadow-md transition text-left">
                <img src="{{ asset($testi['image']) }}"
                    class="h-14 w-14 rounded-full mb-5 object-cover"
                    alt="{{ $testi['name'] }}">

                <p class="text-slate-600 leading-relaxed italic">
                    "{{ $testi['text'] }}"
                </p>

                <div class="mt-6">
                    <h4 class="font-bold text-slate-900 text-lg">{{ $testi['name'] }}</h4>
                    <p class="text-violet-600 text-sm font-medium">{{ $testi['univ'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="py-25 px-8">
        <div class="max-w-[97%] mx-auto bg-gradient-to-br from-[#1E3A8A] via-[#5b5fd7] to-[#C4B5FD] rounded-[40px] p-12 md:p-20 text-center text-white shadow-2xl">

            <p class="uppercase tracking-[0.2em] font-semibold text-sm opacity-90 mb-4">
                Ready to stay on top of your task?
            </p>

            <h2 class="text-[40px] md:text-[56px] font-extrabold mb-6 leading-tight">
                Start Your Productivity Journey Today
            </h2>

            <p class="text-slate-200 text-lg md:text-xl max-w-2xl mx-auto mb-10 opacity-90">
                Join thousands of students who are already more productive with Lumina.
            </p>

            <a href="{{ route('register') }}" class="inline-flex items-center gap-3 bg-white text-violet-700 px-8 py-4 rounded-xl font-bold text-lg hover:bg-slate-100 transition-all transform hover:scale-105 shadow-lg">
                Get Started For Free
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="faq" class="px-8 lg:px-16 py-16 bg-white border-t border-slate-100">
        <div class="grid md:grid-cols-5 gap-12">
            <div>
                <img src="{{ asset('images/logo-lumina.png') }}" class="h-22 mb-5">
                <p class="text-slate-500">Your all-in-one task and deadline manager for student life.</p>
                <div>


                    <div class="flex gap-5 mt-6 text-slate-500">
                        <a href="#" class="hover:text-pink-600 transition-colors">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                        </a>
                        <a href="#" class="hover:text-slate-900 transition-colors">
                            <i class="fa-brands fa-x-twitter text-2xl"></i>
                        </a>
                        <a href="#" class="hover:text-slate-900 transition-colors">
                            <i class="fa-brands fa-github text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-4">Product</h4>
                <ul class="space-y-3 text-slate-500">
                    <li>Features</li>
                    <li>Pricing</li>
                    <li>Changelog</li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4">Company</h4>
                <ul class="space-y-3 text-slate-500">
                    <li>About Us</li>
                    <li>Careers</li>
                    <li>Contact</li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4">Support</h4>
                <ul class="space-y-3 text-slate-500">
                    <li>Help Center</li>
                    <li>FAQ</li>
                    <li>Privacy Policy</li>
                </ul>
            </div>

            <div class="flex items-end justify-end text-slate-400 text-sm">
                © 2026 Lumina. All rights reserved.
            </div>
        </div>
    </footer>

</body>

</html>