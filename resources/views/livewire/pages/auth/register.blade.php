<div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full max-w-md bg-white shadow-xl rounded-xl p-8">
        <h1 class="text-3xl font-bold text-center mb-6">Register</h1>

        <form wire:submit.prevent="register" class="space-y-5">

            <div class="flex flex-col">
                <label for="name" class="mb-1 text-sm font-medium text-gray-700">
                    Name
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    wire:model.defer="name"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2
                           focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                    required
                />
                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="email" class="mb-1 text-sm font-medium text-gray-700">
                    Email
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    wire:model.defer="email"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2
                           focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                    required
                />
                @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="password" class="mb-1 text-sm font-medium text-gray-700">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    wire:model.defer="password"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2
                           focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                    required
                />
                @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full py-2 rounded-lg bg-blue-600 text-white font-semibold
                       hover:bg-blue-700 transition"
            >
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-gray-700">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                Login here
            </a>
        </p>
    </div>
</div>
