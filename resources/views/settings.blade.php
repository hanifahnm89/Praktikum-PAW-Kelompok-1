@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">

    <x-sidebar />

    <main class="ml-64 flex-1 p-12">

        <!-- TITLE -->
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

                <form action="{{ route('settings.update') }}"
                    method="POST">

                    @csrf

                    <!-- PROFILE -->
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

                    <!-- FORM -->
                    <div class="grid grid-cols-2 gap-x-8 gap-y-6">

                        <x-common.form-input
                            name="first_name"
                            label="First name"
                            value="{{ $user->first_name }}"
                            placeholder="First name" />

                        <x-common.form-input
                            name="last_name"
                            label="Last name"
                            value="{{ $user->last_name }}"
                            placeholder="Last name" />

                        <x-common.form-input
                            name="email"
                            label="Email"
                            value="{{ $user->email }}"
                            placeholder="Email" />

                        <x-common.form-input
                            name="role"
                            label="Role"
                            value="{{ $user->role }}"
                            placeholder="Role" />

                        <x-common.form-input
                            name="phone"
                            label="Phone Number"
                            value="{{ $user->phone }}"
                            placeholder="Phone Number" />

                        <x-common.form-input
                            name="country"
                            label="Country"
                            value="{{ $user->country }}"
                            placeholder="Country" />

                    </div>

                    <!-- BUTTON -->
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

                <!-- PASSWORD -->
                <div class="mb-14">

                    <div class="flex items-start justify-between mb-6">

                        <div>

                            <h2 class="text-xl font-semibold text-gray-800 mb-1">
                                Password
                            </h2>

                            <p class="text-sm text-gray-400">
                                Your current password is protected and hidden
                            </p>

                        </div>

                        <button
                            onclick="openPasswordModal()"
                            class="bg-primary text-white px-6 py-3 rounded-xl text-sm font-semibold hover:opacity-90 transition">

                            Update Password

                        </button>

                    </div>

                    <!-- PASSWORD BOX -->
                    <div class="border border-gray-200 rounded-2xl px-6 py-5 flex items-center justify-between">

                        <div>

                            <p class="text-xs text-gray-400 mb-2">
                                Current Password
                            </p>

                            <p class="text-2xl tracking-[6px] text-gray-700">
                                ••••••••••••
                            </p>

                            <!-- LAST CHANGED -->
                            <p class="text-xs text-gray-400 mt-2">

                                Last changed
                                {{ $user->password_updated_at
                ? \Carbon\Carbon::parse($user->password_updated_at)->format('d F Y')
                : 'Never'
            }}

                            </p>

                        </div>

                        <i class="ph ph-lock-key text-3xl text-primary"></i>

                    </div>

                    <!-- LOGIN ACTIVITY -->
                    <div>

                        <h2 class="text-xl font-semibold mb-2">
                            Account login activity
                        </h2>

                        <p class="text-sm text-gray-400 mb-5">
                            You’re currently logged in on these devices:
                        </p>

                        @foreach($sessions as $session)

                        @php
                        $isCurrent = session()->getId() === $session->id;
                        $agent = json_decode($session->user_agent);
                        @endphp

                        <div class="border border-gray-200 rounded-2xl p-5 flex items-center gap-4 mb-4">

                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">

                                <i class="ph ph-laptop text-2xl text-primary"></i>

                            </div>

                            <div>

                                <p class="font-semibold text-gray-800">
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

                            <!-- CUSTOM -->
                            <div id="customReminderList"
                                class="space-y-3 mt-3"></div>

                            <!-- BUTTON -->
                            <button
                                onclick="openModal()"
                                class="mt-4 bg-purple-600 text-white text-xs px-5 py-3 rounded-xl flex items-center gap-2 hover:bg-purple-700 transition font-semibold">

                                Add Custom Time +

                            </button>

                        </div>

                    </div>

                </div>

            </div>

    </main>

</div>

