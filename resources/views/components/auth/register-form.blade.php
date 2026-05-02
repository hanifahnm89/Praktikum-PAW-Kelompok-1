<form action="{{ route('register.store') }}" method="POST" class="space-y-4">
    @csrf    
    <div class="grid grid-cols-2 gap-4">
        <x-common.form-input name="first_name" label="First Name" placeholder="Fill your First Name" />
        <x-common.form-input name="last_name" label="Last Name" placeholder="Fill your Last Name" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <x-common.form-input name="email" label="Email" type="email" placeholder="Enter Your Email" />
        <x-common.form-input name="phone" label="Phone Number" placeholder="Enter your Phone Number" />
    </div>

    <x-common.form-input name="role" label="Role" placeholder="Enter your Role" />
    <x-common.form-input name="country" label="Country" placeholder="Choose your Country" />
    <x-common.form-input name="password" label="Password" type="password" placeholder="Enter your Password" />
    <x-common.form-input name="password_confirmation" label="Confirm Password" type="password" placeholder="Confirm Password" />

    <label class="flex items-center gap-2 cursor-pointer text-[10px] text-gray-500 font-medium py-2">
        <input type="checkbox" class="w-3.5 h-3.5 rounded border-gray-300">
        <span>I agree to all the <span class="text-red-500 font-bold">Terms</span> and <span class="text-red-500 font-bold">Privacy Policies</span></span>
    </label>

    <button type="submit" 
        class="w-full bg-[#2D3E8B] text-white py-4 rounded-xl font-bold">
    Create account
</button>
</form>