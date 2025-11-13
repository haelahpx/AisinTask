<header class="bg-white shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">

        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Welcome,
            </h1>
            <h1 class="text-sm text-gray-500">
                {{ auth()->user()->name }}
            </h1>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="px-4 py-2 bg-black text-white text-sm rounded hover:bg-gray-700 transition">
                Logout
            </button>
        </form>

    </div>
</header>