<!-- ================= REMINDER MODAL ================= -->
<div id="customReminderModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-[520px] rounded-[36px] p-10 relative">

        <!-- CLOSE -->
        <button onclick="closeModal()"
            class="absolute top-6 right-6 text-2xl text-gray-400 hover:text-gray-700">

            ×

        </button>

        <h2 class="text-3xl font-bold text-primary mb-3">
            Add Custom Reminder
        </h2>

        <p class="text-gray-500 text-sm mb-8">
            Set custom reminder time before your task starts.
        </p>

        <!-- TIME -->
        <div class="mb-6">

            <label class="block text-sm font-medium text-gray-600 mb-2">
                Time Amount
            </label>

            <input
                id="customTime"
                type="number"
                placeholder="Enter time"
                class="w-full border border-gray-300 rounded-xl px-5 py-4 outline-none focus:border-primary">

        </div>

        <!-- UNIT -->
        <div class="mb-10">

            <label class="block text-sm font-medium text-gray-600 mb-2">
                Select Unit
            </label>

            <select
                id="customUnit"
                class="w-full border border-gray-300 rounded-xl px-5 py-4 outline-none focus:border-primary">

                <option>Minutes</option>
                <option>Hours</option>
                <option>Days</option>

            </select>

        </div>

        <!-- BUTTON -->
        <div class="flex gap-4">

            <button
                onclick="closeModal()"
                class="w-1/2 bg-gray-100 text-gray-700 py-4 rounded-xl font-semibold">

                Cancel

            </button>

            <button
                onclick="addCustomReminder()"
                class="w-1/2 bg-primary text-white py-4 rounded-xl font-semibold hover:opacity-90">

                Add Reminder

            </button>

        </div>

    </div>

</div>

<!-- ================= PASSWORD MODAL ================= -->
<div id="passwordModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-[500px] rounded-[32px] p-8 relative">

        <!-- CLOSE -->
        <button
            onclick="closePasswordModal()"
            class="absolute top-5 right-5 text-2xl text-gray-400 hover:text-gray-600">

            ×

        </button>

        <h2 class="text-3xl font-bold text-primary mb-2">
            Update Password
        </h2>

        <p class="text-sm text-gray-400 mb-8">
            Create a new secure password for your account
        </p>

        <form action="{{ route('password.update') }}" method="POST">

            @csrf

            <!-- CURRENT -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Current Password
                </label>

                <input
                    type="password"
                    name="current_password"
                    placeholder="Enter current password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none focus:border-primary">

            </div>

            <!-- NEW -->
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    New Password
                </label>

                <input
                    type="password"
                    name="new_password"
                    placeholder="Enter new password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none focus:border-primary">

            </div>

            <!-- CONFIRM -->
            <div class="mb-8">

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="new_password_confirmation"
                    placeholder="Confirm new password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none focus:border-primary">

            </div>

            <!-- BUTTON -->
            <div class="flex gap-4">

                <button
                    type="button"
                    onclick="closePasswordModal()"
                    class="w-1/2 bg-gray-100 text-gray-700 py-3 rounded-xl font-semibold">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="w-1/2 bg-primary text-white py-3 rounded-xl font-semibold hover:opacity-90">

                    Save Password

                </button>

            </div>

        </form>

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

    // ================= REMINDER MODAL =================

    function openModal() {

        const modal = document.getElementById('customReminderModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

    }

    function closeModal() {

        const modal = document.getElementById('customReminderModal');

        modal.classList.remove('flex');
        modal.classList.add('hidden');

    }

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
                checked
                class="w-5 h-5 accent-purple-600 cursor-pointer rounded-full">
        `;

        container.prepend(item);

        closeModal();

        document.getElementById('customTime').value = '';

    }

    // ================= PASSWORD MODAL =================

    function openPasswordModal() {

        const modal = document.getElementById('passwordModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

    }

    function closePasswordModal() {

        const modal = document.getElementById('passwordModal');

        modal.classList.remove('flex');
        modal.classList.add('hidden');

    }
</script>

@endsection