<x-app-layout>
    <div class="w-10/12 bg-white font-semibold rounded-sm mx-auto mt-[20%] border py-6">
        <h1 class="ml-16 text-xl font-bold">Edit Task</h1>
        <br>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex items-center">
                <input class="ml-16 w-10/12 px-2 py-2 border rounded-md shadow-md border-gray-400 focus:border-gray-400 focus:outline-none" type="text" name="description" id="description" value="{{ $task->description }}">
                <a href="#"><button class="border rounded-sm bg-blue-500 text-xl font-bold text-white px-4 py-2 ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                  </svg>
                  </button></a>
            </div>

            <form action="{{ route('tasks.index') }}">
                <button class="ml-16 mt-4">Back</button>
            </form>
        </form>
    </div>
</x-app-layout>
