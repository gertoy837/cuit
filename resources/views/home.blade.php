<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cuit App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="w-[50%] mx-auto py-10">
        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-xl font-semibold text-shadow-blue-600">
                Hello, {{ Auth::user()->name }}
            </h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>

        <!-- Textarea and Button -->
        <div class="bg-white p-6 rounded-xl shadow mb-8">
            <form method="POST" action="{{ route('cuit.post') }}">
                @csrf
                <textarea
                    class="w-full border border-gray-300 rounded-lg p-4 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                    max="150" name="content" required rows="4" placeholder="What's on your mind?"></textarea>
                <div class="text-right mt-4">
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">
                        Cuit
                    </button>
                </div>
            </form>
        </div>

        <!-- Post Cards -->
        <div class="space-y-6">
            @forelse ($posts as $post)
                <!-- Example Post -->
                <div class="bg-white p-5 rounded-xl shadow">
                    <p class="text-gray-700 text-2xl">{{ $post->content }}</p>
                    <div class="text-sm text-gray-400 mt-2">Posted by {{ $post->user->name }} -
                        {{ $post->created_at->diffForHumans() }}
                    </div>

                    <!-- Reply Button -->
                    <button onclick="toggleReply(this)" class="mt-4 text-blue-600 hover:underline text-sm">
                        Reply
                    </button>

                    <!-- Reply Section (hidden by default) -->
                    <div class="mt-4 hidden">
                        <textarea
                            class="w-full border border-gray-300 rounded-lg p-3 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="2" placeholder="Write a reply..."></textarea>
                        <div class="text-right mt-2">
                            <button
                                class="bg-green-600 text-white px-4 py-1 rounded-full hover:bg-green-700 transition">
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white p-5 rounded-xl shadow text-center text-gray-600">Belum ada cuitan</div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Script for toggling reply section -->
    <script>
        function toggleReply(button) {
            const replyBox = button.nextElementSibling;
            replyBox.classList.toggle("hidden");
        }

        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: "success",
                confirmedButtonText: 'OK'
            })
        @endif
    </script>

</body>

</html>
