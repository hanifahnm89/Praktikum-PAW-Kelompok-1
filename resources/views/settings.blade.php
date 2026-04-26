@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <x-sidebar />

    <main class="ml-64 flex-1 p-12">
        <h2 class="text-3xl font-bold text-primary mb-8">Settings</h2>

        <div class="bg-white rounded-[32px] p-10 shadow-sm border border-gray-100">
            <div class="flex gap-10 border-b border-gray-100 mb-10">
                <button id="tab-account"
                    class="tab-btn pb-4 border-b-2 border-primary text-primary font-bold text-sm">
                    Account Setting
                </button>

                <button id="tab-security"
                    class="tab-btn pb-4 border-b-2 border-primary text-primary font-bold text-sm">
                    Login & Security
                </button>

                <button id="tab-notification"
                    class="tab-btn pb-4 border-b-2 border-primary text-primary font-bold text-sm">
                    Notifications
                </button>
            </div>

            <!-- ACCOUNT CONTENT -->
            <div id="content-account">
                <form action="#" method="POST">
                    <div class="mb-10">
                        <p class="text-gray-500 text-xs font-bold mb-4">Your Profile Picture</p>
                        <label class="w-28 h-28 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition">
                            <i class="ph ph-image-plus text-3xl text-gray-300 mb-1"></i>
                            <span class="text-[10px] text-gray-300 font-medium text-center px-2">Upload your photo</span>
                            <input type="file" class="hidden">
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                        <x-common.form-input label="Full name" placeholder="Please enter your full name" />
                        <x-common.form-input label="Username" placeholder="Please enter your username" />

                        <x-common.form-input label="Email" placeholder="Please enter your email" />
                        <x-common.form-input label="Role" placeholder="Please enter your role" />

                        <div class="relative w-full">
                            <label class="absolute -top-2.5 left-4 bg-white px-1.5 text-[11px] text-gray-400 font-medium z-10">Phone number</label>
                            <div class="flex border border-gray-300 rounded-lg overflow-hidden focus-within:border-primary transition">
                                <span class="bg-gray-50 px-4 py-3 text-gray-400 text-sm border-r border-gray-100">+62</span>
                                <input type="text" placeholder="Please enter your phone number" class="w-full px-4 py-3 outline-none text-sm placeholder:text-gray-200">
                            </div>
                        </div>

                        <x-common.form-input label="Country" placeholder="Please enter your country" />
                    </div>

                    <div class="flex items-center gap-8 mt-12">
                        <button type="submit" class="bg-primary text-white px-10 py-3 rounded-xl font-bold text-sm shadow-lg hover:opacity-90 transition">
                            Update Profile
                        </button>
                        <button type="reset" class="text-gray-400 font-bold text-sm hover:text-gray-600 transition">
                            Reset
                        </button>
                    </div>
                </form>
            </div>

            <!-- SECURITY CONTENT -->
            <div id="content-security" class="hidden">

                <!-- CHANGE PASSWORD -->
                <div class="mb-10">
                    <h2 class="text-lg font-semibold mb-1">Change Password</h2>
                    <p class="text-sm text-gray-400 mb-4">
                        Update your password to keep your account secure
                    </p>

                    <input type="password"
                        class="w-full px-4 py-3 border rounded-xl mb-2"
                        placeholder="Current Password">

                    <p class="text-xs text-gray-400 mb-4">
                        Last changed 12 July 2026
                    </p>

                    <div class="flex justify-end">
                        <button class="bg-primary text-white px-6 py-3 rounded-xl text-sm">
                            Update Password
                        </button>
                    </div>
                </div>

                <!-- ACCOUNT LOGIN ACTIVITY -->
                <div class="mb-10">
                    <h2 class="text-lg font-semibold mb-1">Account login activity</h2>
                    <p class="text-sm text-gray-400 mb-4">
                        You’re currently logged in on these devices:
                    </p>

                    @foreach($sessions as $session)
                    @php
                    $isCurrent = session()->getId() === $session->id;
                    $agent = json_decode($session->user_agent);
                    @endphp

                    <div class="border rounded-2xl p-4 flex items-center gap-4 mb-3">
                        <i class="ph ph-laptop text-2xl text-gray-600"></i>

                        <div>
                            <p class="font-semibold">
                                {{ $agent->browser ?? 'Device' }}
                            </p>

                            <p class="text-sm text-gray-400">
                                {{ $session->ip_address }}
                            </p>

                            <span class="text-xs {{ $isCurrent ? 'text-green-500' : 'text-gray-400' }}">
                                {{ $isCurrent ? 'This device' : \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>




                <!-- OTHER DEVICES -->
                <h3 class="text-sm font-semibold mb-3">Logins on other devices</h3>

                <div class="border rounded-2xl divide-y">

                    <div class="p-4 flex items-center gap-4">
                        <i class="ph ph-device-tablet text-xl text-gray-500"></i>
                        <div>
                            <p class="font-medium">iPad Gen 10</p>
                            <p class="text-sm text-gray-400">Malang, Indonesia</p>
                            <span class="text-xs text-gray-400">about an hour ago</span>
                        </div>
                    </div>

                    <div class="p-4 flex items-center gap-4">
                        <i class="ph ph-device-mobile text-xl text-gray-500"></i>
                        <div>
                            <p class="font-medium">iPhone 17 Pro</p>
                            <p class="text-sm text-gray-400">Malang, Indonesia</p>
                            <span class="text-xs text-gray-400">17 hours ago</span>
                        </div>
                    </div>

                    <div class="p-4 flex items-center gap-4">
                        <i class="ph ph-laptop text-xl text-gray-500"></i>
                        <div>
                            <p class="font-medium">Asus</p>
                            <p class="text-sm text-gray-400">Malang, Indonesia</p>
                            <span class="text-xs text-gray-400">at 07:12 on 21 February 2026</span>
                        </div>
                    </div>

                    <div class="p-4 text-red-500 text-sm font-medium cursor-pointer">
                        Select devices to log out
                    </div>

                </div>
            </div>

        </div>


        <!-- NOTIFICATION CONTENT -->
        <div id="content-notification" class="hidden">

            <div class="grid grid-cols-2 gap-10">

                <!-- LEFT -->
                <div>

                    <!-- EMAIL -->
                    <h3 class="text-lg font-semibold mb-4">Email Notification</h3>

                    <div class="space-y-4 mb-10">

                        <!-- ITEM -->
                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Task Reminders</span>

                            <div class="relative">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-[#6d3df5] transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Upcoming deadline</span>

                            <div class="relative">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-[#6d3df5] transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Product Update</span>

                            <div class="relative">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-[#6d3df5] transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                    </div>

                    <!-- PUSH -->
                    <h3 class="text-lg font-semibold mb-4">Push Notification</h3>

                    <div class="space-y-4">

                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Task assigned to you</span>

                            <div class="relative">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-[#6d3df5] transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Task due soon</span>

                            <div class="relative">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-[#6d3df5] transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Task complete</span>

                            <div class="relative">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-[#6d3df5] transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                    </div>

                </div>


                <!-- RIGHT -->
                <div>

                    <div>
                        <h3 class="font-semibold text-gray-800 mb-4">Reminder Settings</h3>

                        <div class="space-y-3">

                            <!-- OPTION -->
                            <label class="flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer group">
                                <span class="text-sm text-gray-700">10 Minutes</span>

                                <div class="relative">
                                    <input type="radio" name="reminder" class="peer hidden" checked>

                                    <!-- OUTER CIRCLE -->
                                    <div class="w-5 h-5 rounded-full border-2 border-purple-500 flex items-center justify-center">

                                        <!-- INNER DOT -->
                                        <div class="w-2.5 h-2.5 bg-purple-600 rounded-full hidden peer-checked:block"></div>

                                    </div>
                                </div>
                            </label>

                            <label class="flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer">
                                <span class="text-sm text-gray-700">30 Minutes</span>

                                <div class="relative">
                                    <input type="radio" name="reminder" class="peer hidden">

                                    <div class="w-5 h-5 rounded-full border-2 border-purple-500 flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 bg-purple-600 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>

                            <label class="flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer">
                                <span class="text-sm text-gray-700">1 Hour</span>

                                <div class="relative">
                                    <input type="radio" name="reminder" class="peer hidden">

                                    <div class="w-5 h-5 rounded-full border-2 border-purple-500 flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 bg-purple-600 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>

                            <label class="flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer">
                                <span class="text-sm text-gray-700">1 Day</span>

                                <div class="relative">
                                    <input type="radio" name="reminder" class="peer hidden">

                                    <div class="w-5 h-5 rounded-full border-2 border-purple-500 flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 bg-purple-600 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>

                            <label class="flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer">
                                <span class="text-sm text-gray-700">3 Day</span>

                                <div class="relative">
                                    <input type="radio" name="reminder" class="peer hidden">

                                    <div class="w-5 h-5 rounded-full border-2 border-purple-500 flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 bg-purple-600 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>

                            <label class="flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer">
                                <span class="text-sm text-gray-700">7 Day</span>

                                <div class="relative">
                                    <input type="radio" name="reminder" class="peer hidden">

                                    <div class="w-5 h-5 rounded-full border-2 border-purple-500 flex items-center justify-center">
                                        <div class="w-2.5 h-2.5 bg-purple-600 rounded-full hidden peer-checked:block"></div>
                                    </div>
                                </div>
                            </label>

                        </div>

                        <button class="mt-4 bg-purple-600 text-white text-xs px-4 py-2 rounded-lg flex items-center gap-2">
                            Add Custom Time +
                        </button>
                    </div>


                </div>

            </div>

        </div>

</div>
</main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".tab-btn");

        const account = document.getElementById("content-account");
        const security = document.getElementById("content-security");
        const notification = document.getElementById("content-notification");

        function resetTabs() {
            tabs.forEach(tab => {
                tab.classList.remove("border-b-2", "border-primary", "text-primary", "font-bold");
                tab.classList.add("text-gray-400");
            });

            account.classList.add("hidden");
            security.classList.add("hidden");
            notification.classList.add("hidden");
        }

        document.getElementById("tab-account").addEventListener("click", function() {
            resetTabs();
            this.classList.add("border-b-2", "border-primary", "text-primary", "font-bold");
            account.classList.remove("hidden");
        });

        document.getElementById("tab-security").addEventListener("click", function() {
            resetTabs();
            this.classList.add("border-b-2", "border-primary", "text-primary", "font-bold");
            security.classList.remove("hidden");
        });

        document.getElementById("tab-notification").addEventListener("click", function() {
            resetTabs();
            this.classList.add("border-b-2", "border-primary", "text-primary", "font-bold");
            notification.classList.remove("hidden");
        });
    });
</script>
@endsection