    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="mb-3">
                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                    Create Post
                </button>
            </div>
            @if ($isOpen)
            @include('livewire.post.create')
            @endif
            @if (session()->has('success'))
            @if ($isNotif)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                <strong class="font-bold">Holy smokes!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg wire:click="hideNotif()" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
            @endif
            @endif

            <table class="table-fixed w-full text-center">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="py-3">#</th>
                        <th class="py-3">Title</th>
                        <th class="py-3">Desc</th>
                        <th class="py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                    <tr>
                        <td class="py-3">{{ $loop->iteration }}</td>
                        <td class="py-3">{{ $post->title }}</td>
                        <td class="py-3">{{ $post->desc }}</td>
                        <td class="py-3">
                            <button wire:click="edit({{ $post->id }})" class="bg-green-500 hover:bg-green-700 text-white text-sm font-bold py-1 px-4 rounded">
                                Edit
                            </button>
                            <button wire:click="delete({{ $post->id }})" class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-4 rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td colspan="4" class="text-sm py-2">Empty</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>