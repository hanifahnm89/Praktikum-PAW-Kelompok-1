@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <x-sidebar />

    <main class="ml-64 flex-1 p-12">

        <h2 class="text-3xl font-bold text-primary mb-8">
            Settings
        </h2>

        <!-- MAIN CARD -->
        <div class="bg-white rounded-[32px] p-10 shadow-sm border border-gray-100">

            <!-- TAB -->
            <div class="flex gap-10 border-b border-gray-100 mb-10">

                <button id="tab-account"
                    class="tab-btn pb-4 border-b-2 border-primary text-primary font-bold text-sm">
                    Account Setting
                </button>

                <button id="tab-security"
                    class="tab-btn pb-4 text-gray-400 font-bold text-sm">
                    Login & Security
                </button>

                <button id="tab-notification"
                    class="tab-btn pb-4 text-gray-400 font-bold text-sm">
                    Notifications
                </button>

            </div>

            <!-- ================= ACCOUNT ================= -->
            <div id="content-account">

                <form action="#" method="POST">

                    <div class="mb-10">

                        <p class="text-gray-500 text-xs font-bold mb-4">
                            Your Profile Picture
                        </p>

                        <label class="w-28 h-28 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition">

                            <i class="ph ph-image-plus text-3xl text-gray-300 mb-1"></i>

                            <span class="text-[10px] text-gray-300 font-medium text-center px-2">
                                Upload your photo
                            </span>

                            <input type="file" class="hidden">

                        </label>

                    </div>

                    <div class="grid grid-cols-2 gap-x-8 gap-y-6">

                        <x-common.form-input
                            label="Full name"
                            placeholder="Please enter your full name" />

                        <x-common.form-input
                            label="Username"
                            placeholder="Please enter your username" />

                        <x-common.form-input
                            label="Email"
                            placeholder="Please enter your email" />

                        <x-common.form-input
                            label="Role"
                            placeholder="Please enter your role" />

                        <!-- PHONE -->
                        <div class="relative w-full">

                            <label class="absolute -top-2.5 left-4 bg-white px-1.5 text-[11px] text-gray-400 font-medium z-10">
                                Phone number
                            </label>

                            <div class="flex border border-gray-300 rounded-lg overflow-hidden focus-within:border-primary transition">

                                <span class="bg-gray-50 px-4 py-3 text-gray-400 text-sm border-r border-gray-100">
                                    +62
                                </span>

                                <input type="text"
                                    placeholder="Please enter your phone number"
                                    class="w-full px-4 py-3 outline-none text-sm placeholder:text-gray-200">

                            </div>

                        </div>

                        <x-common.form-input
                            label="Country"
                            placeholder="Please enter your country" />

                    </div>

                    <div class="flex items-center gap-8 mt-12">

                        <button type="submit"
                            class="bg-primary text-white px-10 py-3 rounded-xl font-bold text-sm shadow-lg hover:opacity-90 transition">

                            Update Profile

                        </button>

                        <button type="reset"
                            class="text-gray-400 font-bold text-sm hover:text-gray-600 transition">

                            Reset

                        </button>

                    </div>

                </form>

            </div>

            <!-- ================= SECURITY ================= -->
            <div id="content-security" class="hidden">

                <!-- CHANGE PASSWORD -->
                <div class="mb-10">

                    <h2 class="text-lg font-semibold mb-1">
                        Change Password
                    </h2>

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

                <!-- LOGIN ACTIVITY -->
                <div class="mb-10">

                    <h2 class="text-lg font-semibold mb-1">
                        Account login activity
                    </h2>

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

            </div>

            <!-- ================= NOTIFICATION ================= -->
            <div id="content-notification" class="hidden">

                <div class="grid grid-cols-2 gap-10">

                    <!-- LEFT -->
                    <div>

                        <h3 class="text-lg font-semibold mb-4">
                            Email Notification
                        </h3>

                        <div class="space-y-4 mb-10">

                            @foreach(['Task Reminders','Upcoming deadline','Product Update'] as $item)

                            <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">

                                <span class="text-sm">
                                    {{ $item }}
                                </span>

                                <div class="relative">

                                    <input type="checkbox"
                                        class="sr-only peer"
                                        checked>

                                    <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-[#6d3df5] transition"></div>

                                    <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>

                                </div>

                            </label>

                            @endforeach

                        </div>

                        <!-- PUSH -->
                        <h3 class="text-lg font-semibold mb-4">
                            Push Notification
                        </h3>

                        <div class="space-y-4">

                            @foreach(['Task assigned to you','Task due soon','Task complete'] as $item)

                            <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">

                                <span class="text-sm">
                                    {{ $item }}
                                </span>

                                <div class="relative">

                                    <input type="checkbox"
                                        class="sr-only peer"
                                        checked>

                                    <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-[#6d3df5] transition"></div>

                                    <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>

                                </div>

                            </label>

                            @endforeach

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div>

                        <h3 class="font-semibold text-gray-800 mb-4">
                            Reminder Settings
                        </h3>

                        <!-- DEFAULT -->
                        <div id="reminderList" class="space-y-3">

                            @foreach(['10 Minutes','30 Minutes','1 Hour','6 Hours','12 Hours','1 Day','3 Days','7 Days'] as $item)

                            <label class="flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer">

                                <span class="text-sm text-gray-700">
                                    {{ $item }}
                                </span>

                                <input
                                    type="checkbox"
                                    class="w-5 h-5 accent-purple-600 cursor-pointer rounded-full">

                            </label>

                            @endforeach

                        </div>

                        <!-- CUSTOM RESULT -->
                        <div id="customReminderList"
                            class="space-y-3 mt-3"></div>

                        <!-- BUTTON -->
                        <button
                            onclick="openModal()"
                            class="mt-4 bg-purple-600 text-white text-xs px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-purple-700 transition">

                            Add Custom Time +

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </main>
</div>

<<<<<<< HEAD
        <!-- NOTIFICATION CONTENT -->
        <div id="content-notification" class="hidden bg-white rounded-[32px] p-10 shadow-sm border border-gray-100">
=======
<!-- ================= MODAL ================= -->
<div id="customReminderModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
>>>>>>> e36a333b9ecb01483c870dce597133429f1d57df

    <div class="bg-white w-[520px] rounded-[36px] p-10 relative">

        <!-- BACK -->
        <button onclick="closeModal()"
            class="absolute top-6 left-6 text-3xl text-purple-700">

            ←

        </button>

        <h2 class="text-4xl font-bold text-purple-800 mt-12 mb-3">
            Add custom reminder
        </h2>

<<<<<<< HEAD
                            <div class="relative">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-primary transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>
=======
        <p class="text-gray-600 text-sm leading-relaxed mb-10">
            Set a specific interval to receive notifications before your task starts.
        </p>
>>>>>>> e36a333b9ecb01483c870dce597133429f1d57df

        <!-- TIME -->
        <div class="mb-6">

<<<<<<< HEAD
                            <div class="relative">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-primary transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Product Update</span>

                            <div class="relative">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-primary transition"></div>
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
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-primary transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Task due soon</span>

                            <div class="relative">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-primary transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                        <label class="flex justify-between items-center border rounded-xl px-5 py-4 cursor-pointer">
                            <span class="text-sm">Task complete</span>

                            <div class="relative">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-300 rounded-full peer-checked:bg-primary transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-0.5 left-0.5 transition peer-checked:translate-x-5"></div>
                            </div>
                        </label>

                    </div>

                </div>

                <!-- RIGHT -->
                <div>

                    <h3 class="font-semibold text-gray-800 mb-4">Reminder Settings</h3>

                    <div class="space-y-3">

                        @foreach(['10 Minutes','30 Minutes','1 Hour','1 Day','3 Day','7 Day'] as $item)
                        <label class="flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer">

                            <span class="text-sm text-gray-700">{{ $item }}</span>

                            <!-- RADIO ASLI -->
                            <input
                                type="radio"
                                name="reminder"
                                class="w-5 h-5 accent-primary cursor-pointer"
                                {{ $loop->first ? 'checked' : '' }}>

                        </label>
                        @endforeach

                    </div>

                    <button class="mt-4 bg-primary text-white text-xs font-bold px-6 py-2 rounded-lg flex items-center gap-4">
                        Add Custom Time +
                    </button>

                </div>
            </div>
=======
            <label class="block text-gray-500 text-lg mb-2">
                Time amount
            </label>

            <input
                id="customTime"
                type="number"
                placeholder="Time amount"
                class="w-full border border-gray-300 rounded-xl px-5 py-4 outline-none focus:border-purple-600">
>>>>>>> e36a333b9ecb01483c870dce597133429f1d57df

        </div>

        <!-- UNIT -->
        <div class="mb-10">

            <label class="block text-gray-500 text-lg mb-2">
                Select unit
            </label>

            <select
                id="customUnit"
                class="w-full border border-gray-300 rounded-xl px-5 py-4 outline-none focus:border-purple-600">

                <option>Minutes</option>
                <option>Hours</option>
                <option>Days</option>

            </select>

        </div>

        <!-- BUTTON -->
        <div class="flex gap-4">

            <button onclick="closeModal()"
                class="w-1/2 bg-gray-200 text-gray-700 py-4 rounded-xl font-semibold">

                Cancel

            </button>

            <button
                onclick="addCustomReminder()"
                class="w-1/2 bg-purple-700 text-white py-4 rounded-xl font-semibold">

                Add reminder

            </button>

        </div>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const tabs = document.querySelectorAll(".tab-btn");

        const account = document.getElementById("content-account");
        const security = document.getElementById("content-security");
        const notification = document.getElementById("content-notification");

        function resetTabs() {

            tabs.forEach(tab => {

                tab.classList.remove(
                    "border-b-2",
                    "border-primary",
                    "text-primary"
                );

                tab.classList.add("text-gray-400");

            });

            account.classList.add("hidden");
            security.classList.add("hidden");
            notification.classList.add("hidden");

        }

        // ACCOUNT
        document.getElementById("tab-account")
            .addEventListener("click", function() {

                resetTabs();

                this.classList.add(
                    "border-b-2",
                    "border-primary",
                    "text-primary"
                );

                account.classList.remove("hidden");

            });

        // SECURITY
        document.getElementById("tab-security")
            .addEventListener("click", function() {

                resetTabs();

                this.classList.add(
                    "border-b-2",
                    "border-primary",
                    "text-primary"
                );

                security.classList.remove("hidden");

            });

        // NOTIFICATION
        document.getElementById("tab-notification")
            .addEventListener("click", function() {

                resetTabs();

                this.classList.add(
                    "border-b-2",
                    "border-primary",
                    "text-primary"
                );

                notification.classList.remove("hidden");

            });

    });

    // OPEN MODAL
    function openModal() {

        const modal = document.getElementById('customReminderModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

    }

    // CLOSE MODAL
    function closeModal() {

        const modal = document.getElementById('customReminderModal');

        modal.classList.remove('flex');
        modal.classList.add('hidden');

    }

    // ADD REMINDER
    function addCustomReminder() {

        const time = document.getElementById('customTime').value;
        const unit = document.getElementById('customUnit').value;

        if (!time) return;

        const container = document.getElementById('customReminderList');

        const item = document.createElement('label');

        item.className =
            "flex justify-between items-center border rounded-xl px-4 py-3 cursor-pointer";

        item.innerHTML = `
            <span class="text-sm text-gray-700">
                ${time} ${unit}
            </span>

            <input
                type="checkbox"
                class="w-5 h-5 accent-purple-600 cursor-pointer rounded-full">
        `;

        
        container.prepend(item);

        closeModal();

        document.getElementById('customTime').value = '';

    }
</script>
@endsection