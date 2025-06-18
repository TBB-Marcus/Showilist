<x-app-layout title="">



<div class="w-screen grid grid-cols-1 grid-rows-1 items-center justify-items-center">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-130 h-210 mt-20 rounded-xl bg-contrast flex flex-col justify-between items-center">
            @if (request()->has('register'))
                <h1 class="text-textbase font-bold text-center mt-20 text-3xl">Sign up to SHOWilist</h1>
                <form method="POST" action="{{ route('register') }}" class="flex flex-col items-center justify-center flex-1">
                    @csrf
                    <input type="text" name="username" placeholder="Username" class="w-100 h-12 mt-20 bg-default pl-5 rounded-md">
                    <input type="text" name="email" placeholder="Email" class="w-100 h-12 mt-5 bg-default pl-5 rounded-md">
                    <input type="password" name="password" placeholder="Password" class="w-100 h-12 mt-5 bg-default pl-5 rounded-md">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-100 h-12 mt-5 bg-default pl-5 rounded-md">
                    <button type="submit" value="info" class="w-40 h-15 rounded-full mt-40 bg-gradient-to-r from-sky-400 to-blue-500 hover:scale-110 transition-all cursor-pointer shadow-2xl">Register!</button>
                </form>
                <a href="/auth?login" class="text-center w-full mb-8 text-textbase/50 hover:text-texthover cursor-pointer">Already have a user? <u>Log In</u></a>
            @else
                <h1 class="text-textbase font-bold text-center mt-20 text-3xl">Log in to SHOWilist</h1>
                <form method="POST" action="{{ route('login') }}" class="flex flex-col items-center justify-center flex-1">
                    @csrf
                    <input type="text" name="email" placeholder="Email" class="w-100 h-12 mt-20 bg-default pl-5 rounded-md">
                    <input type="password" name="password" placeholder="Password" class="w-100 h-12 mt-5 bg-default pl-5 rounded-md">
                    <span class="mt-5"><input type="checkbox" name="remember"><label class="text-textbase text-sm pl-2">Remember me</label></span>
                    <button type="submit" class="w-40 h-15 rounded-full mt-40 bg-gradient-to-r from-sky-400 to-blue-500 hover:scale-110 transition-all cursor-pointer shadow-2xl">Log in!</button>
                </form>
                <a href="/auth?register" class="text-center w-full mb-8 text-textbase/50 hover:text-texthover cursor-pointer">Don't have a user? <u>Register</u></a>
            @endif
        </div>
    </div>
</div>

</x-app-layout>
