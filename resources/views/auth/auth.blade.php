<x-app-layout title="Auth">
    <div class="mt-50 flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-contrast rounded-xl shadow-xl p-8">
            @if ($errors->any())
                <div class="mb-4">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-500 text-center">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if (request()->has('register'))
                <h1 class="text-textbase font-bold text-center text-3xl mb-8">Sign up for SHOWilist</h1>
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <input type="text" name="username" placeholder="Username" class="w-full h-12 bg-default pl-5 rounded-md">
                    <input type="text" name="email" placeholder="Email" class="w-full h-12 bg-default pl-5 rounded-md">
                    <input type="password" name="password" placeholder="Password" class="w-full h-12 bg-default pl-5 rounded-md">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full h-12 bg-default pl-5 rounded-md">
                    <button type="submit" class="w-full h-12 rounded-full bg-gradient-to-r from-sky-400 to-blue-500 hover:scale-105 transition-transform shadow-lg text-white font-semibold">Register!</button>
                </form>
                <a href="/auth?login" class="block text-center mt-6 text-textbase/50 hover:text-texthover">Already have a user? <u>Log In</u></a>
            @else
                <h1 class="text-textbase font-bold text-center text-3xl mb-8">Log in to SHOWilist</h1>
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <input type="text" name="email" placeholder="Email" class="w-full h-12 bg-default pl-5 rounded-md">
                    <input type="password" name="password" placeholder="Password" class="w-full h-12 bg-default pl-5 rounded-md">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        <label class="text-textbase text-sm">Remember me</label>
                    </div>
                    <button type="submit" class="w-full h-12 rounded-full bg-gradient-to-r from-sky-400 to-blue-500 hover:scale-105 transition-transform shadow-lg text-white font-semibold">Log in!</button>
                </form>
                <a href="/auth?register" class="block text-center mt-6 text-textbase/50 hover:text-texthover">Don't have a user? <u>Register</u></a>
            @endif
        </div>
    </div>
</x-app-layout>
