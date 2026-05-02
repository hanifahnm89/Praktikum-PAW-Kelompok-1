<form action="{{ route('login.check') }}" method="POST" class="space-y-5">
    @csrf
    <x-common.form-input name="email" label="Email" type="email" placeholder="Enter your Email" />
    <x-common.form-input name="password" label="Password" type="password" placeholder="Enter your Password" />

    <div class="flex items-center justify-between text-[11px]">
        <label class="flex items-center gap-2 cursor-pointer text-gray-500 font-medium">
            <input type="checkbox" class="w-3.5 h-3.5 rounded border-gray-300 accent-blue-600">
            Remember me
        </label>
        <a href="#" class="text-red-500 font-bold">Forgot Password</a>
    </div>

    <button type="submit" 
        class="w-full bg-[#2D3E8B] text-white py-4 rounded-xl font-bold">
    Login
</button>

</form>